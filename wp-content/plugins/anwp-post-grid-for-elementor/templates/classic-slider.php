<?php
/**
 * The Template for displaying Classic Slider.
 *
 * This template can be overridden by copying it to yourtheme/anwp-post-grid/classic-slider.php
 *
 * @var object $data - Object with widget data.
 *
 * @author           Andrei Strekozov <anwp.pro>
 * @package          AnWP_Post_Grid/Templates
 * @since            0.6.0
 *
 * @version          0.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$data = (object) wp_parse_args(
	$data,
	[
		'slider_posts'            => [],
		'layout'                  => 'd',
		'wrapper_classes'         => 'swiper-slide',
		'slides_to_show'          => 3,
		'slides_to_show_mobile'   => 1,
		'slides_to_show_tablet'   => 2,
		'slides_to_scroll'        => 1,
		'slides_to_scroll_mobile' => 1,
		'slides_to_scroll_tablet' => 1,
		'navigation'              => '',
		'direction'               => 'ltr',
		'spacing_between'         => [ 'size' => 20 ],
		'autoplay'                => 'yes',
		'autoplay_delay'          => 5000,
		'effect'                  => 'slide',
		'grid_widget_title'       => '',
		'header_size'             => 'h3',
		'header_icon'             => '',
		'show_read_more'          => '',
		'read_more_label'         => '',
		'read_more_class'         => '',
	]
);

if ( empty( $data->slider_posts ) ) {
	return;
}

$spacing_between = ( ! empty( $data->spacing_between['size'] ) && $data->spacing_between['size'] >= 100 ) ? 100 : absint( $data->spacing_between['size'] );
?>
<div class="anwp-pg-wrap">

	<?php
	// Widget Header
	anwp_post_grid()->load_partial( $data, 'header' );
	?>

	<!-- Slider main container -->
	<div
		class="anwp-pg-classic-slider anwp-pg-swiper-wrapper position-static swiper-container anwp-pg-no-transform"
		data-pg-slides-per-view="<?php echo esc_attr( $data->slides_to_show ); ?>"
		data-pg-slides-per-view-mobile="<?php echo esc_attr( $data->slides_to_show_mobile ); ?>"
		data-pg-slides-per-view-tablet="<?php echo esc_attr( $data->slides_to_show_tablet ); ?>"
		data-pg-slides-per-group="<?php echo esc_attr( $data->slides_to_scroll ); ?>"
		data-pg-slides-per-group-mobile="<?php echo esc_attr( $data->slides_to_scroll_mobile ); ?>"
		data-pg-slides-per-group-tablet="<?php echo esc_attr( $data->slides_to_scroll_tablet ); ?>"
		data-pg-autoplay="<?php echo esc_attr( $data->autoplay ); ?>"
		data-pg-autoplay-delay="<?php echo esc_attr( $data->autoplay_delay ); ?>"
		data-pg-space-between="<?php echo esc_attr( $spacing_between ); ?>"
		data-pg-effect="<?php echo esc_attr( $data->effect ); ?>"
		data-pg-show-read-more="<?php echo esc_attr( $data->show_read_more ); ?>"
		dir="<?php echo esc_attr( $data->direction ); ?>"
	>
		<!-- Additional required wrapper -->
		<div class="swiper-wrapper">
			<!-- Slides -->
			<?php
			foreach ( $data->slider_posts as $grid_post ) {
				$data->grid_post = $grid_post;
				anwp_post_grid()->load_partial( $data, 'teaser/teaser', sanitize_key( $data->layout ) );
			}
			?>
		</div>

		<?php if ( count( $data->slider_posts ) ) : ?>
			<?php if ( in_array( $data->navigation, [ 'dots', 'both' ], true ) ) : ?>
				<div class="swiper-pagination"></div>
			<?php endif; ?>
			<?php if ( in_array( $data->navigation, [ 'arrows', 'both' ], true ) ) : ?>
				<div class="elementor-swiper-button elementor-swiper-button-prev">
					<i class="eicon-chevron-left" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php esc_html_e( 'Previous', 'anwp-post-grid' ); ?></span>
				</div>
				<div class="elementor-swiper-button elementor-swiper-button-next">
					<i class="eicon-chevron-right" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php esc_html_e( 'Next', 'anwp-post-grid' ); ?></span>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>
