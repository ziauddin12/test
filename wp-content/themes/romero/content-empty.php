<?php
/**
 * No content
 *
 * @package Romero
 */
?>
<article class="no-results not-found">
	<h1 class="entry-title"><?php _e( 'Nothing Found', 'romero' ); ?></h1>
	<section class="entry">
<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) {
?>
		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'romero' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php
	} if ( is_search() ) {
?>
		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'romero' ); ?></p>
<?php
		get_search_form();
	} else {
?>
		<p><?php _e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'romero' ); ?></p>
<?php
		get_search_form();
	}
?>
	</section>
</article>