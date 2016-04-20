<?php

class Skeleton implements IPreUnit{
    private $theme ="simple";
    public function __construct(){
        global $blog;
        if (property_exists($blog,"Theme")){
            $this->theme = $blog->Theme;
        }
    }
    public function GetFiles(){
        return array("skeleton.php");
    }
    public function Requires(){
        return array("Posts","i18n");
    }
    public function GetVersion(){
    	return "0.2";
    }
	public function GetName(){
		return "Skeleton";
	}
    private function GetSitemapContent(){
        global $blog;
        $p = new Posts();
        $sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".
        "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
         xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
         xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";
        $posts = $p->Run();
        $sites = $p->Run(".smd");
        $entry = "<url>\n".
                "<loc>".$blog->URL."</loc>\n".
                "<lastmod>".date("Y-m-d",filectime(__CONTENTPATH__."blog.json"))."</lastmod>\n".
                "<changefreq>monthly</changefreq>\n".
                "<priority>1</priority>\n".
            "</url>\n";
        $sitemap .= $entry;
        
        foreach($posts as $post){
            $url = htmlspecialchars($blog->URL."?/post/&post=".urlencode($post->Filename));

            $entry = "<url>\n".
                    "<loc>".$url."</loc>\n".
                    "<lastmod>".date("Y-m-d",filectime(__CONTENTPATH__.$post->Filename))."</lastmod>\n".
                    "<changefreq>monthly</changefreq>\n".
                    "<priority>1</priority>\n".
                "</url>\n";
            $sitemap .= $entry;
        }
        foreach($sites as $site){
            $url = htmlspecialchars($blog->URL."?/post/&post=".urlencode($site->Filename));
            $entry = "<url>\n".
                    "<loc>".$url."</loc>\n".
                    "<lastmod>".date("Y-m-d",filectime(__CONTENTPATH__.$site->Filename))."</lastmod>\n".
                    "<changefreq>monthly</changefreq>\n".
                    "<priority>1</priority>\n".
                "</url>\n";
            $sitemap .= $entry;
        }
        $sitemap .="</urlset>\n";
        return $sitemap;
    }
    public function CreateSitemapIfNeeded(){
        $path =dirname(  __DIR__)."/sitemap.xml";
        $now = time();
        if (!file_exists($path) || $now - filemtime($path) > 60*60*24){
            return  file_put_contents($path,$this->GetSitemapContent());
        }
        else{
            return false;
        }
    }
    public function Run(){
    	global $router;
        $this->CreateSitemapIfNeeded();
        $router->Route("/",function($php) use ($router){
            global $blog;
            $p = new Posts();
            $posts = array_filter($p->Run(),function($p){
                return !$p->Hidden;
            });
            $query = null;
            if (isset($php->post->query)){
                $query = $php->post->query;
            }
            if (isset($php->get->query)){
                $query = $php->get->query;
            }
            
            if (!is_null($query)){
                $posts = array_filter($posts,function($p) use ($php,$query){
                    $needle = $query;
                    return \BTRString::Contains(strtolower($p->Title),$needle) || \BTRString::Contains(strtolower($p->Content),$needle);
                });
            }
            $sites = $p->Run(".smd");
            $title = $blog->Name;
            $innerContent = __DIR__."/".$this->theme."/latest.php";
            $postCount = count($posts);
            $currentSite = isset($php->get->site) ? (int)$php->get->site : 1;
          
            $allPageCount = $postCount/5.0;
            $fullPageCount = ceil($postCount/5.0);
            $min = 0;
            $max = $fullPageCount;
            //filter
            $offset = $currentSite == 1 ? 0 : ($currentSite -1)*5.0;
            $posts = array_slice($posts,$offset,$currentSite*5.0);
            
            require_once(__DIR__."/".$this->theme."/template.php");
        });
        $router->Route("/post/",function($php){
            global $blog;
            $p = new Posts();
            $posts = $p->Run();
            $sites = $p->Run(".smd");
            $data = array_merge($sites,$posts);
            $needle = urldecode($php->get->post);
            $selectedPosts = array_filter($data,function($p) use ($php,$needle){
                $r =  in_array($p->Filename, array($needle.".md",$needle.".smd"),true);
                return $r;
            });
            
            global $post;
            $post = null;
            if (count($selectedPosts) == 1){
                $post = array_shift($selectedPosts);
            }
            else{
                //TODO: 404
                $post = new \Post();
                $post->Title = "Entry not found";
                $post->Content="The you searched for does not exists!";
                $post->Date = strtotime("1970-01-01 00:00");
                $post->HTTPCode = 404;
            }
            $title = $post->Title. "-" .$blog->Name;
            $innerContent = __DIR__."/".$this->theme."/post.php";
            require_once(__DIR__."/".$this->theme."/template.php");
        },array("post"));   
    }
}