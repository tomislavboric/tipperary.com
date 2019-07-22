<?php
/**
 * The default template for displaying page content
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<section class="content-contact"> 
	<div class="grid-container">
		
		<?php /*
		<header>
			<h2 class="content-contact__title section__title"><?php _e( 'Contact', 'foundationpress' ); ?></h2>
		</header>
		*/ ?>

		<div class="grid-x grid-margin-x">

			<div class="cell medium-6 large-6 content-contact__data">
				<?php require locate_template ( 'template-parts/content-contact-data.php'  );  ?> 
			</div> 

			<div class="cell medium-6 large-6 content-contact__map"> 
				<?php require locate_template ( 'template-parts/content-map.php' ); ?> 			        
			</div> 

		</div> 

	</div>
</section>