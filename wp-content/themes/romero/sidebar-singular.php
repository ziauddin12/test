<?php
/**
 * Sidebar template for single posts
 *
 * @package Romero
 */
?>
<div class="sidebar sidebar-main" role="complementary">
<?php
	the_post_navigation( array(
		'prev_text' => __( '<b>Next Post</b> %title', 'romero' ),
		'next_text' => __( '<b>Previous Post</b> %title', 'romero' ),
	) );

	if ( is_active_sidebar( 'sidebar-1' ) ) {
?>
<?php
		do_action( 'before_sidebar' );
		dynamic_sidebar( 'sidebar-1' );

	}
?>
</div>
