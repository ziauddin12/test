<?php
/**
 * Post terms
 *
 * @package Romero
 */

	// not applicable to all post types
	if ( 'post' !== get_post_type( get_the_ID() ) ) {
		return;
	}

	if ( ! get_the_tags() ) {

		$message = sprintf( __( 'Posted in %s', 'romero' ),
			get_the_category_list( _x( ', ', 'Category/ Tag list separator (includes a space after the comma)', 'romero' ) )
		);

	} else {

		$message = sprintf( __( 'Posted in %s, and tagged %s', 'romero' ),
			get_the_category_list( _x( ', ', 'Category/ Tag list separator (includes a space after the comma)', 'romero' ) ),
			get_the_tag_list( '#', _x( ', ', 'Category/ Tag list separator (includes a space after the comma)', 'romero' ), '' )
		);

	}

	if ( $message ) {
		echo '<span class="terms">' . $message . '</span>';
	}