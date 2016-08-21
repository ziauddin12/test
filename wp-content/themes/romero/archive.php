<?php
/**
 * Archive Template
 *
 * @package Romero
 */

	get_header();
?>
	<header class="entry-archive-header header-overlap">
		<div class="container">
<?php
		the_archive_title( '<h1 class="entry-title entry-archive-title">', '</h1>' );
		the_archive_description( '<div class="category-description">', '</div>' );
?>
		</div>
	</header>

	<div class="container hfeed">
		<div class="main">
<?php
	if ( have_posts() ) {
?>
			<div id="main-content" class="showcase">
<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}

		the_posts_pagination();
?>
			</div>
<?php
	} else {
?>
			<div id="main-content" class="main-content">
<?php
		get_template_part( 'content-empty' );
?>
			</div>
<?php
	}

	get_footer();