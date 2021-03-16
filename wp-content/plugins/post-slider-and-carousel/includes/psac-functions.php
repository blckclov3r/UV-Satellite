<?php
/**
 * Plugin generic functions file
 *
 * @package Post Slider and Carousel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Escape Tags & Slashes
 * Handles escapping the slashes and tags
 *
 * @since 1.0
 */
function psac_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @since 1.0
 */
function psac_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'psac_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash($data);
	}
}

/**
 * Function to unique number value
 * 
 * @since 1.0
 */
function psac_get_unique() {
	static $unique = 0;
	$unique++;

	// For VC front end editing
	if ( ( function_exists('vc_is_page_editable') && vc_is_page_editable() ) || 
		 ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' && isset($_POST['editor_post_id']) )
		)
	{
		return rand() .'-'. current_time( 'timestamp' );
	}

	return $unique;
}

/**
 * Function to validate that public script should be enqueue at last.
 * Call this function at last.
 * @since 1.0
 */
function psac_enqueue_script() {

	// Check public script is in queue
	if( wp_script_is( 'psac-public-script', 'enqueued' ) ) {
		
		// Dequeue Script
		wp_dequeue_script( 'psac-public-script' );

		// Enqueue Script
		wp_enqueue_script( 'psac-public-script' );
	}
}

/**
 * Function to get post excerpt
 * 
 * @since 1.0
 */
function psac_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

	$word_length = !empty($word_length) ? $word_length : 55;

	// If post id is passed
	if( !empty($post_id) ) {
		if (has_excerpt($post_id)) {
			$content = get_the_excerpt();
		} else {
			$content = !empty($content) ? $content : get_the_content();
		}
	}

	if( ! empty( $content ) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}

	return $content;
}

/**
 * Function to get post featured image
 * 
 * @since 1.0
 */
function psac_get_post_featured_image( $post_id = '', $size = 'full' ) {
    
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
    $image 	= isset($image[0]) ? $image[0] : '';

    return $image;
}

/**
 * Function to get post external link or permalink
 * 
 * @since 1.0
 */
function psac_get_post_link( $post_id = '' ) {

	$post_link = '';

	if( ! empty( $post_id ) ) {
		$post_link = get_permalink( $post_id );
	}

	return $post_link;
}

/**
 * Function to get 'psac_post_slider' shortcode designs
 * 
 * @since 1.0
 */
function psac_post_slider_designs() {
	$design_arr = array(
		'design-1'	=> esc_html__('Design 1', 'post-slider-and-carousel'),
		'design-2'	=> esc_html__('Design 2', 'post-slider-and-carousel'),		
	);
	return $design_arr;
}

/**
 * Function to get 'psac_post_carousel' shortcode designs
 * 
 * @since 1.0
 */
function psac_post_carousel_designs() {
	$design_arr = array(
		'design-1'	=> esc_html__('Design 1', 'post-slider-and-carousel'),
		'design-2'	=> esc_html__('Design 2', 'post-slider-and-carousel'),		
	);
	return $design_arr;
}

/**
 * Get plugin registered shortcodes
 * 
 * @since 1.0
 */
function psac_registered_shortcodes( $type = 'simplified' ) {

	$result		= array();
	$shortcodes = array(
					'general' => array(
									'name'			=> esc_html__('General', 'post-slider-and-carousel'),
									'shortcodes'	=> array(
															'psac_post_slider'			=> esc_html__('Post Slider', 'post-slider-and-carousel'),
															'psac_post_carousel'		=> esc_html__('Post Carousel', 'post-slider-and-carousel'),
														)
									),
					);
	$shortcodes = apply_filters('psac_registered_shortcodes', (array)$shortcodes );

	// For simplified result
	if( $type == 'simplified' && ! empty( $shortcodes ) ) {
		foreach ($shortcodes as $shrt_key => $shrt_val) {
			if( is_array( $shrt_val ) && ! empty( $shrt_val['shortcodes'] ) ) {
				$result = array_merge( $result, $shrt_val['shortcodes'] );
			} else {
				$result[ $shrt_key ] = $shrt_val;
			}
		}
	} else {
		$result = $shortcodes;
	}
	return $result;
}