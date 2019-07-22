<?php

// vars
$text_image_title = get_field( 'text_image_title' );
$text_image_text  = get_field( 'text_image_text' );
$text_image_button_text  = get_field( 'text_image_button_text' );
$text_image_button_link  = get_field( 'text_image_button_link' );
$text_image_image = get_field( 'text_image_image' );
?>
<section class="text-image">
  <div class="grid-container">
    <div class="grid-x grid-margin-x">

      <div class="text-image__content cell medium-6">

        <header class="text-image__content-header">
          <h2 class="text-image__content-title"><?php echo $text_image_title; ?></h2>
        </header>

        <div class="text-image__content-text">
          <?php echo $text_image_text; ?>
        </div>

        <?php if ( $text_image_button_text && $text_image_button_link ) : ?>
          <footer>
            <a href="<?php echo $text_image_button_link; ?>" class="button"><?php echo $text_image_button_text; ?></a>
          </footer>
        <?php endif; ?>

      </div>
      <div class=" cell medium-6">
        <figure class="text-image__image">
          <img src="<?php echo $text_image_image['sizes']['large']; ?>" width="<?php echo $text_image_image['sizes']['large-width']; ?>" height="<?php echo $text_image_image['sizes']['large-height']; ?>" alt="<?php echo $text_image_title; ?>">
          <meta itemprop="image" content="<?php echo $text_image_image['sizes']['large']; ?>">
        </figure>
      </div>

    </div>
  </div>
</section>
