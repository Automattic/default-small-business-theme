<?php
/**
 * Gutenbergtheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Gutenbergtheme
 */

if ( ! function_exists( 'smallbusinesstheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function smallbusinesstheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on smallbusinesstheme, use a find and replace
		 * to change 'smallbusinesstheme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'smallbusinesstheme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => __( 'Primary', 'smallbusinesstheme' ),
			'social' => __( 'Social Links', 'smallbusinesstheme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for Custom Logo.
		add_theme_support( 'custom-logo', array(
			'width'       => 600,
			'height'      => 300,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Adding support for core block visual styles.
		// add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		// add_theme_support( 'editor-styles' );

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'smallbusinesstheme' ),
				'slug'  => 'strong-blue',
				'color' => '#0073aa',
			),
			array(
				'name'  => __( 'Lighter Blue', 'smallbusinesstheme' ),
				'slug'  => 'lighter-blue',
				'color' => '#229fd8',
			),
			array(
				'name'  => __( 'Very Light Gray', 'smallbusinesstheme' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
			),
			array(
				'name'  => __( 'Very Dark Gray', 'smallbusinesstheme' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
			),
		) );
	}
endif;
add_action( 'after_setup_theme', 'smallbusinesstheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function smallbusinesstheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'smallbusinesstheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'smallbusinesstheme_content_width', 0 );

/**
 * Register Google Fonts
 */
function smallbusinesstheme_fonts_url() {
	$fonts_url = '';

	/*
	 *Translators: If there are characters in your language that are not
	 * supported by Noto Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$notoserif = esc_html_x( 'on', 'Noto Serif font: on or off', 'smallbusinesstheme' );

	if ( 'off' !== $notoserif ) {
		$font_families = array();
		$font_families[] = 'Noto Serif:400,400italic,700,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/**
 * Enqueue scripts and styles.
 */
function smallbusinesstheme_scripts() {

	wp_enqueue_style( 'gutenbergbase-style', get_stylesheet_uri() );

	wp_enqueue_style( 'smallbusinesstheme-blocks-style', get_template_directory_uri() . '/css/blocks.css' );

	wp_enqueue_style( 'smallbusinesstheme-fonts', smallbusinesstheme_fonts_url() );

	wp_enqueue_script( 'smallbusinesstheme-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'smallbusinesstheme-priority-navigation', get_template_directory_uri() . '/js/priority-navigation.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'smallbusinesstheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Screenreader text
	wp_localize_script( 'smallbusinesstheme-navigation', 'smallBusinessThemeScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'smallbusinesstheme' ),
		'collapse' => esc_html__( 'collapse child menu', 'smallbusinesstheme' ),
	) );

	// Icons
	wp_localize_script( 'smallbusinesstheme-navigation', 'smallBusinessThemeIcons', array(
		'dropdown' => smallbusinesstheme_get_icon_svg( 'expand_more' )
	) );

	// Menu toggle text
	wp_localize_script( 'smallbusinesstheme-navigation', 'smallBusinessThemeMenuToggleText', array(
		'menu'  => esc_html__( 'Menu', 'smallbusinesstheme' ),
		'close' => esc_html__( 'Close', 'smallbusinesstheme' ),
	) );


}
add_action( 'wp_enqueue_scripts', 'smallbusinesstheme_scripts' );

/**
 * Enqueue Gutenberg editor styles
 */
function smallbusinesstheme_editor_styles() {
	wp_enqueue_style( 'smallbusinesstheme-editor-style', get_template_directory_uri() . '/editor.css' );
}
add_action( 'enqueue_block_editor_assets', 'smallbusinesstheme_editor_styles' );

/**
 * Check whether the browser supports JavaScript
 */
function smallbusinesstheme_html_js_class() {
	echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
}
add_action( 'wp_head', 'smallbusinesstheme_html_js_class', 1 );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/inc/classes/svg-icons.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
