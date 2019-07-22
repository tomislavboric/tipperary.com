<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

$favicon = get_field('favicon', 'options');

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php
	if ( ! empty( $favicon ) ) {
		printf( '<link rel="icon" href="%s">', esc_url( $favicon['url'] ) );
	}
	?>

	<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

	<link rel="stylesheet" href="//use.typekit.net/sra8nyg.css">

	<?php wp_head(); ?>


	<script>
  /* (function($) {
      $(document).on('facetwp-loaded', function() {
          if (FWP.loaded) {
              $('html, body').animate({
                  scrollTop: $('.facetwp-template').offset().top - 120
              }, 500);
              console.log($('.facetwp-template').offset().top);
          }
      });
  })(jQuery); */
</script>
</head>
<body <?php body_class(); ?>>

	<?php
	$blog_name        = get_bloginfo( 'name' );
	$blog_description = get_bloginfo( 'description' );
	$header_logo_info = $blog_name . ' - ' . $blog_description;
	$logo        	    = get_field( 'logo', 'options' );
	$logo_img         = $logo['sizes']['fp-xlarge'];
	?>

	<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
	<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
<?php endif; ?>

<div class="social-icons">
	<?php echo social_links();
	if (is_singular('itinerary')) { ?>
		<a href="#" onclick="window.print();return false;" class="printable">
			<i class="fa fa-print"></i>
			<span class="social-icons__text"><?php _e( 'PRINT', 'foundationpress' ); ?></span>
		</a>
	<?php } ?>
</div>


<!--start: main content wrapper needed for mobile menu-->
<div class="mainContainer shadow">

	<header class="header">
		<div class="grid-container">
			<div class="grid-x grid-margin-x align-middle">

				<!-- Mobile menu-->
				<div class="header__mobile" >
					<div class="header__mobile-icon">
						<button aria-label="<?php _e( 'Main Menu', 'foundationpress' ); ?>" class="menu-icon" type="button" >
							<span class="menu-icon__hamburger"></span>
						</button>
					</div>
				</div>


				<div class="header__nav header__nav--left cell auto">
					<?php foundationpress_top_bar_l(); ?>
				</div>

				<div class="header__logo cell shrink">
					<a class="header__logo-link" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( $blog_name ); ?>">
						<img class="header__logo-img" src="<?php echo esc_url( $logo_img ); ?>" title="<?php echo esc_attr( $header_logo_info ); ?>" alt="<?php echo esc_attr( $header_logo_info ); ?>" />
					</a>
				</div>

				<div class="header__nav header__nav--right cell auto">
					<?php foundationpress_top_bar_r(); ?>
				</div>

			</div>
		</div>
		<?php
		if(!is_single() && !is_singular('tribe_events')){
			echo '<div class="language-switcher">';
			dynamic_sidebar('sidebar-widgets');
			echo '</div>';

		}
		?>
	</header>

