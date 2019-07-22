<section class="tabs-slider">

	<?php
	if( $itinerary_day_stops ){ ?>
		<ul class="tabs-slider__list sub-header js-swipe-tabs">
		<?php
		$i = 0;
		foreach ( $itinerary_day_stops as $itinerary_day_stop ) { $i++; ?>
			<li class="tabs-title tabs-slider__tab swipe-tab <?php if($i == '1'){ echo 'slick-current'; } ?>">
				<a href="#<?php echo $tab .'-'. $i; ?>"><?php echo 'Stop ' . $i; ?></a>
			</li>
		<?php
		}
		?>
		</ul>
	<?php
	}
	?>

	<div class="tabs-slider__container js-swipe-tabs-container">

		<?php
		if( $itinerary_day_stops ){ $i = 0;
			foreach ( $itinerary_day_stops as $itinerary_day_stop ) { $i++;
			$itinerary_day_stop_image = $itinerary_day_stop['image'];
			$itinerary_day_stop_map = $itinerary_day_stop['map'];
			$itinerary_day_stop_type = $itinerary_day_stop['type'];  ?>
			<div class="swipe-tab-content">
			    <div class="grid-x grid-margin-x">

				    <div class="cell <?php if(($itinerary_day_stop_type  == 'map') || ( !empty($itinerary_day_stop_image))) { ?> medium-6 large-6 <?php }else { ?> auto <?php } ?> tabs-slider__content">
				    	<header>
							<h3 class="tabs-slider__title"><?php echo $itinerary_day_stop['title']; ?></h3>
						</header>

				        <?php echo $itinerary_day_stop['content']; ?>

				        <?php if(!empty( $itinerary_day_stop['link'] )) { ?>
				        <footer>
				        	<a href="<?php echo $itinerary_day_stop['link']; ?>" class="button"><?php echo $itinerary_day_stop['link_text']; ?></a>
				        </footer>
				    	<?php } ?>

				    </div>

            	<?php
				    if( ($itinerary_day_stop_type == 'image') && (!empty($itinerary_day_stop_image))) { ?>
					<div id="tab_slider-<?php echo rand(0, 100) ?>" class="cell medium-6 large-6 tabs-slider__slider">
						<?php foreach($itinerary_day_stop_image as $image){ ?>
						<figure class="tabs-slider__image shadow">
						  <img src="<?php echo $image['sizes']['sign-up-image']; ?>" alt="<?php echo $image['alt']; ?>" class="tabs-slider__image-img" />
						</figure>
						<?php } ?>
					</div>

					<?php }else if( $itinerary_day_stop['type'] == 'map' ){
					$lat = $itinerary_day_stop_map['lat'];
					$long = $itinerary_day_stop_map['lng'];
          			?>
					<div class="cell medium-6 large-6 tabs-slider__map">
					  <?php  require locate_template ( 'template-parts/content-map.php' ); ?>
			    	</div>
					<?php }else{} ?>
			    </div>
			</div>
		<?php
			}
		}
		?>
	</div>
</section>
