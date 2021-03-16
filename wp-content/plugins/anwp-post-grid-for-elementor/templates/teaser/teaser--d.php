<?php
/**
 * The Template for displaying Post Teaser - D.
 *
 * This template can be overridden by copying it to yourtheme/anwp-post-grid/teaser/teaser--d.php
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
		'grid_cols'           => '3',
		'grid_cols_tablet'    => '2',
		'grid_cols_mobile'    => '1',
		'grid_thumbnail_size' => 'large',
		'show_category'       => 'yes',
		'show_date'           => 'yes',
		'show_comments'       => 'yes',
		'card_height'         => '180',
		'show_excerpt'        => 'yes',
		'wrapper_classes'     => '',
		'show_read_more'      => '',
		'read_more_label'     => '',
		'read_more_class'     => '',
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

if ( 'yes' === $data->show_read_more ) {
	$wrapper_classes .= ' anwp-pg-post-teaser--with-read-more ';
}
?>
<div class="anwp-pg-post-teaser anwp-pg-post-teaser--inner-cover-link anwp-pg-post-teaser--layout-d d-flex flex-column <?php echo esc_attr( $wrapper_classes ); ?>">
	<div class="anwp-pg-post-teaser__thumbnail position-relative">

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
			<div class="anwp-pg-post-teaser__top-meta d-flex flex-column anwp-pg-post-teaser__category-column mr-auto">
				<?php
				foreach ( $post_categories as $post_category ) :
					anwp_post_grid()->elements->render_post_category_link_filled( $post_category, 'anwp-pg-post-teaser__category-wrapper align-self-start' );
				endforeach;
				?>
			</div>
			<?php
		endif;

		/*
		|--------------------------------------------------------------------
		| Post Format Icon
		|--------------------------------------------------------------------
		*/
		if ( in_array( $post_format, [ 'video', 'gallery' ], true ) ) :
			?>
			<div class="anwp-pg-post-teaser__format-icon anwp-pg-post-teaser__format-icon--top d-flex align-items-center justify-content-center">
				<svg class="anwp-pg-icon anwp-pg-icon--s18 anwp-pg-icon--white">
					<use xlink:href="#icon-anwp-pg-<?php echo esc_attr( 'video' === $post_format ? 'play' : 'device-camera' ); ?>"></use>
				</svg>
			</div>
		<?php endif; ?>

		<?php if ( 'yes' === $data->show_post_icon && anwp_post_grid()->settings->get_post_icon( $wp_post->ID ) ) : ?>
			<div class="anwp-pg-post-teaser__format-icon d-flex align-items-center justify-content-center">
				<img class="anwp-object-contain" src="<?php echo esc_url( anwp_post_grid()->settings->get_post_icon( $wp_post->ID ) ); ?>" alt="post format icon">
			</div>
		<?php endif; ?>

		<div class="anwp-pg-post-teaser__thumbnail-img <?php echo esc_attr( $card_height_class ); ?>"
			style="background-image: url(<?php echo esc_url( anwp_post_grid()->elements->get_post_image_uri( $data->grid_thumbnail_size, true, $wp_post->ID ) ); ?>)">
		</div>

		<div class="anwp-pg-post-teaser__thumbnail-bg anwp-position-cover"></div>

		<a class="anwp-position-cover anwp-link-without-effects" href="<?php the_permalink( $wp_post ); ?>" aria-hidden="true"></a>
	</div>

	<div class="anwp-pg-post-teaser__content flex-grow-1 pt-1 d-flex flex-column">

		<div class="anwp-pg-post-teaser__title anwp-font-heading mt-2">
			<a class="anwp-link-without-effects" href="<?php the_permalink( $wp_post ); ?>" aria-hidden="true">
				<?php echo esc_html( get_the_title( $wp_post->ID ) ); ?>
			</a>
		</div>

		<div class="anwp-pg-post-teaser__bottom-meta d-flex flex-wrap">

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

		<?php if ( 'yes' === $data->show_excerpt ) : ?>
			<div class="anwp-pg-post-teaser__excerpt mb-2"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_excerpt( $wp_post ) ), 30, ' ...' ) ); ?></div>
		<?php endif; ?>

		<?php if ( 'yes' === $data->show_read_more ) : ?>
			<div class="w-100 anwp-pg-read-more mt-auto">
				<a href="<?php the_permalink( $wp_post ); ?>" class="anwp-pg-read-more__btn mt-3 mb-0 <?php echo esc_attr( $data->read_more_class ? $data->read_more_class : 'btn btn-sm btn-outline-info w-100 text-decoration-none' ); ?>">
					<?php echo empty( $data->read_more_label ) ? esc_html__( 'Read More', 'anwp-post-grid' ) : esc_html( $data->read_more_label ); ?>
				</a>
			</div>
		<?php endif; ?>

	</div>

</div>
