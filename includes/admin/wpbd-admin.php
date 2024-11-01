<?php
/**
 * post plugin Admin Class
 *
 * manage for the Admin side functionality of this plugin
 *
 * @package WP Post and Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Wpbd_Admin {
	function __construct() {
		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wpbd_register_menu'), 9 );
		// Filter to add plugin action link
		add_filter( 'wpoh_plugin_action_links_' .WPBD_PLUGIN_BASENAME, array($this, 'wpbd_plugin_action_links') );
	}
	/**
	 * Function to register admin menus
	 * 
	 * @package WP Post and Blog Designer
	 * @since 1.0.4
	 */
	function wpbd_register_menu() {		
		// Getting Started Page
		add_menu_page( __('Post wpbd Blog Design', 'wp-post-and-blog-designer'), __('Post & Blog Design', 'wp-post-and-blog-designer'), 'edit_posts', 'wpbd-about', array($this, 'wpbd_getting_started_page'), 'dashicons-admin-customizer', 6 );		
		
	}
	/**
	 * Function to get 'How It Works' HTML
	 *
	 * @package WP Post and Blog Designer	
	 * @since 1.0.0
	 */
	function wpbd_getting_started_page() {
	include_once( WPBD_DIR. '/includes/admin/how-it-work.php' );
	}
}

$wpbd_admin = new Wpbd_Admin();