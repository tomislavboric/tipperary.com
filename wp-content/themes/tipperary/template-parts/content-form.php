<?php
/**
 * The default template for displaying page content
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<section id="form" class="content-form"> 
	<div class="grid-container align-middle">
		
		<header>
			<h2 class="content-contact__title section__title"><?php _e( 'Enquire', 'foundationpress' ); ?></h2>
		</header> 

		<div class="content-form__form grid-x grid-margin-x align-center">
		    <div class="cell medium-10">  
		       <?php echo do_shortcode( '[gravityform id="'.$form_id.'" title="false" description="false"]'); ?>
		    </div>
   		</div>
 	</div>
</section>