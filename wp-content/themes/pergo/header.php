<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php if( function_exists('wp_body_open') ) wp_body_open(); ?>

	<?php get_template_part( 'header/preloader' ); ?>

	<!-- PAGE CONTENT
	============================================= -->	
	<div id="page" class="page">

		<?php get_template_part( 'header/'.PergoHeader::get_navbar_style() ); ?>
		<?php get_template_part( 'header/breadcrumbs' ); ?>
