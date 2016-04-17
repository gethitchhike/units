<html>
<head>
<link href="./units/backend/Skeleton-2.0.4/css/normalize.css" rel='stylesheet' type='text/css'>
<link href="./units/backend/Skeleton-2.0.4/css/skeleton.css" rel='stylesheet' type='text/css'>
<script src="./units/backend/jquery-2.2.2.min.js" type="text/javascript"></script>
<script src="./units/backend/jquery.dataTables.min.js" type="text/javascript"></script>
<link href="./units/backend/jquery.dataTables.min.css" rel='stylesheet' type='text/css'>
</head>
<body>		
	<div class="container">
	<div class="row">
		<table id="posts" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Author</th>
            </tr>
        </thead>
      		<?php foreach($posts as $post):?>
      			<tr>
      				<td><a href="index.php?/editor/&post=<?php echo $post->Filename;?>"><?php echo $post->Filename;?></a></td>
      				<td><?php echo date("d.m.Y H:i:s",$post->Date);?></td>
      				<td><?php echo $post->Author->Name;?></td>
      			</tr>
      		<?php endforeach;?>
        </tbody>
    </table>
	</div>
	</div>
	<style>
		.columns{
			border:1px solid white;
		}
		.container{
			padding-top:5em;
		}
	</style>
	<script>
	$(document).ready(function() {
	    $('#posts').DataTable({
	    	"order":[]
	    });
	} );
	</script>
</body>
</html>