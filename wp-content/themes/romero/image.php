<?php
/**
 * Attachment template
 *
 * @package Romero
 */

	get_header();
?>
	<header class="entry-archive-header header-overlap">
		<div class="container">
			<?php the_title( '<h1 class="entry-title">&#8216;', '&#8217;</h1>' ); ?>
		</div>
	</header>

	<div class="container hfeed">
		<div class="main">
			<div class="main-content showcase">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<section class="entry">
				<div class="attachment-image"><?php echo wp_get_attachment_link( $post->ID, 'romero-attachment-fullsize' ); ?></div>
<?php

	if ( has_excerpt() ) {
?>
				<div class="entry-caption">
					<?php the_excerpt(); ?>
				</div>
<?php
	}

	$metadata = wp_get_attachment_metadata();
	printf( __( '<p class="post-meta-data">Published <time class="entry-date" datetime="%1$s" pubdate>%2$s</time> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a></p>', 'romero' ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( wp_get_attachment_url() ),
		$metadata['width'],
		$metadata['height'],
		esc_url( get_permalink( $post->post_parent ) ),
		get_the_title( $post->post_parent )
	);
?>
				<nav id="image-navigation" class="site-navigation" role="navigation">
					<span class="image-previous"><?php previous_image_link( 'romero-attachment' ); ?></span>
					<span class="image-parent"><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rev="attachment" class="attachment-parent"><?php _e( '&lsaquo; Return to post', 'romero' ); ?></a></span>
					<span class="image-next"><?php next_image_link( 'romero-attachment' ); ?></span>
				</nav><!-- #image-navigation -->
			</section>
<?php
	get_template_part( 'inc/comments' );
?>
		</article>
<?php
	get_footer();