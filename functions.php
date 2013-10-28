<?php

class withinMyself_Theme {
	public function __construct() {
		// Late priority, to run after the parent theme's hook.
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ), 20 );
		add_action( 'customize_register', array( $this, 'customize_register' ), 20 );
	}

	public function after_setup_theme() {
		// Disable Twenty Thirteen's theme options page.
		remove_action( 'admin_menu', 'twentythirteen_theme_options_add_page' );
	}

	// Remove Twenty Thirteen's layout and color scheme customizer controls.
	public function customize_register( $wp_customize ) {
		$wp_customize->remove_section( 'twentythirteen_layout' );
		$wp_customize->remove_control( 'twentythirteen_color_scheme' );
	}
};

new withinMyself_Theme;

/* Filter to add author credit to Infinite Scroll footer */
function withinMyself_footer_credits( $credit ) {
	$credit = sprintf( __( '%3$s | Theme: %1$s by %2$s.', 'withinMyself' ), 'Within Myself', '<a href="http://regretless.com/" rel="designer">Ying Zhang</a>', '<a href="http://wordpress.org/" title="' . esc_attr( __( 'A Semantic Personal Publishing Platform', 'withinMyself' ) ) . '" rel="generator">Proudly powered by WordPress</a>' );
	return $credit;
}
add_filter( 'infinite_scroll_credit', 'withinMyself_footer_credits' );