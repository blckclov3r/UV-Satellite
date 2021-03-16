<?php
/**
 * 'psac_post_slider' Shortcode
 * 
 * @package Post Slider and Carousel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to handle the `psac_post_slider` shortcode
 * 
 * @since 1.0
 */
function psac_render_post_slider( $atts, $content = null ) {

	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> 20,
		'category' 				=> '',
		'show_read_more' 		=> 'true',
		'design' 				=> 'design-1',
		'show_author' 			=> 'true',
		'show_date' 			=> 'true',
		'show_category' 		=> 'true',
		'show_content' 			=> 'false',
		'content_words_limit' 	=> 20,
		'media_size'			=> 'large',
		'dots' 					=> 'true',
		'arrows'				=> 'true',
		'autoplay' 				=> 'true',
		'autoplay_interval' 	=> 4000,
		'speed' 				=> 600,
		'loop' 					=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'show_tags'				=> 'false',
		'show_comments'			=> 'true',
		'sliderheight'			=> '',
		), $atts, 'psac_post_slider'));

	$shortcode_designs 		= psac_post_slider_designs();
	$limit 					= !empty($limit) 						? $limit 						: 20;
	$category 				= !empty($category)						? explode(',', $category) 		: '';
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$show_date 				= ( $show_date == 'false' ) 			? false							: true;
	$show_category 			= ( $show_category == 'false' )			? false							: true;
	$show_content 			= ( $show_content == 'false' ) 			? false							: true;
	$media_size 			= (!empty($media_size))					? $media_size 					: 'large'; //thumbnail, medium, large, full
	$words_limit 			= !empty( $content_words_limit ) 		? $content_words_limit	 		: 20;
	$dots 					= ( $dots == 'false' )					? false							: true;
	$arrows 				= ( $arrows == 'false' )				? false							: true;
	$autoplay 				= ( $autoplay == 'false' )				? false							: true;
	$autoplay_interval 		= !empty( $autoplay_interval ) 			? $autoplay_interval 			: 4000;
	$speed 					= !empty( $speed ) 						? $speed 						: 600;
	$loop 					= ( $loop == 'false' )					? false							: true;
	$show_author 			= ($show_author == 'false')				? false							: true;
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= !empty($orderby) 						? $orderby 						: 'date';
	$show_tags 				= ( $show_tags == 'false' ) 			? false							: true;
	$show_comments 			= ( $show_comments == 'false' ) 		? false							: true;
	$show_read_more 		= ( $show_read_more == 'false' ) 		? false							: true;
	$sliderheight 			= (!empty($sliderheight)) 				? $sliderheight 				: '';

	// Shortcode file
	$post_design_file_path 	= PSAC_DIR . '/templates/slider/' . $design . '.php';
	$design_file 			= (file_exists($post_design_file_path)) ? $post_design_file_path : '';

	// Slider configuration
	$slider_conf = compact('dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'loop');

	// Enqueue required script
	wp_enqueue_script( 'jquery-owl-carousel' );
	wp_enqueue_script( 'psac-public-script' );
	psac_enqueue_script();

	// Taking some globals
	global $post;

	// Taking some variables
	$unique	= psac_get_unique();

	// WP Query Parameters
	$args = array ( 
				'post_type'				=> PSAC_POST_TYPE,
				'post_status'			=> array( 'publish' ),
				'orderby'				=> $orderby, 
				'order'					=> $order,
				'posts_per_page'		=> $limit,
				'ignore_sticky_posts'	=> true,
			);

	// Category Parameter
	if( ! empty( $category ) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy'	=> PSAC_CAT,
									'terms'		=> $category,
									'field' 	=> ( isset($category[0]) && is_numeric($category[0]) ) ? 'term_id' : 'slug',
								));
	}

	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

	<div class="psac-post-slider-wrp psac-slider-and-carousel psac-clearfix">
		<div class="psac-post-slider owl-carousel <?php echo 'psac-'.$design; ?>" id="psac-slider-<?php echo $unique; ?>" data-conf="<?php echo htmlspecialchars(json_encode( $slider_conf )); ?>">
			<?php while ( $query->have_posts() ) : $query->the_post();

				$terms 		= get_the_terms( $post->ID, PSAC_CAT );
				$cat_links	= array();

				if( ! is_wp_error( $terms ) && $terms ) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a class="psac-post-cat psac-post-cat-'.$term->term_id.'" href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name 		= join( " ", $cat_links );

				$feat_image 	= psac_get_post_featured_image( $post->ID, $media_size );
				$post_link 		= psac_get_post_link( $post->ID );
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1)  ? __('Reply', 'post-slider-and-carousel') : __('Replies', 'post-slider-and-carousel');

				$image_bg_css   = $feat_image		? " background-image: url('".esc_url( $feat_image )."'); " : '';
				$image_bg_css   .= $sliderheight	? " height:{$sliderheight}px; " : '';

				// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
				}
			endwhile;
		?>
		</div>
	</div>

	<?php
	} // End of have_post()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// Post Slider Shortcode
add_shortcode( 'psac_post_slider', 'psac_render_post_slider' );