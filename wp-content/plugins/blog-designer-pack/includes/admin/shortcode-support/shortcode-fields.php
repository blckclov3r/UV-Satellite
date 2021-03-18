<?php
/**
 * Shortcode Fields for Shortcode Preview 
 *
 * @package Blog Designer Pack 
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Generate 'bdp_post' shortcode fields
 * 
 * @package Blog Designer Pack 
 * @since 1.0
 */
function bdp_post_lite_shortcode_fields( $shortcode = '' ) {
	$fields = array(
			// General Settings
			'general' => array(
					'title'     => __('General Parameters', 'blog-designer-pack'),
					'params'   	=>  array(
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Design', 'blog-designer-pack' ),
											'name' 		=> 'design',
											'value' 	=> bdp_post_designs(),
											'desc' 		=> __( 'Choose design.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Grid', 'blog-designer-pack' ),
											'name' 			=> 'grid',
											'value' 		=> array(
																	'1'	 => __( 'Grid 1', 'blog-designer-pack' ),
																	'2'	 => __( 'Grid 2', 'blog-designer-pack' ),
																	'3'	 => __( 'Grid 3', 'blog-designer-pack' ),
																	'4'	 => __( 'Grid 4', 'blog-designer-pack' ),
																	'5'	 => __( 'Grid 5', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Choose number of column to be displayed.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Post Date', 'blog-designer-pack' ),
											'name' 			=> 'show_date',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post date.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Author', 'blog-designer-pack' ),
											'name' 			=> 'show_author',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post author.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Tags', 'blog-designer-pack' ),
											'name' 			=> 'show_tags',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post tags.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Comments', 'blog-designer-pack' ),
											'name' 			=> 'show_comments',
											'value' 		=> array(
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post comment count.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Category', 'blog-designer-pack' ),
											'name' 			=> 'show_category',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post category.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Content', 'blog-designer-pack' ),
											'name' 			=> 'show_content',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post content.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Content Word Limit', 'blog-designer-pack' ),
											'name' 			=> 'content_words_limit',
											'value' 		=> 20,
											'desc' 			=> __( 'Enter content word limit.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Read More', 'blog-designer-pack' ),
											'name' 			=> 'show_read_more',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Show read more.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Image Size', 'blog-designer-pack' ),
											'name' 			=> 'media_size',
											'value' 		=> 'large',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Choose WordPress registered image size. e.g', 'blog-designer-pack' ).' thumbnail, medium, medium_large, large, full.',
										),										
										
									)
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'blog-designer-pack'),
					'params'    => array(					
										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Number of Post', 'blog-designer-pack' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min'			=> -1,
											'desc' 			=> __( 'Enter total number of post to be displayed. Enter -1 to display all.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order By', 'blog-designer-pack' ),
											'name' 			=> 'orderby',
											'value' 		=>  array(
																	'date' 			=> __( 'Post Date', 'blog-designer-pack' ),
																	'ID' 			=> __( 'Post ID', 'blog-designer-pack' ),
																	'author' 		=> __( 'Post Author', 'blog-designer-pack' ),
																	'title' 		=> __( 'Post Title', 'blog-designer-pack' ),
																	'modified' 		=> __( 'Post Modified Date', 'blog-designer-pack' ),
																	'rand' 			=> __( 'Random', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select order type.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'blog-designer-pack' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'blog-designer-pack' ),
																	'asc'	=>  __( 'Ascending', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'blog-designer-pack' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id OR slug to display categories wise. To find the category id please refer <a href="https://docs.infornweb.com/assets/images/post-category-id.png" target="_blank">screenshot</a>.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination', 'blog-designer-pack' ),
											'name' 			=> 'pagination',
											'value' 		=> array( 
																'true'	=> __( 'True', 'blog-designer-pack' ),
																'false'	=> __( 'False', 'blog-designer-pack' ),
															),
											'dependency' 	=> array(
																		'element' 				=> 'limit',
																		'value_not_equal_to' 	=> '-1',
																	),
											'desc' 			=> __( 'Display Pagination.', 'blog-designer-pack' ),
										),										
									)
				),
				
			// Pro Grid Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'blog-designer-pack'),
					'params'    => array(		
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'blog-designer-pack' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'blog-designer-pack' ),
											'desc' 			=> __( 'Enter read more text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'blog-designer-pack' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'blog-designer-pack' ),
																'new'	=> __( 'New Tab', 'blog-designer-pack' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'blog-designer-pack' ),
											'name' 			=> 'sharing',
											'value' 		=> 'Upgrade to pro',
											'desc' 			=> __( 'Enable social sharing.', 'blog-designer-pack' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'blog-designer-pack' ),
											'name'		=> 'style_id',
											'value' 		=> 'Upgrade to pro',
											'desc'		=> __( 'Choose your created style from style manager.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'blog-designer-pack' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'blog-designer-pack' ) . '<label title="'.__('Note: Extra class will be added at top most parent so using extra class you customize your design.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'blog-designer-pack' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'blog-designer-pack' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'blog-designer-pack' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'blog-designer-pack' ),
																	'featured'	=> __( 'Featured', 'blog-designer-pack' ),
																	'trending'	=> __( 'Trending', 'blog-designer-pack'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'blog-designer-pack' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'blog-designer-pack' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'blog-designer-pack'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'blog-designer-pack' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'blog-designer-pack' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'blog-designer-pack' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'blog-designer-pack' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'blog-designer-pack').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'blog-designer-pack' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination Type', 'blog-designer-pack' ),
											'name' 			=> 'pagination_type',
											'value' 		=> array(
																	'numeric'			=> __( 'Numeric', 'blog-designer-pack' ),
																	'prev-next'			=> __( 'Next - Prev', 'blog-designer-pack' ),
																	'prev-next-ajax'	=> __( 'Next - Prev Ajax', 'blog-designer-pack' ),
																	'load-more'			=> __( 'Load More', 'blog-designer-pack' ),
																	'infinite'			=> __( 'Infinite Scroll', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Choose pagination type.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'blog-designer-pack' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination previous button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'blog-designer-pack' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination next button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'blog-designer-pack' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'blog-designer-pack' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'blog-designer-pack').'"> [?]</label>',
										),  
																			
									)
				)
		);
	return $fields;
}

/**
 * Generate 'bdp_post_slider' shortcode fields
 * 
 * @package Blog Designer Pack 
 * @since 1.0
 */
function bdp_post_slider_lite_shortcode_fields( $shortcode = '' ) {
	$fields = array(
			// General Settings
			'general' => array(
					'title'     => __('General Parameters', 'blog-designer-pack'),
					'params'   	=>  array(
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Design', 'blog-designer-pack' ),
											'name' 		=> 'design',
											'value' 	=> bdp_recent_post_slider_designs(),
											'desc' 		=> __( 'Choose design.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Post Date', 'blog-designer-pack' ),
											'name' 			=> 'show_date',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post date.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Author', 'blog-designer-pack' ),
											'name' 			=> 'show_author',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post author.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Tags', 'blog-designer-pack' ),
											'name' 			=> 'show_tags',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display post tags.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Comments', 'blog-designer-pack' ),
											'name' 			=> 'show_comments',
											'value' 		=> array(
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post comment count.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Category', 'blog-designer-pack' ),
											'name' 			=> 'show_category',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post category.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Content', 'blog-designer-pack' ),
											'name' 			=> 'show_content',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display post content.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Content Word Limit', 'blog-designer-pack' ),
											'name' 			=> 'content_words_limit',
											'value' 		=> 20,
											'desc' 			=> __( 'Enter content word limit.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Read More', 'blog-designer-pack' ),
											'name' 			=> 'show_read_more',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Show read more.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Image Size', 'blog-designer-pack' ),
											'name' 			=> 'media_size',
											'value' 		=> 'large',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Choose WordPress registered image size. e.g', 'blog-designer-pack' ).' thumbnail, medium, medium_large, large, full.',
										),
										
									)
			),

			// Slider Fields
			'slider' => array(
					'title'		=> __('Slider Parameters', 'blog-designer-pack'),
					'params'    => array(
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Loop', 'blog-designer-pack' ),
											'name' 			=> 'loop',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Enable slider loop.', 'blog-designer-pack' ),
										),
										array(
											'type'		=> 'dropdown',
											'heading' 	=> __( 'Show Arrows', 'blog-designer-pack' ),
											'name' 		=> 'arrows',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'		=> __( 'Show prev - next arrows.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Show Dots', 'blog-designer-pack' ),
											'name' 		=> 'dots',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 		=> __( 'Show pagination dots.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay', 'blog-designer-pack' ),
											'name' 			=> 'autoplay',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Enable slider autoplay.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Autoplay Interval', 'blog-designer-pack' ),
											'name' 			=> 'autoplay_interval',
											'value' 		=> 5000,
											'desc' 			=> __( 'Enter autoplay interval.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'autoplay',
																	'value' 	=> array( 'true' ),
																),
										),
										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Speed', 'blog-designer-pack' ),
											'name' 			=> 'speed',
											'value' 		=> 500,
											'desc' 			=> __( 'Enter slider speed.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'autoplay',
																	'value' 	=> array( 'true' ),
																),
										),	
										
								)
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'blog-designer-pack'),
					'params'    => array(										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Number of Post', 'blog-designer-pack' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min'			=> -1,
											'validation'	=> 'number',
											'desc' 			=> __( 'Enter total number of post to be displayed. Enter -1 to display all.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order By', 'blog-designer-pack' ),
											'name' 			=> 'orderby',
											'value' 		=>  array(
																	'date' 			=> __( 'Post Date', 'blog-designer-pack' ),
																	'ID' 			=> __( 'Post ID', 'blog-designer-pack' ),
																	'author' 		=> __( 'Post Author', 'blog-designer-pack' ),
																	'title' 		=> __( 'Post Title', 'blog-designer-pack' ),
																	'modified' 		=> __( 'Post Modified Date', 'blog-designer-pack' ),
																	'rand' 			=> __( 'Random', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select order type.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'blog-designer-pack' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'blog-designer-pack' ),
																	'asc'	=>  __( 'Ascending', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'blog-designer-pack' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id OR slug to display categories wise. To find the category id please refer <a href="https://docs.infornweb.com/assets/images/post-category-id.png" target="_blank">screenshot</a>.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),									
										
									)
			),
			// Pro Grid Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'blog-designer-pack'),
					'params'    => array(		
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'blog-designer-pack' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'blog-designer-pack' ),
											'desc' 			=> __( 'Enter read more text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'blog-designer-pack' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'blog-designer-pack' ),
																'new'	=> __( 'New Tab', 'blog-designer-pack' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'blog-designer-pack' ),
											'name' 			=> 'sharing',
											'value' 		=> 'Upgrade to pro',
											'desc' 			=> __( 'Enable social sharing.', 'blog-designer-pack' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'blog-designer-pack' ),
											'name'		=> 'style_id',
											'value' 	=> 'Upgrade to pro',
											'desc'		=> __( 'Choose your created style from style manager.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'blog-designer-pack' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'blog-designer-pack' ) . '<label title="'.__('Note: Extra class will be added at top most parent so using extra class you customize your design.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'blog-designer-pack' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'blog-designer-pack' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'blog-designer-pack' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'blog-designer-pack' ),
																	'featured'	=> __( 'Featured', 'blog-designer-pack' ),
																	'trending'	=> __( 'Trending', 'blog-designer-pack'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'blog-designer-pack' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'blog-designer-pack' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'blog-designer-pack'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'blog-designer-pack' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'blog-designer-pack' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'blog-designer-pack' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'blog-designer-pack' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'blog-designer-pack').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'blog-designer-pack' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'blog-designer-pack' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'blog-designer-pack' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'blog-designer-pack' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Slider previous button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'arrows',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'blog-designer-pack' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Slider next button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'arrows',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay Pause on Hover', 'blog-designer-pack' ),
											'name' 			=> 'autoplay_hover_pause',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
															),
											'desc' 			=> __( 'Autoplay pause on hover.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'autoplay',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Slider Auto Height', 'blog-designer-pack' ),
											'name' 			=> 'auto_height',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider auto height.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Start Position', 'blog-designer-pack' ),
											'name' 			=> 'start_position',
											'value' 		=> '',
											'desc' 			=> __( 'Enter slide number to start from that.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slide Margin', 'blog-designer-pack' ),
											'name' 			=> 'slide_margin',
											'value' 		=> 5,
											'desc' 			=> __( 'Slide margin.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Stage Padding', 'blog-designer-pack' ),
											'name' 			=> 'stage_padding',
											'value' 		=> 0,
											'desc' 			=> __( 'Enter slider stage padding. A partial slide will be visible at both the end.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Thumbnail', 'blog-designer-pack' ),
											'name' 			=> 'show_thumbnail',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display slider thumbnail.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Number of Thumbnails', 'blog-designer-pack' ),
											'name' 			=> 'thumbnail',
											'value' 		=> 7,
											'min'			=> 1,
											'desc' 			=> __( 'Enter number of thumbnails. The ideal value should be 7.', 'blog-designer-pack' ) . '<label title="'.__('Note: Number of thumbnails will adjust according to responsive layout mode.', 'blog-designer-pack').'"> [?]</label>',
											'dependency' 	=> array(
																	'element' 	=> 'show_thumbnail',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'URL Hash Listner', 'blog-designer-pack' ),
											'name' 			=> 'url_hash_listener',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable url hash listner of slider.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Lazyload', 'blog-designer-pack' ),
											'name' 			=> 'lazyload',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider lazyload behaviour.', 'blog-designer-pack' ),
										),	
																			
									)
			)						
	);
	return $fields;
}

/**
 * Generate 'bdp_post_carousel' shortcode fields
 * 
 * @package Blog Designer Pack 
 * @since 1.0
 */
function bdp_post_carousel_lite_shortcode_fields( $shortcode = '' ) {
	$fields = array(
			// General Settings
			'general' => array(
					'title'     => __('General Parameters', 'blog-designer-pack'),
					'params'   	=>  array(
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Design', 'blog-designer-pack' ),
											'name' 		=> 'design',
											'value' 	=> bdp_recent_post_carousel_designs(),
											'desc' 		=> __( 'Choose design.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Post Date', 'blog-designer-pack' ),
											'name' 			=> 'show_date',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post date.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Author', 'blog-designer-pack' ),
											'name' 			=> 'show_author',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post author.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Tags', 'blog-designer-pack' ),
											'name' 			=> 'show_tags',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display post tags.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Comments', 'blog-designer-pack' ),
											'name' 			=> 'show_comments',
											'value' 		=> array(
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post comment count.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Category', 'blog-designer-pack' ),
											'name' 			=> 'show_category',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post category.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Content', 'blog-designer-pack' ),
											'name' 			=> 'show_content',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display post content.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Content Word Limit', 'blog-designer-pack' ),
											'name' 			=> 'content_words_limit',
											'value' 		=> 20,
											'desc' 			=> __( 'Enter content word limit.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Read More', 'blog-designer-pack' ),
											'name' 			=> 'show_read_more',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Show read more.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Image Size', 'blog-designer-pack' ),
											'name' 			=> 'media_size',
											'value' 		=> 'large',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Choose WordPress registered image size. e.g', 'blog-designer-pack' ).' thumbnail, medium, medium_large, large, full.',
										),										
									)
			),

			// Slider Fields
			'slider' => array(
					'title'		=> __('Slider Parameters', 'blog-designer-pack'),
					'params'    => array(
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slides Column', 'blog-designer-pack' ),
											'name' 			=> 'slide_show',
											'value' 		=> 3,
											'desc' 			=> __( 'Enter number of slides to show.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slides to Scroll', 'blog-designer-pack' ),
											'name' 			=> 'slide_scroll',
											'value' 		=> 1,
											'desc' 			=> __( 'Enter number of slides to scroll at a time.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Loop', 'blog-designer-pack' ),
											'name' 			=> 'loop',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Enable slider loop.', 'blog-designer-pack' ),
										),
										array(
											'type'		=> 'dropdown',
											'heading' 	=> __( 'Show Arrows', 'blog-designer-pack' ),
											'name' 		=> 'arrows',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'		=> __( 'Show prev - next arrows.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Show Dots', 'blog-designer-pack' ),
											'name' 		=> 'dots',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 		=> __( 'Show pagination dots.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay', 'blog-designer-pack' ),
											'name' 			=> 'autoplay',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Enable slider autoplay.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Autoplay Interval', 'blog-designer-pack' ),
											'name' 			=> 'autoplay_interval',
											'value' 		=> 5000,
											'desc' 			=> __( 'Enter autoplay interval.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 	=> 'autoplay',
																'value' 	=> array( 'true' ),
															),
										),
										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Speed', 'blog-designer-pack' ),
											'name' 			=> 'speed',
											'value' 		=> '',
											'desc' 			=> __( 'Enter slider speed.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 	=> 'autoplay',
																'value' 	=> array( 'true' ),
															),
										),									
										
								)
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'blog-designer-pack'),
					'params'    => array(										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Number of Post', 'blog-designer-pack' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min'			=> -1,
											'validation'	=> 'number',
											'desc' 			=> __( 'Enter total number of post to be displayed. Enter -1 to display all.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order By', 'blog-designer-pack' ),
											'name' 			=> 'orderby',
											'value' 		=> array(
																	'date' 			=> __( 'Post Date', 'blog-designer-pack' ),
																	'ID' 			=> __( 'Post ID', 'blog-designer-pack' ),
																	'author' 		=> __( 'Post Author', 'blog-designer-pack' ),
																	'title' 		=> __( 'Post Title', 'blog-designer-pack' ),
																	'modified' 		=> __( 'Post Modified Date', 'blog-designer-pack' ),
																	'rand' 			=> __( 'Random', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select order type.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'blog-designer-pack' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'blog-designer-pack' ),
																	'asc'	=>  __( 'Ascending', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'blog-designer-pack' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id OR slug to display categories wise. To find the category id please refer <a href="https://docs.infornweb.com/assets/images/post-category-id.png" target="_blank">screenshot</a>.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),										
									)
			),
			// Pro Grid Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'blog-designer-pack'),
					'params'    => array(		
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'blog-designer-pack' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'blog-designer-pack' ),
											'desc' 			=> __( 'Enter read more text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'blog-designer-pack' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'blog-designer-pack' ),
																'new'	=> __( 'New Tab', 'blog-designer-pack' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'blog-designer-pack' ),
											'name' 			=> 'sharing',
											'value' 		=> 'Upgrade to pro',
											'desc' 			=> __( 'Enable social sharing.', 'blog-designer-pack' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'blog-designer-pack' ),
											'name'		=> 'style_id',
											'value' 	=> 'Upgrade to pro',
											'desc'		=> __( 'Choose your created style from style manager.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'blog-designer-pack' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'blog-designer-pack' ) . '<label title="'.__('Note: Extra class will be added at top most parent so using extra class you customize your design.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'blog-designer-pack' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'blog-designer-pack' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'blog-designer-pack' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'blog-designer-pack' ),
																	'featured'	=> __( 'Featured', 'blog-designer-pack' ),
																	'trending'	=> __( 'Trending', 'blog-designer-pack'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'blog-designer-pack' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'blog-designer-pack' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'blog-designer-pack'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'blog-designer-pack' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'blog-designer-pack' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'blog-designer-pack' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'blog-designer-pack' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'blog-designer-pack').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'blog-designer-pack' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'blog-designer-pack' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'blog-designer-pack' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'blog-designer-pack' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Slider previous button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'arrows',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'blog-designer-pack' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Slider next button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'arrows',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay Pause on Hover', 'blog-designer-pack' ),
											'name' 			=> 'autoplay_hover_pause',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Autoplay pause on hover.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 	=> 'autoplay',
																'value' 	=> array( 'true' ),
															),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Slider Center Mode', 'blog-designer-pack' ),
											'name' 			=> 'center',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider center mode.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Slider Auto Height', 'blog-designer-pack' ),
											'name' 			=> 'auto_height',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider auto height.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Start Position', 'blog-designer-pack' ),
											'name' 			=> 'start_position',
											'value' 		=> '',
											'desc' 			=> __( 'Enter slide number to start from that.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slide Margin', 'blog-designer-pack' ),
											'name' 			=> 'slide_margin',
											'value' 		=> 5,
											'desc' 			=> __( 'Slide margin.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Slider Stage Padding', 'blog-designer-pack' ),
											'name' 			=> 'stage_padding',
											'value' 		=> '',
											'desc' 			=> __( 'Enter slider stage padding. A partial slide will be visible at both the end.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'URL Hash Listner', 'blog-designer-pack' ),
											'name' 			=> 'url_hash_listener',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable url hash listner of slider.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Lazyload', 'blog-designer-pack' ),
											'name' 			=> 'lazyload',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Enable slider lazyload behaviour.', 'blog-designer-pack' ),
										),	
																			
									)
				)
	);
	return $fields;
}

/**
 * Generate 'bdp_post_gridbox' shortcode fields
 * 
 * @package Blog Designer Pack 
 * @since 1.0
 */
function bdp_post_gridbox_lite_shortcode_fields( $shortcode = '' ) {
	$fields = array(
			// General Settings
			'general' => array(
					'title'     => __('General Parameters', 'blog-designer-pack'),
					'params'   	=>  array(
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Design', 'blog-designer-pack' ),
											'name' 		=> 'design',
											'value' 	=> bdp_recent_post_gridbox_designs(),
											'desc' 		=> __( 'Choose design.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Post Date', 'blog-designer-pack' ),
											'name' 			=> 'show_date',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post date.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Author', 'blog-designer-pack' ),
											'name' 			=> 'show_author',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post author.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Tags', 'blog-designer-pack' ),
											'name' 			=> 'show_tags',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display post tags.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Comments', 'blog-designer-pack' ),
											'name' 			=> 'show_comments',
											'value' 		=> array(
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post comment count.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Category', 'blog-designer-pack' ),
											'name' 			=> 'show_category',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post category.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Content', 'blog-designer-pack' ),
											'name' 			=> 'show_content',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post content.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Content Word Limit', 'blog-designer-pack' ),
											'name' 			=> 'content_words_limit',
											'value' 		=> 20,
											'desc' 			=> __( 'Enter content word limit.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Read More', 'blog-designer-pack' ),
											'name' 			=> 'show_read_more',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Show read more.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Image Size', 'blog-designer-pack' ),
											'name' 			=> 'media_size',
											'value' 		=> 'large',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Choose WordPress registered image size. e.g', 'blog-designer-pack' ).' thumbnail, medium, medium_large, large, full.',
										),
									)
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'blog-designer-pack'),
					'params'    => array(										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Number of Post', 'blog-designer-pack' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min'			=> -1,
											'validation'	=> 'number',
											'desc' 			=> __( 'Enter total number of post to be displayed. Enter -1 to display all.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order By', 'blog-designer-pack' ),
											'name' 			=> 'orderby',
											'value' 		=>  array(
																	'date' 			=> __( 'Post Date', 'blog-designer-pack' ),
																	'ID' 			=> __( 'Post ID', 'blog-designer-pack' ),
																	'author' 		=> __( 'Post Author', 'blog-designer-pack' ),
																	'title' 		=> __( 'Post Title', 'blog-designer-pack' ),
																	'modified' 		=> __( 'Post Modified Date', 'blog-designer-pack' ),
																	'rand' 			=> __( 'Random', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select order type.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'blog-designer-pack' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'blog-designer-pack' ),
																	'asc'	=>  __( 'Ascending', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'blog-designer-pack' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id OR slug to display categories wise. To find the category id please refer <a href="https://docs.infornweb.com/assets/images/post-category-id.png" target="_blank">screenshot</a>.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination', 'blog-designer-pack' ),
											'name' 			=> 'pagination',
											'value' 		=> array( 
																'true'	=> __( 'True', 'blog-designer-pack' ),
																'false'	=> __( 'False', 'blog-designer-pack' ),
															),
											'dependency' 	=> array(
																		'element' 				=> 'limit',
																		'value_not_equal_to' 	=> '-1',
																	),
											'desc' 			=> __( 'Display Pagination.', 'blog-designer-pack' ),
										),									
										
									)
				),
				// Pro Grid Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'blog-designer-pack'),
					'params'    => array(		
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'blog-designer-pack' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'blog-designer-pack' ),
											'desc' 			=> __( 'Enter read more text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'blog-designer-pack' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'blog-designer-pack' ),
																'new'	=> __( 'New Tab', 'blog-designer-pack' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'blog-designer-pack' ),
											'name' 			=> 'sharing',
											'value' 		=> 'Upgrade to pro',
											'desc' 			=> __( 'Enable social sharing.', 'blog-designer-pack' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'blog-designer-pack' ),
											'name'		=> 'style_id',
											'value' 	=> 'Upgrade to pro',
											'desc'		=> __( 'Choose your created style from style manager.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Height', 'blog-designer-pack' ),
											'name' 			=> 'height',
											'value' 		=> '',
											'desc' 			=> __( 'Enter post image or box height. Leave empty for default.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'blog-designer-pack' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'blog-designer-pack' ) . '<label title="'.__('Note: Extra class will be added at top most parent so using extra class you customize your design.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'blog-designer-pack' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'blog-designer-pack' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'blog-designer-pack' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'blog-designer-pack' ),
																	'featured'	=> __( 'Featured', 'blog-designer-pack' ),
																	'trending'	=> __( 'Trending', 'blog-designer-pack'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'blog-designer-pack' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'blog-designer-pack' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'blog-designer-pack'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'blog-designer-pack' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'blog-designer-pack' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'blog-designer-pack' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'blog-designer-pack' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'blog-designer-pack').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'blog-designer-pack' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination Type', 'blog-designer-pack' ),
											'name' 			=> 'pagination_type',
											'value' 		=> array(
																	'numeric'			=> __( 'Numeric', 'blog-designer-pack' ),
																	'prev-next'			=> __( 'Next - Prev', 'blog-designer-pack' ),
																	'prev-next-ajax'	=> __( 'Next - Prev Ajax', 'blog-designer-pack' ),
																	'load-more'			=> __( 'Load More', 'blog-designer-pack' ),
																	'infinite'			=> __( 'Infinite Scroll', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Choose pagination type.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'blog-designer-pack' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination previous button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'blog-designer-pack' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination next button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'blog-designer-pack' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'blog-designer-pack' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'blog-designer-pack').'"> [?]</label>',
										),  
																			
									)
				)
		);
	return $fields;
}

/**
 * Generate 'bdp_post_list' shortcode fields
 * 
 * @package Blog Designer Pack 
 * @since 1.0
 */
function bdp_post_list_lite_shortcode_fields( $shortcode = '' ) {
	$fields = array(
			// General Settings
			'general' => array(
					'title'     => __('General Parameters', 'blog-designer-pack'),
					'params'   	=>  array(
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Design', 'blog-designer-pack' ),
											'name' 		=> 'design',
											'value' 	=> bdp_recent_post_list_designs(),
											'desc' 		=> __( 'Choose design.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Post Date', 'blog-designer-pack' ),
											'name' 			=> 'show_date',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post date.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Author', 'blog-designer-pack' ),
											'name' 			=> 'show_author',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post author.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Tags', 'blog-designer-pack' ),
											'name' 			=> 'show_tags',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post tags.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Comments', 'blog-designer-pack' ),
											'name' 			=> 'show_comments',
											'value' 		=> array(
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post comment count.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Category', 'blog-designer-pack' ),
											'name' 			=> 'show_category',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post category.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Content', 'blog-designer-pack' ),
											'name' 			=> 'show_content',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post content.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Content Word Limit', 'blog-designer-pack' ),
											'name' 			=> 'content_words_limit',
											'value' 		=> 20,
											'desc' 			=> __( 'Enter content word limit.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Read More', 'blog-designer-pack' ),
											'name' 			=> 'show_read_more',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Show read more.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Image Size', 'blog-designer-pack' ),
											'name' 			=> 'media_size',
											'value' 		=> 'large',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Choose WordPress registered image size. e.g', 'blog-designer-pack' ).' thumbnail, medium, medium_large, large, full.',
										),
										
									)
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'blog-designer-pack'),
					'params'    => array(										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Number of Post', 'blog-designer-pack' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min'			=> -1,
											'validation'	=> 'number',
											'desc' 			=> __( 'Enter total number of post to be displayed. Enter -1 to display all.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order By', 'blog-designer-pack' ),
											'name' 			=> 'orderby',
											'value' 		=>  array(
																	'date' 			=> __( 'Post Date', 'blog-designer-pack' ),
																	'ID' 			=> __( 'Post ID', 'blog-designer-pack' ),
																	'author' 		=> __( 'Post Author', 'blog-designer-pack' ),
																	'title' 		=> __( 'Post Title', 'blog-designer-pack' ),
																	'modified' 		=> __( 'Post Modified Date', 'blog-designer-pack' ),
																	'rand' 			=> __( 'Random', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select order type.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'blog-designer-pack' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'blog-designer-pack' ),
																	'asc'	=>  __( 'Ascending', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'blog-designer-pack' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id OR slug to display categories wise. To find the category id please refer <a href="https://docs.infornweb.com/assets/images/post-category-id.png" target="_blank">screenshot</a>.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),										
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination', 'blog-designer-pack' ),
											'name' 			=> 'pagination',
											'value' 		=> array( 
																'true'	=> __( 'True', 'blog-designer-pack' ),
																'false'	=> __( 'False', 'blog-designer-pack' ),
															),
											'dependency' 	=> array(
																		'element' 				=> 'limit',
																		'value_not_equal_to' 	=> '-1',
																	),
											'desc' 			=> __( 'Display Pagination.', 'blog-designer-pack' ),
										),										
									)
				),
				// Pro Grid Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'blog-designer-pack'),
					'params'    => array(		
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'blog-designer-pack' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'blog-designer-pack' ),
											'desc' 			=> __( 'Enter read more text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'blog-designer-pack' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'blog-designer-pack' ),
																'new'	=> __( 'New Tab', 'blog-designer-pack' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'blog-designer-pack' ),
											'name' 			=> 'sharing',
											'value' 		=> 'Upgrade to pro',
											'desc' 			=> __( 'Enable social sharing.', 'blog-designer-pack' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'blog-designer-pack' ),
											'name'		=> 'style_id',
											'value' 	=> 'Upgrade to pro',
											'desc'		=> __( 'Choose your created style from style manager.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'blog-designer-pack' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'blog-designer-pack' ) . '<label title="'.__('Note: Extra class will be added at top most parent so using extra class you customize your design.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'blog-designer-pack' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'blog-designer-pack' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'blog-designer-pack' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'blog-designer-pack' ),
																	'featured'	=> __( 'Featured', 'blog-designer-pack' ),
																	'trending'	=> __( 'Trending', 'blog-designer-pack'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'blog-designer-pack' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'blog-designer-pack' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'blog-designer-pack'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'blog-designer-pack' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'blog-designer-pack' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'blog-designer-pack' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'blog-designer-pack' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'blog-designer-pack').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'blog-designer-pack' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination Type', 'blog-designer-pack' ),
											'name' 			=> 'pagination_type',
											'value' 		=> array(
																	'numeric'			=> __( 'Numeric', 'blog-designer-pack' ),
																	'prev-next'			=> __( 'Next - Prev', 'blog-designer-pack' ),
																	'prev-next-ajax'	=> __( 'Next - Prev Ajax', 'blog-designer-pack' ),
																	'load-more'			=> __( 'Load More', 'blog-designer-pack' ),
																	'infinite'			=> __( 'Infinite Scroll', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Choose pagination type.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'blog-designer-pack' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination previous button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'blog-designer-pack' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination next button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'blog-designer-pack' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'blog-designer-pack' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'blog-designer-pack').'"> [?]</label>',
										),  
																			
									)
				)
		);
	return $fields;
}

/**
 * Generate 'bdp_masonry' shortcode fields
 * 
 * @package Blog Designer Pack 
 * @since 1.0
 */
function bdp_masonry_lite_shortcode_fields( $shortcode = '' ) { 
	$fields = array(
			// General Settings
			'general' => array(
					'title'     => __('General Parameters', 'blog-designer-pack'),
					'params'   	=>  array(
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Design', 'blog-designer-pack' ),
											'name' 		=> 'design',
											'value' 	=> bdp_post_masonry_designs(),
											'desc' 		=> __( 'Choose design.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Grid', 'blog-designer-pack' ),
											'name' 			=> 'grid',
											'value' 		=> array(
																	'1'	 => __( 'Grid 1', 'blog-designer-pack' ),
																	'2'	 => __( 'Grid 2', 'blog-designer-pack' ),
																	'3'	 => __( 'Grid 3', 'blog-designer-pack' ),
																	'4'	 => __( 'Grid 4', 'blog-designer-pack' ),
																	'5'	 => __( 'Grid 5', 'blog-designer-pack' ),
																),
											'default'		=> 2,
											'desc' 			=> __( 'Choose number of column to be displayed.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Effect', 'blog-designer-pack' ),
											'name' 			=> 'effect',
											'value' 		=> bdp_post_masonry_effects(),
											'desc' 			=> __( 'Choose display effect.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Post Date', 'blog-designer-pack' ),
											'name' 			=> 'show_date',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post date.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Author', 'blog-designer-pack' ),
											'name' 			=> 'show_author',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post author.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Tags', 'blog-designer-pack' ),
											'name' 			=> 'show_tags',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post tags.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Comments', 'blog-designer-pack' ),
											'name' 			=> 'show_comments',
											'value' 		=> array(
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post comment count.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Category', 'blog-designer-pack' ),
											'name' 			=> 'show_category',
											'value' 		=> array( 
																	'true'		=> __( 'True', 'blog-designer-pack' ),
																	'false'		=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post category.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Content', 'blog-designer-pack' ),
											'name' 			=> 'show_content',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Display post content.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Content Word Limit', 'blog-designer-pack' ),
											'name' 			=> 'content_words_limit',
											'value' 		=> 20,
											'desc' 			=> __( 'Enter content word limit.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Read More', 'blog-designer-pack' ),
											'name' 			=> 'show_read_more',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Show read more.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_content',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Image Size', 'blog-designer-pack' ),
											'name' 			=> 'media_size',
											'value' 		=> 'large',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Choose WordPress registered image size. e.g', 'blog-designer-pack' ).' thumbnail, medium, medium_large, large, full.',
										),											
									)
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'blog-designer-pack'),
					'params'    => array(										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Number of Post', 'blog-designer-pack' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min'			=> -1,
											'validation'	=> 'number',
											'desc' 			=> __( 'Enter total number of post to be displayed. Enter -1 to display all.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order By', 'blog-designer-pack' ),
											'name' 			=> 'orderby',
											'value' 		=>  array(
																	'date' 			=> __( 'Post Date', 'blog-designer-pack' ),
																	'ID' 			=> __( 'Post ID', 'blog-designer-pack' ),
																	'author' 		=> __( 'Post Author', 'blog-designer-pack' ),
																	'title' 		=> __( 'Post Title', 'blog-designer-pack' ),
																	'modified' 		=> __( 'Post Modified Date', 'blog-designer-pack' ),
																	'rand' 			=> __( 'Random', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select order type.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'blog-designer-pack' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'blog-designer-pack' ),
																	'asc'	=>  __( 'Ascending', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'blog-designer-pack' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id OR slug to display categories wise. To find the category id please refer <a href="https://docs.infornweb.com/assets/images/post-category-id.png" target="_blank">screenshot</a>.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),										
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination', 'blog-designer-pack' ),
											'name' 			=> 'pagination',
											'value' 		=> array( 
																'true'	=> __( 'True', 'blog-designer-pack' ),
																'false'	=> __( 'False', 'blog-designer-pack' ),
															),
											'default'		=> 'false',				
											'dependency' 	=> array(
																		'element' 				=> 'limit',
																		'value_not_equal_to' 	=> '-1',
																	),
											'desc' 			=> __( 'Display Pagination.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Load More Text', 'blog-designer-pack' ),
											'name' 			=> 'load_more_text',
											'value' 		=> __( 'Load More Posts', 'blog-designer-pack' ),
											'desc' 			=> __( 'Enter load more text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'pagination',
																	'value' 	=> array( 'false' ),
																),	
										),		
									)
				),
				// Pro Grid Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'blog-designer-pack'),
					'params'    => array(		
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'blog-designer-pack' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'blog-designer-pack' ),
											'desc' 			=> __( 'Enter read more text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'blog-designer-pack' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'blog-designer-pack' ),
																'new'	=> __( 'New Tab', 'blog-designer-pack' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'blog-designer-pack' ),
											'name' 			=> 'sharing',
											'value' 		=> 'Upgrade to pro',
											'desc' 			=> __( 'Enable social sharing.', 'blog-designer-pack' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'blog-designer-pack' ),
											'name'		=> 'style_id',
											'value' 	=> 'Upgrade to pro',
											'desc'		=> __( 'Choose your created style from style manager.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'blog-designer-pack' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'blog-designer-pack' ) . '<label title="'.__('Note: Extra class will be added at top most parent so using extra class you customize your design.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'blog-designer-pack' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'blog-designer-pack' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'blog-designer-pack' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'blog-designer-pack' ),
																	'featured'	=> __( 'Featured', 'blog-designer-pack' ),
																	'trending'	=> __( 'Trending', 'blog-designer-pack'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'blog-designer-pack' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'blog-designer-pack' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'blog-designer-pack'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'blog-designer-pack' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'blog-designer-pack' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'blog-designer-pack' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'blog-designer-pack' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'blog-designer-pack').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'blog-designer-pack' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination Type', 'blog-designer-pack' ),
											'name' 			=> 'pagination_type',
											'value' 		=> array(
																	'numeric'			=> __( 'Numeric', 'blog-designer-pack' ),
																	'prev-next'			=> __( 'Next - Prev', 'blog-designer-pack' ),
																	'prev-next-ajax'	=> __( 'Next - Prev Ajax', 'blog-designer-pack' ),
																	'load-more'			=> __( 'Load More', 'blog-designer-pack' ),
																	'infinite'			=> __( 'Infinite Scroll', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Choose pagination type.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'blog-designer-pack' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination previous button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'blog-designer-pack' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination next button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'blog-designer-pack' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'blog-designer-pack' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'blog-designer-pack').'"> [?]</label>',
										),  
																			
									)
				),
				// Pro Grid Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'blog-designer-pack'),
					'params'    => array(		
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Read More Text', 'blog-designer-pack' ),
											'name' 			=> 'read_more_text',
											'value' 		=> __( 'Read More', 'blog-designer-pack' ),
											'desc' 			=> __( 'Enter read more text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element' 	=> 'show_read_more',
																	'value' 	=> array( 'true' ),
																),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'blog-designer-pack' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'blog-designer-pack' ),
																'new'	=> __( 'New Tab', 'blog-designer-pack' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Social Sharing', 'blog-designer-pack' ),
											'name' 			=> 'sharing',
											'value' 		=> 'Upgrade to pro',
											'desc' 			=> __( 'Enable social sharing.', 'blog-designer-pack' ) . '<label title="'.__('Note: Social sharing must be enabled from plugin settings and must not be disabled from individual post.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Style Manager', 'blog-designer-pack' ),
											'name'		=> 'style_id',
											'value' 	=> 'Upgrade to pro',
											'desc'		=> __( 'Choose your created style from style manager.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 		=> 'text',
											'heading' 	=> __( 'CSS Class', 'blog-designer-pack' ),
											'name' 		=> 'css_class',
											'value' 	=> '',
											'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'blog-designer-pack' ) . '<label title="'.__('Note: Extra class will be added at top most parent so using extra class you customize your design.', 'blog-designer-pack').'"> [?]</label>',
										),
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'blog-designer-pack' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Tag Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'tag_taxonomy',
											'value' 		=> '',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered tag taxonomy name. You can find it on plugin setting page. This is just to display post tags.', 'blog-designer-pack' ) . '<label title="'.__("Note: Be sure you have added valid tag taxonomy name otherwise no result will be displayed. \n\nLeave it empty for default.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'blog-designer-pack' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'blog-designer-pack' ),
																	'featured'	=> __( 'Featured', 'blog-designer-pack' ),
																	'trending'	=> __( 'Trending', 'blog-designer-pack'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'blog-designer-pack' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'blog-designer-pack' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category', 'blog-designer-pack'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'blog-designer-pack' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Post', 'blog-designer-pack' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'blog-designer-pack' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'blog-designer-pack' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'blog-designer-pack').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'blog-designer-pack' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Pagination Type', 'blog-designer-pack' ),
											'name' 			=> 'pagination_type',
											'value' 		=> array(
																	'numeric'			=> __( 'Numeric', 'blog-designer-pack' ),
																	'prev-next'			=> __( 'Next - Prev', 'blog-designer-pack' ),
																	'prev-next-ajax'	=> __( 'Next - Prev Ajax', 'blog-designer-pack' ),
																	'load-more'			=> __( 'Load More', 'blog-designer-pack' ),
																	'infinite'			=> __( 'Infinite Scroll', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Choose pagination type.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination',
																'value_not_equal_to' 	=> array( 'false' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Previous Button Text', 'blog-designer-pack' ),
											'name' 			=> 'prev_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination previous button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Next Button Text', 'blog-designer-pack' ),
											'name' 			=> 'next_text',
											'value' 		=> '',
											'desc' 			=> __( 'Pagination next button text.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																'element' 				=> 'pagination_type',
																'value_not_equal_to' 	=> array( 'load-more', 'infinite' ),
															),
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'blog-designer-pack' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'blog-designer-pack' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'blog-designer-pack').'"> [?]</label>',
										),  
																			
									)
				)
		);
	return $fields;
}


/**
 * Generate 'bdp_ticker' shortcode fields
 * 
 * @package Blog Designer Pack 
 * @since 1.0
 */
function bdp_ticker_lite_shortcode_fields( $shortcode = '' ) {

	$fields = array(
			// General fields
			'general' => array(
					'title'     => __('General Parameters', 'blog-designer-pack'),
					'params'   	=>  array(
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Ticker Title', 'blog-designer-pack' ),
											'name' 			=> 'ticker_title',
											'value' 		=> __('Latest Post', 'blog-designer-pack'),
											'desc' 			=> __( 'Title for the ticker.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'colorpicker',
											'heading' 		=> __( 'Theme Color', 'blog-designer-pack' ),
											'name' 			=> 'theme_color',
											'value' 		=> '#2096cd',
											'desc' 			=> __( 'Set ticker theme color.', 'blog-designer-pack' )
										),
										array(
											'type' 			=> 'colorpicker',
											'heading' 		=> __( 'Ticker Heading Color', 'blog-designer-pack' ),
											'name' 			=> 'heading_font_color',
											'value' 		=> '#fff',
											'desc' 			=> __( 'Set ticker heading font color.', 'blog-designer-pack' )
										),
										array(
											'type' 			=> 'colorpicker',
											'heading' 		=> __( 'Font Color', 'blog-designer-pack' ),
											'name' 			=> 'font_color',
											'value' 		=> '#2096cd',
											'desc' 			=> __( 'Set ticker text font color.', 'blog-designer-pack' ),

										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Font Style', 'blog-designer-pack' ),
											'name' 			=> 'font_style',
											'value' 		=> array(
																	'normal' 		=> __( 'Normal', 'blog-designer-pack' ),
																	'bold' 			=>  __( 'Bold', 'blog-designer-pack' ),
																	'italic' 		=>  __( 'Italic', 'blog-designer-pack' ),
																	'bold-italic' 	=>  __( 'Bold Italic', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Set font style of the post.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Ticker Effect', 'blog-designer-pack' ),
											'name' 			=> 'ticker_effect',
											'value' 		=> array(
																	'slide-v' => __( 'Verticle Ticker Effect','blog-designer-pack' ),	 
																	'slide-h' => __( 'Horizontal Ticker Effect', 'blog-designer-pack' ),
																	'fade' => __( 'Fade Ticker Effect', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Set the ticker effect. e.g. Vertical, Horizontal, Fade.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Autoplay', 'blog-designer-pack' ),
											'name' 			=> 'autoplay',
											'value' 		=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Autoplay ticker.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Speed', 'blog-designer-pack' ),
											'name' 			=> 'speed',
											'value' 		=> 3000,
											'desc' 			=> __( 'Speed of the ticker.', 'blog-designer-pack' ),
											'dependency' 	=> array(
																	'element'	=> 'autoplay',
																	'value'		=> array( 'true' ),
																),
										),										
									),
			),

			// Data Fields
			'query' => array(
					'title'		=> __('Query Parameters', 'blog-designer-pack'),
					'params'	=> array(										
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Total Ticker Items Limit', 'blog-designer-pack' ),
											'name' 			=> 'limit',
											'value' 		=> 20,
											'min' 			=> -1,
											'validation'	=> 'number',
											'desc' 			=> __( 'Enter number to be displayed. Enter -1 to display all.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Order By', 'blog-designer-pack' ),
											'name' 			=> 'orderby',
											'value' 		=>  array(
																	'date' 			=> __( 'Post Date', 'blog-designer-pack' ),
																	'ID' 			=> __( 'Post ID', 'blog-designer-pack' ),
																	'author' 		=> __( 'Post Author', 'blog-designer-pack'),
																	'title' 		=> __( 'Post Title', 'blog-designer-pack' ),
																	'modified' 		=> __( 'Post Modified Date', 'blog-designer-pack' ),
																	'rand' 			=> __( 'Random', 'blog-designer-pack' ),
																	),
											'desc' 			=> __( 'Select order type.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Post Order', 'blog-designer-pack' ),
											'name' 			=> 'order',
											'value' 		=> array(
																	'desc'	=> __( 'Descending', 'blog-designer-pack' ),
																	'asc'	=>  __( 'Ascending', 'blog-designer-pack' ),
																),
											'desc' 			=> __( 'Select sorting order.', 'blog-designer-pack' ),
										),
										
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Category', 'blog-designer-pack' ),
											'name' 			=> 'category',
											'value' 		=> '',
											'desc' 			=> __( 'Enter category id OR slug to display categories wise. To find the category id please refer <a href="https://docs.infornweb.com/assets/images/post-category-id.png" target="_blank">screenshot</a>.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids or slug with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),										
									)
			),
			// Pro Grid Fields
			'premium' => array(
					'title'		=> __('Premium Parameters', 'blog-designer-pack'),
					'params'    => array(		
										
										array(
											'type'		=> 'dropdown',
											'heading' 	=> __( 'Show Arrows', 'blog-designer-pack' ),
											'name' 		=> 'arrows',
											'value' 	=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'		=> __( 'Show prev - next arrows.', 'blog-designer-pack' ),
										),
										array(
											'type' 		=> 'dropdown',
											'heading' 	=> __( 'Post Link Target', 'blog-designer-pack' ),
											'name'		=> 'link_behaviour',
											'value' 	=> array(
																'self'	=> __( 'Same Tab', 'blog-designer-pack' ),
																'new'	=> __( 'New Tab', 'blog-designer-pack' ),
															),
											'desc'		=> __( 'Choose post link behaviour.', 'blog-designer-pack' ),
										),
										array(
												'type' 		=> 'text',
												'heading' 	=> __( 'CSS Class', 'blog-designer-pack' ),
												'name' 		=> 'css_class',
												'value' 	=> '',
												'desc' 		=> __( 'Enter an extra CSS class for design customization.', 'blog-designer-pack' ) . '<label title="'.__('Note: Extra class added as parent so using extra class you customize your design.', 'blog-designer-pack').'"> [?]</label>',
											),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Post type', 'blog-designer-pack' ),
											'name' 			=> 'post_type',
											'value' 		=> 'post',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered post type name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Taxonomy', 'blog-designer-pack' ),
											'name' 			=> 'taxonomy',
											'value' 		=> 'category',
											'refresh_time'	=> 1000,
											'desc' 			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Display Type', 'blog-designer-pack' ),
											'name' 			=> 'type',
											'value' 		=> array(
																	'' 			=> __( 'Select Type', 'blog-designer-pack' ),
																	'featured'	=> __( 'Featured', 'blog-designer-pack' ),
																	'trending'	=> __( 'Trending', 'blog-designer-pack'),
																),
											'desc' 			=> __( 'Select display type of post. Is it Featured or Trending?', 'blog-designer-pack' ) . '<label title="'.__('Note: Be sure you have added valid post type name and post type is enabled from plugin setting.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'dropdown',
											'heading' 		=> __( 'Show Sticky Posts', 'blog-designer-pack' ),
											'name' 			=> 'sticky_posts',
											'value' 		=> array(
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'default'		=> 'false',
											'desc' 			=> __( 'Display sticky posts.', 'blog-designer-pack' ) . '<label title="'.__("Note: Slicky post only be displayed at front side. In preview mode sticky post will not be displayed.", 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Include author', 'blog-designer-pack' ),
											'name' 			=> 'author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to display posts of particular author.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude author', 'blog-designer-pack' ),
											'name' 			=> 'exclude_author',
											'value' 		=> '',
											'desc' 			=> __( 'Enter author id to hide post of particular author. Works only if `Include Author` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant users listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type'			=> 'dropdown',
											'class'			=> '',
											'heading'		=> __( 'Display Child Category','blog-designer-pack'),
											'name'			=> 'include_cat_child',
											'value'			=> array( 
																	'true'	=> __( 'True', 'blog-designer-pack' ),
																	'false'	=> __( 'False', 'blog-designer-pack' ),
																),
											'desc'			=> __( 'If you are using parent category then whether to display child category or not.', 'blog-designer-pack' ),
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Category', 'blog-designer-pack' ),
											'name' 			=> 'exclude_cat',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'blog-designer-pack' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Display Specific Posts', 'blog-designer-pack' ),
											'name' 			=> 'posts',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'text',
											'heading' 		=> __( 'Exclude Post', 'blog-designer-pack' ),
											'name' 			=> 'hide_post',
											'value' 		=> '',
											'desc' 			=> __('Enter id of the post which you do not want to display.', 'blog-designer-pack') . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant post listing page.', 'blog-designer-pack').'"> [?]</label>',
										),
										array(
											'type' 			=> 'number',
											'heading' 		=> __( 'Query Offset', 'blog-designer-pack' ),
											'name' 			=> 'query_offset',
											'value' 		=> '',
											'desc' 			=> __( 'Exclude number of posts from starting.', 'blog-designer-pack' ) . '<label title="'.__('e.g if you pass 5 then it will skip first five post. Note: Do not use limit=-1 and pagination=true with this.', 'blog-designer-pack').'"> [?]</label>',
										),	
																			
									)
				)
	);
	return $fields;	
}
