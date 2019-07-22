<section class="tabs-single">

	<?php
	if( $itinerary_day_stops ){ ?>
		<nav class="tabs-single__navigation">
			<ul class="tabs-single__list" data-responsive-accordion-tabs="tabs small-tabs medium-tabs large-tabs" id="single-tabs-<?php echo $tab; ?>">
			<?php
			$i = 0;
			foreach ( $itinerary_day_stops as $itinerary_day_stop ) { $i++; ?>
				<li class="tabs-title tabs-single__tab <?php if($i == '1'){ echo 'is-active'; } ?>">
					<a href="#<?php echo $tab .'-'. $i; ?>"><?php echo $itinerary_day_stop['title']; ?></a>
				</li>
			<?php
			}
			?>
			</ul>
		</nav>
	<?php
	}
	?>

	<div class="tabs-single__container" data-tabs-content="single-tabs-<?php echo $tab; ?>">
		<?php
		if( $itinerary_day_stops ){ $i = 0;
			foreach ( $itinerary_day_stops as $itinerary_day_stop ) { $i++;
			$itinerary_day_stop_image = $itinerary_day_stop['image'];
			$itinerary_day_stop_map = $itinerary_day_stop['map'];
			$itinerary_day_stop_type = $itinerary_day_stop['type'];  ?>

			<section class="tabs-panel <?php if($i == '1'){ echo 'is-active'; } ?>" id="<?php echo $tab .'-'. $i; ?>">
			    <div class="grid-x grid-margin-x">

				    <div class="cell <?php if(($itinerary_day_stop_type  == 'map') || ( !empty($itinerary_day_stop_image))) { ?> medium-6 large-6 <?php }else { ?> auto <?php } ?> tabs-single__content">
				    	<header>
							<h3 class="tabs-single__title"><?php echo $itinerary_day_stop['title']; ?></h3>
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
					<div class="cell medium-6 large-6 slider">
						<div class="slider-main">
						  <?php foreach($itinerary_day_stop_image as $image){ ?>
						    <figure class="tabs-single__image item image shadow">
						      <img src="<?php echo $image['sizes']['sign-up-image']; ?>" alt="<?php echo $image['alt']; ?>" class="tabs-single__image-img" />
						    </figure>
						  <?php } ?>

						</div>
					</div>

					<?php }else if( $itinerary_day_stop['type'] == 'map' ){
					$lat = $itinerary_day_stop_map['lat'];
					$long = $itinerary_day_stop_map['lng'];
          ?>
					<div class="cell medium-6 large-6 tabs-single__map">
					  <?php  require locate_template ( 'template-parts/content-map.php' ); ?>
			    </div>
					<?php }else{} ?>
			    </div>
			</section>
		<?php
			}
		}
		?>
	</div>
</section> 