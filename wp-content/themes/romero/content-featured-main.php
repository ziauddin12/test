<?php
/**
 * Giant featured content image
 *
 * @package Romero
 */

	$styles = array();
	$image = romero_archive_image_url( get_the_ID(), 'romero-archive-featured' );

	if ( $image[0] ) {
		$styles[] = 'background-image:url(' . esc_url( $image[0] ) . ')';
	}

?>
<article id="post-<?php the_ID(); ?>" class="featured-post" style="<?php echo implode( '; ', $styles );?>" >
	<a href="<?php the_permalink(); ?>" class="permalink"><span class="screen-reader-text"><?php the_title(); ?></span></a>
	<section class="entry entry-archive">
		<div class="container">
<?php
	romero_the_main_category();

	if ( get_the_title() ) {
?>
			<h2 class="entry-title">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
<?php
	}
?>
		</div>
	</section>
</article>