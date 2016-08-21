<?php
/**
 * Author post listing
 *
 * @package Romero
 */

	get_header();
	$user_id = get_query_var( 'author' );
?>
	<header class="entry-archive-header header-overlap">
		<div class="container">
			<h1 class="entry-title entry-archive-title">
				<?php _e( 'Author Archives','showcase' ); ?>
			</h1>
		</div>
	</header>

	<div class="container hfeed">
		<div class="main">
			<?php romero_contributor( $user_id ); ?>
			<div id="main-content" class="showcase main-content">
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