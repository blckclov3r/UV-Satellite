<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Post Slider and Carousel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Psac_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'psac_register_menu') );
		
		// Shortcode Preview
		add_action( 'current_screen', array($this, 'psac_generate_preview_screen') );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @since 1.0
	 */
	function psac_register_menu() {

		// Getting Started Page
		add_menu_page( __('Post Slider and Carousel', 'post-slider-and-carousel'), __('Post Slider and Carousel', 'post-slider-and-carousel'), 'edit_posts', 'psac-about', array($this, 'psac_getting_started_page'), 'dashicons-sticky' );
	
		// Shortcode Builder
		add_submenu_page( 'psac-about', __('Shortcode Builder - Post Slider and Carousel', 'post-slider-and-carousel'), __('Shortcode Builder', 'post-slider-and-carousel'), 'manage_options', 'psac-shrt-generator', array($this, 'psac_shortcode_generator') );
	
		// Shortcode Preview
		add_submenu_page( null, __('Shortcode Preview - Post Slider and Carousel', 'post-slider-and-carousel'), __('Shortcode Preview', 'post-slider-and-carousel'), 'manage_options', 'psac-shortcode-preview', array($this, 'psac_shortcode_preview_page') );
	}

	/**
	 * Function to get 'How It Works' HTML
	 *
	 * @since 1.0
	 */
	function psac_getting_started_page() {
		include_once( PSAC_DIR . '/includes/admin/getting-started.php' );
	}
	
	/**
	 * Plugin Shortcode Builder Page
	 * 
	 * @since 1.0
	 */
	function psac_shortcode_generator() {
		include_once( PSAC_DIR . '/includes/admin/shortcode-generator/shortcode-generator.php' );
	}
	
	/**
	 * Handle plugin shoercode preview
	 * 
 	 * @since 1.0
	 */
	function psac_shortcode_preview_page() {
	}
	
	/**
	 * Handle plugin shoercode preview
	 * 	
 	 * @since 1.0
	 */
	function psac_generate_preview_screen( $screen ) {
		if( $screen->id == 'admin_page_psac-shortcode-preview' ) {
			include_once( PSAC_DIR . '/includes/admin/shortcode-generator/shortcode-preview.php' );
			exit;
		}
	}
}

$psac_admin = new Psac_Admin();