<?php
/**
 * 'bdp_recent_post_slider' Shortcode
 * 
 * @package Blog Designer Pack
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to handle the `bdp_recent_post_slider` shortcode
 * 
 * @package Blog Designer Pack
 * @since 1.0.0
 */
function bdp_post_slider( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> 20,
		'category' 				=> '',
		'show_read_more' 		=> 'true',
		'design' 				=> 'design-1',
		'show_author' 			=> 'true',
		'show_date' 			=> 'true',
		'show_category' 		=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> 20,	
		'media_size' 			=> 'large',
		'dots' 					=> 'true',
		'arrows'				=> 'true',
		'autoplay' 				=> 'true',
		'autoplay_interval' 	=> 3000,
		'speed' 				=> 600,
		'loop' 					=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'show_tags'				=> 'true',
		'show_comments'			=> 'true',
		), $atts, 'bdp_post_slider'));
	
	$shortcode_designs 		= bdp_recent_post_slider_designs();
	
	$posts_per_page 		= !empty($limit) 						? $limit 						: 20;
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$showDate 				= ( $show_date == 'false' ) 			? 'false'						: 'true';
	$showCategory 			= ( $show_category == 'false' )			? 'false' 						: 'true';
	$showContent 			= ( $show_content == 'false' ) 			? 'false' 						: 'true';
	$media_size 			= (!empty($media_size))					? $media_size					: 'large'; //thumbnail, medium, large, full	
	$words_limit 			= !empty( $content_words_limit ) 		? $content_words_limit	 		: 20;	
	$dots 					= ( $dots == 'false' )					? 'false' 						: 'true';
	$arrows 				= ( $arrows == 'false' )				? 'false' 						: 'true';
	$autoplay 				= ( $autoplay == 'false' )				? 'false' 						: 'true';
	$autoplay_interval 		= !empty( $autoplay_interval ) 			? $autoplay_interval 			: 3000;
	$speed 					= !empty( $speed ) 						? $speed 						: 600;
	$loop 					= ( $loop == 'false' )					? 'false' 						: 'true';
	$showAuthor 			= ($show_author == 'false')				? 'false'						: 'true';
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= !empty($orderby) 						? $orderby 						: 'date';
	$show_tags 				= ( $show_tags == 'false' ) 			? 'false'						: 'true';
	$show_comments 			= ( $show_comments == 'false' ) 		? 'false'						: 'true';
	$showreadmore 			= ( $show_read_more == 'false' ) 		? 'false'						: 'true';
	
	// Shortcode file
	$post_design_file_path 	= BDP_DIR . '/templates/slider/' . $design . '.php';
	$design_file 			= (file_exists($post_design_file_path)) ? $post_design_file_path : '';
	
	// Slider configuration
	$slider_conf = compact('dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'loop', 'design');
	
	// Enqueue required script
	wp_enqueue_script( 'jquery-slick' );
	wp_enqueue_script( 'bdp-public-script' );
	bdp_enqueue_script();

	// Taking some globals
	global $post;

	// Taking some variables
	$unique	= bdp_get_unique();

	// WP Query Parameters
	$args = array ( 
				'post_type'				=> BDP_POST_TYPE,
				'post_status'			=> array( 'publish' ),
				'orderby'				=> $orderby, 
				'order'					=> $order,
				'posts_per_page'		=> $posts_per_page,
				'ignore_sticky_posts'	=> true,
			);
	
	// Category Parameter
	if($cat != "") {

		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> BDP_CAT,
									'terms' 	=> $cat,
									'field' 	=> ( isset($cat[0]) && is_numeric($cat[0]) ) ? 'term_id' : 'slug',
								));

	} 

	// WP Query
	$query = new WP_Query( $args );

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

	<div class="bdp-post-slider-wrp bdp-clearfix">
		<div class="bdp-post-slider <?php echo 'bdp-'.$design; ?>"  id="bdp-slider-<?php echo $unique; ?>">
			<?php while ( $query->have_posts() ) : $query->the_post();
				
				$terms 		= get_the_terms( $post->ID, BDP_CAT );
				$cat_links = array();
				if( $terms ) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name 		= join( " ", $cat_links );
				
				$feat_image 	= bdp_get_post_featured_image( $post->ID, $media_size );
				$post_link 		= bdp_get_post_link( $post->ID );
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1)  ? esc_html__('Reply', 'blog-designer-pack') : esc_html__('Replies', 'blog-designer-pack');
				
				// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
				}
				
			endwhile;
		?>
		</div>
		<div class="bdp-slider-conf"><?php echo htmlspecialchars(json_encode( $slider_conf )); ?></div>
	</div>

	<?php
	} // End of have_post()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// Post Slider Shortcode
add_shortcode( 'bdp_post_slider', 'bdp_post_slider' );