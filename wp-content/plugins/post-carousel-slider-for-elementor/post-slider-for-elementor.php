<?php
/**
 Plugin Name: Post Carousel Slider for Elementor
 Description: Post Carousel Slider for Elementor Lets you display your WordPress Posts as Carousel Slider. You can now show your posts using this plugin easily to your users as a Carousel Slider
 Author: Plugin Devs
 Author URI: https://plugin-devs.com/
 Version: 1.1.3
 License: GPLv2
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 Text Domain: post-slider-for-elementor
*/

 // Exit if accessed directly.
 if ( ! defined( 'ABSPATH' ) ) { exit; }

 /**
  * Main class for News Ticker
  */
class WB_POST_SLIDER
 {
 	
 	private static $instance;

	public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new WB_POST_SLIDER();
            self::$instance->init();
        }
        return self::$instance;
    }

    //Empty Construct
 	function __construct(){}
 	
 	//initialize Plugin
 	public function init(){
 		$this->defined_constants();
 		$this->include_files();
		add_action( 'elementor/init', array( $this, 'wb_create_category') ); // Add a custom category for panel widgets
 	}

 	//Defined all constants for the plugin
 	public function defined_constants(){
 		define( 'WB_PS_MAIN_FILE', __FILE__ );
 		define( 'WB_PS_PATH', plugin_dir_path( __FILE__ ) );
		define( 'WB_PS_URL', plugin_dir_url( __FILE__ ) ) ;
		define( 'WB_PS_VERSION', '1.1.3' ) ; //Plugin Version
		define( 'WB_PS_MIN_ELEMENTOR_VERSION', '2.0.0' ) ; //MINIMUM ELEMENTOR Plugin Version
		define( 'WB_PS_MIN_PHP_VERSION', '5.4' ) ; //MINIMUM PHP Plugin Version
		define( 'WB_PS_PRO_LINK', 'https://plugin-devs.com/product/post-carousel-slider-for-elementor/' ) ; //Pro Link
 	}

 	//Include all files
 	public function include_files(){

 		require_once( WB_PS_PATH . 'functions.php' );
 		require_once( WB_PS_PATH . 'admin/post-slider-utils.php' );
 		if( is_admin() ){
 			require_once( WB_PS_PATH . 'admin/admin-pages.php' );	
 			require_once( WB_PS_PATH . 'class-plugin-deactivate-feedback.php' );	
 			require_once( WB_PS_PATH . 'support-page/class-support-page.php' );	
			require_once( WB_PS_PATH . 'class-plugin-review.php');
 		}
 		//require_once( WB_PS_PATH . 'admin/notices/support.php' );
 	}

 	//Elementor new category register method
 	public function wb_create_category() {
	   \Elementor\Plugin::$instance->elements_manager->add_category( 
		   	'web-builder-element',
		   	[
		   		'title' => esc_html( 'Web Builders Element', 'news-ticker-for-elementor' ),
		   		'icon' => 'fa fa-plug', //default icon
		   	],
		   	2 // position
	   );
	}

 	// prevent the instance from being cloned
    public function __clone(){}

    // prevent from being unserialized
    public function __wakeup(){}
 }

function wb_post_slider_register_function(){
	$wb_post_slider = WB_POST_SLIDER::getInstance();
	if( is_admin() ){
		$wb_ps_feedback = new WB_PS_Usage_Feedback(
			__FILE__,
			'webbuilders03@gmail.com',
			false,
			true
		);
	}
}
add_action('plugins_loaded', 'wb_post_slider_register_function');

add_action('wp_footer', 'wb_ps_display_custom_css');
function wb_ps_display_custom_css(){
	$custom_css = get_option( 'wb_ps_custom_css' );
	$css ='';
	if ( ! empty( $custom_css ) ) {
		$css .= '<style type="text/css">';
		$css .= '/* Custom CSS */' . "\n";
		$css .= $custom_css . "\n";
		$css .= '</style>';
	}
	echo $css;
}


/**
 * Submenu filter function. Tested with Wordpress 4.1.1
 * Sort and order submenu positions to match your custom order.
 *
 */
function wb_ps_order_submenu( $menu_ord ) {

  global $submenu;

  // Enable the next line to see a specific menu and it's order positions
  //echo '<pre>'; print_r( $submenu['wbel-post-slider'] ); echo '</pre>'; exit();

  $arr = array();

  $arr[] = $submenu['wbel-post-slider'][1];
  $arr[] = $submenu['wbel-post-slider'][2];
  $arr[] = $submenu['wbel-post-slider'][5];
  $arr[] = $submenu['wbel-post-slider'][4];

  $submenu['wbel-post-slider'] = $arr;

  return $menu_ord;

}

// add the filter to wordpress
add_filter( 'custom_menu_order', 'wb_ps_order_submenu' );


/**
 * Setup Plugin Activation Time
 *
 * @since 1.0.1
 *
 */
register_activation_hook(__FILE__,  'pdpcs_setup_plugin_activation_time' );
add_action('upgrader_process_complete', 'pdpcs_setup_plugin_activation_time');
add_action('init', 'pdpcs_setup_plugin_activation_time');
function pdpcs_setup_plugin_activation_time(){
	$installation_time = get_option('pdpcs_installed_time');
	if( !$installation_time ){
		update_option('pdpcs_installed_time', current_time('timestamp'));
	}
}