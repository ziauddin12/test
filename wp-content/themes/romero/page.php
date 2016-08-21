<?php
/**
 * Single page template
 *
 * @package Romero
 */

	get_header();

	if ( get_the_post_thumbnail( get_the_ID() ) ) {
		get_template_part( 'content', 'featured-main' );
	} else {
?>
	<header class="entry-header header-overlap">
		<div class="container">
<?php
	the_title( '<h1 class="entry-title">', '</h1>' );
?>
		</div>
	</header>
<?php
	}
?>

	<div class="container hfeed">
		<div class="main">

			<div class="main-content article">
<?php

	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();
			get_template_part( 'content-page' );
			get_template_part( 'inc/comments' );

		}
	} else {
		get_template_part( 'content-empty' );
	}

?>
			</div>
<?php
	get_sidebar();

	get_footer();
