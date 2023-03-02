<?php
/**
 * Tabs navigation.
 *
 * @package ControlBlockPatterns
 */

?>
<h2 class="nav-tab-wrapper">
	<a href="#getting-started" class="nav-tab nav-tab-active"><?php esc_html_e( 'Getting Started', 'control-block-patterns' ); ?></a>
	<?php do_action( 'ctrlbp_about_tabs' ); ?>
	<a href="#support" class="nav-tab"><?php esc_html_e( 'Support', 'control-block-patterns' ); ?></a>
</h2>
