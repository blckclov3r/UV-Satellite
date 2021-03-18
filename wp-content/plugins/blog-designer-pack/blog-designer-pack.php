<?php
/**
 * Plugin Name: Blog Designer Pack
 * Plugin URI: https://premium.infornweb.com/news-blog-designer-pack-pro/
 * Version: 2.2.5
 * Description: Display blog posts on your website with 6 blog layouts (2 designs for each blog layout) plus 1 Ticker and 2 Widgets
 * Text Domain: blog-designer-pack
 * Domain Path: /languages/
 * Author: InfornWeb
 * Author URI: https://premium.infornweb.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( function_exists( 'bdp_fs' ) ) {
	bdp_fs()->set_basename( false, __FILE__ );
}

/**
 * Basic plugin definitions
 * 
 * @package Blog Designer Pack
 * @since 1.0.0
 */
if( !defined( 'BDP_VERSION' ) ) {
	define( 'BDP_VERSION', '2.2.5' ); // Version of plugin
}
if( !defined( 'BDP_DIR' ) ) {
	define( 'BDP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'BDP_URL' ) ) {
	define( 'BDP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'BDP_PLUGIN_BASENAME' ) ) {
	define( 'BDP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined('BDP_POST_TYPE') ) {
	define('BDP_POST_TYPE', 'post'); // Post type name
}
if( !defined('BDP_CAT') ) {
	define('BDP_CAT', 'category'); // Plugin category name
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Blog Designer Pack
 * @since 1.0
 */
register_activation_hook( __FILE__, 'bdp_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package Blog Designer Pack
 * @since 1.0.6
 */
function bdp_install() {

	// Deactivate free version
	if( is_plugin_active('blog-designer-pack-pro/blog-designer-pack-pro.php') ) {
		add_action( 'update_option_active_plugins', 'bdp_deactivate_pro_version' );
	}

	$notice_transient = get_transient( 'bdp_pro_buy_notice' );

	if ( $notice_transient == false ) {
		set_transient( 'bdp_pro_buy_notice', 1, HOUR_IN_SECONDS );
	}
}

/**
 * Deactivate free plugin
 * 
 * @package Blog Designer Pack
 * @since 1.0.6
 */
function bdp_deactivate_pro_version() {
	deactivate_plugins('blog-designer-pack-pro/blog-designer-pack-pro.php', true);
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Blog Designer Pack
 * @since 1.0.0
 */
function bdp_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory.
	$bdp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$bdp_lang_dir = apply_filters( 'bdp_languages_directory', $bdp_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter.
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'blog-designer-pack' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'blog-designer-pack', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $bdp_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/plugins/' . BDP_PLUGIN_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/blog-designer-pack folder
		
		load_textdomain( 'blog-designer-pack', $mofile_global );
		
	} else { // Load the default language files
		load_plugin_textdomain( 'blog-designer-pack', false, $bdp_lang_dir );
	}	
}

/**
 * Plugins Loaded Action
 * Call function when all plugins are loaded.
 * 
 * @package Blog Designer Pack
 * @since 1.0.0
 */
function bdp_plugins_loaded() {
		
	bdp_load_textdomain();
			
	if( ! defined('BDP_SCREEN_ID') ) {
		define( 'BDP_SCREEN_ID', sanitize_title(__('Blog Designer Pack', 'blog-designer-pack')) );
	}
}
add_action('plugins_loaded', 'bdp_plugins_loaded');

// Including freemius file
include_once( BDP_DIR . '/freemius.php' );

// Functions file
require_once( BDP_DIR . '/includes/bdp-functions.php' );
require_once( BDP_DIR . '/includes/bdp-ajax-functions.php' );

// Script Class
require_once( BDP_DIR . '/includes/class-bdp-script.php' );

// Admin file
require_once( BDP_DIR . '/includes/admin/class-bdp-admin.php' );

// Shortcode files
require_once( BDP_DIR . '/includes/shortcodes/bdp-post.php' );
require_once( BDP_DIR . '/includes/shortcodes/bdp-post-list.php' );
require_once( BDP_DIR . '/includes/shortcodes/bdp-post-gridbox.php' );
require_once( BDP_DIR . '/includes/shortcodes/bdp-recent-post-slider.php' ); 
require_once( BDP_DIR . '/includes/shortcodes/bdp-recent-post-carousel.php' );
require_once( BDP_DIR . '/includes/shortcodes/bdp-post-masonry.php' );
require_once( BDP_DIR . '/includes/shortcodes/bdp-post-ticker.php' );

// Widgets Files
require_once( BDP_DIR . '/includes/widgets/class-bdp-latest-post.php' );
require_once( BDP_DIR . '/includes/widgets/class-bdp-latest-post-scrolling-widget.php' );

// Shortcode Supports
include_once( BDP_DIR . '/includes/admin/shortcode-support/shortcode-fields.php' );