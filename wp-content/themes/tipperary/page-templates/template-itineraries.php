<?php
/*
Template Name: Itineraries
*/
get_header(); ?>

<?php get_template_part( 'template-parts/page-header' ); ?>

<?php /*

I have commenterd out this code since it wan placed 100% in width on responsive. If it needs to be like that let me know.
<main class="main-grid__itineraries">
  <div class="itineraries__itineraries-display grid-container">
    <div class="itineraries__filters-container grid-x grid-margin-x medium-up-3">
*/ ?>
<main class="itineraries__grid">
  <div class="grid-container">
    <div class="grid-x grid-margin-x medium-up-3">

      <div class="cell">
        <?php
        echo do_shortcode('[facetwp facet="search_itinerary"]');
        ?>
      </div>
      <div class="cell">
        <?php
        echo do_shortcode('[facetwp facet="itinerary_categories_dropdown"]');
        ?>
      </div>
      <div class="cell align-right">
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
</main>
<?php get_footer();