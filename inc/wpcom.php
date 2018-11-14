<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Business Elegant
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function business_elegant_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => 'ffffff',
			'border' => 'e8ecf1',
			'text'   => '6e7381',
			'link'   => '121733',
			'url'    => '121733',
		);
	}

	// Add print stylesheet.
	add_theme_support( 'print-style' );
}
add_action( 'after_setup_theme', 'business_elegant_wpcom_setup' );

/**
 * Remove the widont filter because of the limited space for post/page title in the design.
 */
function business_elegant_widont() {
	remove_filter( 'the_title', 'widont' );
}
add_action( 'init', 'business_elegant_widont' );


