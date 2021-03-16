<?php
/**
 * The Template for displaying Post Teaser - C.
 *
 * This template can be overridden by copying it to yourtheme/anwp-post-grid/teaser/teaser--c.php
 *
 * @var object $data - Object with widget data.
 *
 * @author           Andrei Strekozov <anwp.pro>
 * @package          AnWP_Post_Grid/Templates
 * @since            0.1.0
 *
 * @version          0.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$data = (object) wp_parse_args(
	$data,
	[
		'grid_post'           => (object) [],
		'card_height'         => '180',
		'grid_cols'           => '3',
		'grid_cols_tablet'    => '2',
		'grid_cols_mobile'    => '1',
		'show_category'       => 'yes',
		'show_date'           => 'yes',
		'show_comments'       => 'yes',
		'grid_thumbnail_size' => 'medium',
		'wrapper_classes'     => '',
		'category_limit'      => 1,
		'show_post_icon'      => 'yes',
	]
);

$wp_post = $data->grid_post;

/** @var WP_Post $wp_post */
if ( empty( $wp_post->ID ) ) {
	return;
}

// Post Format
$post_format = get_post_format( $wp_post );

// Wrapper Classes
$wrapper_classes = $data->wrapper_classes ? $data->wrapper_classes : anwp_post_grid()->elements->get_teaser_grid_classes( $data, 3, 2, 1 );

if ( 'yes' === $data->show_comments ) {
	if ( comments_open( $wp_post->ID ) || get_comments_number( $wp_post->ID ) ) {
		$wrapper_classes .= ' anwp-pg-post-teaser--has-comments-meta';
	}

	if ( AnWP_Post_Grid::is_pvc_active() ) {
		$wrapper_classes .= ' anwp-pg-post-teaser--has-pvc-meta';
	}
}

// Card Height
$card_height       = ( ! empty( $data->card_height['size'] ) && $data->card_height['size'] >= 150 ) ? absint( $data->card_height['size'] ) : 180;
$card_height_class = 'anwp-pg-height-' . $card_height;
?>
<div class="anwp-pg-post-teaser anwp-pg-post-teaser--layout-c <?php echo esc_attr( $wrapper_classes ); ?>">
	<div class="anwp-pg-post-teaser__thumbnail position-relative">

		<?php if ( 'yes' === $data->show_post_icon && anwp_post_grid()->settings->get_post_icon( $wp_post->ID ) ) : ?>
			<div class="anwp-pg-post-teaser__format-icon d-flex align-items-center justify-content-center
				<?php echo 'yes' !== $data->show_category ? '' : 'anwp-pg-post-teaser__format-icon--has-category'; ?>
				<?php echo 'yes' !== $data->show_comments ? '' : 'anwp-pg-post-teaser__format-icon--has-comments'; ?>
				">
				<img class="anwp-object-contain" src="<?php echo esc_url( anwp_post_grid()->settings->get_post_icon( $wp_post->ID ) ); ?>" alt="post format icon">
			</div>
		<?php endif; ?>

		<div class="anwp-pg-post-teaser__thumbnail-img <?php echo esc_attr( $card_height_class ); ?>"
			style="background-image: url(<?php echo esc_url( anwp_post_grid()->elements->get_post_image_uri( $data->grid_thumbnail_size, true, $wp_post->ID ) ); ?>)">
		</div>

		<div class="anwp-pg-post-teaser__muted_bg"></div>
		<div class="anwp-pg-post-teaser__thumbnail-bg anwp-position-cover"></div>

		<div class="anwp-pg-post-teaser__content d-flex flex-column anwp-position-cover">
			<div class="anwp-pg-post-teaser__top-meta d-flex mb-2">
				<?php
				if ( 'yes' === $data->show_comments ) :

					if ( comments_open( $wp_post->ID ) || get_comments_number( $wp_post->ID ) ) :
						?>
						<span class="anwp-pg-post-teaser__meta-comments d-flex align-items-center mr-2">
							<svg class="anwp-pg-icon anwp-pg-icon--s1em anwp-pg-icon--white mr-1">
								<use xlink:href="#icon-anwp-pg-comment-discussion"></use>
							</svg>
							<?php echo intval( get_comments_number( $wp_post->ID ) ); ?>
						</span>
						<?php
					endif;

					if ( AnWP_Post_Grid::is_pvc_active() ) :
						?>
						<span class="anwp-pg-post-teaser__meta-views d-flex align-items-center mr-2">
							<svg class="anwp-pg-icon anwp-pg-icon--s1em anwp-pg-icon--white mr-1">
								<use xlink:href="#icon-anwp-pg-eye"></use>
							</svg>
							<?php echo intval( pvc_get_post_views( $wp_post->ID ) ); ?>
						</span>
						<?php
					endif;
				endif;
				?>

			</div>

			<?php
			/*
			|--------------------------------------------------------------------
			| Post Category
			|--------------------------------------------------------------------
			*/
			$post_categories = get_the_category( $wp_post->ID );

			if ( 'yes' === $data->show_category && is_array( $post_categories ) && isset( $post_categories[0]->term_id ) ) :
				$category_limit  = absint( $data->category_limit ) ? absint( $data->category_limit ) : 1;
				$post_categories = array_slice( $post_categories, 0, $category_limit );
				?>
				<div class="d-flex flex-column anwp-pg-post-teaser__category-column ml-auto">
					<?php
					foreach ( $post_categories as $post_category ) :
						anwp_post_grid()->elements->render_post_category_link_filled( $post_category, 'anwp-pg-post-teaser__category-wrapper align-self-end' );
					endforeach;
					?>
				</div>
			<?php endif; ?>

			<div class="anwp-pg-post-teaser__bottom-block d-flex align-items-center position-relative py-4 px-1 mb-3 mt-auto">
				<?php if ( 'yes' === $data->show_date ) : ?>
					<div class="anwp-pg-post-teaser__bottom-meta position-absolute">
						<span class="posted-on m-0"><?php echo anwp_post_grid()->elements->get_post_date( $wp_post->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					</div>
				<?php endif; ?>

				<div class="anwp-pg-post-teaser__title anwp-font-heading">
					<?php echo esc_html( get_the_title( $wp_post->ID ) ); ?>
				</div>
			</div>
		</div>

		<a class="anwp-position-cover anwp-link-without-effects" href="<?php the_permalink( $wp_post ); ?>" aria-hidden="true"></a>
	</div>
</div>
