<?php
/**
 * Footer Sidebar
 * Only shows on posts and pages
 *
 * @package Romero
 */

	if ( is_singular() ) {
		if ( is_active_sidebar( 'sidebar-2' ) ) {
?>
<section class="sidebar sidebar-footer" id="sidebar-footer" role="complementary">
	<div class="container">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div>
</section>
<?php
		}
	}
