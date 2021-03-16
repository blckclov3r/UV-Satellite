<?php
/**
 * The Template for displaying Post Teaser - F.
 *
 * This template can be overridden by copying it to yourtheme/anwp-post-grid/teaser/teaser--f.php
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
		'grid_post'        => (object) [],
		'grid_cols'        => '3',
		'grid_cols_tablet' => '2',
		'grid_cols_mobile' => '1',
		'show_category'    => 'yes',
		'show_date'        => 'yes',
		'show_comments'    => 'yes',
		'category_limit'   => 1,
		'show_post_icon'   => 'yes',
	]
);

$wp_post = $data->grid_post;

/** @var WP_Post $wp_post */
if ( empty( $wp_post->ID ) ) {
	return;
}

// Post Format
$post_format = get_post_format( $wp_post );

// Grid Classes
$grid_classes = anwp_post_grid()->elements->get_teaser_grid_classes( $data, 3, 2, 1 );

if ( 'yes' === $data->show_comments ) {
	if ( comments_open( $wp_post->ID ) || get_comments_number( $wp_post->ID ) ) {
		$grid_classes .= ' anwp-pg-post-teaser--has-comments-meta';
	}

	if ( AnWP_Post_Grid::is_pvc_active() ) {
		$grid_classes .= ' anwp-pg-post-teaser--has-pvc-meta';
	}
}
?>
<div class="anwp-pg-post-teaser anwp-pg-post-teaser--layout-f <?php echo esc_attr( $grid_classes ); ?> d-flex position-relative">
	<div class="anwp-pg-post-teaser__thumbnail position-relative">

		<?php if ( 'yes' === $data->show_post_icon && anwp_post_grid()->settings->get_post_icon( $wp_post->ID ) ) : ?>
			<div class="anwp-pg-post-teaser__format-icon d-flex align-items-center justify-content-center">
				<img class="anwp-object-contain" src="<?php echo esc_url( anwp_post_grid()->settings->get_post_icon( $wp_post->ID ) ); ?>" alt="post format icon">
			</div>
		<?php endif; ?>

		<div class="anwp-pg-post-teaser__thumbnail-img"
			style="background-image: url(<?php echo esc_url( anwp_post_grid()->elements->get_post_image_uri( 'medium', true, $wp_post->ID ) ); ?>)">
		</div>

		<div class="anwp-pg-post-teaser__thumbnail-bg anwp-position-cover"></div>
	</div>

	<div class="anwp-pg-post-teaser__content flex-grow-1 d-flex flex-column pt-1">
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
			<div class="d-flex flex-wrap anwp-pg-post-teaser__top-meta">
				<?php
				foreach ( $post_categories as $post_category ) :
					anwp_post_grid()->elements->render_post_category_link( $post_category, 'anwp-pg-post-teaser__category-wrapper mb-1 mr-2' );
				endforeach;
				?>
			</div>
		<?php endif; ?>

		<div class="anwp-pg-post-teaser__title anwp-font-heading my-auto">
			<?php echo esc_html( get_the_title( $wp_post->ID ) ); ?>
		</div>

		<div class="anwp-pg-post-teaser__bottom-meta mt-1 d-flex flex-wrap">

			<?php if ( 'yes' === $data->show_date ) : ?>
				<div class="anwp-pg-post-teaser__bottom-meta-item d-flex align-items-center mr-3">
					<svg class="anwp-pg-icon anwp-pg-icon--s16 mr-1">
						<use xlink:href="#icon-anwp-pg-calendar"></use>
					</svg>
					<span class="posted-on m-0"><?php echo anwp_post_grid()->elements->get_post_date( $wp_post->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				</div>
				<?php
			endif;

			if ( 'yes' === $data->show_comments ) :
				if ( comments_open( $wp_post->ID ) || get_comments_number( $wp_post->ID ) ) :
					?>
					<div class="anwp-pg-post-teaser__bottom-meta-item d-flex align-items-center mr-3">
						<svg class="anwp-pg-icon anwp-pg-icon--s16 mr-1">
							<use xlink:href="#icon-anwp-pg-comment-discussion"></use>
						</svg>
						<?php echo intval( get_comments_number( $wp_post->ID ) ); ?>
					</div>
					<?php
				endif;

				if ( AnWP_Post_Grid::is_pvc_active() ) :
					?>
					<div class="anwp-pg-post-teaser__bottom-meta-item d-flex align-items-center">
						<svg class="anwp-pg-icon anwp-pg-icon--s16 mr-1">
							<use xlink:href="#icon-anwp-pg-eye"></use>
						</svg>
						<?php echo intval( pvc_get_post_views( $wp_post->ID ) ); ?>
					</div>
					<?php
				endif;
			endif;
			?>
		</div>

	</div>

	<a class="anwp-position-cover anwp-link-without-effects" href="<?php the_permalink( $wp_post ); ?>" aria-hidden="true"></a>
</div>
