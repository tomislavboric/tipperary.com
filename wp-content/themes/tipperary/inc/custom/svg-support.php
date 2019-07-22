<?php
/**
 *
 * Enabling SVG files
 *
 */

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
  $mimes['zip'] = 'application/zip';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function check_svg_on_media_upload( $response ) {
  if ( $response['type'] === 'image/svg+xml' && class_exists( 'SimpleXMLElement' ) ) {
    $path = $response['tmp_name'];

    $svg_content = file( $path );
    $svg_content = implode( ' ', $svg_content );

    if ( file_exists( $path ) ) {
      if ( ! $this->is_valid_xml( $svg_content ) ) {
        return array(
            'size' => $response,
            'name' => $response['name'],
        );
      }
    }
  }
  return $response;
}
//add_filter( 'wp_handle_upload_prefilter', 'check_svg_on_media_upload' );
