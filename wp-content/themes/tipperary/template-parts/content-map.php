<?php
/**
 * The default template for displaying page content
 *
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<section class="content-map">

  <?php
  $rand_number = rand('0', '1000');
	if( !empty($long) ):
	?>
	<div id="content-map__map-<?php echo $rand_number ?>" class="content-map__map content-map__map--<?php echo $rand_number; ?>">
		<div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $long; ?>" data-address="<?php echo $address; ?>"></div>
	</div>
	<?php endif; ?>

</section>
<script type="text/javascript">
(function($) {
<?php
global $post;

$args['icon'] = get_template_directory_uri() .'/src/assets/images/location.png';

  ?>
function new_map( $el ) {

	// var
	var $markers = $el.find('.marker');
	var args = {
		zoom		: 10,
		center		: new google.maps.LatLng(0, 0),
    mapTypeId	: google.maps.MapTypeId.ROADMAP,
    styles : [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}]

  };

  var map = new google.maps.Map( $el[0], args);

	map.markers = [];

	$markers.each(function(){
    add_marker( $(this), map );
	});

  	center_map( map );

	return map;
}

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
    map			: map,
    icon: '<?php echo $args['icon']; ?>',
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.attr('data-address') )
	{
		// create info window
	/* 	var infowindow = new google.maps.InfoWindow({
			content		: $marker.attr('data-address')
		}); */

    // show info window when marker is clicked
   /*  google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
      infowindow.open(map, marker);
    }); */
		/* google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		}); */
	}

}

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 9 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

var map = null;

$(document).ready(function(){

	//$('div[class*="content-map__map--"]').each(function(){
		// create map
		map = new_map( $('#content-map__map-<?php echo $rand_number ?>') );
	//});

});

})(jQuery);
</script>
