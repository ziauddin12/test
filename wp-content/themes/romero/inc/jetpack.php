<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Romero
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function romero_jetpack_init() {

	$settings = array(
		'container' => 'main-content',
		'footer_widgets' => romero_can_infinite_scroll(),
		'footer' => 'header-wrapper',
		'posts_per_page' => 16,
		'wrapper' => false,
	);

	add_theme_support( 'infinite-scroll', $settings );

	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'romero_get_featured_posts',
		'max_posts' => 7,
	) );

	add_theme_support( 'jetpack-responsive-videos' );

	add_theme_support( 'site-logo', array(
		'size' => 'romero-logo',
	) );

}

add_action( 'after_setup_theme', 'romero_jetpack_init' );


/**
 * Get featured posts using Jetpack Featured content
 */
function romero_get_featured_posts() {

	return apply_filters( 'romero_get_featured_posts', array() );

}


/**
 * Check if Jetpack Featured Content has any featured posts available
 *
 * @param type $minimum
 * @return boolean
 */
function romero_has_featured_posts( $minimum = 1 ) {

    if ( is_paged() ) {
        return false;
	}

    $minimum = absint( $minimum );
    $featured_posts = apply_filters( 'romero_get_featured_posts', array() );

    if ( ! is_array( $featured_posts ) ) {
        return false;
	}

    if ( $minimum > count( $featured_posts ) ) {
        return false;
	}

    return true;

}


/**
 * Count how many featured posts there are
 *
 * @return boolean
 */
function romero_count_featured_posts( ) {

    if ( is_paged() ) {
        return false;
	}

    $featured_posts = apply_filters( 'romero_get_featured_posts', array() );

    if ( ! is_array( $featured_posts ) ) {
        return 0;
	}

    return count( $featured_posts );

}


/**
 * can jetpack enable the auto loading infinite scroll
 */
function romero_can_infinite_scroll() {

	if ( class_exists( 'Jetpack_User_Agent_Info' ) && method_exists( 'Jetpack_User_Agent_Info', 'is_ipad' ) && Jetpack_User_Agent_Info::is_ipad() ) {
		return true;
	}

	if ( function_exists( 'jetpack_is_mobile' ) && jetpack_is_mobile() ) {
		return true;
	}

	return false;

}


/**
 * change default jetpack infinite scroll setttings
 */
function romero_infinite_scroll_js_settings( $settings ) {

	$settings['text'] = __( 'More Posts', 'romero' );

	return $settings;

}

add_filter( 'infinite_scroll_js_settings', 'romero_infinite_scroll_js_settings' );
