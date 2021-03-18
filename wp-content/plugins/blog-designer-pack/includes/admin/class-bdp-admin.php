<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Blog Designer Pack
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Bdp_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'bdp_register_menu'), 9 );		

		// Shortcode Preview
		add_action( 'current_screen', array($this, 'bdp_generate_preview_screen') );

		// Filter to add row action in category table
		add_filter( 'category_row_actions', array($this, 'bdp_add_tax_row_data'), 10, 2 );

		// Action to add admin message
		add_action( 'admin_init', array($this, 'bdp_admin_processes') );

		// Action to add admin message
		add_action( 'admin_notices', array($this, 'bdp_premium_admin_messages') );		
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Blog Designer Pack
	 * @since 1.0.4
	 */
	function bdp_register_menu() {

		// Getting Started Page
		add_menu_page( __('Blog Designer Pack', 'blog-designer-pack'), __('Blog Designer Pack', 'blog-designer-pack'), 'edit_posts', 'bdp-about', array($this, 'bdp_all_shortcode_page'), 'dashicons-editor-bold' );
		
		// Shortcode Builder
		add_submenu_page( 'bdp-about', __('Shortcode Builder - Blog Designer Pack', 'blog-designer-pack'), __('Shortcode Builder', 'blog-designer-pack'), 'manage_options', 'bdp-shrt-generator', array($this, 'bdp_shortcode_generator') );
		
		// Getting Started Sub Menu
		//add_submenu_page( 'bdp-about', __('Getting Started', 'blog-designer-pack'), __('Getting Started', 'blog-designer-pack'), 'manage_options', 'bdp-getting-started', array($this, 'bdp_getting_started_page') );
	
		// Shortcode Preview
		add_submenu_page( null, __('Shortcode Preview - Blog Designer Pack', 'blog-designer-pack'), __('Shortcode Preview', 'blog-designer-pack'), 'manage_options', 'bdp-shortcode-preview', array($this, 'bdp_shortcode_preview_page') );
	}
	
	/**
	 * Plugin Shortcode Builder Page
	 * 
	 * @package Blog Designer Pack
	 * @since 1.0
	 */
	function bdp_shortcode_generator() {
		include_once( BDP_DIR . '/includes/admin/shortcode-generator/shortcode-generator.php' );
	}

	/**
	 * Handle plugin shoercode preview
	 * 
	 * @package Blog Designer Pack
 	 * @since 1.0
	 */
	function bdp_shortcode_preview_page() {
	}
	
	/**
	 * Handle plugin shoercode preview
	 * 
	 * @package Blog Designer Pack
 	 * @since 1.0
	 */
	function bdp_generate_preview_screen( $screen ) {
		if( $screen->id == 'admin_page_bdp-shortcode-preview' ) {
			include_once( BDP_DIR . '/includes/admin/shortcode-generator/shortcode-preview.php' );
			exit;
		}
	}

	/**
	 * Function to get 'All Shortcode' HTML
	 *
	 * @package Blog Designer Pack	
	 * @since 1.0.0
	 */
	function bdp_all_shortcode_page() { 
		include_once( BDP_DIR . '/includes/admin/getting-started.php' );
	}
	
	/**
	 * Function to get 'How It Works' HTML
	 *
	 * @package Blog Designer Pack	
	 * @since 1.0.0
	 */
	function bdp_getting_started_page() {		
		include_once( BDP_DIR . '/includes/admin/all-shortcode-page.php' );
	}

	/**
	 * Function to add category row action
	 * 
	 * @package Blog Designer Pack
	 * @since 1.0
	 */
	function bdp_add_tax_row_data( $actions, $tag ) {
		return array_merge( array( 'pluginplay_id' => "<span style='color:#555'>ID: {$tag->term_id}</span>" ), $actions );
	}

	/**
	 * Function to perform some admin prior processes
	 * 
	 * @since 1.0.7
	 */
	function bdp_admin_processes() {
		
		// If promote notice is cancelled
		if( isset( $_GET['message'] ) && $_GET['message'] == 'bdp-pro-buy-notice' && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'bdp-promote-notice' ) ) {
			set_transient( 'bdp_pro_buy_notice', 1, 30 * DAY_IN_SECONDS );
		}
	}

	/**
	 * Function to add admin message for premium version
	 * 
	 * @since 1.0.7
	 */
	function bdp_premium_admin_messages() {

		$notice_transient = get_transient( 'bdp_pro_buy_notice' );

		if ( $notice_transient == false ) {

			$notice_link	= wp_nonce_url( add_query_arg( array('message' => 'bdp-pro-buy-notice') ), 'bdp-promote-notice' );
			$premium_link	= add_query_arg( array('page' => 'bdp-about-pricing'), admin_url('admin.php') );
			
			$notices = array(
								0 => sprintf( __('Hey! It looks like that you are using Blog Designer Pack for a while. Would you like to a look at the Pro version? <a href="%s">Click here</a> for the amazing features.', 'blog-designer-pack'), $premium_link ),
								1 => sprintf( __('Hey! Do you know Blog Designer Pack Pro have 90+ premium layouts? <a href="%s">Click here</a> to take a look.', 'blog-designer-pack'), $premium_link ),
								2 => sprintf( __('Hey! Blog Designer Pack Pro supports Custom Post type and Custom taxonomy. <a href="%s">Upgrade now</a> to create a any layout for Custom Post type.', 'blog-designer-pack'), $premium_link ),
								4 => sprintf( __('Hey! Do you want more layouts for Post Slider and Post Carousel? <a href="%s">Upgrade now</a>', 'blog-designer-pack'), $premium_link ),
								5 => sprintf( __('Load More or Infinite Scrolling pagination can be a good feature for your blog page with Blog Designer Pack. <a href="%s">Take a look</a>', 'blog-designer-pack'), $premium_link ),
								6 => sprintf( __('Create Category Grid or Category Slider with Blog Designer Pack Pro. <a href="%s">Take a look</a>', 'blog-designer-pack'), $premium_link ),
								7 => sprintf( __('Create Post Timeline layout with Blog Designer Pack Pro. <a href="%s">Upgrade now</a>', 'blog-designer-pack'), $premium_link ),
								8 => sprintf( __('Display Featured Post or Trending Post with Blog Designer Pack Pro. <a href="%s">Upgrade now</a>', 'blog-designer-pack'), $premium_link ),
								9 => sprintf( __('Use social sharing feature for Post with Blog Designer Pack Pro. <a href="%s">Upgrade now</a>', 'blog-designer-pack'), $premium_link ),
							);
			$notice_key = array_rand( $notices );

			echo '<div class="updated notice" style="position:relative;">
					<p>'.$notices[ $notice_key ].' <span style="background-color:tomato; display:inline-block; padding:1px 5px; margin:0 0 0 10px; border-radius:3px; color:#fff; font-size:12px; font-weight:600;">Hot</span></p>
					<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
				</div>';
		}
	}
}

$bdp_admin = new Bdp_Admin();