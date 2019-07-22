<section class="tabs">
  <div class="grid-container">
	<?php
	$itinerary_category = get_terms( array(
	    'taxonomy' => 'itinerary_category',
	    'hide_empty' => false,
	) );
	?>

	<header class="section__header">
		<h2 class="tabs-title__main section__title"><?php _e( 'Holiday inspirations', 'foundationpress' ); ?></h2>
	</header>

	<?php
  	if( $itinerary_category ){ ?>
    <nav class="tabs__navigation">
      <ul class="tabs-list" data-responsive-accordion-tabs="tabs medium-tabs large-tabs" id="itinerary-tabs">
      <?php
        $i = 0;
        foreach ($itinerary_category as $itinerary_cat) { $i++; ?>
          <li class="tabs-title <?php if($i == '1'){ echo 'is-active'; } ?>">
            <a href="#<?php echo $itinerary_cat->slug; ?>"><?php echo $itinerary_cat->name; ?></a>
          </li>
        <?php
        }
      }
      ?>
    </ul>
    </nav>

  	<div class="iteneraries__filters-container grid-x grid-margin-x">

	    <div class="cell auto">	      
	      <?php
	        echo do_shortcode('[facetwp facet="search_itinerary"]');
	      ?>
	    </div>

	    <div class="cell large-3">
	      <?php
	        echo do_shortcode('[facetwp facet="no_of_days"]');
	      ?>
	    </div>

  	</div>
	
	<div class="tabs-content" data-tabs-content="itinerary-tabs">
		<?php
		if( $itinerary_category ){ $i = 0;
		foreach ($itinerary_category as $itinerary_cat) { $i++;
			$current_cat = $itinerary_cat->slug;    ?>

			<div class="tabs-panel <?php if($i == '1'){ echo 'is-active'; } ?>" id="<?php echo $current_cat; ?>">

			  	<div class="align-middle">
				    <div class="grid-x grid-margin-x small-up-12 medium-up-2 large-up-3">
				    <?php

				    $args = array(
				        'tax_query' => array(
				            array(
				                'taxonomy' => 'itinerary_category',
				                'field' => 'slug',
				                'terms' => $current_cat,
				            ),
				        ),
				        'post_type' => 'itinerary',
				        'posts_per_page' => 2,
				        'order' => 'ASC',
				        'facetwp' => true,
				        );
				      	$query = new WP_Query( $args );


				      	if ( $query->have_posts() ) {

				            while($query->have_posts()){ $query->the_post();
				            $itinerary_no_of_days = get_field( 'itinerary_no_of_days', $post->ID );
	                  		$itinerary_main_content = get_field( 'itinerary_main_content', $post->ID );

	                   ?>
				            <div class="cell tabs-content__box">

			                <figure class="tabs-content__box-image">
	                          	<a href="<?php the_permalink(); ?>" class="tabs-content__box-link">
	                            <img src="<?php the_post_thumbnail_url( 'tabs-image' ) ?>" width="360" height="540" alt="<?php the_title(); ?>">
		                        <?php if(!empty( $itinerary_no_of_days )) { ?>
		                          <span class="tabs-content__box-date"><?php echo $itinerary_no_of_days; ?> <?php if($itinerary_no_of_days < '2'){ echo 'day'; }else { echo 'days'; } ?></span>
		                        <?php } ?>
		                        <span class="screen-reader-text"><?php the_title(); ?></span>
	                          	<figcaption class="tabs-content__box-content">

	                              <h3 class="tabs-content__box-title"><?php the_title(); ?></h3>
	                          	</figcaption>
	                           	</a>
		                    </figure>


			                    <script type="application/ld+json">
			                    {
			                        "@context": "http://schema.org",
			                        "@type": "Article",
			                        "mainEntityOfPage": {
			                              "@type": "WebPage",
			                              "@id": "<?php the_permalink(); ?>"
			                            },
			                        "headline": "<?php the_title(); ?>",
			                        "image": "<?php the_post_thumbnail_url( 'tabs-image' ) ?>",
			                        "author": "<?php the_author(); ?>",
			                        "publisher": "<?php the_author(); ?>",
			                        "url": "<?php the_permalink(); ?>",
			                        "datePublished": "<?php the_date(); ?>",
			                        "dateModified": "<?php the_modified_date(); ?>",
			                        "articleBody": "<?php echo strip_tags($itinerary_main_content); ?>"
			                    }
			                    </script>
			                </div>
				            <?php			           
				        	}
				        	 
				        	echo do_shortcode('[facetwp pager="true"]');
				      	}					
				     	wp_reset_query();			     	
				      ?>

				    </div>
				</div>
			</div>

		<?php }
		} 
		
		 
		?>

	</div>
</div>
	 
</section>
