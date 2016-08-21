<?php
/**
 * Template Name: Contributor Page
 *
 * @package Romero
 */

	get_header();
?>
	<header class="entry-header header-overlap">
		<div class="container">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	</header>

	<div class="container hfeed">
		<div class="main">
<?php
	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			$content = get_the_content();

			if ( $content ) {
?>
			<div class="main-content article">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<section class="entry entry-single">
<?php
				echo $content;

				edit_post_link();
?>
					</section>
<?php
			}

			get_template_part( 'content-contributors' );

			if ( comments_open() || '0' != get_comments_number() ) {
				comments_template( '', true );
			}
?>
				</article>
			</div>
<?php
		}

	} else {
		get_template_part( 'content-empty' );
	}

	get_sidebar();

	get_footer();