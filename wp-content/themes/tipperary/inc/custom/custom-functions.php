<?php

/** filtering map styles
 ** see https://developers.google.com/maps/documentation/javascript/style-reference
 */
add_filter( 'facetwp_map_init_args', function( $settings) {
	$settings['init']['styles'] = json_decode( '[{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}]' );
  return $settings;
});


/**
 * On Save update field
 */
add_action('pmxi_after_xml_import', 'post_saved', 10, 1);

add_action('acf/save_post', 'post_saved', 20);

function post_saved($id) {
    //AIzaSyCSZhFuDAys0ZFmroKvpBg57qpmKT15xys
  $post_type = get_post_type($id);
  if($post_type == 'listings'){
    $listing_lat = get_field('listing_lat', $id);
    $listing_long = get_field('listing_long', $id);

    if(!empty($listing_lat) && !empty($listing_long)){
      $address = get_field('listing_address', $id);
      $json_data = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address).'&country=ireland&key=AIzaSyBfaO4DW7uMVGQM-q9t2mMJuTiPrxxq3Eo&sensor=true');
        $json_a = json_decode($json_data, true); //json decoder
        $field_lat_key = "field_5c8a961dbba5f";
        $value_lat = $json_a['results'][0]['geometry']['location']['lat'];
        update_field( $field_lat_key, $value_lat, $id );

        $field_lng_key = "field_5c8a962cbba60";
        $value_lng = $json_a['results'][0]['geometry']['location']['lng'];
        update_field( $field_lng_key, $value_lng, $id );

      }
    }
  }


/**
 ** enable filtering on load of map
 **/
add_action( 'wp_footer', function() {
  global $template;
  $template_file = basename((__FILE__).$template);
  if($template_file === 'template-explore.php') {
   ?>
   <script>
    (function($) {
      if($(window).width() > '1024'){
        $(document).on('facetwp-refresh', function() {
          if (FWP.loaded) {
            $(".facetwp-template").addClass("loading").css("opacity", .7);
            $(".facetwp-filters .facetwp-facet").css({
              "pointer-events": "none"
            });
            $(function() {
              FWP.auto_refresh = !0;
            });
          }else {
            $(".facetwp-template").addClass("loading").css("opacity", 1);
          }
        });
        $(document).on('facetwp-loaded', function() {
          //$(".facetwp-template").removeClass("loading").css("opacity", 1);
          var filterButton = $( ".facetwp-map-filtering" );
          console.log('explore');
          if ( !filterButton.hasClass('enabled') && 'undefined' == typeof FWP_MAP.enableFiltering ) {
            filterButton.text(FWP_JSON['map']['resetText']);
            FWP_MAP.is_filtering = true;
            filterButton.addClass('enabled');
            FWP_MAP.enableFiltering = true;
            $(".facetwp-template").removeClass("loading").css("opacity", 1);
          }else {
            $(".facetwp-template").removeClass("loading").css("opacity", 1);
          }

          $('.single-location').hover( function(){
            var markers = FWP_MAP.get_post_markers($(this).data('id'));

            for (let index = 0; index < markers.length; index++) {

              const element = markers[index];
              console.log(element);
              FWP_MAP.infoWindow.close();
              FWP_MAP.infoWindow.setContent();
              FWP_MAP.infoWindow.setContent(element.content);
              FWP_MAP.infoWindow.open(FWP_MAP.map, element);
              //element.click();
            }
          });

        });

      }

      FWP.hooks.addAction('facetwp_map/marker/mouseover', function(marker) {
          /**
          * The post ID associated with the active marker
          */
          var post_id = marker.post_id;
          /**
          * The following code adds the CSS class "is-active" to the active post,
          * assuming each result's HTML is structured similarly to:
          * <div class="post-item" data-id="123">Hello World!</div>
          */
          $('.single-location').removeClass('is-active');
          $('.single-location[data-id="' + post_id + '"]').addClass('is-active');
        });
      FWP.hooks.addAction('facetwp_map/marker/mouseout ', function(marker) {
          /**
          * The post ID associated with the active marker
          */
          var post_id = marker.post_id;
          /**
          * The following code adds the CSS class "is-active" to the active post,
          * assuming each result's HTML is structured similarly to:
          * <div class="post-item" data-id="123">Hello World!</div>
          */
          $('.single-location').removeClass('is-active');
        });
      
    })(jQuery);


    </script>
    <?php
  } else {
    ?>
    <script>
      (function($) {
        $(document).on('facetwp-refresh', function() {
          if (FWP.loaded) {
          $(".facetwp-template").css("opacity", .7);//.addClass("loading");
          $(".facetwp-filters .facetwp-facet").css({
            "pointer-events": "none"
          });
          $(function() {
            FWP.auto_refresh = !0;
          });
        }
      });
        $(document).on('facetwp-loaded', function() {
        $(".facetwp-template").css("opacity", 1);//.removeClass("loading");
      });

      })(jQuery);


    </script>
    <?php
  }
}, 100 );

// Change cluster image
add_filter( 'facetwp_map_init_args', function( $settings ) {
  $settings['imagePath'] = get_template_directory_uri() .'/src/assets/images/m/'; // e.g. https://yoursite.com/images/m';
  return $settings;
});

add_filter( 'facetwp_map_marker_args', function( $args, $post_id ) {
  $terms = wp_get_post_terms( $post_id, 'interest' ); // assuming you have a custom taxonomy named "age"
  foreach ( $terms as $term ) {
    $args['icon'] =  get_field('icon', 'term_' . $term->term_id);
    print_r(get_field('icon', $term->ID));
  }
  return $args;
}, 10, 2 );


// Favorites count
function post_views_output( $post_id ) {
  $count_key = 'post_views_count';
  $count     = get_post_meta( $post_id, $count_key, true );

  if ( $count === '' ) {

    delete_post_meta( $post_id, $count_key );
    add_post_meta( $post_id, $count_key, '0' );
    return '0';

  }
  return $count;
}
// Favorites count update
function post_views_counter( $post_id ) {
  $count_key = 'post_views_count';
  $count     = get_post_meta( $post_id, $count_key, true );
  if ( $count === '' ) {

    $count = 0;
    delete_post_meta( $post_id, $count_key );
    add_post_meta( $post_id, $count_key, '0' );

  } elseif ( ! is_user_logged_in() ) {
    $count++;
    update_post_meta( $post_id, $count_key, $count );
  }
}

/**
 * FacetWP Custom Pagination
 */
function custom_facetwp_pager( $output, $params ) {
  $output = '';
  $page = (int) $params['page'];
  $total_pages = (int) $params['total_pages'];
    // Only show pagination when > 1 page
  if ( 1 < $total_pages ) {
    if ( 1 < $page ) {
      $output .= '<a class="facetwp-page" data-page="' . ( $page - 1 ) . '"><i class="material-icons notranslate">keyboard_arrow_left</i></a>';
    }
    if ( 3 < $page ) {
      $output .= '<a class="facetwp-page first-page" data-page="1">1</a>';
            // $output .= ' <span class="dots">…</span> ';
    }
    for ( $i = 2; $i > 0; $i-- ) {
      if ( 0 < ( $page - $i ) ) {
        $output .= '<a class="facetwp-page" data-page="' . ($page - $i) . '">' . ($page - $i) . '</a>';
      }
    }
        // Current page
    $output .= '<a class="facetwp-page active" data-page="' . $page . '">' . $page . '</a>';
    for ( $i = 1; $i <= 2; $i++ ) {
      if ( $total_pages >= ( $page + $i ) ) {
        $output .= '<a class="facetwp-page" data-page="' . ($page + $i) . '">' . ($page + $i) . '</a>';
      }
    }
    if ( $total_pages > ( $page + 2 ) ) {
      $output .= ' <span class="dots">…</span> ';
      $output .= '<a class="facetwp-page last-page" data-page="' . $total_pages . '">' . $total_pages . '</a>';
    }
    if ( $page < $total_pages ) {
      $output .= '<a class="facetwp-page" data-page="' . ( $page + 1 ) . '"><i class="material-icons notranslate">keyboard_arrow_right</i></a>';
    }
  }
  return $output;
}
add_filter( 'facetwp_pager_html', 'custom_facetwp_pager', 10, 2 );

// Sort by title if the shortcode template is named "bravo"
add_filter( 'facetwp_query_args', function( $query_args, $class ) {
  if ( 'listings' == $class->ajax_params['template'] ) {
    $query_args['orderby']	= 'meta_value';
    $query_args['meta_key']	= 'is_featured_listing';
    $query_args['order']		= 'DESC';
  }
  return $query_args;
}, 10, 2 );


/*
 *  Add Google Maps API Key to ACF
 */
function am2_acf_google_map_api( $api ) {

	$api['key'] = 'AIzaSyCSZhFuDAys0ZFmroKvpBg57qpmKT15xys';

	return $api;

}
add_filter( 'acf/fields/google_map/api', 'am2_acf_google_map_api' );


add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
  if ( '' !== $query->get( 'facetwp' ) ) {
    $is_main_query = (bool) $query->get( 'facetwp' );
  }
  return $is_main_query;
}, 10, 2 );

// Preload selection on home page

add_filter( 'facetwp_preload_url_vars', function( $url_vars ) {
  if ( '' == FWP()->helper->get_uri() ) {
    if ( empty( $url_vars['itinerary_categories'] ) ) {

      $url_vars['itinerary_categories'] = array( 'featured' );
    }
  }
  return $url_vars;
} );


/* Generates social networks icon links */
function social_links( $container_css_class_modifier = "" ) {
	$output = "";
	$socials = array();

  $facebook = get_field( 'facebook', 'options' );
  $twitter = get_field( 'twitter', 'options' );
  $instagram = get_field( 'instagram', 'options' );
  $linkedin = get_field( 'linkedin', 'options' );
  $snapchat = get_field( 'snapchat', 'options' );
  $googleplus = get_field( 'googleplus', 'options' );
  $pinterest = get_field( 'pinterest', 'options' );
  $youtube = get_field( 'youtube', 'options' );

  if( !empty( $facebook ) ) {
    $socials['facebook'] = $facebook;
  }
  if( !empty( $twitter ) ) {
    $socials['twitter'] = $twitter;
  }
  if( !empty( $instagram ) ) {
    $socials['instagram'] = $instagram;
  }
  if( !empty( $linkedin ) ) {
    $socials['linkedin'] = $linkedin;
  }
  if( !empty( $snapchat ) ) {
    $socials['snapchat'] = $snapchat;
  }
  if( !empty( $googleplus ) ) {
    $socials['googleplus'] = $googleplus;
  }
  if( !empty( $pinterest ) ) {
    $socials['pinterest'] = $pinterest;
  }
  if( !empty( $youtube ) ) {
    $socials['youtube'] = $youtube;
  }

  if( !empty( $socials ) ) {
    $output .= '<ul class="social ' . $container_css_class_modifier . '">';

    foreach( $socials as $key => $value ) {
      $square = '';
      if(($key != 'instagram') && ($key != 'linkedin')){
        $square = '-square';
      }
      $output .= '<li class="social__item social__item--' . $key . '">
      <a href="' . $value . '" target="_blank" class="'.  $key .'">
      <i class="fab fa-'.  $key .''. $square .'"></i>
      <span class="social__icon social__icon--' . $key . ' social-icons__text">
      '.  $key .'
      </span>

      </a>
      </li>';

    }

    $output .= '</ul>';
  }

  return $output;
}


// Function to handle the thumbnail request
function get_the_post_thumbnail_src($img)
{
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}
function social_buttons($content) {
  global $post;
  if(is_singular() || is_home()){

        // Get current page URL
    $sb_url = urlencode(get_permalink());

        // Get current page title
    $sb_title = str_replace( ' ', '%20', get_the_title());

        // Get Post Thumbnail for pinterest
    $sb_thumb = get_the_post_thumbnail_src(get_the_post_thumbnail());

        // Construct sharing URL without using any script
    $twitterURL = 'https://twitter.com/intent/tweet?text='.$sb_title.'&amp;url='.$sb_url.'&amp;';
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$sb_url;;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$sb_url.'&amp;title='.$sb_title;

        // Add sharing button at the end of page/page content
    $content .= '<div class="social-box"><div class="social-btn">';
    $content .= '<a class="social-box__single social-box__single--twitter" href="'. $twitterURL .'" target="_blank" rel="nofollow"><i class="fab fa-twitter"></i></a>';
    $content .= '<a class="social-box__single social-box__single--facebook" href="'.$facebookURL.'" target="_blank" rel="nofollow"><i class="fab fa-facebook-f"></i></a>';
    $content .= '<a class="social-box__single social-box__single--linkedin" href="'.$linkedInURL.'" target="_blank" rel="nofollow"><i class="fab fa-linkedin-in"></i></a>';
    $content .= '</div></div>';

    return $content;
  }else{
        // if not a post/page then don't include sharing button
    return $content;
  }
};
// Enable the_content if you want to automatically show social buttons below your post.

 //add_filter( 'the_content', 'social_buttons');

// This will create a wordpress shortcode [social].
// Please it in any widget and social buttons appear their.
// You will need to enabled shortcode execution in widgets.
add_shortcode('social','social_buttons');
