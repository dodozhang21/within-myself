<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @since Within Myself 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php get_sidebar( 'main' ); ?>

			<div class="site-info">
				<?php do_action( 'withinMyself_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'withinMyself' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'withinMyself' ); ?>"><?php printf( __( 'Proudly powered by %s', 'withinMyself' ), 'WordPress' ); ?></a> | <a href="<?php echo esc_url( __( 'http://regretless.com/', 'withinMyself' ) ); ?>" title="<?php esc_attr_e( 'Ying Zhang', 'withinMyself' ); ?>"><?php printf( __( 'Theme Within Myself by %s', 'withinMyself' ), 'Ying Zhang' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>