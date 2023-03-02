<?php
/**
 * Plugin Name: Control Block Patterns
 * Plugin URI:  https://controlpatterns.net
 * Description: Save & control your site Block Patterns in an organized way. 1400+ Predefined Blocks are ready to use. You can Register new Pattern Category, Block Patterns, You can also unregister Default Block Patterns & Pattern Categories. 
 * Version:     1.3.5.3
 * Author:      SenseFlame
 * Author URI:  https://controlpatterns.net
 * License:     GPL2+
 * Text Domain: control-block-patterns
 * Domain Path: /assets/languages/
 *
 * @package ControlPatterns
 */

if ( defined( 'ABSPATH' ) && ! defined( 'CTRLBP_VER' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
	new ControlPatterns\Loader();
}