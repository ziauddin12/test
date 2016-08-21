<?php
/**
 * Sidebar template
 *
 * @package Romero
 */

	$class = '';
	if ( is_singular() ) {
		$class = 'overlap';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
?>
<div class="sidebar sidebar-main <?php echo $class; ?>" role="complementary">
<?php
	do_action( 'before_sidebar' );
	dynamic_sidebar( 'sidebar-1' );
?>
</div>
<?php
	}