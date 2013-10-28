<?php

/*
 * Adding Theme Customizer option
 */
function withinMyself_customize( $wp_customize ) {
	$wp_customize->add_setting(
		// ID
		'twentythirteen_scheme',
		// Arguments array
		array(
			'default' => 'green',
			'type' => 'option'
		)
	);
	$wp_customize->add_control(
		// ID
		'color_scheme_control',
		// Arguments array
		array(
			'type' => 'radio',
			'label' => __( 'Color Scheme', 'withinMyself' ),
			'section' => 'colors',
			'choices' => array(
				'orange'	=> __( 'Orange (original)', 'withinMyself' ),
				'green'		=> __( 'Green', 'withinMyself' ),
				'purple'	=> __( 'Purple', 'withinMyself' ),
				'pink'		=> __( 'Pink', 'withinMyself' ),
				'red'		=> __( 'Red', 'withinMyself' ),
				'blue'		=> __( 'Blue', 'withinMyself' ),
				'yellow'	=> __( 'Yellow', 'withinMyself' ),
				'turquoise'	=> __( 'Turquoise', 'withinMyself' ),
				'sepia'		=> __( 'Sepia', 'withinMyself' ),
				'gray'		=> __( 'Gray', 'withinMyself' ),
				'coteazur'	=> __( 'Cote d\'Azur', 'withinMyself' )
			),
			// This last one must match setting ID from above
			'settings' => 'twentythirteen_scheme'
		)
	);

	$wp_customize->add_section( 'withinMyself_style' , array(
			'title'      => __( 'Styles', 'withinMyself' ),
			'priority'   => 30,
		) 
	);

	$wp_customize->add_setting(
		// ID
		'twentythirteen_style',
		// Arguments array
		array(
			'default' => 'traditional',
			'type' => 'option'
		)
	);

	$wp_customize->add_control(
		// ID
		'style_control',
		// Arguments array
		array(
			'type' => 'radio',
			'label' => __( 'Styles', 'withinMyself' ),
			'section' => 'withinMyself_style',
			'choices' => array(
				'traditional'	=> __( 'Traditional (original)', 'withinMyself' ),
				'scallop'		=> __( 'Scallop', 'withinMyself' )
			),
			// This last one must match setting ID from above
			'settings' => 'twentythirteen_style'
		)
	);
}
add_action( 'customize_register', 'withinMyself_customize' );


/*
 * Add color scheme body_class
 */
function withinMyself_body_classes( $classes ) {
	$classes[] = 'withinMyself-color-scheme-' . get_option( 'twentythirteen_scheme' );
	$classes[] = 'withinMyself-style-' . get_option( 'twentythirteen_style' );
	return $classes;	
}
add_filter( 'body_class', 'withinMyself_body_classes' );


/**
* Adds color scheme class to Tiny MCE editor
*/
function withinMyself_tiny_mce_classes( $thsp_mceInit ) {
    $thsp_mceInit['body_class'] .= ' withinMyself-color-scheme-' . get_option( 'twentythirteen_scheme' );
    $thsp_mceInit['body_class'] .= ' withinMyself-style-' . get_option( 'twentythirteen_style' );
 
    return $thsp_mceInit;
}
add_filter( 'tiny_mce_before_init', 'withinMyself_tiny_mce_classes' );


/**
 * Enqueue scripts and styles
 */
function withinMyself_styles() {

	$theme_data = get_theme_data( get_stylesheet_directory_uri() . '/style.css' );

	wp_enqueue_style( 'twentythirteen-within-myself-style', get_stylesheet_directory_uri() . "/css/" . get_option( 'twentythirteen_scheme' ) . ".css", array(), $theme_data['Version']);
}
add_action( 'wp_enqueue_scripts', 'withinMyself_styles' );

/*
 * Replace header images based on active color scheme
 */
 /*
function withinMyself_custom_header_setup() {

	$withinMyself_colors = array(
		'orange'		=> __( 'Orange', 'withinMyself' ),
		'green'			=> __( 'Green', 'withinMyself' ), 
		'purple'		=> __( 'Purple', 'withinMyself' ),
		'pink'			=> __( 'Pink', 'withinMyself' ),
		'red'			=> __( 'Red', 'withinMyself' ),
		'blue'			=> __( 'Blue', 'withinMyself' ),
		'yellow'		=> __( 'Yellow', 'withinMyself' ),
		'turquoise'		=> __( 'Turquoise', 'withinMyself' ),
		'sepia'			=> __( 'Sepia', 'withinMyself' ),
		'gray'			=> __( 'Gray', 'withinMyself' ),
		'coteazur'		=> __( 'Cote d\'Azur', 'withinMyself' ),
	);
	
	if ( '' != get_option( 'twentythirteen_scheme' ) ) :
		$color_scheme = get_option( 'twentythirteen_scheme' );
	else :
		$color_scheme = 'green';
	endif;
	
	// remove the header support
	remove_theme_support( 'custom-header' );
	
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '100e22',
		'default-image'          => '%2$s/images/headers/' . $color_scheme . '/circle.png',

		// Set height and width, with a maximum value for the width.
		'height'                 => 230,
		'width'                  => 1600,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'twentythirteen_header_style',
		'admin-head-callback'    => 'twentythirteen_admin_header_style',
		'admin-preview-callback' => 'twentythirteen_admin_header_image',
	);

	// add it back, with changes
	add_theme_support( 'custom-header', $args );


	// remove the default headers
	unregister_default_headers( array( 'circle', 'diamond', 'star' ) );

	// replace with new ones
	$new_headers = array();
	foreach ( $withinMyself_colors as $withinMyself_color_value => $withinMyself_color_name ) :
		$new_headers[$withinMyself_color_value . '-star'] = array(
			'url'           => '%2$s/images/headers/' . $withinMyself_color_value . '/star.png',
			'thumbnail_url' => '%2$s/images/headers/' . $withinMyself_color_value . '/star-thumbnail.png',
			'description'   => _x( 'Star', 'header image description', 'twentythirteen' )
		);
		$new_headers[$withinMyself_color_value . '-circle'] = array(
			'url'           => '%2$s/images/headers/' . $withinMyself_color_value . '/circle.png',
			'thumbnail_url' => '%2$s/images/headers/' . $withinMyself_color_value . '/circle-thumbnail.png',
			'description'   => _x( 'Circle', 'header image description', 'twentythirteen' )
		);
		$new_headers[$withinMyself_color_value . '-diamond'] = array(
			'url'           => '%2$s/images/headers/' . $withinMyself_color_value . '/diamond.png',
			'thumbnail_url' => '%2$s/images/headers/' . $withinMyself_color_value . '/diamond-thumbnail.png',
			'description'   => _x( 'Diamond', 'header image description', 'twentythirteen' )
		);
	endforeach;
	register_default_headers( $new_headers );
}
add_action( 'after_setup_theme', 'withinMyself_custom_header_setup', 11 );
*/


/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since withinMyself 1.0.2
 */
function withinMyself_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-withinMyself-customizer', get_stylesheet_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '1.0.2', true );
}
add_action( 'customize_preview_init', 'withinMyself_customize_preview_js' );
