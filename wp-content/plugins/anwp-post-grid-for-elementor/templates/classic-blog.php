<?php
/**
 * The Template for displaying Classic Blog.
 *
 * This template can be overridden by copying it to yourtheme/anwp-post-grid/classic-blog.php
 *
 * @var object $data - Object with widget data.
 *
 * @author           Andrei Strekozov <anwp.pro>
 * @package          AnWP_Post_Grid/Templates
 * @since            0.6.2
 *
 * @version          0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$data = (object) wp_parse_args(
	$data,
	[
		'grid_posts'        => [],
		'offset'            => 0,
		'layout'            => 'classic',
		'show_load_more'    => false,
		'load_more_label'   => '',
		'load_more_class'   => '',
		'grid_widget_title' => '',
		'header_size'       => 'h3',
		'header_icon'       => '',
		'posts_per_load'    => 3,
		'show_author'       => '',
		'show_read_more'    => '',
		'read_more_label'   => '',
		'read_more_class'   => '',
		'post_image_width'  => '1_3',
		'show_post_icon'    => 'yes',
	]
);

if ( empty( $data->grid_posts ) ) {
	return;
}
?>
<div class="anwp-pg-wrap">

	<?php
	// Widget Header
	anwp_post_grid()->load_partial( $data, 'header' );
	?>

	<div class="anwp-pg-classic-blog anwp-pg-posts-wrapper">
		<?php
		foreach ( $data->grid_posts as $grid_post ) {
			$data->grid_post = $grid_post;
			anwp_post_grid()->load_partial( $data, 'teaser/classic' );
		}
		?>
	</div>
	<?php if ( $data->show_load_more ) : ?>
		<div class="w-100 anwp-pg-load-more">
			<button class="button btn btn-outline-secondary anwp-pg-load-more__btn mx-auto d-block my-3 <?php echo esc_attr( $data->load_more_class ); ?>" type="button"
				data-anwp-loaded-qty="<?php echo absint( count( $data->grid_posts ) + $data->offset ); ?>"
				data-anwp-posts-per-load="<?php echo absint( $data->posts_per_load ); ?>"
				data-anwp-load-more="<?php echo esc_attr( anwp_post_grid()->elements->get_serialized_load_more_data( $data, 'classic-blog' ) ); ?>">
				<span class="anwp-pg-load-more__label"><?php echo empty( $data->load_more_label ) ? esc_html__( 'load more', 'anwp-post-grid' ) : esc_html( $data->load_more_label ); ?></span>
					<span class="anwp-pg-wave d-flex align-items-center">
					<span class="anwp-pg-rect anwp-pg-rect1"></span>
					<span class="anwp-pg-rect anwp-pg-rect2"></span>
					<span class="anwp-pg-rect anwp-pg-rect3"></span>
					<span class="anwp-pg-rect anwp-pg-rect4"></span>
					<span class="anwp-pg-rect anwp-pg-rect5"></span>
				</span>
			</button>
		</div>
	<?php endif; ?>

	<?php
	// Pagination
	anwp_post_grid()->load_partial( $data, 'pagination' );
	?>
</div>
