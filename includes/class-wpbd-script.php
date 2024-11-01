<?php
/**
 * Script and CSS Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Post and Blog Designer
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Wpbd_Script {	
	function __construct() {		
		// Action for add style on front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpbd_front_style') );		
		// Action for add script on front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpbd_front_script') );		
	}
	/**
	 * Function to add style at front side
	 * 
	 * @package Wp post and Blog Designer
	 * @since 1.0.0
	 */
	function wpbd_front_style() {

          // Registring font awesome css
		 if( !wp_style_is( 'wpoh-fontawesome-css', 'registered' ) ) {
			wp_register_style( 'wpoh-fontawesome-css', WPBD_URL.'assets/css/font-awesome.min.css', array(), WPBD_VERSION  );
			wp_enqueue_style( 'wpoh-fontawesome-css' );
			
		} 
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpoh-slick-css', 'registered' ) ) {
			wp_register_style( 'slick-style', WPBD_URL.'assets/css/wpbd-slick.css', array(), WPBD_VERSION );
			wp_enqueue_style( 'slick-style' );
		}
		// Register and enqueing custom css
		wp_register_style( 'wpbd-custom-style', WPBD_URL.'assets/css/wpbd-custom.css', array(), WPBD_VERSION );
		wp_enqueue_style( 'wpbd-custom-style' );
	}
	/**
	 * Function for add script at front side 
	 * 
	 * @package Wp post and Blog Designer
	 * @since 1.0.0
	 */
	function wpbd_front_script() {
		// Register slick slider script for post design
		if( !wp_script_is( 'wpoh-slick-js', 'registered' ) ) {
			wp_register_script( 'wpoh-slick-js', WPBD_URL. 'assets/js/wpbd-slick.min.js', array('jquery'), WPBD_VERSION, true);
		}
		
		// Register vertical ticker script for post designer
		if( !wp_script_is( 'wpoh-vartical-ticker-js', 'registered' ) ) {
			wp_register_script( 'wpoh-vartical-ticker-js', WPBD_URL. 'assets/js/wpbd-post-ticker.js', array('jquery'), WPBD_VERSION, true);
		}

		// Register all ticker script for post and blog designer
		if( !wp_script_is( 'wpbd-ticker-js', 'registered' ) ) {
			wp_register_script( 'wpbd-ticker-js', WPBD_URL . 'assets/js/wpbd-costum-ticker.js', array('jquery'), WPBD_VERSION, true );
		}

		// Register all ticker script for post and blog designer
		if( !wp_script_is( 'wpoh-filter-js', 'registered' ) ) {
			wp_register_script( 'wpoh-filter-js', WPBD_URL . 'assets/js/filterizr.js', array('jquery'), WPBD_VERSION, true );
			
		}
		
		// Register and enque custom script
		wp_register_script( 'wpbd-custom-script', WPBD_URL. 'assets/js/wpbd-costum.js', array('jquery'), WPBD_VERSION, true );
		wp_localize_script( 'wpbd-custom-script', 'Wpbd', array(
																		'is_mobile' => (wp_is_mobile()) ? 1 : 0,
																		'is_rtl' 	=> (is_rtl()) ? 1 : 0
																	));
		// Register Custom Mmasonry Script
		wp_register_script( 'wpbd-custom-masonry-script', WPBD_URL.'assets/js/wpbd-custom-masonry.js', array('jquery'), WPBD_VERSION, true );

		// Register  script for SSL certificate for AJAX
		wp_localize_script( 'wpbd-custom-masonry-script', 'Wpbd', array( 
																	'ajaxurl' 		=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
																	'no_post_msg'	=> __('Sorry, No more post Available.', 'wp-post-and-blog-designer')
																));															
	}	

}

$wpbd_script = new Wpbd_Script();