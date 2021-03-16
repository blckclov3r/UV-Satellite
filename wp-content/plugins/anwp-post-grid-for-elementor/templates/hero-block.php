<?php
/**
 * The Template for displaying Hero Block.
 *
 * This template can be overridden by copying it to yourtheme/anwp-post-grid/hero-block.php
 *
 * @var object $data - Object with widget data.
 *
 * @author           Andrei Strekozov <anwp.pro>
 * @package          AnWP_Post_Grid/Templates
 * @since            0.6.1
 *
 * @version          0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$data = (object) wp_parse_args(
	$data,
	[
		'grid_posts'  => [],
		'layout'      => 'a',
		'grid_gutter' => 'thin',
		'offset'      => 0,
	]
);

if ( empty( $data->grid_posts ) ) {
	return;
}

$main_classes      = 'anwp-col-sm-9 anwp-col-lg-6';
$secondary_classes = 'anwp-col-sm-3';
?>
<div class="anwp-pg-wrap">
	<div class="d-flex anwp-row flex-wrap no-gutters anwp-pg-hero-block anwp-pg-posts-wrapper anwp-pg-gutter--<?php echo esc_attr( $data->grid_gutter ); ?>">

		<div class="<?php echo esc_attr( $main_classes ); ?> anwp-pg-height-2x anwp-pg-hero-main-block-wrapper">
			<?php
			$data->grid_post       = $data->grid_posts[0];
			$data->wrapper_classes = 'anwp-pg-hero-main-block my-0';

			anwp_post_grid()->load_partial( $data, 'teaser/teaser', sanitize_key( $data->layout ) );
			?>
		</div>
		<div class="<?php echo esc_attr( $secondary_classes ); ?> anwp-pg-hero-secondary-block-wrapper">
			<?php
			$data->wrapper_classes = 'anwp-pg-hero-secondary-block';

			$data->grid_post = $data->grid_posts[1];
			anwp_post_grid()->load_partial( $data, 'teaser/teaser', sanitize_key( $data->layout ) );

			$data->grid_post = $data->grid_posts[2];
			anwp_post_grid()->load_partial( $data, 'teaser/teaser', sanitize_key( $data->layout ) );
			?>
		</div>
		<div class="<?php echo esc_attr( $secondary_classes ); ?> anwp-pg-hero-secondary-block-wrapper d-sm-none d-lg-block">
			<?php
			$data->wrapper_classes = 'anwp-pg-hero-secondary-block';

			$data->grid_post = $data->grid_posts[3];
			anwp_post_grid()->load_partial( $data, 'teaser/teaser', sanitize_key( $data->layout ) );

			$data->grid_post = $data->grid_posts[4];
			anwp_post_grid()->load_partial( $data, 'teaser/teaser', sanitize_key( $data->layout ) );
			?>
		</div>
	</div>
</div>
