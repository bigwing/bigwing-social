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

require( 'customizer.php' );

add_action( 'plugins_loaded', function() {
	load_plugin_textdomain( 'bigwing-social', false, basename( dirname( __FILE__ ) ) . '/languages' );
} );

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
		'a.co'            => 'amazon',
		'amazon.com'      => 'amazon',
		'behance.net'     => 'behance',
		'blogger.com'     => 'blogger',
		'codepen.io'      => 'codepen',
		'dribbble.com'    => 'dribble',
		'dropbox.com'     => 'dropbox',
		'eventbrite.com'  => 'eventbrite',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'ghost.org'       => 'ghost',
		'github.com'      => 'github',
		'github.io'       => 'github',
		'plus.google.com' => 'google-plus',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'medium.com'      => 'medium',
		'path.com'        => 'path',
		'pinterest.com'   => 'pinterest-alt',
		'getpocket.com'   => 'pocket',
		'polldaddy.com'   => 'polldaddy',
		'reddit.com'      => 'reddit',
		'skype.com'       => 'skype',
		'spotify.com'     => 'spotify',
		'squarespace.com' => 'squarespace',
		'stumbleupon.com' => 'stumbleupon',
		'telegram.org'    => 'telegram',
		'tumblr.com'      => 'tumblr-alt',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter-alt',
		'vimeo.com'       => 'vimeo',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'youtu.be'        => 'youtube',
		'youtube.com'     => 'youtube'
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

function bwsocial_get_options_defaults() {
	$defaults = array(
		'icon_size'         => '24',
		'fill_color'        => 'gray',
		'fill_color_custom' => '#767676',
		'text_color'        => '#FFFFFF'
	);
	return $defaults;
}

/**
 * Return SVG markup.
 *
 * Forked from twentyseventeen `twentyseventeen_get_svg`
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function bwsocial_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'bigwing-social' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an SVG icon filename.', 'bigwing-social' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'fallback'    => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA.
	$aria_labelledby = '';

	if ( $args['title'] ) {
		$aria_hidden     = '';
		$unique_id       = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
		}
	}
	
	/* Get Fill/Text Color */
	$options = get_option( 'bw_social' );
	$options = wp_parse_args( $options, bwsocial_get_options_defaults() );
	$css = array();
	if ( isset( $options[ 'fill_color' ] ) && 'custom' === $options[ 'fill_color' ] ) {
		$fill_color = $options[ 'fill_color_custom' ];
		$css[] = sprintf( 'fill: %s', $fill_color );
	}
	$css = implode( ';', $css );

	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img" style="' . esc_attr( $css ) . '">';

	// Display the title.
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

		// Display the desc only if the title is already set.
		if ( $args['desc'] ) {
			$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
		}
	}

	/*
	 * Display the icon.
	 *
	 * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
	 *
	 * See https://core.trac.wordpress.org/ticket/38387.
	 */
	$svg .= ' <use href="#' . esc_html( $args['icon'] ) . '" xlink:href="#' . esc_html( $args['icon'] ) . '"></use> ';

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
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
add_action( 'wp_footer', 'bwsocial_include_svg', 9999 );
function bwsocial_include_svg() {

	// Define SVG sprite file.
	$path = '/images/social-logos.svg';
	$svg_icons = rtrim( plugin_dir_path(__FILE__), '/' );
	if ( ! empty( $path ) && is_string( $path) ) {
		$svg_icons .= '/' . ltrim( $path, '/' );
	}

	/**
	 * Filter BW Social Icons Sprite.
	 *
	 * @since 1.0.0
	 *
	 * @param string Absolute directory path to SVG sprite
	 */
	$svg_icons = apply_filters( 'bigwing/bigwing_social/sprite', $svg_icons );

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		echo '<div style="position: absolute; height: 0; width: 0; overflow: hidden;">';
		require_once( $svg_icons );
		echo '</div>';
	}
}

/**
 * Whether a menu is a social menu or not.
 *
 * Whether a menu is a social menu or not.
 *
 * @since 1.0.0
 * 
 *
 * @param array $args Array of wp_nav_menu() arguments. 
 */
function bwsocial_maybe_has_menu( $args ) {
	
	// Check theme location
	$location = isset( $args[ 'theme_location' ] ) ? $args[ 'theme_location' ] : false;
	if ( $location && 'bw-social' === $location ) {
		return true;
	}
	
	// Check Menu
	$menu = isset( $args[ 'menu' ] ) ? $args[ 'menu' ] : false;
	if ( ! $menu ) {
		return false;
	}
	
	// Get menu object
	$menu_object = wp_get_nav_menu_object( $menu );
	if ( $menu_object && is_a( $menu_object, 'WP_Term' ) ) {
		$menu_locations = get_nav_menu_locations();
		foreach( $menu_locations as $menu_location => $menu_term_id ) {
			if ( 'bw-social' === $menu_location && $menu_term_id === $menu_object->term_id ) {
				return true;
			}
		}
	}
	
	return false;
}

/**
 * Add screen reader span around link text in menu item.
 *
 * Add screen reader span around link text in menu item.
 *
 * @since 1.0.0
 * 
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param WP_Post  $item  Menu item data object.
 * @param int      $depth Depth of menu item. Used for padding.
 */
add_filter( 'nav_menu_item_args', 'bwsocial_nav_menu_item_args', 20, 3 );
function bwsocial_nav_menu_item_args( $args, $item, $depth ) {
	if ( ! bwsocial_maybe_has_menu( (array)$args ) ) {
		return $args;
	}
	
	// Wrap text in span so it can be hidden via CSS
	$args->link_before = '<span class="bw-screen-reader-text">';
	$args->link_after = '</span>';
	
	// Add SVG Icons
	$maybe_icons = bwsocial_get_icons();
	foreach ( $maybe_icons as $attr => $value ) {
		if ( false !== strpos( $item->url, $attr ) ) {
			$args->link_after .= bwsocial_get_svg( array( 'icon' => esc_attr( $value ) ) );
		}
	}
	
	return $args;
}

/**
 * Add menu-level classes.
 *
 * Add menu-level classes.
 *
 * @since 1.0.0
 * 
 * @see wp_nav_menu()
 *
 * @param array $args Array of wp_nav_menu() arguments. 
 */
add_filter( 'wp_nav_menu_args', 'bwsocial_nav_menu_args', 20, 1 );
function bwsocial_nav_menu_args( $args ) {
	
	if ( ! bwsocial_maybe_has_menu( $args ) ) {
		return $args;
	}
	
	$options = get_option( 'bw_social' );
	$options = wp_parse_args( $options, bwsocial_get_options_defaults() );
	
	$classes = array(
		'bw-social-menu',
		'bw-social-icon-' . absint( $options[ 'icon_size' ] ),
		'bw-social-fill-' . esc_attr( $options[ 'fill_color' ] )
	);
	$args[ 'container_class' ] .= ' ' . implode( ' ', $classes );
	$args[ 'container_class' ] = ltrim( $args[ 'container_class' ], ' ' );
	return $args;
}

/**
 * Register navigation menus for usage.
 *
 * Register navigation menus for usage.
 *
 * @since 1.0.0
 */
add_action( 'after_setup_theme', 'bwsocial_register_nav_menu', 10, 1 );
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