<?php
/**
 * Post meta data
 *
 * @package Romero
 */
?>
	<div class="post-meta-data">
<?php
	romero_post_time();

	romero_comments_link();

	romero_post_author();

	romero_the_main_category();

	if ( is_singular() ) {
		get_template_part( 'inc/post-terms' );
	}
?>
	</div>