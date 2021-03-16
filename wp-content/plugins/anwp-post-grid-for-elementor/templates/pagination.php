<?php
/**
 * The Template for displaying Pagination.
 *
 * This template can be overridden by copying it to yourtheme/anwp-post-grid/pagination.php
 *
 * @var object $data - Object with widget data.
 *
 * @author           Andrei Strekozov <anwp.pro>
 * @package          AnWP_Post_Grid/Templates
 * @since            0.6.4
 *
 * @version          0.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$data = (object) wp_parse_args(
	$data,
	[
		'grid_posts'      => [],
		'total_posts'     => '',
		'show_load_more'  => false,
		'show_pagination' => '',
		'limit'           => 3,
	]
);

if ( 'yes' !== $data->show_pagination || ! absint( $data->total_posts ) || ! absint( $data->limit ) || $data->total_posts <= $data->limit || $data->show_load_more ) {
	return;
}
?>
<nav aria-label="anwp-pg-pagination-navigation" class="anwp-pg-pagination-navigation position-relative">
	<ul class="anwp-pg-pagination mx-0 justify-content-center flex-wrap"
		data-anwp-show_previous="yes"
		data-anwp-show_next="yes"
		data-anwp-show_first_ellipsis="yes"
		data-anwp-show_last_ellipsis="yes"
		data-anwp-auto_hide_previous="no"
		data-anwp-auto_hide_next="no"
		data-anwp-show_page_numbers="yes"
		data-anwp-page_range="2"
		data-anwp-text_previous=""
		data-anwp-text_next=""
		data-anwp-total="<?php echo esc_attr( ceil( $data->total_posts / $data->limit ) ); ?>"
		data-anwp-pagination="<?php echo esc_attr( anwp_post_grid()->elements->get_serialized_load_more_data( $data ) ); ?>"></ul>
</nav>
