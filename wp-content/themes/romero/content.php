<?php
/**
 * Generic content
 *
 * @package Romero
 */

	$image = get_the_post_thumbnail( get_the_ID(), 'romero-archive' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	if ( $image ) {
?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="thumbnail">
			<?php echo $image; ?>
		</a>
<?php
	}
?>
	<section class="entry entry-archive">
<?php
	romero_the_main_category();

	romero_comments_link();

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
		<div class="excerpt">
			<?php echo wpautop( get_the_excerpt() ); ?>
		</div>

		<p class="post-meta-data"><?php romero_post_author(); ?> <?php romero_post_time(); ?></p>
	</section>
</article>