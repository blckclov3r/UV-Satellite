<?php
/**
 * Shortcode Fields for Shortcode Preview
 *
 * @package Post Slider and Carousel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Generate 'psac_post_slider' shortcode fields
 * 
 * @since 1.0
 */
function psac_post_slider_lite_shortcode_fields( $shortcode = '' ) {
	$fields = array(
			// General Settings
			'general' => array(
					'title'     => __('General Parameters', 'post-slider-and-carousel'),
					'params'   	=>  array(
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Design', 'post-slider-and-carousel' ),
											'name' 		=> 'design',
											'value' 	=> psac_post_slider_designs(),
											'desc' 		=> __( 'Choose design.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Post Date', 'post-slider-and-carousel' ),
											'name' 			=> 'show_date',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post date.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Author', 'post-slider-and-carousel' ),
											'name' 			=> 'show_author',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post author.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Tags', 'post-slider-and-carousel' ),
											'name' 			=> 'show_tags',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'post-slider-and-carousel' ),
																	'false'		=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display post tags.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Comments', 'post-slider-and-carousel' ),
											'name' 			=> 'show_comments',
											'value' 		=> array(
																	'true'		=> __( 'True', 'post-slider-and-carousel' ),
																	'false'		=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post comment count.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Category', 'post-slider-and-carousel' ),
											'name' 			=> 'show_category',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'post-slider-and-carousel' ),
																	'false'		=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post category.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Content', 'post-slider-and-carousel' ),
											'name' 			=> 'show_content',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display post content.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Content Word Limit', 'post-slider-and-carousel' ),
											'name' 			=> 'content_words_limit',
											'value' 		=> 20,
											'desc' 			=> __( 'Enter content word limit.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Read More', 'post-slider-and-carousel' ),
											'name' 			=> 'show_read_more',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Show read more.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Image Size', 'post-slider-and-carousel' ),
											'name' 			=> 'media_size',
											'value' 		=> 'large',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Choose WordPress registered image size. e.g', 'post-slider-and-carousel' ).' thumbnail, medium, large, full.',
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Height', 'post-slider-and-carousel' ),
											'name' 			=> 'sliderheight',
											'value' 		=> 400,
											'desc' 			=> __( 'Enter slider height.', 'post-slider-and-carousel' ),											
										),	
									)
			),

			// Slider Fields
			'slider' => array(
					'title'		=> __('Slider Parameters', 'post-slider-and-carousel'),
					'params'    => array(
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Loop', 'post-slider-and-carousel' ),
											'name' 			=> 'loop',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Enable slider loop.', 'post-slider-and-carousel' ),
										),
										array(
											'type'		=> 'dropdown',
											'heading' 	=> __( 'Show Arrows', 'post-slider-and-carousel' ),
											'name' 		=> 'arrows',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc'		=> __( 'Show prev - next arrows.', 'post-slider-and-carousel' ),
										),
										
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Show Dots', 'post-slider-and-carousel' ),
											'name' 		=> 'dots',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 		=> __( 'Show pagination dots.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay', 'post-slider-and-carousel' ),
											'name' 			=> 'autoplay',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Enable slider autoplay.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Autoplay Interval', 'post-slider-and-carousel' ),
											'name' 			=> 'autoplay_interval',
											'value' 		=> 4000,
											'desc' 			=> __( 'Enter autoplay interval.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'autoplay',
																	'value' 	=> array( 'true' ),
																),
										),										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Speed', 'post-slider-and-carousel' ),
											'name' 			=> 'speed',
											'value' 		=> 600,
											'desc' 			=> __( 'Enter slider speed.', 'post-slider-and-carousel' ),											
										),	
								)
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'post-slider-and-carousel'),
					'params'    => array(										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Number of Post', 'post-slider-and-carousel' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min'			=> -1,
											'validation'	=> 'number',
											'desc' 			=> __( 'Enter total number of post to be displayed. Enter -1 to display all.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order By', 'post-slider-and-carousel' ),
											'name' 			=> 'orderby',
											'value' 		=>  array(
																	'date' 			=> __( 'Post Date', 'post-slider-and-carousel' ),
																	'ID' 			=> __( 'Post ID', 'post-slider-and-carousel' ),
																	'author' 		=> __( 'Post Author', 'post-slider-and-carousel' ),
																	'title' 		=> __( 'Post Title', 'post-slider-and-carousel' ),
																	'modified' 		=> __( 'Post Modified Date', 'post-slider-and-carousel' ),
																	'rand' 			=> __( 'Random', 'post-slider-and-carousel' ),
																	'menu_order'	=> __( 'Menu Order', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Select order type.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'post-slider-and-carousel' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'post-slider-and-carousel' ),
																	'asc'	=>  __( 'Ascending', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'post-slider-and-carousel' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id to display categories wise.', 'post-slider-and-carousel' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-slider-and-carousel').'"> [?]</label>',
											'refresh_time'	=> 1000,
										),										
									)
			),

			// Pro Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'post-slider-and-carousel'),
					'params'    => array(										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'post-slider-and-carousel' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'post-slider-and-carousel' ),
											'desc' 			=> __( 'Enter read more text.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'post-slider-and-carousel' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'post-slider-and-carousel' ),
																'new'	=> __( 'New Tab', 'post-slider-and-carousel' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'post-slider-and-carousel' ),
											'name' 			=> 'sharing',
											'value' 		=> __( 'Upgrade to pro', 'post-slider-and-carousel' ),
											'desc' 			=> __( 'Enable social sharing.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'post-slider-and-carousel' ),
											'name'		=> 'style_id',
											'value' 		=> __( 'Upgrade to pro', 'post-slider-and-carousel' ),
											'desc'		=> __( 'Choose your created style from style manager.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'post-slider-and-carousel' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Extra class added as parent so using extra class you customize your design.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'post-slider-and-carousel' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Slider previous button text.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																'element' 				=> 'arrows',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'post-slider-and-carousel' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Slider next button text.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																'element' 				=> 'arrows',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay Pause on Hover', 'post-slider-and-carousel' ),
											'name' 			=> 'autoplay_hover_pause',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
															),
											'desc' 			=> __( 'Autoplay pause on hover.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'autoplay',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Slider Auto Height', 'post-slider-and-carousel' ),
											'name' 			=> 'auto_height',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider auto height.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Start Position', 'post-slider-and-carousel' ),
											'name' 			=> 'start_position',
											'value' 		=> '',
											'desc' 			=> __( 'Enter slide number to start from that.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slide Margin', 'post-slider-and-carousel' ),
											'name' 			=> 'slide_margin',
											'value' 		=> 5,
											'desc' 			=> __( 'Slide margin.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Stage Padding', 'post-slider-and-carousel' ),
											'name' 			=> 'stage_padding',
											'value' 		=> 0,
											'desc' 			=> __( 'Enter slider stage padding. A partial slide will be visible at both the end.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Thumbnail', 'post-slider-and-carousel' ),
											'name' 			=> 'show_thumbnail',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display slider thumbnail.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Number of Thumbnails', 'post-slider-and-carousel' ),
											'name' 			=> 'thumbnail',
											'value' 		=> 7,
											'min'			=> 1,
											'desc' 			=> __( 'Enter number of thumbnails. The ideal value should be 7.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Number of thumbnails will adjust according to responsive layout mode.', 'post-slider-and-carousel').'"> [?]</label>',
											'dependency' 	=> array(
																	'element' 	=> 'show_thumbnail',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'URL Hash Listner', 'post-slider-and-carousel' ),
											'name' 			=> 'url_hash_listener',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable url hash listner of slider.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Lazyload', 'post-slider-and-carousel' ),
											'name' 			=> 'lazyload',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider lazyload behaviour.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'post-slider-and-carousel' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'post-slider-and-carousel' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'post-slider-and-carousel' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'post-slider-and-carousel' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'post-slider-and-carousel' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'post-slider-and-carousel' ),
																	'featured'	=> __( 'Featured', 'post-slider-and-carousel' ),
																	'trending'	=> __( 'Trending', 'post-slider-and-carousel'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'post-slider-and-carousel' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'post-slider-and-carousel' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'post-slider-and-carousel'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'post-slider-and-carousel' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'post-slider-and-carousel' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'post-slider-and-carousel' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'post-slider-and-carousel') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'post-slider-and-carousel' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'post-slider-and-carousel') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'post-slider-and-carousel' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'post-slider-and-carousel' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'post-slider-and-carousel').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'post-slider-and-carousel' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'post-slider-and-carousel' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'post-slider-and-carousel' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'post-slider-and-carousel' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'post-slider-and-carousel').'"> [?]</label>',
										),										
									)
			)
	);
	return $fields;
}

/**
 * Generate 'psac_post_carousel' shortcode fields
 * 
 * @since 1.0
 */
function psac_post_carousel_lite_shortcode_fields( $shortcode = '' ) {
	$fields = array(
			// General Settings
			'general' => array(
					'title'     => __('General Parameters', 'post-slider-and-carousel'),
					'params'   	=>  array(
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Design', 'post-slider-and-carousel' ),
											'name' 		=> 'design',
											'value' 	=> psac_post_carousel_designs(),
											'desc' 		=> __( 'Choose design.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Post Date', 'post-slider-and-carousel' ),
											'name' 			=> 'show_date',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post date.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Author', 'post-slider-and-carousel' ),
											'name' 			=> 'show_author',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post author.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Tags', 'post-slider-and-carousel' ),
											'name' 			=> 'show_tags',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'post-slider-and-carousel' ),
																	'false'		=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post tags.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Comments', 'post-slider-and-carousel' ),
											'name' 			=> 'show_comments',
											'value' 		=> array(
																	'true'		=> __( 'True', 'post-slider-and-carousel' ),
																	'false'		=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post comment count.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Category', 'post-slider-and-carousel' ),
											'name' 			=> 'show_category',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'post-slider-and-carousel' ),
																	'false'		=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post category.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Content', 'post-slider-and-carousel' ),
											'name' 			=> 'show_content',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Display post content.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Content Word Limit', 'post-slider-and-carousel' ),
											'name' 			=> 'content_words_limit',
											'value' 		=> 20,
											'desc' 			=> __( 'Enter content word limit.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Read More', 'post-slider-and-carousel' ),
											'name' 			=> 'show_read_more',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Show read more.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Image Size', 'post-slider-and-carousel' ),
											'name' 			=> 'media_size',
											'value' 		=> 'large',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Choose WordPress registered image size. e.g', 'post-slider-and-carousel' ).' thumbnail, medium, large, full.',
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Height', 'post-slider-and-carousel' ),
											'name' 			=> 'sliderheight',
											'value' 		=> 400,
											'desc' 			=> __( 'Enter slider height.', 'post-slider-and-carousel' ),											
										),		
									)
			),

			// Slider Fields
			'slider' => array(
					'title'		=> __('Slider Parameters', 'post-slider-and-carousel'),
					'params'    => array(
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slides Column', 'post-slider-and-carousel' ),
											'name' 			=> 'slide_show',
											'value' 		=> 3,
											'desc' 			=> __( 'Enter number of slides to show.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slides to Scroll', 'post-slider-and-carousel' ),
											'name' 			=> 'slide_scroll',
											'value' 		=> 1,
											'desc' 			=> __( 'Enter number of slides to scroll at a time.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Loop', 'post-slider-and-carousel' ),
											'name' 			=> 'loop',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Enable slider loop.', 'post-slider-and-carousel' ),
										),
										array(
											'type'		=> 'dropdown',
											'heading' 	=> __( 'Show Arrows', 'post-slider-and-carousel' ),
											'name' 		=> 'arrows',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc'		=> __( 'Show prev - next arrows.', 'post-slider-and-carousel' ),
										),										
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Show Dots', 'post-slider-and-carousel' ),
											'name' 		=> 'dots',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 		=> __( 'Show pagination dots.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay', 'post-slider-and-carousel' ),
											'name' 			=> 'autoplay',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Enable slider autoplay.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Autoplay Interval', 'post-slider-and-carousel' ),
											'name' 			=> 'autoplay_interval',
											'value' 		=> 4000,
											'desc' 			=> __( 'Enter autoplay interval.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																'element' 	=> 'autoplay',
																'value' 	=> array( 'true' ),
															),
										),										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Speed', 'post-slider-and-carousel' ),
											'name' 			=> 'speed',
											'value' 		=> 600,
											'desc' 			=> __( 'Enter slider speed.', 'post-slider-and-carousel' ),											
										),	
								)
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'post-slider-and-carousel'),
					'params'    => array(										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Number of Post', 'post-slider-and-carousel' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min'			=> -1,
											'validation'	=> 'number',
											'desc' 			=> __( 'Enter total number of post to be displayed. Enter -1 to display all.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order By', 'post-slider-and-carousel' ),
											'name' 			=> 'orderby',
											'value' 		=> array(
																	'date' 			=> __( 'Post Date', 'post-slider-and-carousel' ),
																	'ID' 			=> __( 'Post ID', 'post-slider-and-carousel' ),
																	'author' 		=> __( 'Post Author', 'post-slider-and-carousel' ),
																	'title' 		=> __( 'Post Title', 'post-slider-and-carousel' ),
																	'modified' 		=> __( 'Post Modified Date', 'post-slider-and-carousel' ),
																	'rand' 			=> __( 'Random', 'post-slider-and-carousel' ),
																	'menu_order'	=> __( 'Menu Order', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Select order type.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'post-slider-and-carousel' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'post-slider-and-carousel' ),
																	'asc'	=>  __( 'Ascending', 'post-slider-and-carousel' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'post-slider-and-carousel' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id to display categories wise.', 'post-slider-and-carousel' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-slider-and-carousel').'"> [?]</label>',
											'refresh_time'	=> 1000,
										),
								)
			),

			// Pro Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'post-slider-and-carousel'),
					'params'    => array(										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'post-slider-and-carousel' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'post-slider-and-carousel' ),
											'desc' 			=> __( 'Enter read more text.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'post-slider-and-carousel' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'post-slider-and-carousel' ),
																'new'	=> __( 'New Tab', 'post-slider-and-carousel' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'post-slider-and-carousel' ),
											'name' 			=> 'sharing',
											'value' 		=> __( 'Upgrade to pro', 'post-slider-and-carousel' ),
											'desc' 			=> __( 'Enable social sharing.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'post-slider-and-carousel' ),
											'name'		=> 'style_id',
											'value' 		=> __( 'Upgrade to pro', 'post-slider-and-carousel' ),
											'desc'		=> __( 'Choose your created style from style manager.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'post-slider-and-carousel' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Extra class added as parent so using extra class you customize your design.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'post-slider-and-carousel' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Slider previous button text.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																'element' 				=> 'arrows',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'post-slider-and-carousel' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Slider next button text.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																'element' 				=> 'arrows',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay Pause on Hover', 'post-slider-and-carousel' ),
											'name' 			=> 'autoplay_hover_pause',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
															),
											'desc' 			=> __( 'Autoplay pause on hover.', 'post-slider-and-carousel' ),
											'dependency' 	=> array(
																	'element' 	=> 'autoplay',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Slider Auto Height', 'post-slider-and-carousel' ),
											'name' 			=> 'auto_height',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider auto height.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Slider Center Mode', 'post-slider-and-carousel' ),
											'name' 			=> 'center',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider center mode.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Slider Auto Height', 'post-slider-and-carousel' ),
											'name' 			=> 'auto_height',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider auto height.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Start Position', 'post-slider-and-carousel' ),
											'name' 			=> 'start_position',
											'value' 		=> '',
											'desc' 			=> __( 'Enter slide number to start from that.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slide Margin', 'post-slider-and-carousel' ),
											'name' 			=> 'slide_margin',
											'value' 		=> 5,
											'desc' 			=> __( 'Slide margin.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Stage Padding', 'post-slider-and-carousel' ),
											'name' 			=> 'stage_padding',
											'value' 		=> 0,
											'desc' 			=> __( 'Enter slider stage padding. A partial slide will be visible at both the end.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Thumbnail', 'post-slider-and-carousel' ),
											'name' 			=> 'show_thumbnail',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display slider thumbnail.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Number of Thumbnails', 'post-slider-and-carousel' ),
											'name' 			=> 'thumbnail',
											'value' 		=> 7,
											'min'			=> 1,
											'desc' 			=> __( 'Enter number of thumbnails. The ideal value should be 7.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Number of thumbnails will adjust according to responsive layout mode.', 'post-slider-and-carousel').'"> [?]</label>',
											'dependency' 	=> array(
																	'element' 	=> 'show_thumbnail',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'URL Hash Listner', 'post-slider-and-carousel' ),
											'name' 			=> 'url_hash_listener',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable url hash listner of slider.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Lazyload', 'post-slider-and-carousel' ),
											'name' 			=> 'lazyload',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider lazyload behaviour.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'post-slider-and-carousel' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'post-slider-and-carousel' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'post-slider-and-carousel' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'post-slider-and-carousel' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'post-slider-and-carousel' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'post-slider-and-carousel' ),
																	'featured'	=> __( 'Featured', 'post-slider-and-carousel' ),
																	'trending'	=> __( 'Trending', 'post-slider-and-carousel'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'post-slider-and-carousel' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'post-slider-and-carousel' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'post-slider-and-carousel' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'post-slider-and-carousel'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'post-slider-and-carousel' ),
																	'false'	=> __( 'False', 'post-slider-and-carousel' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'post-slider-and-carousel' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'post-slider-and-carousel' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'post-slider-and-carousel' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'post-slider-and-carousel' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'post-slider-and-carousel') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'post-slider-and-carousel' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'post-slider-and-carousel') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'post-slider-and-carousel' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'post-slider-and-carousel' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'post-slider-and-carousel').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'post-slider-and-carousel' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'post-slider-and-carousel' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'post-slider-and-carousel').'"> [?]</label>',
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'post-slider-and-carousel' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'post-slider-and-carousel' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'post-slider-and-carousel').'"> [?]</label>',
										),										
									)
			)
	);
	return $fields;
}

