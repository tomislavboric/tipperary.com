<?php get_header(); ?>
<?php get_template_part( 'template-parts/page-header' ); ?>
<main class="itinerary-single">

	<?php
	while ( have_posts() ) { the_post();
		$main_title = get_field( 'itinerary_main_title', $post->ID );
		$content = get_field( 'itinerary_main_content', $post->ID  );
		$itinerary_slider = get_field( 'itinerary_slider', $post->ID );
		$itinerary_day = get_field( 'itinerary_day', $post->ID  );
		$images = get_field( 'itinerary_slider', $post->ID  );
		?>

		<?php // start: anchors // ?>
		<?php
		if( $itinerary_day ){
			echo '
			<section class="itinerary-single__list">
			<div class="grid-container">
			<div class="grid-x grid-margin-x">
			<nav class="itinerary-single__list-navigation">
			<ul class="itinerary-single__list-navigation-wrap">
			<li class="itinerary-single__list-item">
			<a href="#overview" class="itinerary-single__list-ancor js-scroll-to-anchor active">'. __('Overview', 'tipperary') .' </a>
			</li>';
			$no = 0;
			foreach ( $itinerary_day as $day ) { $no++;
				$itinerary_day_title = $day['itinerary_day_title'];
				$stripped_day_title = str_replace(' ', '', $itinerary_day_title);
				?>
				<li class="itinerary-single__list-item">
					<a href="#<?php echo preg_replace('/[^a-zA-Z]/', '', $stripped_day_title); ?>" class="itinerary-single__list-ancor js-scroll-to-anchor">Day <?php echo $no; ?></a>
				</li>
				<?php
			}
			echo '
			</ul>
			</nav>
			</div>
			</div>
			</section>';
		}  ?>
  <?php // end: anchors //
  echo '<div class="language-switcher">';
  dynamic_sidebar('sidebar-widgets');
  echo '</div>';
  ?>

  <?php // start: overview // ?>
  <div class="grid-container" id="overview">
  	<div class="grid-x grid-margin-x">
  		<div class="cell medium-12 large-12 itinerary-single__day">
  			<?php require locate_template ( 'template-parts/content-overview.php' );  ?>
  		</div>
  	</div>
  </div>
  <?php // end: overview // ?>


  <?php // start: slider // ?>
  <section id="image-carousel" class="itinerary-single__slider">

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

  			<?php endif; ?>
  		</div>
  	</div>
  </section>
  <?php // end: slider // ?>

  <?php  // start: itinerary_day // ?>
  <?php
  if( $itinerary_day ){ $tab = 0;
  	foreach ( $itinerary_day as $day ) { $tab++;
  		$itinerary_day_title 		= $day['itinerary_day_title'];
  		$stripped_day_title = str_replace(' ', '', $itinerary_day_title);
  		$itinerary_day_description 	= $day['itinerary_day_description'];
  		$itinerary_day_image 		= $day['itinerary_day_image'];
  		$itinerary_no_of_stops 		= $day['itinerary_no_of_stops'];
  		$itinerary_day_kilometers 	= $day['itinerary_day_kilometers'];
  		$itinerary_day_stops 		= $day['itinerary_day_stops'];
  		?>
  		<section class="itinerary-single__day" id="<?php echo preg_replace('/[^a-zA-Z]/', '', $stripped_day_title); ?>">
  			<div class="grid-container">

  				<header class="itinerary-single__header">
  					<h2 class="itinerary-single__day-title"><?php _e('Day', 'tipperary'); ?> <?php echo $tab; ?></h2>
  					<?php
  					if( !empty($itinerary_day_kilometers) || ( $itinerary_no_of_stops )){ ?>
  						<span class="itinerary-single__data">
  							<i class="fa fa-car-side"></i>
  							<?php
  							if( $itinerary_day_kilometers ) {
  								echo ' - '. $itinerary_day_kilometers;
  							}  ?>
  							<?php
  							if( $itinerary_no_of_stops ) {
  								echo ' - '. $itinerary_no_of_stops . ' stops';
  							}  ?>
  						</span>
  						<?php
  					}
  					?>
  				</header>

  				<div class="grid-x grid-margin-x">

  					<div class="cell <?php if(!empty( $itinerary_day_image )) { ?> medium-6 large-6 <?php }else { ?>auto<?php } ?> itinerary-single__day-content">
  						<?php echo $itinerary_day_description; ?>
  					</div>

  					<?php if(!empty( $itinerary_day_image )) { ?>
  						<div class="cell medium-6 large-6">
                <figure class="itinerary-single__day-image">
    							<img src="<?php echo $itinerary_day_image['sizes']['large']; ?>" alt="<?php echo $itinerary_day_image['alt']; ?>" class="itinerary-single__day-image-img" />
                </figure>
  						</div>
  					<?php } ?>

  				</div>

  				<?php // start: itinerary tabs // ?>
  				<?php  require locate_template ( 'template-parts/tabs-slider.php' );  ?>
  				<?php // end: itinerary tabs // */ ?>

  			</div>
  		</section>

  		<?php
  	}
  }
  ?>
<?php } ?>

</main>
<?php get_footer(); ?>
