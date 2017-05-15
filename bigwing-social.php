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

// Register the default nav menu for the plugin
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

add_action( 'wp_enqueue_scripts', 'bwsocial_register_scripts' );

/**
 * Register styles for the menu.
 *
 * Register styles for the menu.
 *
 * @since 1.0.0
 */
function bwsocial_register_scripts() {
	wp_register_style( 'bwsocial', plugins_url( '/css/main.min.css', __FILE__ ), array(), '20170515', 'all' );
}