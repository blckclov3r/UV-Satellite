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

class WpPostsCarouselShortcodeDecode {
    public static function initialize($atts, $content = null, $code = "") {
        return WpPostsCarouselGenerator::generate($atts);
    }
}
add_shortcode("wp_posts_carousel", array('WpPostsCarouselShortcodeDecode', "initialize"));
?>