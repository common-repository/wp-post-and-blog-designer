<?php
/**
 * Plugin Name: WP Post and Blog Designer
 * Plugin URI: https://profiles.wordpress.org
 * Version: 1.1
 * Description: Display Posts on your website with 8 layouts (2 designs for each layout) plus 1 Ticker and 2 Widgets.
 * Text Domain: wp-post-and-blog-designer
 * Domain Path: /languages/
 * Author: pareshpachani007
 * Author URI: https://profiles.wordpress.org/pareshpachani007
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * defind variable for plugin definitions
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
if( !defined( 'WPBD_VERSION' ) ) {
	define( 'WPBD_VERSION', '1.1' ); // Version of plugin
}
if( !defined( 'WPBD_DIR' ) ) {
	define( 'WPBD_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPBD_URL' ) ) {
	define( 'WPBD_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPBD_PLUGIN_BASENAME' ) ) {
	define( 'WPBD_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined('WPBD_POST_TYPE') ) {
	define('WPBD_POST_TYPE', 'post'); // Post type name
}
if( !defined('WPBD_CAT') ) {
	define('WPBD_CAT', 'category'); // Plugin category name
}
/**
 * Load plugin Text Domain
 * This gets the plugin ready to translation
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_load_textdomain() {

	global $wp_version;
	
	// Set filter for plugin languages directory.
	$wpbd_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wpbd_lang_dir = apply_filters( 'wpbd_get_languages_directory', $wpbd_lang_dir );
	
	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter.
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'wp-post-and-blog-designer' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'wp-post-and-blog-designer', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $wpbd_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/plugins/' . WPBD_PLUGIN_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // check it in global /wp-content/languages/wp-post-and-blog-designer folder
		
		load_textdomain( 'wp-post-and-blog-designer', $mofile_global );
		
	} else { // Load the default language files
		load_plugin_textdomain( 'wp-post-and-blog-designer', false, $wpbd_lang_dir );
	}	
}
// Action to load plugin text domain
add_action('plugins_loaded', 'wpbd_load_textdomain');
// Functions file
require_once( WPBD_DIR . '/includes/wpbd-functions.php' );
// common Script file with Class 
require_once( WPBD_DIR . '/includes/class-wpbd-script.php' );
// for Admin file
require_once( WPBD_DIR . '/includes/admin/wpbd-admin.php' );
require_once( WPBD_DIR . '/includes/class-wpbd-ajax.php' );


// all Shortcode files
require_once( WPBD_DIR . '/shortcodes/class-wpbd-shortcode.php' );

// Widgets Files 
require_once( WPBD_DIR . '/widgets/class-wpbd-post-widget.php' );
require_once( WPBD_DIR . '/widgets/class-wpbd-post-sliding-widget.php' );