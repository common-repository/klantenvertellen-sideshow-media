<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also defines a function that starts the plugin.
 *
 * @link              https://www.sideshowmedia.nl
 * @since             3.0.0
 * @package           Klantenvertellen_SideShow_Media
 *
 * @wordpress-plugin
 * Plugin Name:       Klantenvertellen SideShow Media
 * Plugin URI:        https://www.sideshowmedia.nl/klantenvertellen-plugin-voor-wordpress/
 * Description:       Easily display a widget or reviews from Klantenvertellen on your WordPress website.
 * Version:           3.0.4
 * Author:            Zadok Buurmans
 * Author URI:        http://www.zadokbuurmans.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
     die;
}

// Include the shared and public dependencies.
include_once( plugin_dir_path( __FILE__ ) . 'shared/class-deserializer.php' );
include_once( plugin_dir_path( __FILE__ ) . 'public/class-content-messenger.php' );

// Include the dependencies needed to instantiate the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'admin/*.php' ) as $file ) {
    include_once $file;
}

add_action( 'plugins_loaded', 'klantenvertellen_sideshow_media' );

/**
 * Starts the plugin.
 *
 * @since 3.0.0
 */
function klantenvertellen_sideshow_media() {
	
	// Setup and initialize the class for saving our options.
	$serializer = new Serializer();
	$serializer->init();

	// Setup the class used to retrieve our option value.
	$deserializer = new Deserializer();

	// Setup the administrative functionality.
	$admin = new Menu( new Menu_Page( $deserializer ) );
	$admin->init();

	// Setup the public facing functionality.
	$public = new Content_Messenger( $deserializer );
	$public->init();
}