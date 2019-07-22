<?php get_header(); ?>

<?php get_template_part( 'template-parts/page-header' ); ?>

<main class="listings-single">
  <?php
    echo '<div class="language-switcher">';
      dynamic_sidebar('sidebar-widgets');
    echo '</div>';
		while ( have_posts() ) { the_post();
			$listing_template = get_field( 'listing_template', $post->ID );
			if( $listing_template == 'Layout 1') {
				echo '<section class="listings-single listings-single--v1">';
				require locate_template ( 'page-templates/listings-template-v1.php' );
				echo '</div>';
			} else {
				echo '<section class="listings-single listings-single--v2">';
				require locate_template ( 'page-templates/listings-template-v2.php' );
				echo '</div>';
			}
		}
	?>

</main>
<?php get_footer(); ?>
