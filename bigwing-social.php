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


/**
 * Register styles for the menu.
 *
 * Register styles for the menu.
 *
 * @since 1.0.0
 */
add_action( 'wp_enqueue_scripts', 'bwsocial_register_scripts', 10, 1 );
function bwsocial_register_scripts() {
	wp_enqueue_style( 'bwsocial', plugins_url( '/css/main.min.css', __FILE__ ), array(), '20170515', 'all' );
}

/**
 * Include SVG file in the footer.
 *
 * Include SVG file in the footer.
 *
 * @since 1.0.0
 * 
 * Forked from twentyseventeen `twentyseventeen_include_svg_icons` 
 */
function bwsocial_include_svg() {

	// Define SVG sprite file.
	$path = '/images/social-logos.svg';
	$svg_icons = rtrim( plugin_dir_path(__FILE__), '/' );
	if ( ! empty( $path ) && is_string( $path) ) {
		$svg_icons .= '/' . ltrim( $path, '/' );
	}

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		echo '<div style="position: absolute; height: 0; width: 0; overflow: hidden;">';
		require_once( $svg_icons );
		echo '</div>';
	}
}
add_action( 'wp_footer', 'bwsocial_include_svg', 9999 );




/**
 * Add social styles for menu item.
 *
 * Add social styles for menu item.
 *
 * @since 1.0.0
 * 
 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 * @param int      $depth   Depth of menu item. Used for padding. 
 */
//add_filter( 'nav_menu_css_class', 'bwsocial_nav_menu_css_class', 10, 4 );
function bwsocial_nav_menu_css_class( $classes, $item, $args, $depth ) {
	$location = isset( $args->theme_location ) ? $args->theme_location : false;
	if ( ! $location || 'bw-social' !== $location ) {
		return $args;
	}
	
	$url = $item->url;
	$url = parse_url( $url, PHP_URL_HOST );
	
	die( '<pre>' . print_r( $url, true ) );
}


