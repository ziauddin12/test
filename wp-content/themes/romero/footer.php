<?php
/**
 * Footer Template
 *
 * @package Romero
 */
?>
	</div>
</div>

<?php
	get_sidebar( 'footer' );
?>

<footer role="contentinfo" id="footer">
<?php
	romero_social_links();
?>
	<section class="footer-wrap">
		<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'romero' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'romero' ), 'WordPress' ); ?></a>
		<span class="sep"> | </span>
		<?php printf( __( 'Theme: %1$s by %2$s.', 'romero' ), 'Romero', '<a href="https://prothemedesign.com/" rel="designer">Pro Theme Design</a>' ); ?>
	</section>
</footer>

<?php wp_footer(); ?>

</body>
</html>