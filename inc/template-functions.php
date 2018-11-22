<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Business
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_theme_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'business_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function business_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'business_theme_pingback_header' );

/*
 * Add an extra li to our nav for our priority+ navigation to use
 */
function business_theme_add_ellipses_to_nav( $items, $args ) {
	if ( 'menu-1' === $args->theme_location ) :
		$items .= '<li id="more-menu" class="menu-item menu-item-has-children">';
		$items .= '<button class="dropdown-toggle" aria-expanded="false">';
		$items .= '<span class="screen-reader-text">'. esc_html( 'More', 'business_theme' ) . '</span>';
		$items .= business_theme_get_icon_svg( 'more_horiz' );
		$items .= '</button>';
		$items .= '<ul class="sub-menu"></ul></li>';
	endif;
	return $items;
}
add_filter( 'wp_nav_menu_items', 'business_theme_add_ellipses_to_nav', 10, 2 );

function business_theme_add_ellipses_to_page_menu( $items, $args ) {
	$items .= '<li id="more-menu" class="menu-item menu-item-has-children">';
	$items .= '<button class="dropdown-toggle" aria-expanded="false">';
	$items .= '<span class="screen-reader-text">'. esc_html( 'More', 'business_theme' ) . '</span>';
	$items .= business_theme_get_icon_svg( 'more_horiz' );
	$items .= '</button>';
	$items .= '<ul class="sub-menu"></ul></li>';
    return $items;
}
add_filter( 'wp_list_pages', 'business_theme_add_ellipses_to_page_menu', 10, 2 );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
if ( ! function_exists( 'business_theme_excerpt_more' ) ) :
    function business_theme_excerpt_more( $more ) {
        $link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
            esc_url( get_permalink( get_the_ID() ) ),
            /* translators: %s: Name of current post. */
            sprintf( esc_html__( 'Continue reading %s', 'business_theme' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
            );
        return ' &hellip; ' . $link;
    }
    add_filter( 'excerpt_more', 'business_theme_excerpt_more' );
endif;
