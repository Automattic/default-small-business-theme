<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Business
 */

get_header(); ?>
	
	<main id="primary" class="site-main">

		<header class="page-header">
			<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'business_theme' ); ?></h2>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'business_theme' ); ?></p>

			<?php
				get_search_form();
			?>
		</div><!-- .page-content -->

	</main><!-- #primary -->

<?php
get_footer();
