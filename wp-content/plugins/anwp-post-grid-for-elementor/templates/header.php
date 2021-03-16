<?php
/**
 * The Template for displaying Header.
 *
 * This template can be overridden by copying it to yourtheme/anwp-post-grid/header.php
 *
 * @var object $data - Object with widget data.
 *
 * @author           Andrei Strekozov <anwp.pro>
 * @package          AnWP_Post_Grid/Templates
 * @since            0.7.0
 *
 * @version          0.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$data = (object) wp_parse_args(
	$data,
	[
		'grid_widget_title' => '',
		'header_size'       => '',
		'header_icon'       => '',
	]
);

if ( empty( $data->grid_widget_title ) ) {
	return false;
}
?>
<div class="anwp-pg-widget-header d-flex align-items-center position-relative">
	<?php
	printf(
		'<%1$s class="d-flex align-items-center flex-wrap anwp-pg-widget-header__title">%3$s %2$s</%1$s>',
		esc_attr( $data->header_size ),
		esc_html( $data->grid_widget_title ),
		$data->header_icon // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	);
	?>
	<div class="anwp-pg-widget-header__secondary-line"></div>
</div>
