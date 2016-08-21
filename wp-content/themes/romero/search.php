<?php
/**
 * Search results template
 *
 * @package Romero
 */

	get_header();
?>
	<header class="entry-archive-header header-overlap">
		<div class="container">
			<h1 class="entry-title entry-archive-title">
				<?php printf( __( 'Search results for &#8216;<em>%s</em>&#8217;', 'romero' ), get_search_query() ); ?>
			</h1>
		</div>
	</header>

	<div class="container hfeed">
		<div class="main">
			<div id="main-content" class="main-content showcase">
<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}

		the_posts_pagination();
	} else {
		get_template_part( 'content-empty' );
	}
?>
		</div>
<?php
	get_footer();
