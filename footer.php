<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business Elegant
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<?php business_elegant_social_menu(); ?>

		<p class="site-credits">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', '_s' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'business_elegant' ), 'WordPress' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %s', 'business_elegant' ), '<a href="https://github.com/default-small-business-theme/">Business Elegant</a>' );
			?>
		</p>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
