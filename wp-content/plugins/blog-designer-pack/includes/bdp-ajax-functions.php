<?php
/**
 * Public Class
 * Handles shortcodes functionality of plugin * 
 * @package Blog Designer Pack
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpbdp_Public {

	function __construct() {

		// Ajax call to update option
		add_action( 'wp_ajax_bdp_get_more_post', array($this, 'bdp_get_more_post') );
		add_action( 'wp_ajax_nopriv_bdp_get_more_post', array($this, 'bdp_get_more_post') );
	}

	/**
	 * Get more Blog post througn ajax
	 *
	 * @since 1.0.0
	 */
	function bdp_get_more_post() {
		
		// Taking some defaults
		$result = array();
		
		if( !empty($_POST['shrt_param']) ) {
			
			global $post, $bdp_in_shrtcode;
			
			extract( $_POST['shrt_param'] );
			
			$design_file_path 	= BDP_DIR . '/templates/masonry/' . $design . '.php';
			$design_file 		= (file_exists($design_file_path)) 	? $design_file_path : '';
			$shortcode_atts 	= $_POST['shrt_param']; // Assigning it to variable
			
			$args = array (
					'post_type'      	=> BDP_POST_TYPE, 
					'orderby'        	=> !empty($orderby) 	? $orderby : 'post_date',
					'order'          	=> !empty($order) 		? $order 	: 'DESC',
					'posts_per_page' 	=> !empty($posts_per_page) 		? $posts_per_page 	: '10',
					'paged'          	=> !empty($_POST['paged']) 		? $_POST['paged'] 	: '1',
					
				);

			if($cat != "") {
				$args['tax_query'] = array( array( 'taxonomy' => BDP_CAT, 'field' => 'id', 'terms' => $cat) );
			}

			$blog_posts = new WP_Query($args);

			ob_start();

			if ( $blog_posts->have_posts() ) {

				while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
					
					$blog_links 			= array();
					$terms 					= get_the_terms( $post->ID, BDP_CAT );
					$post_link 				= bdp_get_post_link( $post->ID );
					$bdp_author 			= get_the_author();
					$post_featured_image 	= bdp_get_post_featured_image( $post->ID, $media_size );						
					$terms 					= get_the_terms( $post->ID, BDP_CAT );
					$tags					= get_the_tag_list(' ',', ');
					$comments				= get_comments_number( $post->ID );
					$reply					= ($comments <= 1) ? esc_html__('Reply', 'blog-designer-pack') : esc_html__('Replies', 'blog-designer-pack');
					
					if($terms) {
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$blog_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
					}
					$cate_name = join( " ", $blog_links );
				if( $design_file ) {
					include( $design_file );
				}
				endwhile; // End while loop
			}			
				$data = ob_get_clean();
						
				$result['success'] 	= 1;
				$result['data'] 	= $data;
				
		} else {
			$result['success'] 	= 0;
		}
		wp_send_json($result);		
	}
}

$bdp_public = new Wpbdp_Public();