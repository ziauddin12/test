<?php
/**
 * Comments template.
 *
 * @package Romero
 */

	if ( post_password_required() ) {
		return;
	}
?>
<section class="content-comments">
<?php
	if ( have_comments() ) {
?>
	<h3 id="comments">
<?php
		printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'romero' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
?>
		<a href="#respond" title="<?php esc_attr_e( 'Leave a comment', 'romero' ); ?>">&raquo;</a>
	</h3>

	<ol class="comment-list" id="singlecomments">
<?php
		wp_list_comments( array(
			'avatar_size' => 50,
			'short_ping' => true,
			'callback' => 'romero_comments_layout',
		));
?>
	</ol>
<?php
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
?>
	<nav class="navigation comments-navigation">
		<h1 class="screen-reader"><?php _e( 'Comment navigation', 'romero' ); ?></h1>
		<div class="nav-links">
			<div class="nav-previous">
				<?php previous_comments_link( __( 'Older Comments', 'romero' ) ); ?>
			</div>
			<div class="nav-next">
				<?php next_comments_link( __( 'Newer Comments', 'romero' ) ); ?>
			</div>
		</div>
	</nav>
<?php
		}
	}

	if ( 'open' == $post->comment_status ) {
		comment_form();
	}
?>
</section>