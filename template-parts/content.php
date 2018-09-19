<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Smallbusinesstheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<figure class="entry-featured-image">
		<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
		<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail();
		endif;
		?>
		</a>
	</figure>

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php smallbusinesstheme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'smallbusinesstheme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'smallbusinesstheme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php smallbusinesstheme_entry_footer(); ?>
		</div>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
