<?php
/**
 * Header Template
 *
 * @package Romero
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a href="#main-content" class="screen-reader-shortcut"><?php esc_html_e( 'Skip to content', 'romero' ); ?></a>
<header class="masthead" role="banner">
	<div class="container" id="header-wrapper">
		<div class="action-wrapper">
			<div class="branding">
				<h1 class="site-title">
					<?php if ( function_exists( 'jetpack_the_site_logo' ) ) { jetpack_the_site_logo(); } ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'romero' ); ?>" class="site-title-link">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<p class="site-description">
					<?php bloginfo( 'description' ); ?>
				</p>
			</div>

			<div class="actions">
				<div class="secondary">
					<?php romero_social_links(); ?>
					<?php get_search_form(); ?>
				</div>

				<nav class="menu-primary menu" role="navigation">
					<h3 class="menu-toggle"><?php esc_html_e( 'Menu', 'romero' ); ?></h3>
<?php
	if ( romero_sidebar_menu_active() ) {
?>
					<a href="#" id="sidebar-menu-toggle"><span class="screen-reader-text"><?php esc_html_e( 'View Widgets', 'romero' ); ?></span></a>
<?php
	}

	wp_nav_menu( array(
		'theme_location' => 'primary',
		'menu_id' => 'nav',
		'menu_class' => 'menu-wrap',
		'container' => false,
	) );
?>
				</nav>
			</div>
		</div>
	</div>

	<div class="container">
<?php
	get_sidebar( 'menu' );
	romero_header();
	do_action( 'before' );
?>
	</div>
</header>
<!-- test -->