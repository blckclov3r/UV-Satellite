<?php
/**
 * Plugin Name: Post Slider and Carousel with Widget
 * Plugin URI: https://demo.infornweb.com/post-slider-and-carousel/
 * Version: 2.0.5
 * Description: Display Posts Slider or Post Carousel on your website. Display Latest OR Recent posts with vertical scrolling slider widget.
 * Text Domain:  post-slider-and-carousel
 * Domain Path: /languages/
 * Author: InfornWeb
 * Author URI: https://premium.infornweb.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( function_exists( 'psac_fs' ) ) {
	psac_fs()->set_basename( false, __FILE__ );
}

/**
 * Basic plugin definitions
 * 
 * @package Post Slider and Carousel
 * @since 1.0.0
 */
if( !defined( 'PSAC_VERSION' ) ) {
	define( 'PSAC_VERSION', '2.0.5' ); // Version of plugin
}
if( !defined( 'PSAC_DIR' ) ) {
	define( 'PSAC_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'PSAC_URL' ) ) {
	define( 'PSAC_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'PSAC_PLUGIN_BASENAME' ) ) {
	define( 'PSAC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined('PSAC_POST_TYPE') ) {
	define('PSAC_POST_TYPE', 'post'); // Post type name
}
if( !defined('PSAC_CAT') ) {
	define('PSAC_CAT', 'category'); // Plugin category name
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Post Slider and Carousel
 * @since 1.0
 */
register_activation_hook( __FILE__, 'psac_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package Post Slider and Carousel
 * @since 1.0
 */
function psac_install() {

	// Deactivate free version
	if( is_plugin_active('post-slider-and-carousel-pro/post-slider-and-carousel-pro.php') ) {
		add_action( 'update_option_active_plugins', 'psac_deactivate_pro_version' );
	}
}

/**
 * Deactivate premium version to avoid conflicts
 * 
 * @since 1.0
 */
function psac_deactivate_pro_version() {
	deactivate_plugins('post-slider-and-carousel-pro/post-slider-and-carousel-pro.php', true);
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Post Slider and Carousel
 * @since 1.0.0
 */
function psac_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory.
	$psac_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$psac_lang_dir = apply_filters( 'psac_languages_directory', $psac_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter.
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'post-slider-and-carousel' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'post-slider-and-carousel', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $psac_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/plugins/' . PSAC_PLUGIN_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/post-slider-and-carousel folder
		
		load_textdomain( 'post-slider-and-carousel', $mofile_global );
		
	} else { // Load the default language files
		load_plugin_textdomain( 'post-slider-and-carousel', false, $psac_lang_dir );
	}	
}

function psac_plugins_loaded() {
			psac_load_textdomain();
			
			if( !defined('PSAC_SCREEN_ID') ) {
				define( 'PSAC_SCREEN_ID', sanitize_title(__('Post Slider and Carousel', 'post-slider-and-carousel')) );
			}			
}
add_action('plugins_loaded', 'psac_plugins_loaded');

// Including freemius file
include_once( PSAC_DIR . '/freemius.php' );

// Functions file
require_once( PSAC_DIR . '/includes/psac-functions.php' );

// Script Class
require_once( PSAC_DIR . '/includes/class-psac-script.php' );

// Admin file
require_once( PSAC_DIR . '/includes/admin/class-psac-admin.php' );

// Shortcode files
require_once( PSAC_DIR . '/includes/shortcodes/psac-recent-post-slider.php' ); 
require_once( PSAC_DIR . '/includes/shortcodes/psac-recent-post-carousel.php' );

// Widgets Files
require_once( PSAC_DIR . '/includes/widgets/class-psac-post-scrolling-widget.php' );

// Shortcode Supports
include_once( PSAC_DIR . '/includes/admin/shortcode-support/shortcode-fields.php' );