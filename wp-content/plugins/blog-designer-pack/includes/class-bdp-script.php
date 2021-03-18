<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Blog Designer Pack
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpbdp_Script {
	
	function __construct() {
		
		// Action for admin scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'bdp_admin_script_style' ) );
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'bdp_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'bdp_front_script') );
	}
	
	
	/**
	 * Registring and enqueing admin sctipts and styles
	 *
	 * @package Blog Designer Pack
 	 * @since 1.0
	 */
	function  bdp_admin_script_style($hook_suffix) {
		// For VC Front End Page Editing
		if( function_exists('vc_is_frontend_editor') && vc_is_frontend_editor() ) {
			wp_register_script( 'bdp-vc-frontend', BDP_URL . 'assets/js/vc/bdp-vc-frontend.js', array(), BDP_VERSION, true );
			wp_enqueue_script( 'bdp-vc-frontend' );
		}
		
		// Styles
		wp_register_style( 'bdp-admin-style', BDP_URL . 'assets/css/bdp-admin.css', array(), BDP_VERSION );
		wp_enqueue_style( 'bdp-admin-style' );
		
		wp_register_script( 'bdp-shrt-generator', BDP_URL . 'assets/js/bdp-shortcode-generator.js', array( 'jquery' ), BDP_VERSION, true );
		wp_localize_script( 'bdp-shrt-generator', 'Bdp_Shrt_Generator', array(
																'shortcode_err' => esc_html__('Sorry, Something happened wrong. Kindly please be sure that you have choosen relevant shortcode from the dropdown.', 'blog-designer-pack'),
															));	
																	
		// Shortcode Builder
		if( $hook_suffix == BDP_SCREEN_ID.'_page_bdp-shrt-generator' ) {			
			wp_enqueue_style( 'bdpp-admin-style' );
			wp_enqueue_script('shortcode');	
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('wp-color-picker');	
			wp_enqueue_script( 'bdp-shrt-generator' );
		}															
														
	}	

	/**
	 * Function to add style at front side
	 * 
	 * @package Blog Designer Pack
	 * @since 1.0.4
	 */
	function bdp_front_style() {

		// Registring and enqueing slick slider css
		if( !wp_style_is( 'slick-style', 'registered' ) ) {
			wp_register_style( 'slick-style', BDP_URL.'assets/css/slick.css', array(), BDP_VERSION );
			wp_enqueue_style( 'slick-style' );
		}

		// Registring and enqueing public css
		wp_register_style( 'bdp-public-style', BDP_URL.'assets/css/bdp-public.css', array(), BDP_VERSION );
		wp_enqueue_style( 'bdp-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package Blog Designer Pack
	 * @since 1.0.0
	 */
	function bdp_front_script() {
		
		global $post;
		
		// Taking post id 
		$post_id = isset($post->ID) ? $post->ID : '';

		// Registring slick slider script
		if( !wp_script_is( 'jquery-slick', 'registered' ) ) {
			wp_register_script( 'jquery-slick', BDP_URL. 'assets/js/slick.min.js', array('jquery'), BDP_VERSION, true);
		}
		
		// Registring post vertical ticker script
		if( !wp_script_is( 'jquery-vticker', 'registered' ) ) {
			wp_register_script( 'jquery-vticker', BDP_URL. 'assets/js/post-vticker.min.js', array('jquery'), BDP_VERSION, true);
		}

		// Registring ticker script
		if( !wp_script_is( 'bdp-ticker-script', 'registered' ) ) {
			wp_register_script( 'bdp-ticker-script', BDP_URL . 'assets/js/bdp-ticker.js', array('jquery'), BDP_VERSION, true );
		}
		
		// Registring and enqueing public script
		wp_register_script( 'bdp-public-script', BDP_URL. 'assets/js/bdp-public.js', array('jquery'), BDP_VERSION, true );
		wp_localize_script( 'bdp-public-script', 'Wpbdp', array(
																'is_mobile' 	=> (wp_is_mobile()) ? 1 : 0,
																'is_rtl' 		=> (is_rtl()) ? 1 : 0,
																'ajaxurl' 		=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
																'no_post_msg'	=> esc_html__('Sorry, No more post to display.', 'blog-designer-pack')
																));

		/*===== Page Builder Scripts =====*/
		// VC Front End Page Editing
		if ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) {			
			wp_register_script( 'bdp-vc-page-iframe', BDP_URL . 'assets/js/vc/bdp-vc-page-iframe.js', array(), BDP_VERSION, true );			
			
			wp_enqueue_script( 'jquery-slick' );
			wp_enqueue_script( 'jquery-vticker' );
			wp_enqueue_script( 'bdp-ticker-script' );
			wp_enqueue_script( 'bdp-public-script' ); 			
			wp_enqueue_script( 'bdp-vc-page-iframe' );
		}

		// Elementor Frontend Editing
		if ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_GET['elementor-preview'] ) && $post_id == (int) $_GET['elementor-preview'] ) {
			wp_register_script( 'bdp-elementor-script', BDP_URL . 'assets/js/elementor/bdp-elementor.js', array(), BDP_VERSION, true );
			
			wp_enqueue_script( 'jquery-slick' );
			wp_enqueue_script( 'jquery-vticker' );
			wp_enqueue_script( 'bdp-ticker-script' );
			wp_enqueue_script( 'bdp-public-script' ); 			
			wp_enqueue_script( 'bdp-elementor-script' );
		}															
	}	

}

$bdp_script = new Wpbdp_Script();