<?php
/**
 * Full width page template
 * Template Name: Full Width
 *
 * @package Romero
 */

	get_header();
?>
	<header class="entry-header header-overlap">
		<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</header>

	<div class="container hfeed">
		<div class="main">

			<div class="main-content full-width">
<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content-page' );
		}
	}
?>
			</div>
<?php
	get_footer();