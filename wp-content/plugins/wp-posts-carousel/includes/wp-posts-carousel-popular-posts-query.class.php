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

/*
 * class to get populat posts from Wordpress Popular Posts plugin
 */
class WP_Posts_Carousel_Popular_Posts_Query extends WP_Query {
    private $args;

    function __construct($args) {
        $this->args = $args;

        add_filter( 'posts_fields', array( $this, 'posts_fields') );
        add_filter( 'posts_orderby', array( $this, 'posts_orderby' ) );

        parent::__construct($args);

        remove_filter( 'posts_fields', array( $this, 'posts_fields' ) );
        remove_filter( 'posts_orderby', array( $this, 'posts_orderby' ) );
    }

    function posts_fields($sql) {
        global $wpdb;
        return $sql . ", (SELECT SUM(". $wpdb->prefix . "popularpostsdata.pageviews) FROM " . $wpdb->prefix . "popularpostsdata WHERE postid=" . $wpdb->posts . ".ID AND last_viewed > DATE_SUB('" . current_time('mysql') . "', INTERVAL 1 MONTH)) AS views";
    }

    function posts_orderby($sql) {
        return "views " . $this->args['order'];
    }
}
?>