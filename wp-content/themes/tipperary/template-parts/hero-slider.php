<?php

// vars
$hero_image = get_field('hero_image');
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');

?>
<section class="grid-container full align-middle slider">

  <!-- start:slider -->
  <div class="slider-main">

    <div class="item image">
      <figure class="slider-main__figure">
        <img src="<?php echo $hero_image['sizes']['featured-xlarge-v2']; ?>" height="<?php echo $hero_image['sizes']['featured-xlarge-v2']; ?>" width="<?php echo $hero_image['sizes']['featured-xlarge-v2']; ?>" alt="">
      </figure>
    </div>

  </div>

  <div class="grid-x grid-margin-x slider-search">
    <div class="cell center">

      <h1 class="slider-search__title"><?php echo $hero_title; ?></h1>
      <p class="slider-search__subtitle"><?php echo $hero_subtitle; ?></p>
      <div class="slider-search__dropdown">
        <form id="slider-search__form" class="slider-search__form js-form" method="get" action="<?php echo site_url('/explore/'); ?>">
         <?php
         $terms = get_terms(
          array(
            'taxonomy' => 'listing_category',
            'hide_empty' => false,
          )
        );
        ?>
        <select id="slider-search__dropdown-select" class="slider-search__dropdown-select js-select2 wide" name="fwp_categories">
          <?php /*<option value=""><?php _e('Select Category', 'tipperary'); ?></option> */ ?>
          <?php
          foreach ($terms as $key => $term) { ?>
            <option value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
          <?php }
          ?>
        </select>
      </form>

    </div>

  </div>
</div>
</section>
