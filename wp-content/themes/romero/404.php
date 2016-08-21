<?php
/**
 * Error - file not found
 *
 * @package Romero
 */

	get_header();
?>
	<header class="entry-archive-header">
		<div class="container container-404">
			<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'romero' ); ?></h1>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'romero' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</header>

	<div class="container hfeed">
		<div class="main">
<?php
	get_footer();