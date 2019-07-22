<?php

$main_title 	 		      = get_the_title();
$content 				        = get_field( 'listing_description', $post->ID  );
$listing_website 		    = get_field( 'listing_website', $post->ID );
$listing_contact_email 	= get_field( 'listing_contact_email', $post->ID  );
$images                 = get_field( 'listing_images', $post->ID  );
$listing_telephone 		  = get_field( 'listing_telephone', $post->ID );
$listing_address	 	    = get_field( 'listing_address', $post->ID  );
$lat 					          = get_field('listing_lat', $post->ID);
$long 					        = get_field('listing_long', $post->ID);
$address 					      = get_field('listing_address', $post->ID);
$form_id                = '1';
$listing_tripadvisor 		= get_field('listing_tripadvisor', $post->ID);
?>

<!-- start: overview -->
<div class="grid-container align-middle">
  <div class="grid-x grid-margin-x">

    <!-- start: overview -->
    <div class="cell medium-6 large-6">
      <?php require locate_template ( 'template-parts/content-overview.php' );  ?>
    </div>
    <!-- end: overview -->

    <div class="listings-single__contact cell medium-6">

      <!-- start: conact information -->
      <?php require locate_template ( 'template-parts/content-contact-data.php'  );  ?>
      <!-- end: conact information -->

      <!-- start: button form popup -->
      <div class="cell align-center">
        <button class="button secondary button--large button--mt" data-open="ContactForm"><?php _e( 'Enquire now', 'foundationpress' ); ?></button>

        <!-- start: form -->
        <div class="reveal" id="ContactForm" data-reveal>
          <?php require locate_template ( 'template-parts/content-form.php' );  ?>
          <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- end: form -->

      </div>
      <!-- end: button form popup -->

    </div>

  </div>
</div>

<?php /*
<div class="enquire-cta">
  <div class="grid-container">

    <div class="section__header">
      <h2 class="section__title section__title--center section__title--white section__title">This is title</h2>
    </div>

    <div class="grid-x grid-padding-x">

      <div class="cell align-center">
        <button class="button secondary button--large" data-open="ContactForm"><?php _e( 'Enquire now', 'foundationpress' ); ?></button>

        <?php // start: form // ?>
        <div class="reveal" id="ContactForm" data-reveal>
          <?php require locate_template ( 'template-parts/content-form.php' );  ?>
          <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php // end: form // ?>

      </div>

    </div>
  </div>
</div>

*/
  ?>
  <div>
    <?php
    echo $listing_tripadvisor;
    ?>
  </div>

<div id="image-carousel">
  <div class="image-carousel__wrapper grid-x">
    <div class="image-carousel owl-carousel corner-arrows">
      <?php if( $images ): ?>

        <?php foreach( $images as $image ): ?>
          <div>
            <figure class="image-carousel__figure responsive-embed widescreen" style="background-image: url('<?php echo $image['sizes']['gallery-image-large']; ?>');">
              <meta itemprop="image" content="<?php echo $image['sizes']['large']; ?>">
            </figure>
          </div>
        <?php endforeach; ?>

        <?php else : ?>
          <div>
            <figure class="image-carousel__figure responsive-embed widescreen" style="background-image: url('//dummyimage.com/1170x730/4d494d/686a82.gif&text=placeholder+image+1');">
              <meta itemprop="image" content="<?php echo $image['sizes']['large']; ?>">
            </figure>
          </div>
          <div>
            <figure class="image-carousel__figure responsive-embed widescreen" style="background-image: url('//dummyimage.com/1170x730/4d494d/686a82.gif&text=placeholder+image+1');">
              <meta itemprop="image" content="<?php echo $image['sizes']['large']; ?>">
            </figure>
          </div>
          <div>
            <figure class="image-carousel__figure responsive-embed widescreen" style="background-image: url('//dummyimage.com/1170x730/4d494d/686a82.gif&text=placeholder+image+1');">
              <meta itemprop="image" content="<?php echo $image['sizes']['large']; ?>">
            </figure>
          </div>
          <div>
            <figure class="image-carousel__figure responsive-embed widescreen" style="background-image: url('//dummyimage.com/1170x730/4d494d/686a82.gif&text=placeholder+image+1');">
              <meta itemprop="image" content="<?php echo $image['sizes']['large']; ?>">
            </figure>
          </div>
          <div>
            <figure class="image-carousel__figure responsive-embed widescreen" style="background-image: url('//dummyimage.com/1170x730/4d494d/686a82.gif&text=placeholder+image+1');">
              <meta itemprop="image" content="<?php echo $image['sizes']['large']; ?>">
            </figure>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- start: contact data -->
  <?php require locate_template ( 'template-parts/content-map.php' ); ?>
  <!-- end: contact data -->

