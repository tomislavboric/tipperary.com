<?php

$main_title 	 		      = get_the_title();
$content 				        = get_field( 'listing_description', $post->ID  );
$listing_website 		    = get_field( 'listing_website', $post->ID );
$listing_contact_email 	= get_field( 'listing_contact_email', $post->ID  );
$listing_telephone 		  = get_field( 'listing_telephone', $post->ID );
$listing_address	 	    = get_field( 'listing_address', $post->ID  );
$lat 					          = get_field('listing_lat', $post->ID);
$long 					        = get_field('listing_long', $post->ID);
$address 					      = get_field('listing_address', $post->ID);
$form_id 				        = '1';
$listing_tripadvisor 		= get_field('listing_tripadvisor', $post->ID);
?>

<!-- start: overview -->
<div class="grid-container">
	<?php require locate_template ( 'template-parts/content-overview.php' );  ?>
</div>
<!-- end: overview -->


<!-- start: slider -->
<section class="listing-single__slider">
	<?php // get_template_part( 'template-parts/content-slider' );  // treba uzeti potojeći ?>
</section>
<!-- end: slider -->


<!-- start: form -->
<?php require locate_template ( 'template-parts/content-form.php' );  ?>
<!-- end: form -->


<!-- start: contact data -->
<?php require locate_template ( 'template-parts/content-contact.php' );   ?>
<!-- end: contact data -->
