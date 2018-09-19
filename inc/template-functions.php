<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Smallbusinesstheme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function smallbusinesstheme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'smallbusinesstheme_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function smallbusinesstheme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'smallbusinesstheme_pingback_header' );

/*
 * Add an extra li to our nav for our priority+ navigation to use
 */
function smallbusinesstheme_add_ellipses_to_nav( $items, $args ) {
	if ( 'menu-1' === $args->theme_location ) :
		$items .= '<li id="more-menu" class="menu-item menu-item-has-children">';
		$items .= '<button class="dropdown-toggle" aria-expanded="false">';
		$items .= '<span class="screen-reader-text">'. esc_html( 'More', 'smallbusinesstheme' ) . '</span>';
		$items .= smallbusinesstheme_get_icon_svg( 'more_horiz' );
		$items .= '</button>';
		$items .= '<ul class="sub-menu"></ul></li>';
	endif;
	return $items;
}
add_filter( 'wp_nav_menu_items', 'smallbusinesstheme_add_ellipses_to_nav', 10, 2 );

function smallbusinesstheme_add_ellipses_to_page_menu( $items, $args ) {
	$items .= '<li id="more-menu" class="menu-item menu-item-has-children">';
	$items .= '<button class="dropdown-toggle" aria-expanded="false">';
	$items .= '<span class="screen-reader-text">'. esc_html( 'More', 'smallbusinesstheme' ) . '</span>';
	$items .= smallbusinesstheme_get_icon_svg( 'more_horiz' );
	$items .= '</button>';
	$items .= '<ul class="sub-menu"></ul></li>';
    return $items;
}
add_filter( 'wp_list_pages', 'smallbusinesstheme_add_ellipses_to_page_menu', 10, 2 );
