<?php
/**
 *
 * Filter Yoast SEO Metabox Priority
 * @author Jacob Wise
 * @link http://swellfire.com/code/filter-yoast-seo-metabox-priority
 *
 */

add_filter( 'wpseo_metabox_prio', 'jw_filter_yoast_seo_metabox' );
function jw_filter_yoast_seo_metabox() {
	return 'low';
}
