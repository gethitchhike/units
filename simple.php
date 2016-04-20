<?php

class Simple implements IPreUnit{
    public function GetFiles(){
        return array("simple.php","simple/Skeleton-2.0.4/css/normalize.css","simple/Skeleton-2.0.4/css/skeleton.css","simple/post.php","simple/latest.php","simple/simple.css","simple/template.php");
    }
    public function Requires(){
        return array();
    }
    public function GetVersion(){
        return "0.1";
    }
    public function GetName(){
        return "Simple theme";
    }
    public function Run(){
        global $blog;
        $blog->Theme = "simple"; 
    }
}
