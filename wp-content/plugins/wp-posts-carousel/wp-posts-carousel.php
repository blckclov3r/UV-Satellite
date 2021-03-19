<?php
/*
Plugin Name: Wp Posts Carousel
Plugin URI: http://www.teastudio.pl/en/product/wp-posts-carousel/
Description: WP Posts Carousel is a widget and a shortcode generator to displays posts in carousel by <a href="http://www.owlcarousel.owlgraphic.com/" target="_blank" title="OWL Carousel homepage">OWL Carousel</a>.
Version: 1.3.7
Author: Marcin Gierada
Author URI: http://www.teastudio.pl/
Author Email: m.gierada@teastudio.pl
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/*
 * load i18n
 */
add_action("init", "wp_posts_carousel_init");
function wp_posts_carousel_init() {
    load_plugin_textdomain("wp-posts-carousel", false, dirname(plugin_basename( __FILE__ )) .  "/i18n/languages/");
}


/*
 * plugin
 */
$WP_Posts_Carousel = new WP_Posts_Carousel();
class WP_Posts_Carousel {
    const VERSION = '1.3.6';
    private $plugin_name = 'WP Posts Carousel';
    private $plugin_slug = 'wp-posts-carousel';
    private $options = array();

    public function __construct() {
        /*
         * get options
         */
        $this->options = array_merge( $this->get_defaults(), get_option($this->plugin_slug . '_options') ? get_option($this->plugin_slug . '_options') : array() );


        /*
         * include utils
         */
        require_once( "includes/utils.class.php" );

        //include required files based on admin or site
        if ( is_admin() ) {
            /*
             * activate plugin
             */
            add_action( 'init', array($this, 'wp_posts_carousel_button') );
            add_action( 'admin_init', array($this, 'register_settings'));
            add_action( 'admin_menu', array($this, 'admin_menu_options'));
            add_action( 'admin_head',  array($this, 'wp_posts_carousel_wp_head') );
            add_action( 'admin_head', array($this, 'wp_posts_carousel_button') );

            /*
             * register scripts and stylesheets for admin
             */
            add_action( "admin_enqueue_scripts", array($this, "admin_wp_posts_carousel_register_scripts") );
            /*
             * ajax page for shortcode generator
             */
            add_action( "wp_ajax_wp_posts_carousel_shortcode_generator", array($this, "WpPostsCarouselShortcodeGenerator") );

            /*
             * clear settings
             */
            register_deactivation_hook(__FILE__,  array($this, 'deactivation') );
        } else {
            require_once( "shortcode-decode.class.php" );

            /*
             * register scripts
             */
            add_action( "wp_enqueue_scripts", array($this, "wp_posts_carousel_register_scripts") );
            add_action( "wp_head",  array($this, "wp_posts_carousel_wp_head") );
        }

            /*
             * widget
             */
            require_once( "carousel-generator.class.php" );
            require_once( "carousel-widget.class.php" );
    }

    /**
     * deactivate the plugin
     */
    public function deactivation() {
        if ( !current_user_can( 'activate_plugins' ) ) {
           return;
        }
        delete_option( $this->plugin_slug . '_options' );
    }

    /**
     * retrieves the plugin options from the database.
     */
    private function get_defaults() {
        return array();
    }


    function WpPostsCarouselShortcodeGenerator() {
        require_once("shortcode-generator.php");
        exit();
    }

    /*
     * adds the plugin url in the head tag
     */
    function wp_posts_carousel_wp_head() {
        echo "<script>var wp_posts_carousel_url=\"".plugin_dir_url(__FILE__)."\";</script>";
    }

    /*
     * registers the scripts and styles for admin
     */
    public function admin_wp_posts_carousel_register_scripts() {
        wp_register_script("wp-posts-carousel-js", plugin_dir_url(__FILE__) . "js/wp-posts-carousel.js", array('jquery'), '1.0.0', true);
        wp_enqueue_script("wp-posts-carousel-js");

        wp_register_style("wp-posts-carousel-css", plugin_dir_url(__FILE__) . "css/wp-posts-carousel.css");
        wp_enqueue_style("wp-posts-carousel-css");
    }

    /*
     * registers the scripts and styles
     */
    function wp_posts_carousel_register_scripts() {
        $include_in_footer = array_key_exists('include_in_footer', $this->options) ? true  : false;

        wp_register_script("owl.carousel", plugin_dir_url(__FILE__) . "owl.carousel/owl.carousel.js", array('jquery'), '2.0.0', $include_in_footer);
        wp_register_script("jquery-mousewheel", plugin_dir_url(__FILE__) . "owl.carousel/jquery.mousewheel.min.js", array('jquery'), '3.1.12', $include_in_footer);
        wp_register_style("owl.carousel.style", plugin_dir_url(__FILE__) . "owl.carousel/assets/owl.carousel.css");

        wp_enqueue_script("jquery-effects-core");
        wp_enqueue_script("owl.carousel");
        wp_enqueue_script("jquery-mousewheel");
        wp_enqueue_style("owl.carousel.style");

        /*
         * include Font Awesome library from Bootstrap CDN
         */
        if( array_key_exists('include_font_awesome', $this->options) && $this->options['include_font_awesome'] == 1 ) {
            wp_enqueue_style('wp-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
        }
    }

    /*
     * add button to editor
     */
    function wp_posts_carousel_button() {
        // check user permissions
        if ( !current_user_can( "edit_posts" ) && !current_user_can( "edit_pages" ) ) {
            return;
        }

        //adds button to the visual editor
        add_filter( "mce_external_plugins", array($this, "add_wp_posts_carousel_plugin") );
        add_filter( "mce_buttons", array($this, "register_add_wp_posts_carousel_button") );
    }

    /*
     * callback function
     */
    function add_wp_posts_carousel_plugin( $plugin_array ) {
        $blog_version = floatval(get_bloginfo("version"));

        if( $blog_version >= 4.0 ) {
            $version = "plugin-4.0.js";
        } else if( $blog_version < 4.0 && $blog_version >= 3.9 ) {
            $version = "plugin-3.9.js";
        } else {
            $version = "plugin-3.6.js";
        }

        $plugin_array["wp_posts_carousel_button"] = plugin_dir_url(__FILE__)."js/".$version;
        return $plugin_array;
    }

    /*
     * callback function
     */
    public function register_add_wp_posts_carousel_button( $buttons ) {
        array_push($buttons, "wp_posts_carousel_button");
        return $buttons;
    }

    /**
     * add submenu
     */
    public function admin_menu_options() {
        add_options_page(
            __($this->plugin_name, $this->plugin_slug),
            __($this->plugin_name, $this->plugin_slug),
            'manage_options',
            $this->plugin_slug,
            array( $this, 'settings_page' )
        );
    }

    /**
     * regiseter plugin settings
     */
    public function register_settings() {
        register_setting( $this->plugin_slug, $this->plugin_slug . '_options' );
    }

public function settings_page() {

    /**
     * check if WordPress Popular Posts is active
     */
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( !is_plugin_active( 'wordpress-popular-posts/wordpress-popular-posts.php' ) ) {
        echo '<div class="error"><p>'. __('The <strong>WP Posts Carousel</strong> plugin may require <a href="https://wordpress.org/plugins/wordpress-popular-posts/" target="_blank" title="WordPress Popular Posts">WordPress Popular Posts</a> plugin to display popular posts in carousel. Please install or active this plugin.', $this->plugin_slug) .'</p></div>';
    }
?>
<div class="wrap">
    <h2><?php _e($this->plugin_name, $this->plugin_slug) ?></h2>

    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <div class="inner-sidebar">
            <?php include( 'includes/plugin-info.php' ); ?>
        </div>

        <div class="has-sidebar sm-padded">
            <div id="post-body-content" class="has-sidebar-content">
                <form method="post" action="options.php">
                    <?php settings_fields( $this->plugin_slug ); ?>

                    <h3><?php _e('Main settings', $this->plugin_slug) ?></h3>
                    <hr />

                    <table class="form-table" style="width:auto;clear:initial;">
                        <tbody>
                            <tr valign="top">
                                <th scope="row"><?php _e('Font Awesome', $this->plugin_slug) ?></th>
                                <td>
                                    <label for="<?php echo $this->plugin_slug; ?>_first_paragraph_lock">
                                        <input type="checkbox" name="<?php echo $this->plugin_slug; ?>_options[include_font_awesome]" id="<?php echo $this->plugin_slug; ?>_include_font_awesome" value="1" <?php array_key_exists('include_font_awesome', $this->options) ? checked( (bool) $this->options["include_font_awesome"], true ): null; ?> />
                                        <?php _e('Include Font Awesome', $this->plugin_slug) ?>
                                    </label>
                                    <p class="description"><?php _e('Select this option if you would like to include <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank"><b>Font Awesome</b></a> stylesheet.<br />Uncheck if you are already using this library.', $this->plugin_slug) ?></p>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e('Scripts include', $this->plugin_slug) ?></th>
                                <td>
                                    <label for="<?php echo $this->plugin_slug; ?>_first_paragraph_lock">
                                        <input type="checkbox" name="<?php echo $this->plugin_slug; ?>_options[include_in_footer]" id="<?php echo $this->plugin_slug; ?>_include_in_footer" value="1" <?php array_key_exists('include_in_footer', $this->options) ? checked( (bool) $this->options["include_in_footer"], true ): null; ?> />
                                        <?php _e('Include plugin\'s scripts in "footer" section', $this->plugin_slug) ?>
                                    </label>
                                    <p class="description"><?php _e('Select if you want to include plugins\'s scripts in "footer" section. (on defaults is include in "head")', $this->plugin_slug) ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h3><?php _e('Carousel settings', $this->plugin_slug) ?></h3>
                    <hr />

                    <table class="form-table" style="width:auto;clear:initial;">
                        <tbody>
                            <tr valign="top">
                                <th scope="row"><?php _e('Custom breakpoints', $this->plugin_slug) ?></th>
                                <td>
                                    <label for="<?php echo $this->plugin_slug; ?>_first_paragraph_lock">
                                        <textarea name="<?php echo $this->plugin_slug; ?>_options[custom_breakpoints]" id="<?php echo $this->plugin_slug; ?>_custom_breakpoints" class="wp-posts-carousel-field field-validate" style="width:100%;" rows="2" pattern="^[1-9](0*)(,?[1-9](0*))*$"><?php echo array_key_exists('custom_breakpoints', $this->options) ? $this->options["custom_breakpoints"] : ''; ?></textarea>
                                    </label>
                                    <p class="description"><?php _e('If you need, you can provide custom breakpoints (device screen width) for Responsive Web Design. Please enter breakpoints with comma seperated, e.g: 900,800', $this->plugin_slug) ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr />
                    <?php submit_button('', 'primary', 'submit', true); ?>
                </form>
                <div class="updated below-h2">
                    <div style="padding: 10px">
                        <span class="dashicons dashicons-admin-post"></span> <?php _e('Now you can go to widget list or to post/page edit for create your first carousel. Have a fun!', $this->plugin_slug) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
}