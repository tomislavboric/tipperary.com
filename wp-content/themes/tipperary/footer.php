<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<?php
$blog_name = get_bloginfo( 'name', 'options' );
$footer_logo = get_field( 'footer_logo', 'options' );
$copyright_text = get_field( 'copyright_text', 'options' ); 
?>
<section class="footer footer--widgets">
	<div class="footer__container">
		<div class="footer__grid footer__grid--widgets">
			 
			<?php
				if(is_active_sidebar('footer-widgets')){
					dynamic_sidebar('footer-widgets');
				} 
			?>
			
		</div>
	</div>
</section>

<footer class="footer footer--bottom">
	<div class="footer__container">
		<div class="footer__grid">
			<?php echo $copyright_text; ?>
		</div>
	</div>
</footer>
</div>
<!--end: main content wrapper needed for mobile menu--> 
<?php wp_footer(); ?>

</body>
</html>
