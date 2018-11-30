<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Business Elegant
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_elegant_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'business_elegant_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function business_elegant_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'business_elegant_pingback_header' );

/*
 * Add an extra li to our nav for our priority+ navigation to use
 */
function business_elegant_add_ellipses_to_nav( $items, $args ) {
	if ( 'menu-1' === $args->theme_location ) :
		$items .= '<li id="more-menu" class="menu-item menu-item-has-children">';
		$items .= '<button class="dropdown-toggle" aria-expanded="false">';
		$items .= '<span class="screen-reader-text">'. esc_html( 'More', 'business-elegant' ) . '</span>';
		$items .= business_elegant_get_icon_svg( 'more_horiz' );
		$items .= '</button>';
		$items .= '<ul class="sub-menu"></ul></li>';
	endif;
	return $items;
}
add_filter( 'wp_nav_menu_items', 'business_elegant_add_ellipses_to_nav', 10, 2 );

function business_elegant_add_ellipses_to_page_menu( $items, $args ) {
	$items .= '<li id="more-menu" class="menu-item menu-item-has-children">';
	$items .= '<button class="dropdown-toggle" aria-expanded="false">';
	$items .= '<span class="screen-reader-text">'. esc_html( 'More', 'business-elegant' ) . '</span>';
	$items .= business_elegant_get_icon_svg( 'more_horiz' );
	$items .= '</button>';
	$items .= '<ul class="sub-menu"></ul></li>';
    return $items;
}
add_filter( 'wp_list_pages', 'business_elegant_add_ellipses_to_page_menu', 10, 2 );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
if ( ! function_exists( 'business_elegant_excerpt_more' ) ) :
    function business_elegant_excerpt_more( $more ) {
        $link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
            esc_url( get_permalink( get_the_ID() ) ),
            /* translators: %s: Name of current post. */
            sprintf( esc_html__( 'Continue reading %s', 'business-elegant' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
            );
        return ' &hellip; ' . $link;
    }
    add_filter( 'excerpt_more', 'business_elegant_excerpt_more' );
endif;
