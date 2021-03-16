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
		'grid_thumbnail_size' => 'large',
		'show_category'       => 'yes',
		'show_date'           => 'yes',
		'show_comments'       => 'yes',
		'show_excerpt'        => 'yes',
		'wrapper_classes'     => '',
		'show_author'         => '',
		'show_read_more'      => '',
		'read_more_label'     => '',
		'read_more_class'     => '',
		'post_image_width'    => '1_3',
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

// Post Image
$post_image = anwp_post_grid()->elements->get_post_image_uri( $data->grid_thumbnail_size, false, $wp_post->ID );
?>
<div class="anwp-pg-post-teaser anwp-pg-post-teaser--layout-classic anwp-row anwp-no-gutters">

	<?php if ( $post_image ) : ?>
		<div class="anwp-pg-post-teaser__thumbnail position-relative mb-2 mb-md-0 <?php echo esc_html( '1_2' === $data->post_image_width ? 'anwp-col-md-6' : 'anwp-col-md-4' ); ?>">
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
			if ( 'yes' === $data->show_post_icon && anwp_post_grid()->settings->get_post_icon( $wp_post->ID ) ) :
				?>
				<div class="anwp-pg-post-teaser__format-icon d-flex align-items-center justify-content-center">
					<img class="anwp-object-contain" src="<?php echo esc_url( anwp_post_grid()->settings->get_post_icon( $wp_post->ID ) ); ?>" alt="post format icon">
				</div>
			<?php endif; ?>

			<img src="<?php echo esc_url( $post_image ); ?>"/>

			<div class="anwp-pg-post-teaser__thumbnail-classic-bg anwp-position-cover"></div>

			<a class="anwp-position-cover anwp-link-without-effects" href="<?php the_permalink( $wp_post ); ?>" aria-hidden="true"></a>
		</div>
	<?php endif; ?>

	<div class="anwp-pg-post-teaser__content <?php echo esc_attr( $post_image ? ( '1_2' === $data->post_image_width ? 'anwp-col-md-6' : 'anwp-col-md-8' ) : 'anwp-col-12' ); ?>">

		<div class="anwp-pg-post-teaser__title anwp-font-heading my-2">
			<a class="anwp-link-without-effects" href="<?php the_permalink( $wp_post ); ?>" aria-hidden="true">
				<?php echo esc_html( get_the_title( $wp_post->ID ) ); ?>
			</a>
		</div>

		<div class="anwp-pg-post-teaser__bottom-meta d-flex flex-wrap">

			<?php if ( 'yes' === $data->show_author ) : ?>
				<div class="anwp-pg-post-teaser__bottom-meta-item d-flex align-items-center mr-4">
					<svg class="anwp-pg-icon anwp-pg-icon--s16 mr-2">
						<use xlink:href="#icon-anwp-pg-person"></use>
					</svg>
					<?php the_author_meta( 'user_nicename', $wp_post->post_author ); ?>
				</div>
			<?php endif; ?>

			<?php if ( 'yes' === $data->show_date ) : ?>
				<div class="anwp-pg-post-teaser__bottom-meta-item d-flex align-items-center mr-4">
					<svg class="anwp-pg-icon anwp-pg-icon--s16 mr-2">
						<use xlink:href="#icon-anwp-pg-calendar"></use>
					</svg>
					<?php echo anwp_post_grid()->elements->get_post_date( $wp_post->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php
			endif;

			if ( 'yes' === $data->show_comments ) :
				if ( comments_open( $wp_post->ID ) || get_comments_number( $wp_post->ID ) ) :
					?>
					<div class="anwp-pg-post-teaser__bottom-meta-item d-flex align-items-center mr-4">
						<svg class="anwp-pg-icon anwp-pg-icon--s16 mr-2">
							<use xlink:href="#icon-anwp-pg-comment-discussion"></use>
						</svg>
						<?php echo intval( get_comments_number( $wp_post->ID ) ); ?>
					</div>
					<?php
				endif;

				if ( AnWP_Post_Grid::is_pvc_active() ) :
					?>
					<div class="anwp-pg-post-teaser__bottom-meta-item d-flex align-items-center">
						<svg class="anwp-pg-icon anwp-pg-icon--s16 mr-2">
							<use xlink:href="#icon-anwp-pg-eye"></use>
						</svg>
						<?php echo intval( pvc_get_post_views( $wp_post->ID ) ); ?>
					</div>
					<?php
				endif;
			endif;
			?>
		</div>

		<div class="anwp-pg-post-teaser__excerpt mt-2"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_excerpt( $wp_post ) ), 30, ' ...' ) ); ?></div>

		<?php if ( 'yes' === $data->show_read_more ) : ?>
			<div class="w-100 anwp-pg-read-more mt-3">
				<a href="<?php the_permalink( $wp_post ); ?>" class="anwp-pg-read-more__btn <?php echo esc_attr( $data->read_more_class ); ?>">
					<?php echo empty( $data->read_more_label ) ? esc_html__( 'read more', 'anwp-post-grid' ) : esc_html( $data->read_more_label ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>
