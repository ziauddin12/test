<?php
/**
 * Homepage Template
 *
 * @package Romero
 */

	get_header();

	get_template_part( 'inc/jetpack-featured-content' );
?>
	<div class="container hfeed">
		<div class="main">
<?php
	if ( have_posts() ) {
?>
			<div id="main-content" class="latest">
<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}

		the_posts_pagination();
?>
			</div>
<?php
		get_sidebar();

	} else {
		get_template_part( 'content-empty' );
	}

	get_footer();
