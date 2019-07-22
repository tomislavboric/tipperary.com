<?php
/*
Template Name: Contact
*/
get_header(); ?>

<?php get_template_part( 'template-parts/page-header' ); ?>

<main class="main-content-full-width">
  <div class="contact-page grid-x">
    <?php while ( have_posts() ) : the_post();
      $map = get_field('map', $post->ID);
      $lat = $map['lat'];
      $long = $map['lng'];
      $address = $map['address'];
      $form_id = get_field('form_id', $post->ID);
    ?>
    <div class="cell medium-6 large-6">
    <!-- start: form -->
    <?php require locate_template ( 'template-parts/two-columns.php' );  ?>
    <!-- end: form -->

    </div>
    <div class="cell medium-6 large-6">
    <!-- start: form -->
    <?php require locate_template ( 'template-parts/content-form.php' );  ?>
    <!-- end: form -->
    </div>
    <?php endwhile; ?>


    <!-- start: contact data -->
    <?php require locate_template ( 'template-parts/content-map.php' ); ?>
    <!-- end: contact data -->

  </div>
</main>
<?php get_footer();
