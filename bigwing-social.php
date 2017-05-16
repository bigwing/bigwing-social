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
 * Get list of SVG icons available.
 *
 * Get list of SVG icons available.
 *
 * @since 1.0.0
 * 
 * Forked from twentyseventeen `twentyseventeen_social_links_icons` 
 */
function bwsocial_get_icons() {
	// Supported social links icons.
	$social_links_icons = array(
		'a.co' => 'amazon',
		'amazon.com' => 'amazon',
		'behance.net' => 'behance',
		'blogger.com' => 'blogger',
		'codepen.io' => 'codepen',
		'dribbble.com' => 'dribble',
		'dropbox.com' => 'dropbox',
		'eventbrite.com' => 'eventbrite',
		'facebook.com' => 'facebook',
		'flickr.com' => 'flickr',
		'foursquare.com' => 'foursquare',
		'ghost.org' => 'ghost',
		'github.com' => 'github',
		'github.io' => 'github',
		'plus.google.com' => 'google-plus',
		'instagram.com' => 'instagram',
		'linkedin.com' => 'linkedin',
		'medium.com' => 'medium',
		'path.com' => 'path',
		'pinterest.com' => 'pinterest-alt',
		'getpocket.com' => 'pocket',
		'polldaddy.com' => 'polldaddy',
		'reddit.com' => 'reddit',
		'skype.com' => 'skype',
		'spotify.com' => 'spotify',
		'squarespace.com' => 'squarespace',
		'stumbleupon.com' => 'stumbleupon',
		'telegram.org' => 'telegram',
		'tumblr.com' => 'tumblr-alt',
		'twitch.tv' => 'twitch',
		'twitter.com' => 'twitter-alt',
		'vimeo.com' => 'vimeo',
		'wordpress.org' => 'wordpress',
		'wordpress.com' => 'wordpress',
		'youtu.be' => 'youtube',
		'youtube.com' => 'youtube'
	);

	/**
	 * Filter BW Social Icons.
	 *
	 * @since 1.0.0
	 *
	 * @param array $social_links_icons
	 */
	return apply_filters( 'bigwing/bigwing_social/icons', $social_links_icons );
}