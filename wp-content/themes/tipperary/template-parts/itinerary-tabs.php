<section class="itineraries__grid">
  <div class="grid-container">

    <header class="section__header">
      <h2 class="tabs-title__main section__title"><?php _e( 'Holiday inspirations', 'foundationpress' ); ?></h2>
    </header>


  <?php echo do_shortcode('[facetwp facet="itinerary_categories"]'); ?>

  <div class="grid-x grid-padding-x">
    <div class="cell auto">
      <?php
      echo do_shortcode('[facetwp facet="search_itinerary"]');
      ?>
    </div>
    <div class="cell large-3">
      <?php
      echo do_shortcode('[facetwp facet="no_of_days"]');
      ?>
    </div>
  </div>
  <?php
  echo facetwp_display( 'template', 'iteneraries' );
  echo do_shortcode('[facetwp pager="true"]');
  ?>
</div>
</section>