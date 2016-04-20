<?php global $blog;?>
<?php global $translation;?>
<?php $Parsedown = new Parsedown();?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Language" content="<?php echo $blog->Language;?>"> 
<?php
	global $bootstrap;
	$units = $bootstrap->GetUnitsByImplementation("IHeadUnit");
	foreach($units as $unit){
		$unit->Run();
	}
?>
<link href="./units/skeleton/simple/Skeleton-2.0.4/css/normalize.css" rel='stylesheet' type='text/css'>
<link href="./units/skeleton/simple/Skeleton-2.0.4/css/skeleton.css" rel='stylesheet' type='text/css'>
<link href="./units/skeleton/simple/simple.css" rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
<link rel="alternate" type="application/rss+xml" href="?/feed/" />
<title><?php echo $title;?></title>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="four columns sidebar">
			<div class="bloginfo">
				<h1><a href="<?php echo __USEDOTFORINDEX__ === "true"? ".":"index.php";?>">
				<?php if (count($blog->Authors) == 1 && !empty($blog->Authors[0]->Avatar)) :?>
					<img class="blogavatar" src="<?php echo $blog->Authors[0]->Avatar;?>">
				<?php elseif (property_exists($blog,"Image")) :?>
					<img class="blogavatar" src="<?php echo $blog->Image;?>">
				<?php endif;?>
				<?php echo $blog->Name;?></a></h1>
				<h5><?php echo $blog->Subtitle;?></h5>
				<ul class="inline">
					<li>&copy; <?php echo $blog->Copyright;?></li>
				<?php if (count($sites) != 0) :?>
					<?php foreach($sites as $site):?>
						<li><a href="?/post/<?php echo $site->WebFilename;?>/"><?php echo $site->Title;?></a></li>
					<?php endforeach;?>
					<li><a href="?/feed/">Feed</a></li>
				<?php endif;?>
				</ul>
			</div>
		</div>
		<div class="eight columns">
			<?php
				require_once $innerContent;
			?>
		</div>
	</div>
</div>
</body>
</html>