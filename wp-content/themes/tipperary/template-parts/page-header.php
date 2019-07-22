<?php
//vars
$default_featured_image = get_field('default_featured_image', 'option');
$blog_featured_image = get_field('blog_featured_image','option');

if ( !is_home() && is_singular() || is_page() ) :
  if ( has_post_thumbnail() ) :
    $post_id = get_the_ID();
    $thumbnail = get_the_post_thumbnail_url ( $post_id, 'featured-xlarge');
  elseif ( $default_featured_image ) :
    $thumbnail = $default_featured_image['sizes']['featured-xlarge'];
  else :
    $thumbnail = '';
  endif;
elseif ( is_home() || is_singular() && $blog_featured_image ) :
  if ( $blog_featured_image ) :
    $thumbnail = $blog_featured_image['sizes']['featured-xlarge'];
  elseif ( $default_featured_image ) :
    $thumbnail = $default_featured_image['sizes']['featured-xlarge'];
  else :
    $thumbnail = '';
  endif;
else :
  $thumbnail = $default_featured_image['sizes']['featured-xlarge'];
endif;
?>
<section class="page-header" <?php if ( $thumbnail ) : ?> style="background-image: url('<?php echo $thumbnail; ?>');" <?php endif; ?>>
  <div class="grid-container align-middle">
    <div class="grid-x grid-padding-x">
      <div class="page-header__content cell">

        <header class="page-header__header">
          <?php
          echo '<h1 class="page-header__title">';
          if ( is_home() ) :
            echo "News";
          elseif ( is_post_type_archive() && get_queried_object()->name != 'tribe_events') :
            post_type_archive_title();
          elseif (get_queried_object()->name == 'tribe_events') :
            $title = tribe_get_events_title(false);
            echo 'Events';
          elseif ( is_tax() ) :
            single_term_title();
          else :
            the_title();
          endif;
          echo '</h1>';
          ?>
        </header>
        <?php if ( function_exists('yoast_breadcrumb') ) : ?>
          <div class="page-header__breadcrumbs">
            <?php yoast_breadcrumb(); ?>
          </div>
        <?php endif; ?>

      </div>

    </div>

  </div>
</section>

<?php
/*
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.

$header_image = get_field('header_image', 'options');

if ( has_post_thumbnail( $post->ID ) ) { ?>

  <section class="page-header" role="banner" data-interchange="[<?php the_post_thumbnail_url('featured-small'); ?>, small], [<?php the_post_thumbnail_url( 'featured-medium' ); ?>, medium], [<?php the_post_thumbnail_url( 'featured-large' ); ?>, large], [<?php the_post_thumbnail_url( 'featured-xlarge' ); ?>, xlarge]">
    <h1 class="page-header__title"><?php the_title(); ?></h1>
    <?php
      if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
      }
    ?>
	</section>

<?php } else if($header_image) { ?>

  <section class="page-header" role="banner" data-interchange="[<?php echo $header_image['sizes']['featured-small']; ?>, small], [<?php echo $header_image['sizes']['featured-medium']; ?>, medium], [<?php echo $header_image['sizes']['featured-large']; ?>, large], [<?php echo $header_image['sizes']['featured-xlarge']; ?>, xlarge]">
    <h1 class="page-header__title"><?php the_title(); ?></h1>
    <?php
      if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
      }
    ?>
  </section>

<?php
}
*/
