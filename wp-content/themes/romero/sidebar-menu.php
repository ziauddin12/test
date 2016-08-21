<?php
/**
 * Menu Sidebar
 * opened through the expandable button in the header
 *
 * @package Romero
 */

	if ( romero_sidebar_menu_active() ) {
?>
<section class="sidebar sidebar-menu" id="sidebar-menu" role="complementary">
	<div class="container">
		<div class="column"><?php dynamic_sidebar( 'sidebar-3' ); ?></div>
		<div class="column"><?php dynamic_sidebar( 'sidebar-4' ); ?></div>
		<div class="column"><?php dynamic_sidebar( 'sidebar-5' ); ?></div>
	</div>
</section>
<?php
	}