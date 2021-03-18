<?php
/**
 * 'bdp_post_list' Shortcode
 * 
 * @package Blog Designer Pack
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to handle the `bdp_post` shortcode
 * 
 * @package Blog Designer Pack
 * @since 1.0.0
 */
function bdp_get_posts_list( $atts, $content = null ) {

	// Taking some globals
	global $post, $multipage;

	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> 20,
		'category' 				=> '',
		'design' 				=> 'design-1',
		'show_author' 			=> 'true',
		'pagination' 			=> 'true',
		'media_size' 			=> 'large',
		'show_date' 			=> 'true',
		'show_category' 		=> 'true',
		'show_content' 			=> 'true',
		'show_tags'				=> 'true',
		'show_comments'			=> 'true',
		'content_words_limit' 	=> 20,
		'show_read_more' 		=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		), $atts, 'bdp_post_list'));

	$shortcode_designs 	= bdp_recent_post_list_designs();	
	$posts_per_page 	= !empty($limit) 					? $limit 						: 20;
	$cat 				= (!empty($category))				? explode(',',$category) 		: '';
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$showAuthor 		= ($show_author == 'false')			? 'false'						: 'true';
	$pagination 		= ($pagination == 'false')			? 'false'						: 'true';
	$media_size 		= (!empty($media_size))				? $media_size 	: 'large'; //thumbnail, medium, large, full	
	$showDate 			= ( $show_date == 'false' ) 		? 'false'						: 'true';
	$showCategory 		= ( $show_category == 'false' )		? 'false' 						: 'true';
	$showContent 		= ( $show_content == 'false' ) 		? 'false' 						: 'true';
	$words_limit 		= !empty( $content_words_limit ) 	? $content_words_limit 			: 20;	
	$showreadmore 		= ( $show_read_more == 'false' )	? 'false' 						: 'true';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 			= !empty($orderby)					? $orderby 						: 'date';
	$show_tags 			= ( $show_tags == 'false' ) 		? 'false'						: 'true';
	$show_comments 		= ( $show_comments == 'false' ) 	? 'false'						: 'true';
	$multi_page			= ( $multipage || is_single() ) 	? 1 							: 0;

	// Shortcode file
	$post_design_file_path 	= BDP_DIR . '/templates/list/' . $design . '.php';
	$design_file 			= (file_exists($post_design_file_path)) ? $post_design_file_path : '';

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

	// WP Query Parameters
	$args = array(
		'post_type'				=> BDP_POST_TYPE,
		'post_status'			=> array('publish'),
		'order'					=> $order,
		'orderby'				=> $orderby, 
		'posts_per_page'		=> $posts_per_page,
		'paged'					=> $paged,
		'ignore_sticky_posts'	=> true,
	);

	// Category Parameter
	if( $cat != "" ) {
		$args['tax_query'] = array(
								array( 
									'taxonomy' 	=> BDP_CAT,
									'terms' 	=> $cat,
									'field' 	=> ( isset($cat[0]) && is_numeric($cat[0]) ) ? 'term_id' : 'slug',
								));
	}

	// WP Query
	$query = new WP_Query($args);

	ob_start();

	// If post is there
	if ( $query->have_posts() ) {  ?>
		<div class="bdp-list-main <?php echo 'bdp-'.$design; ?> bdp-clearfix">
			<?php while ( $query->have_posts() ) : $query->the_post();
				
				$cat_links 				= array();
				$css_class 				= '';
				$post_featured_image 	= bdp_get_post_featured_image( $post->ID, $media_size );
				$post_link 				= bdp_get_post_link( $post->ID );
				$terms 					= get_the_terms( $post->ID, BDP_CAT );
				$tags 					= get_the_tag_list(' ',', ');
				$comments 				= get_comments_number( $post->ID );				
				$reply					= ($comments <= 1)  ? esc_html__('Reply', 'blog-designer-pack') : esc_html__('Replies', 'blog-designer-pack');

				if( $terms ) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( " ", $cat_links );

				// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
				}

			endwhile; ?>
		</div>		
		<?php if($pagination == "true" && $query->max_num_pages > 1 ) { ?>
		<div class="bdp-post-pagination bdp-clearfix">
			<?php
				echo bdp_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages, 'multi_page' => $multi_page ) );
			?>
		</div>
		<?php }
	} // end of have_post()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// Post List Shortcode
add_shortcode( 'bdp_post_list', 'bdp_get_posts_list' );