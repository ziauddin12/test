<?php
/**
 * WordPress.com specific functionality
 *
 * @package Romero
 */


/**
 * theme colours for wp.com custom functionality
 *
 * @global string $themecolors
 */
function romero_theme_colors() {

	global $themecolors;

	/**
	 * Set a default theme color array for WP.com.
	 *
	 * @global array $themecolors
	 */
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => 'ffffff',
			'border' => 'eeeeee',
			'text'   => '000000',
			'link'   => '4a90e2',
			'url'    => 'aaaaaa',
		);
	}

}

add_action( 'after_setup_theme', 'romero_theme_colors' );


/**
 * Dequeue Google Fonts if Custom Fonts are being used instead.
 */
function romero_dequeue_fonts( $fonts ) {

	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
	    $custom_fonts = TypekitData::get( 'families' );

		if ( $custom_fonts && $custom_fonts['headings']['id'] ) {
			unset( $fonts['oswald'] );
	    }

		if ( $custom_fonts && $custom_fonts['body-text']['id'] ) {
			unset( $fonts['open-sans'] );
		}
	}

	return $fonts;

}

add_action( 'romero_fonts', 'romero_dequeue_fonts', 11 );