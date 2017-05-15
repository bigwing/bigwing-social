<?php
/*
Plugin Name: BigWing Social
Plugin URI: https://bigwing.com/nest/social
Description: Social options for WordPress.
Author: BigWing
Version: 1.0.0
Requires at least: 4.7
Author URI: https://bigwing.com
Contributors: ronalfy
Text Domain: bigwing-social
Domain Path: /languages
*/

add_action( 'after_setup_theme', 'bwsocial_register_nav_menu', 10, 1 );
/**
 * Register navigation menus for usage.
 *
 * Register navigation menus for usage.
 *
 * @since 1.0.0
 */
function bwsocial_register_nav_menu() {
	register_nav_menu( 'bw-social', __( 'Social Media Menu', 'bigwing-social' ) );
}