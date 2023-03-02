<?php
/**
 * Welcome section.
 *
 * @package ControlBlockPatterns
 */

?>
<h1>
	<?php
	$plugin_data = get_plugin_data( CTRLBP_DIR . 'control-block-patterns.php', false, false );

	// Translators: %s - Plugin name.
	echo esc_html( sprintf( __( 'Welcome to %s', 'control-block-patterns' ), $plugin_data['Name'] ) );
	?>
</h1>
<div class="about-text">
	<?php esc_html_e( 'Control Block Patterns is a free Gutenberg and GDPR-compatible WordPress plugin and framework that makes quick work of customizing a website with—you guessed it—meta boxes, Theme Options and custom fields in WordPress. Follow the instruction below to get started!', 'control-block-patterns' ); ?>
</div>
<a target="_blank" class="wp-badge" href="https://controlpatterns.net/"><?php echo esc_html( $plugin_data['Version'] ); ?></a>
