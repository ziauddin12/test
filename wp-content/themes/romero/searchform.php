<?php
/**
 * Generic search form template
 *
 * @package Romero
 */
?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label>
		<span class="screen-reader"><?php _e( 'Search for...', 'romero' ); ?></span>
		<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" class="search-field text" placeholder="<?php echo esc_attr_x( 'Search...', 'search input placeholder text', 'romero' ); ?>" />
	</label>
	<button class="search-submit">&#62464;<span class="screen-reader"><?php echo __( 'Search', 'romero' ); ?></span></button>
</form>