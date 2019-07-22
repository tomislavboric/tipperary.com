<?php
/**
 * The default template for displaying page content
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<section class="content-overview">

  <?php if ( $main_title) : ?>
	<header class="content-overview__header">
		<h2 class="content-overview__title section__title"><?php _e('Overview', 'tipperary'); ?></h2>
	</header>
	<?php endif; ?>

  <div class="content-overview__content">
		<?php echo $content; ?>
	</div>

</section>

<?php //edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
