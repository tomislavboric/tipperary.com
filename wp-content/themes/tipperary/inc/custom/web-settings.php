<?php
/**
 *
 * ACF Web Settings
 *
 */

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Web Settings',
		'menu_title'	=> 'Web Settings',
		'menu_slug' 	=> 'web-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	/*acf_add_options_sub_page(array(
		'page_title' 	=> 'Blog page settings',
		'menu_title'	=> 'Blog',
		'parent_slug'	=> 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));*/

}
