<?php
/**
 * Jetpack Featured Content
 * See: http://jetpack.me/support/featured-content/
 *
 * @package Romero
 */

	if ( romero_has_featured_posts() ) {
		$featured_posts = romero_get_featured_posts( 7 );
		$current_post = 0;

		foreach ( $featured_posts as $post ) {
			$current_post ++;
			setup_postdata( $post );

			if ( count( $featured_posts ) > 1 && 2 == $current_post ) {
?>
	<section class="showcase container">
<?php
			}

			if ( 1 == $current_post ) {
				get_template_part( 'content', 'featured-main' );
			} else {
				get_template_part( 'content' );
			}
		}

		if ( count( $featured_posts > 1 ) ) {
?>
	</section>
<?php
		}

		wp_reset_postdata();
	}