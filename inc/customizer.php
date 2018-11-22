<?php
/**
 * business_theme Theme Customizer
 *
 * @package Business
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'business_theme_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'business_theme_customize_partial_blogdescription',
		) );
	}

	// add setting for hiding the front page title
	$wp_customize->add_setting( 'hide_front_page_title', array(
		'default'              => false,
		'type'                 => 'theme_mod',
		'transport'            => 'postMessage',
	) );

	$wp_customize->add_control( 'hide_front_page_title', array(
		'label'		=> esc_html__( 'Hide Front Page Title' ),
		'section'	=> 'static_front_page',
		'priority'	=> 10,
		'type'		=> 'checkbox',
		'settings'	=> 'hide_front_page_title',
	) );
}
add_action( 'customize_register', 'business_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function business_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function business_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_theme_customize_preview_js() {
	wp_enqueue_script( 'business_theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'business_theme_customize_preview_js' );

/**
 * Logo Resizer Awesomeness - Bringing logo resizing to the Customizer since 2017
 */
require get_template_directory() . '/inc/logo-resizer.php';

/**
 * Add an option to hide the front page title
 */
function business_theme_customize_hide_front_page_title() {

	$hide = get_theme_mod( 'hide_front_page_title', false );

	if ( true === $hide ) {

	echo <<< EOT
<style type="text/css">
	.home .entry-title {
		display: none;
	}

	.home .hentry {
		margin-top: 0;
	}

	.home .hentry .entry-content > *:first-child {
		margin-top: 0;
	}
</style>
EOT;
	}
}
add_action( 'wp_enqueue_scripts', 'business_theme_customize_hide_front_page_title' );