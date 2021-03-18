<?php
/**
 * Post Masonry Shortcode
 *
 * @package Blog Designer Pack
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function bdp_post_masonry( $atts, $content = null ) {

	// Taking some globals
	global $post, $multipage;

	// Shortcode Parameters
	extract(shortcode_atts(array(
		"limit" 				=> 10,
		"category" 				=> '',
		"design"	 			=> 'design-1',
		"grid" 					=> 2,
		"pagination" 			=> 'false',
		"show_date" 			=> 'true',
		"show_category"			=> 'true',
		"show_content" 			=> 'true',
		"show_read_more" 		=> 'true',
		"content_words_limit" 	=> 20,
		'order'					=> 'DESC',
		'orderby'				=> 'post_date',
		'effect'				=> 'effect-2',
		'load_more_text'		=> '',
		'show_author' 			=> 'true',
		'media_size' 			=> 'large',
		'show_tags'				=> 'true',
		'show_comments'			=> 'true',
	), $atts, 'bdp_masonry'));

	$shortcode_designs 	= bdp_post_masonry_designs();
	$msonry_effects 	= bdp_post_masonry_effects();
	$posts_per_page		= (!empty($limit)) 						? $limit 			: 10;
	$cat 				= (!empty($category))					? explode(',',$category) : '';		
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$pagination 		= ($pagination == 'true')				? 'true'			: 'false';
	$grid 				= (!empty($grid))						? $grid 			: 2;
	$showDate 			= ( $show_date == 'true' ) 				? 'true' 			: 'false';
	$showCategory 		= ( $show_category == 'true')			? 'true' 			: 'false';
	$showContent 		= ( $show_content == 'true' ) 			? 'true' 			: 'false';
	$words_limit 		= !empty($content_words_limit) 			? $content_words_limit : 20;
	$showreadmore 		= ( $show_read_more == 'true' ) 		? 'true' 			: 'false';
	$order 				= ( strtolower($order) == 'asc' ) 		? 'ASC' 			: 'DESC';
	$orderby 			= (!empty($orderby))					? $orderby			: 'post_date';
	$load_more_text 	= !empty($load_more_text) 				? $load_more_text 	: __('Load More Posts', 'blog-designer-pack');
	$effect 			= (!empty($effect) && array_key_exists(trim($effect), $msonry_effects))	? trim($effect) : 'effect-1';
	$showAuthor 		= ($show_author == 'false')				? 'false'			: 'true';
	$media_size 		= (!empty($media_size))					? $media_size 		: 'large'; //thumbnail, medium, large, full
	$show_tags 			= ( $show_tags == 'false' ) 			? 'false'			: 'true';
	$show_comments 		= ( $show_comments == 'false' ) 		? 'false'			: 'true';
	$multi_page			= ( $multipage || is_single() ) 		? 1 				: 0;
	$unique 			= bdp_get_unique();

	// Shortcode file
	$design_file_path 	= BDP_DIR . '/templates/masonry/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';

	// Shortcode Parameters
	$shortcode_atts = compact('posts_per_page', 'cat', 'design', 'pagination', 'grid', 'showDate', 'showCategory', 'showContent', 'words_limit', 'showreadmore', 'order', 'orderby', 'showAuthor', 'media_size', 'show_tags', 'show_comments');

	// Pagination parameter
	if( $multi_page ) {
		$paged = isset( $_GET['bdpp-page'] ) ? $_GET['bdpp-page'] : 1;
	} elseif ( get_query_var( 'paged' ) ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	} else {
		$paged = 1;
	}

	// Enqueue required script
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'bdp-public-script' );
	bdp_enqueue_script();

	// WP Query Parameters
	$args = array (
		'post_type'      		=> BDP_POST_TYPE,
		'post_status' 			=> array('publish'),
		'order'          		=> $order,
		'orderby'        		=> $orderby, 
		'posts_per_page' 		=> $posts_per_page, 
		'paged'          		=> $paged,
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
	$query 		= new WP_Query($args);
	$total_post = $query->found_posts;

	ob_start();

	// If Blog post is there
	if ( $query->have_posts() ) : ?>
		<div class="bdp-post-masonry-wrp bdp-clearfix" id="bdp-post-masonry-wrp-<?php echo $unique; ?>">
			<div class="bdp-post-masonry bdp-clearfix bdp-<?php echo $effect; ?> bdp-<?php echo $design; ?> bdpgrid-<?php echo $grid; ?>" id="bdp-post-masonry-<?php echo $unique; ?>">

				<?php while ( $query->have_posts() ) : $query->the_post();

					$cat_links 				= array();
					$terms 					= get_the_terms( $post->ID, BDP_CAT );
					$post_link 				= bdp_get_post_link( $post->ID );
					$post_featured_image 	= bdp_get_post_featured_image( $post->ID, $media_size );
					$tags 			        = get_the_tag_list(' ',', ');
					$comments 		        = get_comments_number( $post->ID );					
					$reply					= ($comments <= 1)  ? esc_html__('Reply', 'blog-designer-pack') : esc_html__('Replies', 'blog-designer-pack');

					if( $terms ) {
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
					}
					$cate_name = join( " ", $cat_links );

					if( $design_file ) {
						include( $design_file );
					}
					endwhile;
				?>
			</div>

			<?php if( ($posts_per_page != -1) && ($posts_per_page < $total_post) && ($pagination != 'true') ) { ?>
			<div class="bdp-ajax-btn-wrap bdp-clearfix" data-conf="<?php echo htmlspecialchars( json_encode($shortcode_atts)); ?>">
				<button class="bdp-load-more-btn more" data-ajax="1" data-paged="1">
					<i class="bdp-ajax-loader"><img src="<?php echo BDP_URL . 'assets/images/ajax-loader.gif'; ?>" alt="<?php _e('Loading', 'blog-designer-pack'); ?>" /></i> 
					<?php echo $load_more_text; ?>
				</button>
			</div>
			<?php }

			if($pagination == "true" && $query->max_num_pages > 1 ) { ?>
			<div class="bdp-post-pagination bdp-clearfix">
				<?php
					echo bdp_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages, 'multi_page' => $multi_page ) );
				?>
			</div>
			<?php } ?>
		</div>

	<?php
		endif;		
		wp_reset_postdata(); // Reset wp query
		$content .= ob_get_clean();
		return $content;
}

// Post Masonry Shortcode
add_shortcode( 'bdp_masonry', 'bdp_post_masonry' );