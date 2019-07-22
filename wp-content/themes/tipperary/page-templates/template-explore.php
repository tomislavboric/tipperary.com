<?php
/*
Template Name: Explore
*/
get_header(); ?>

<main class="main-grid__explore">
  <div class="location-listings__listing-toggle-inner views">
    <a href="#" class="location-listings__listing-toggle active" data-toggle="results">Results</a>
    <a href="#" class="location-listings__listing-toggle" data-toggle="map">Map</a>
  </div>
  <div class="grid-x">
    <div class="location-listings__listings-display cell" data-toggle-div="results">
      <div class="location-listings__filters-container grid-x grid-padding-x">
        <?php
        echo do_shortcode('[facetwp facet="search"]');
        echo do_shortcode('[facetwp facet="categories"]');
        ?>
        <a href="#" onclick="FWP.reset(); event.preventDefault();" class="button button--clear secondary">Clear All</a>
      </div>
      <div class="location-listings__filters-interests">
        <?php
        echo do_shortcode('[facetwp facet="interests"]');
        ?>
      </div>
      <div class="location-listings__sorting-container grid-x grid-padding-x align-spaced">
        <div class="cell auto">
          <?php
          echo do_shortcode('[facetwp counts="true"]');
          ?>
        </div>
        <div class="cell large-4">
          <?php
          echo do_shortcode('[facetwp sort="true"]');
          ?>
        </div>
      </div>
      <?php
      echo facetwp_display( 'template', 'listings' );
      echo do_shortcode('[facetwp pager="true"]');
      ?>
    </div>
    <div class="location-listings__map-wrapper js-map-wrapper cell" data-toggle-div="map">

      <div class="location-listings__map">
        <?php echo do_shortcode('[facetwp facet="map"]'); ?>
      </div>

    </div>
  </div>
</main>
<?php get_footer('v2');
