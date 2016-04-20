<?php if (count($posts) > 0) :?>
<?php foreach($posts as $post) :?>
	<section class="post">
		<header class="major">
			<h2><a href="?/post/<?php echo $post->WebFilename;?>/"><?php echo $post->Title;?></a></h2>
			<div class="meta">
		<?php if (!is_Null($post->Author)) :?>
			<time class="published" datetime="<?php echo date("Y-m-d",$post->Date);?>"><?php echo date("d.m.Y,H:i",$post->Date);?></time>,
	 				<a href="#" class="author">
	 				<span class="name"><?php echo $post->Author->Name;?></span>
	 				</a>
		<?php endif;?>
		</div>
		</header>
		<p><?php echo \BTRString::SubStrClause(strip_tags($Parsedown->text($post->Content)),2,true)."...";?></p>
		<a href="?/post/<?php echo $post->WebFilename;?>/" class="button"><?php echo $translation["continuereading"];?></a>
	</section>
<?php endforeach;?>
	

<!-- Pagination -->
	<?php
		$suffix = isset($php->post->query) ? "&query=".$php->post->query : "";
		if (empty($suffix) && isset($php->get->query)){
			$suffix = "&query=".$php->get->query;
		}
		$canGoBack = $currentSite -1 != 0;
		$canGoForward = $currentSite < $max;

	?>
		<?php if ($canGoBack) :?>
		<a href="index.php?/&site=<?php echo $currentSite-1;?><?php echo $suffix;?>" class="	button  previous"><?php echo $translation["prevpage"];?></a>
		<?php endif;?>
		<?php if ($canGoForward) :?>
		<a href="index.php?/&site=<?php echo $currentSite+1;?><?php echo $suffix;?>" class="button  next"><?php echo $translation["nextpage"];?></a>
		<?php endif;?>
<?php endif;?>