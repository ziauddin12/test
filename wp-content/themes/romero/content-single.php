<?php
/**
 * Single post content
 *
 * @package Romero
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="entry entry-single">
<?php
	the_content();

	get_template_part( 'inc/post-meta' );

	edit_post_link();

	wp_link_pages( array(
		'before' => '<div class="pagination">',
		'after'  => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
	) );

?>
	</section>
<?php
	romero_contributor();
?>
</article>
