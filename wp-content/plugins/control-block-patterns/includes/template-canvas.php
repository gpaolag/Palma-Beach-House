<?php 
/** Define ABSPATH as this file's directory */
include '../../../../wp-load.php'; 
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pattern Preview</title>	
	<?php wp_head(); ?>
</head>
<body>
	<div id="page">
		<?php 
		if( !empty($_GET['id']) ){
			$pattern = cbp_pattern_api(intval($_GET['id']));
			echo wp_unslash( $pattern['content']['rendered']);

		}		 
		?>
	</div>	
	<?php wp_footer(); ?>	
</body>
</html>