<?php
/*
Author: Marcin Gierada
Author URI: http://www.teastudio.pl/
Author Email: m.gierada@teastudio.pl
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WP_Posts_Carousel_Utils {

    public static function getTemplates() {
        $plugin_theme_file = scandir( plugin_dir_path(__FILE__) . '../templates/' );

        if ( count($plugin_theme_file) > 0 && array_key_exists(0, $plugin_theme_file) && array_key_exists(1, $plugin_theme_file)) {
            unset($plugin_theme_file[0]);
            unset($plugin_theme_file[1]);
        }

        $site_theme = get_stylesheet_directory() . '/css/wp-posts-carousel/';
        if ( is_dir($site_theme) ) {
            $site_theme_file = scandir( $site_theme );

            if ( count($site_theme_file) > 0 && array_key_exists(0, $site_theme_file) && array_key_exists(1, $site_theme_file) ) {
                unset($site_theme_file[0]);
                unset($site_theme_file[1]);
            }
        } else {
            $site_theme_file = array();
        }

        $templates = array_merge( $plugin_theme_file, $site_theme_file );

        return $templates;
    }

    public static function getTaxonomies() {
        return get_post_types(array(
            'public'            => 'true',
            'show_in_nav_menus' => true
        ), 'objects');
    }

    public static function getShows() {
        return apply_filters('wpc_get_shows', array(
            'id'      => __('By id', 'wp-posts-carousel'),
            'title'   => __('By title', 'wp-posts-carousel'),
            'newest'  => __('Newest', 'wp-posts-carousel'),
            'popular' => __('Popular', 'wp-posts-carousel')
        ));    
    }

    public static function getOrderings() {
        return apply_filters('wpc_get_orderings', array(
            'asc'    => __('Ascending', 'wp-posts-carousel'),
            'desc'   => __('Descending', 'wp-posts-carousel'),
            'random' => __('Random', 'wp-posts-carousel')
        ));
    }

    public static function getDescriptions() {
        return apply_filters('get_descriptions', array(
            'false'   => __('No', 'wp-posts-carousel'),
            'excerpt' => __('Excerpt', 'wp-posts-carousel'),
            'content' => __('Full content', 'wp-posts-carousel')
        ));
    }

    public static function getSources() {
        return apply_filters('get_sources', array(
            'thumbnail' => __('Thumbnail', 'wp-posts-carousel'),
            'medium'    => __('Medium', 'wp-posts-carousel'),
            'large'     => __('Large', 'wp-posts-carousel'),
            'full'      => __('Full', 'wp-posts-carousel')
        ));
    }

    public static function getAnimations() {
        return array(
            'linear'           => 'linear',
            'swing'            => 'swing',
            'easeInQuad'       => 'easeInQuad',
            'easeOutQuad'      => 'easeOutQuad',
            'easeInOutQuad'    => 'easeInOutQuad',
            'easeInCubic'      => 'easeInCubic',
            'easeOutCubic'     => 'easeOutCubic',
            'easeInOutCubic'   => 'easeInOutCubic',
            'easeInQuart'      => 'easeInQuart',
            'easeOutQuart'     => 'easeOutQuart',
            'easeInOutQuart'   => 'easeInOutQuart',
            'easeInQuint'      => 'easeInQuint',
            'easeOutQuint'     => 'easeOutQuint',
            'easeInOutQuint'   => 'easeInOutQuint',
            'easeInExpo'       => 'easeInExpo',
            'easeOutExpo'      => 'easeOutExpo',
            'easeInOutExpo'    => 'easeInOutExpo',
            'easeInSine'       => 'easeInSine',
            'easeOutSine'      => 'easeOutSine',
            'easeInOutSine'    => 'easeInOutSine',
            'easeInCirc'       => 'easeInCirc',
            'easeOutCirc'      => 'easeOutCirc',
            'easeInOutCirc'    => 'easeInOutCirc',
            'easeInElastic'    => 'easeInElastic',
            'easeOutElastic'   => 'easeOutElastic',
            'easeInOutElastic' => 'easeInOutElastic',
            'easeInBack'       => 'easeInBack',
            'easeOutBack'      => 'easeOutBack',
            'easeInOutBack'    => 'easeInOutBack',
            'easeInBounce'     => 'easeInBounce',
            'easeOutBounce'    => 'easeOutBounce',
            'easeInOutBounce'  => 'easeInOutBounce'
        );
    }


    public static function getRelations() {
        return array(
            'and' => __('And', 'wp-posts-carousel'),
            'or'  => __('Or', 'wp-posts-carousel'),
        );
    }


    public static function getTooltip( $text = null, $type = 'help' ) {
        if( $text == null ) {
            return null;
        }

        if ( in_array( $type, array('help', 'warning') ) ) {
            switch ($type) {
                case 'warning':
                    $type = 'warning';
                    break;
                case 'help':
                default:
                    $type = 'editor-help';
                    break;
            }
        }
        return '<a href="" title="' . $text . '" class="wp-posts-carousel-tooltip tooltip-' . $type . '"><span class="dashicons dashicons-' . $type . '" title="' . __('Hint', 'wp-posts-carousel') . '"></span></a>';
    }

    public static function parseBreakpoints( $params ) {
        if ( $params == '') {
            return null;
        }
        $out = '';
        $plugin_options = get_option( 'wp-posts-carousel_options' );
        $breakpoints_array = array();

        if ( array_key_exists('custom_breakpoints', $plugin_options) ) {
            $plugin_breakpoints = explode(',', $plugin_options['custom_breakpoints']);
            $data = @unserialize( $params ) ;
            /*
            * is serialized from widget
            * else from shortcode
             */
            if ( $data !== false || $data === 'b:0;' ) {
                $breakpoints = unserialize( $params );
            } else {
                $data = explode(',', $params);
                if ( !empty($data) ) {
                    foreach ( $data as $points) {

                        $point = explode(':', $points);

                        if ( array_key_exists(0, $point) && array_key_exists(1, $point) ) {
                            $breakpoints_array[$point[0]] = $point[1];
                        }
                    }
                }
            }

            if ( count($breakpoints_array) > 0 ) {
                foreach ( $breakpoints_array as $breakpoint => $items ) {
                    if ( intval($breakpoint) > 0 && intval($items) > 0 && !in_array($breakpoint, array(0,600,1000))) {
                        $out .= ',' . intval($breakpoint) . ':{items: ' . intval($items) . '}';
                    }
                }
            }
        }
        return $out;
    }
}
