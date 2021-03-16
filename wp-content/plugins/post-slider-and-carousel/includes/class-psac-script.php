<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Post Slider and Carousel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Psac_Script {

	function __construct() {

		// Action for admin scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'psac_admin_script_style' ) );

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'psac_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'psac_front_script') );
	}
	
	/**
	 * Registring and enqueing admin sctipts and styles
	 *
	 * @package Post Slider and Carousel
 	 * @since 1.0
	 */
	function  psac_admin_script_style($hook_suffix) {

		// For VC Front End Page Editing
		if( function_exists('vc_is_frontend_editor') && vc_is_frontend_editor() ) {
			wp_register_script( 'psac-vc-frontend', PSAC_URL . 'assets/js/vc/psac-vc-frontend.js', array(), PSAC_VERSION, true );
			wp_enqueue_script( 'psac-vc-frontend' );
		}
		
		// Styles
		wp_register_style( 'psac-admin-style', PSAC_URL . 'assets/css/psac-admin.css', array(), PSAC_VERSION );
		
		wp_register_script( 'psac-shrt-generator', PSAC_URL . 'assets/js/psac-shortcode-generator.js', array( 'jquery' ), PSAC_VERSION, true );
		wp_localize_script( 'psac-shrt-generator', 'Psac_Shrt_Generator', array(
														'shortcode_err' => esc_html__('Sorry, Something happened wrong. Kindly please be sure that you have choosen relevant shortcode from the dropdown.', 'post-slider-and-carousel'),
													));
													
		// Shortcode Builder
		if( $hook_suffix == PSAC_SCREEN_ID.'_page_psac-shrt-generator' ) {			
			wp_enqueue_style( 'psac-admin-style' );
			wp_enqueue_script('shortcode');	
			wp_enqueue_script('jquery-ui-accordion');			
			wp_enqueue_script( 'psac-shrt-generator' );
		}											
	}

	/**
	 * Function to add style at front side
	 * 
	 * @since 1.0
	 */
	function psac_front_style() {

		// Registring and enqueing slider css
		if( ! wp_style_is( 'owl-carousel-style', 'registered' ) ) {
			wp_register_style( 'owl-carousel-style', PSAC_URL.'assets/css/owl.carousel.min.css', array(), PSAC_VERSION );
		}

		// Registring and enqueing public css
		wp_register_style( 'psac-public-style', PSAC_URL.'assets/css/psac-public.css', array(), PSAC_VERSION ); 
		
		wp_enqueue_style( 'owl-carousel-style' );
		wp_enqueue_style( 'psac-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @since 1.0
	 */
	function psac_front_script() {
		
		global $post;
		
		// Taking post id 
		$post_id = isset($post->ID) ? $post->ID : '';
		
		// Registring slider script
		if( ! wp_script_is( 'jquery-owl-carousel', 'registered' ) ) {
			wp_register_script( 'jquery-owl-carousel', PSAC_URL. 'assets/js/owl.carousel.min.js', array('jquery'), PSAC_VERSION, true);
		}
		
		// Registring News Ticker script
		wp_register_script( 'jquery-vticker', PSAC_URL. 'assets/js/post-vticker.min.js', array('jquery'), PSAC_VERSION, true);
		
		// Registring and enqueing public script
		wp_register_script( 'psac-public-script', PSAC_URL. 'assets/js/psac-public.js', array('jquery'), PSAC_VERSION, true );
		wp_localize_script( 'psac-public-script', 'Psac', array(
																'is_mobile' => ( wp_is_mobile() ) ? 1 : 0,
																'is_rtl' 	=> ( is_rtl() ) ? 1 : 0
															));
															
		/*===== Page Builder Scripts =====*/
		// VC Front End Page Editing
		if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {			
			wp_register_script( 'psac-vc-page-iframe', PSAC_URL . 'assets/js/vc/psac-vc-page-iframe.js', array(), PSAC_VERSION, true );	
			
			wp_enqueue_script( 'jquery-owl-carousel' );
			wp_enqueue_script( 'jquery-vticker' );			
			wp_enqueue_script( 'psac-public-script' ); 			
			wp_enqueue_script( 'psac-vc-page-iframe' );
		}

		// Elementor Frontend Editing
		if ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_GET['elementor-preview'] ) && $post_id == (int) $_GET['elementor-preview'] ) {
			wp_register_script( 'psac-elementor-script', PSAC_URL . 'assets/js/elementor/psac-elementor.js', array(), PSAC_VERSION, true );
			
			wp_enqueue_script( 'jquery-owl-carousel' );
			wp_enqueue_script( 'jquery-vticker' );			
			wp_enqueue_script( 'psac-public-script' ); 				
			wp_enqueue_script( 'psac-elementor-script' );
		}																	
	}
}

$psac_script = new Psac_Script();