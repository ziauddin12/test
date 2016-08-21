<?php
/**
 * List Testimonials on a page
 *
 * @package Romero
 */

	$testimonials = new WP_Query( array(
		'post_type'      => 'jetpack-testimonial',
		'orderby'        => 'rand',
		'posts_per_page' => 2,
		'no_found_rows'  => true,
	) );

	// only display if there are some testimonials to display
	if ( $testimonials->have_posts() ) {
?>
	<section class="testimonials-wrapper">
		<header>
			<h2 class="entry-title"><?php romero_testimonials_title(); ?></h2>
			<a href="<?php echo esc_url( home_url( 'testimonial/' ) ); ?>" class="button"><?php _e( 'View All &rsaquo;', 'romero' ); ?></a>
		</header>
		<div class="testimonials">
<?php
		while ( $testimonials->have_posts() ) {
			$testimonials->the_post();
			get_template_part( 'content-testimonial' );
		}
?>

		</div>
	</section>
<?php
	}

	wp_reset_postdata();