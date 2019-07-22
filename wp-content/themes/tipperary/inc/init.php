<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'main/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'main/foundation.php' );

/** Format comments */
require_once( 'main/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'main/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'main/class-foundationpress-top-bar-walker.php' );
require_once( 'main/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'main/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'main/entry-meta.php' );

/** Enqueue scripts */
require_once( 'main/enqueue-scripts.php' );

/** Add theme support */
require_once( 'main/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'main/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'main/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'main/responsive-images.php' );

/** Gutenberg editor support */
//require_once( 'main/gutenberg.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'main/class-foundationpress-protocol-relative-theme-assets.php' );

// Custom
require_once( 'custom/web-settings.php' );
// require_once( 'custom/hide-wpadminbar.php' );
require_once( 'custom/wordpress-seo.php' );
require_once( 'custom/svg-support.php' );
require_once( 'custom/acf-json.php' );
require_once( 'custom/custom-functions.php' );
require_once( 'custom/remove-menu-items.php' );

// Remove Admin bar CSS
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}
