<?php
/**
 * Custom header codes
 *
 * @package Romero
 */

/**
 * Custom header image
 */
function romero_custom_header_support() {

	// Custom header image.
	$args = array(
		'default-text-color' => '000000',
		'random-default' => false,
		'width' => 1060,
		'height' => 200,
		'flex-height' => true,
		'header-text' => true,
		'uploads' => true,
		'wp-head-callback' => 'romero_colour_styles',
	);

	add_theme_support( 'custom-header', apply_filters( 'romero_custom_header', $args ) );

}

add_action( 'after_setup_theme', 'romero_custom_header_support' );


/**
 * Print custom header styles
 *
 * @return array
 */
function romero_colour_styles() {

?>
<style>
<?php
	if ( 'blank' == get_header_textcolor() ) {
?>
	.masthead .branding h1.site-title a.site-title-link,
	.masthead .branding .site-description { display:none; }
<?php
	} else {
?>
	.masthead h1.site-title a,
	.masthead h1.site-title a:hover,
	.masthead h2.site-description {
		color:#<?php echo get_header_textcolor(); ?>;
	}
<?php
	}
?>
</style>
<?php

	return true;

}
