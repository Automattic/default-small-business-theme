<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Business
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function business_theme_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'primary',
		'render'    => 'business_theme_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'author-bio'         => true,
		'author-bio-default' => false,
		'post-details' => array(
			'stylesheet' => 'business_theme-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'business_theme_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function business_theme_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', 'archive' );
		endif;
	}
}

/**
 * Return early if Author Bio is not available.
 */
function business_theme_photos_author_bio() {
	if ( function_exists( 'jetpack_author_bio' ) ) {
		jetpack_author_bio();
	}
}

/**
 * Author Bio Avatar Size.
 */
function business_theme_photos_author_bio_avatar_size() {
	return 60; // in px
}
add_filter( 'jetpack_author_bio_avatar_size', 'business_theme_photos_author_bio_avatar_size' );
