<section class="grid-container align-middle tabs">
	<?php
	$itinerary_category = get_terms( array(
	    'taxonomy' => 'itinerary_category',
	    'hide_empty' => false,
	) );
	?>

	<h2 class="tabs-title__main"><?php _e( 'Holiday inspirations', 'foundationpress' ); ?></h2>

	<?php
	if( $itinerary_category ){ ?>
		<ul class="tabs-list" data-responsive-accordion-tabs="tabs medium-accordion large-tabs" id="itinerary-tabs">
		<?php
		$i = 0;
		foreach ($itinerary_category as $itinerary_cat) { $i++; ?>
			<li class="tabs-title <?php if($i == '1'){ echo 'is-active'; } ?>"><a href="#<?php echo $itinerary_cat->slug; ?>"><?php echo $itinerary_cat->name; ?></a></li>
		<?php
		}
		echo '</ul>';
	}
	?>

	<div class="tabs-content" data-tabs-content="itinerary-tabs">
		<?php
		if( $itinerary_category ){ $i = 0;
		foreach ($itinerary_category as $itinerary_cat) { $i++;
			$current_cat = $itinerary_cat->slug;    ?>

		<div class="tabs-panel <?php if($i == '1'){ echo 'is-active'; } ?>" id="<?php echo $current_cat; ?>">

		  	<div class="align-middle">
			    <div class="grid-x grid-margin-x">
			    <?php

			    $args = array(
			        'tax_query' => array(
			            array(
			                'taxonomy' => 'itinerary_category',
			                'field' => 'slug',
			                'terms' => $current_cat
			            ),
			        ),
			        'post_type' => 'itinerary',
			        'posts_per_page' => 9,
			        'order' => 'ASC',
			        );
			      	$query = new WP_Query( $args );


			      	if ( $query->have_posts() ) {

			            while($query->have_posts()){ $query->the_post();  ?>

                       <div class="cell small-12 large-4 tabs-content__box" style="background-image:url('<?php the_post_thumbnail_url( 'tabs-image' ) ?>');">
                          <a href="<?php the_permalink(); ?>">
		                        <div class="tabs-content__box-content">
		                        	<span class="tabs-content__box-date">2 days</span>
                              <h3 class="tabs-content__box-title"><?php the_title(); ?></h3>
                            </div>
                          </a>
		                  	</div>

			            <?php
			        	}
			      	}

			     	wp_reset_query();
			      ?>

			    </div>
			</div>
		</div>

		<?php }
		} ?>
	</div>
</section>
