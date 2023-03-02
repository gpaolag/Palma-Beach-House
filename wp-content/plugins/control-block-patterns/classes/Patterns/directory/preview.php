<?php 
/** Define ABSPATH as this file's directory */

include '../../../../../wp-load.php'; 
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Patten Preview</title>
	<style type="text/css">		

	</style>	
	<?php wp_head(); ?>

</head>
<body>


	



	<div id="page">
		<?php 
		if( !empty($_GET['post_id']) ){			
			echo wp_unslash( get_post_meta( $_GET['post_id'], 'content', true ) );
		}
		 
		?>
	</div>	

	<?php wp_footer(); ?>
	
</body>
</html>