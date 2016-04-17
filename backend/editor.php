<html>
<head>
<link href="./units/backend/Skeleton-2.0.4/css/normalize.css" rel='stylesheet' type='text/css'>
<link href="./units/backend/Skeleton-2.0.4/css/skeleton.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script   src="https://code.jquery.com/jquery-2.2.2.min.js"   integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="   crossorigin="anonymous"></script>
</head>
<body>		
	<div class="container">
	<div class="row">
	<div class="one columns"></div>
	<div class="ten columns">
	<form method="post" action="">
	<div class="row">
	<h1><?php echo $post->Title;?></h1>
	<div class="hidden">
		<a id="back" href="?/backend/"><i class="fa fa-arrow-left"></i></a>
		<a id="delete" href="?/delete/&post=<?php echo $post->Filename;?>"><i class="fa fa-trash-o"></i></a>
	</div>
	<textarea name="content"><?php echo $post->Content;?></textarea>
	<script>
	var simplemde = new SimpleMDE({
		toolbar:[
			{
				name: "save",
				action: save,
				className: "fa fa-hdd-o",
				title: "save",
			},
			{
				name: "back",
				action: back,
				className: "fa fa-arrow-left",
				title: "back",
			},	
			{
				name: "trash",
				action: trash,
				className: "fa fa-trash-o",
				title: "trash",
			},
			"|",
			{
				name: "bold",
				action: SimpleMDE.toggleBold,
				className: "fa fa-bold",
				title: "Bold",
			},
			{
				name: "italic",
				action: SimpleMDE.toggleItalic,
				className: "fa fa-italic",
				title: "Italic",
			},
			{
				name: "strikethrough",
				action: SimpleMDE.toggleStrikethrough,
				className: "fa fa-strikethrough",
				title: "Strikethrought",
			},			
			"|"
			,{
				name: "code",
				action: SimpleMDE.toggleCodeBlock,
				className: "fa fa-code",
				title: "Code",
			}
			,{
				name: "list-u",
				action: SimpleMDE.toggleUnorderedList,
				className: "fa fa-list-ul",
				title: "ul",
			},
			{
				name: "list-o",
				action: SimpleMDE.toggleOrderedList,
				className: "fa fa-list-ol",
				title: "ol",
			},			
			"|"
			,{
				name: "link",
				action: SimpleMDE.drawLink,
				className: "fa fa-link",
				title: "link",
			}
			,{
				name: "image",
				action: SimpleMDE.drawImage,
				className: "fa fa-picture-o",
				title: "image",
			},			
			"|"
			,{
				name: "undo",
				action: SimpleMDE.undo,
				className: "fa fa-undo no-disable",
				title: "undo",
			}
			,{
				name: "redo",
				action: SimpleMDE.redo,
				className: "fa fa-repeat no-disable",
				title: "redo",
			}
				
		],
		spellChecker:false,
		forceSync:true,
		autosave:{
			enabled:false
		}
	});
	function back(){		    
	  var href = $('#back').attr('href');
      window.location.href = href; 
	}
	function trash(){
      var href = $('#delete').attr('href');
      window.location.href = href; 
	}
	function save(){
		jQuery("#send").trigger("click");
	}
	</script>
	</div>
	<input id="send" type="submit" class="hidden">
	</form>
	</div>
	<div class="one columns"></div>
	</div>
	</div>
	<style>
		.columns{
			border:1px solid white;
		}
		.container{
			padding-top:5em;
		}
		.hidden{
			display:none !important;
		}
	</style>
</body>
</html>