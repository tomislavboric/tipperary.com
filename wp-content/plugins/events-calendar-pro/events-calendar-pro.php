<?php
/*
Plugin Name: The Events Calendar PRO
Description: The Events Calendar PRO, a premium add-on to the open source The Events Calendar plugin (required), enables recurring events, custom attributes, venue pages, new widgets and a host of other premium features.
Version: 4.4.15
Author: Modern Tribe, Inc.
Author URI: http://m.tri.be/20
Text Domain: tribe-events-calendar-pro
License: GPLv2 or later
*/

/*
Copyright 2010-2012 by Modern Tribe Inc and the contributors

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define( 'EVENTS_CALENDAR_PRO_DIR', dirname( __FILE__ ) );
define( 'EVENTS_CALENDAR_PRO_FILE', __FILE__ );

// Instantiate class and set up WordPress actions.
function Tribe_ECP_Load() {
	tribe_init_events_pro_autoloading();

	$classes_exist = class_exists( 'Tribe__Events__Main' ) && class_exists( 'Tribe__Events__Pro__Main' );
	$version_ok = $classes_exist && defined( 'Tribe__Events__Main::VERSION' ) && version_compare( Tribe__Events__Main::VERSION, Tribe__Events__Pro__Main::REQUIRED_TEC_VERSION, '>=' );

	if ( class_exists( 'Tribe__Main' ) && ! is_admin() && ! class_exists( 'Tribe__Events__Pro__PUE__Helper' ) ) {
		tribe_main_pue_helper();
	}

	if ( apply_filters( 'tribe_ecp_to_run_or_not_to_run', $version_ok ) ) {
		add_filter( 'tribe_tec_addons', 'tribe_init_ecp_addon' );
		new Tribe__Events__Pro__PUE( __FILE__ );
		Tribe__Events__Pro__Main::instance()->register_active_plugin();
	} else {
		/**
		 * Dummy function to avoid fatal error in edge upgrade case
		 *
		 * @return bool
		 **/
		function tribe_is_recurring_event() {
			return false;
		}
	}
	if ( ! $version_ok ) {
		add_action( 'admin_notices', 'tribe_show_fail_message' );
	}
}

add_action( 'plugins_loaded', 'Tribe_ECP_Load', 2 ); // high priority so that it's not too late for tribe_register-helpers class

/**
 * Shows message if the plugin can't load due to TEC not being installed.
 */
function tribe_show_fail_message() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$mopath = trailingslashit( basename( dirname( __FILE__ ) ) ) . 'lang/';
	$domain = 'tribe-events-calendar-pro';

	// If we don't have Common classes load the old fashioned way
	if ( ! class_exists( 'Tribe__Main' ) ) {
		load_plugin_textdomain( $domain, false, $mopath );
	} else {
		// This will load `wp-content/languages/plugins` files first
		Tribe__Main::instance()->load_text_domain( $domain, $mopath );
	}

	$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';
	$title = __( 'The Events Calendar', 'tribe-events-calendar-pro' );
	echo '<div class="error"><p>' . sprintf( __( 'To begin using Events Calendar PRO, please install the latest version of <a href="%s" class="thickbox" title="%s">The Events Calendar</a>.', 'tribe-events-calendar-pro' ), esc_url( $url ), $title ) . '</p></div>';
}

/**
 * Add Events PRO to the list of add-ons to check required version.
 *
 * @return array $plugins the required info
 */
function tribe_init_ecp_addon( $plugins ) {
	$plugins['Tribe__Events__Pro__Main'] = array(
		'plugin_name' => 'Events Calendar PRO',
		'required_version' => Tribe__Events__Pro__Main::REQUIRED_TEC_VERSION,
		'current_version' => Tribe__Events__Pro__Main::VERSION,
		'plugin_dir_file' => basename( dirname( __FILE__ ) ) . '/events-calendar-pro.php',
	);

	return $plugins;
}

register_deactivation_hook( __FILE__, 'tribe_events_pro_deactivation' );
function tribe_events_pro_deactivation( $network_deactivating ) {
	require_once dirname( __FILE__ ) . '/src/Tribe/Main.php';
	Tribe__Events__Pro__Main::deactivate( $network_deactivating );
}

/**
 * The uninstall hook is no longer registered, but leaving the function
 * here to prevent a fatal error if uninstalled on a site that had
 * it registered previously.
 */
function tribe_ecp_uninstall() {
}

/**
 * Requires the autoloader class from the main plugin class and sets up
 * autoloading.
 */
function tribe_init_events_pro_autoloading() {
	if ( ! class_exists( 'Tribe__Autoloader' ) ) {
		return;
	}
	$autoloader = Tribe__Autoloader::instance();

	$autoloader->register_prefix( 'Tribe__Events__Pro__', dirname( __FILE__ ) . '/src/Tribe', 'events-calendar-pro' );

	// deprecated classes are registered in a class to path fashion
	foreach ( glob( dirname( __FILE__ ) . '/src/deprecated/*.php' ) as $file ) {
		$class_name = str_replace( '.php', '', basename( $file ) );
		$autoloader->register_class( $class_name, $file );
	}
	$autoloader->register_autoloader();
}
