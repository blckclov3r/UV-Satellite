<?php
/**
* Widget Class : Latest Posts Widget Class
*
* @package Blog Designer Pack
* @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function bdp_post_simple_widget_load_widgets() {
	register_widget( 'Wpspw_Pro_Lpw_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'bdp_post_simple_widget_load_widgets' );

class Wpspw_Pro_Lpw_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'bdp_post_simple_widget', 'description' => __('Display Latest WP Post in a sidebar.', 'blog-designer-pack') );
		parent::__construct( 'bdp-lpw-widget', __('BDP-Latest Post Widget', 'blog-designer-pack'), $widget_ops);
	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @package Blog Designer Pack
	 * @since 1.0.0
	*/
	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title']			= sanitize_text_field($new_instance['title']);
		$instance['num_items']		= $new_instance['num_items'];
		$instance['date']			= !empty($new_instance['date']) ? 1 : 0;
		$instance['show_category']	= !empty($new_instance['show_category']) ? 1 : 0;
		$instance['category']		= intval( $new_instance['category'] );
		$instance['link_target']	= !empty($new_instance['link_target']) ? 1 : 0;
		$instance['query_offset']	= !empty($new_instance['query_offset']) ? $new_instance['query_offset'] : '';
		$instance['show_content']	= !empty($new_instance['show_content']) ? 1 : 0;
		$instance['content_words_limit'] = !empty($new_instance['content_words_limit']) ? $new_instance['content_words_limit'] : 20;

		return $instance;
	}

  /**
   * Outputs the settings form for the widget.
   *
   * @package Blog Designer Pack
   * @since 1.0.0
  */
  function form($instance) {
	  
	$defaults = array(
			'num_items'				=> 5,
			'title'					=> __( 'Latest Posts', 'blog-designer-pack' ),
			'date'					=> 1,
			'show_category'			=> 1,
			'category'				=> 0,
			'link_target'			=> 0,
			'query_offset'			=> '',
			'content_words_limit'	=> 20,
			'show_content'			=> 0,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title', 'blog-designer-pack' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- Number of Items -->
		<p>
			<label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items', 'blog-designer-pack' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="number" value="<?php echo $instance['num_items']; ?>" />
		</p>

		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'blog-designer-pack' ); ?>:</label>
			<?php
			$dropdown_args = array(
									'taxonomy'			=> BDP_CAT,
									'class'				=> 'widefat',
									'show_option_all'	=> __( 'All', 'blog-designer-pack' ),
									'id'				=> $this->get_field_id( 'category' ),
									'name'				=> $this->get_field_name( 'category' ),
									'selected'			=> $instance['category']
								);
			wp_dropdown_categories( $dropdown_args );
			?>
		</p>

		<!-- Query Offset -->
		<p>
			<label for="<?php echo $this->get_field_id('query_offset'); ?>"><?php esc_html_e( 'Query Offset', 'blog-designer-pack' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('query_offset'); ?>" name="<?php echo $this->get_field_name('query_offset'); ?>" type="number" value="<?php echo $instance['query_offset']; ?>" />
			<span class="description"><em><?php _e('Query `offset` parameter to exclude number of post. Leave empty for default.', 'blog-designer-pack'); ?></em></span><br/>
			<span class="description"><em><?php _e('Note: This parameter will not work when Number of Items is set to -1.', 'blog-designer-pack'); ?></em></span>
		</p>

		<!-- Display Date -->
		<p>
			<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked($instance['date'], 1); ?> />
			<label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'blog-designer-pack' ); ?></label>
		</p>

		<!-- Display Category -->
		<p>
			<input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked($instance['show_category'], 1); ?> />
			<label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'blog-designer-pack' ); ?></label>
		</p>
		 <!--  Display Short Content -->
		<p>
			<input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>" <?php checked( $instance['show_content'], 1 ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Display Short Content', 'blog-designer-pack' ); ?></label>
		</p>
		
		<!-- Number of content_words_limit -->
		<p>
			<label for="<?php echo $this->get_field_id('content_words_limit'); ?>"><?php esc_html_e( 'Content words limit', 'blog-designer-pack' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('content_words_limit'); ?>" name="<?php echo $this->get_field_name('content_words_limit'); ?>" type="number" value="<?php echo $instance['content_words_limit']; ?>"  />
			 <span class="description"><em><?php _e('Content words limit will only work if Display Short Content checked', 'blog-designer-pack'); ?></em></span>
	   </p>

		<!-- Link Target -->
		<p>
			<input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
			<label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'blog-designer-pack' ); ?></label>
		</p>
	<?php
  }

  /**
  * Outputs the content for the current widget instance.
  *
  * @package Blog Designer Pack
  * @since 1.0.0
  */
  function widget($args, $instance) {
	
	extract($args, EXTR_SKIP);

		$title				= apply_filters( 'widget_title', isset($instance['title']) ? $instance['title'] : __( 'Latest Posts', 'blog-designer-pack' ), $instance, $this->id_base );
		$num_items			= $instance['num_items'];
		$date				= ( isset($instance['date']) && ($instance['date'] == 1) ) ? "true" : "false";
		$show_category		= ( isset($instance['show_category']) && ($instance['show_category'] == 1) ) ? "true" : "false";
		$category			= $instance['category'];
		$query_offset		= isset($instance['query_offset'])  ? $instance['query_offset'] : '';
		$link_target		= (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
		$words_limit		= $instance['content_words_limit'];
		$show_content		= ( isset($instance['show_content']) && ($instance['show_content'] == 1) ) ? "true" : "false";

		// Taking some globals
		global $post;

		// WP Query Parameter
		$post_args = array(
					'post_type'				=> BDP_POST_TYPE,
					'post_status'			=> array( 'publish' ),
					'posts_per_page'		=> $num_items,
					'order'					=> 'DESC',
					'ignore_sticky_posts'	=> true,
					'offset'				=> $query_offset,
				);

		// Category Parameter
		if( !empty($category) ) {
			$post_args['tax_query'] = array(
										array(
											'taxonomy'	=> BDP_CAT,
											'field'		=> 'term_id',
											'terms'		=> $category
									));
		}

		// WP Query
		$cust_loop = new WP_Query($post_args);

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// If Post is there
		if ($cust_loop->have_posts()) {
	?>

		<div class="bdp-recent-post-items">
			
			<?php while ($cust_loop->have_posts()) : $cust_loop->the_post();

				$cat_links  = array();
				$feat_image = bdp_get_post_featured_image( $post->ID, 'medium' );
				$terms      = get_the_terms( $post->ID, BDP_CAT );
				$post_link  = bdp_get_post_link( $post->ID );
				
				if($terms) {
					foreach ( $terms as $term ) {
						$term_link      = get_term_link( $term );
						$cat_links[]   = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( " ", $cat_links );
			?>
				<div class="bdp-post-li bdp-clearfix">
				 <?php if( !empty($feat_image) ) { ?>
					<div class="bdp-post-image-bg">
						<a  href="<?php echo esc_url( $post_link ); ?>" target="<?php echo $link_target; ?>">                                       
							<img src="<?php echo esc_url( $feat_image ); ?>" alt="<?php the_title_attribute(); ?>" />                                       
						</a>
					</div>
					<?php }
					
					if($show_category == 'true' && $cate_name !='') { ?>
						<div class="bdp-post-categories"><?php echo $cate_name; ?></div>
					<?php } ?>

					<h4 class="bdp-post-title">
						<a href="<?php echo esc_url( $post_link ); ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h4>

					<?php if($date == "true") { ?>
					<div class="bdp-post-meta" <?php if($show_content != "true") { ?>  style="margin:0px;" <?php } ?> >
					   <span class="bdp-post-meta-innr bdp-time"><?php echo get_the_date(); ?></span>
					</div>
					<?php }

					if($show_content == "true") { ?>
					<div class="bdp-post-content">
						<div><?php echo bdp_get_post_excerpt( $post->ID, get_the_content(), $words_limit ); ?></div>
					</div>
					<?php } ?>
				</div>
			<?php endwhile; ?>
		  
		</div>

<?php } // End of have_post()

		wp_reset_postdata(); // Reset WP Query

		echo $after_widget;
	}
}