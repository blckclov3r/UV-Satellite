<?php
/**
* Widget Class : Vertical Post Scrolling Widget
*
* @package Post Slider and Carousel
* @since 2.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function psac_post_scroll_widget() {
	register_widget( 'Psac_post_scrolling_Widget' );
}

// Action to register widget
add_action( 'widgets_init', 'psac_post_scroll_widget' );

class Psac_post_scrolling_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'psac-post-scrolling-widget', 'description' => __('Display posts in a sidebar with vertical slider.', 'post-slider-and-carousel') );
		parent::__construct( 'psac-post-scrolling-widget', __('PSAC - Post Vertical Slider Widget', 'post-slider-and-carousel'), $widget_ops);
	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @package Blog Designer Pack
	 * @since 1.0.0
	*/
	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title']					= sanitize_text_field($new_instance['title']);
		$instance['num_items']				= $new_instance['num_items'];
		$instance['date']					= ! empty( $new_instance['date'] ) ? 1 : 0;
		$instance['show_category']			= ! empty( $new_instance['show_category'] ) ? 1 : 0;
		$instance['show_thumb']				= ! empty( $new_instance['show_thumb'] ) ? 1 : 0;
		$instance['category']				= $new_instance['category'];
		$instance['height']					= $new_instance['height'];
		$instance['pause']					= $new_instance['pause'];
		$instance['speed']					= $new_instance['speed'];
		$instance['link_target']			= ! empty( $new_instance['link_target'] ) ? 1 : 0;
		$instance['query_offset']			= ! empty( $new_instance['query_offset'] ) ? $new_instance['query_offset'] : '';
		$instance['show_content']			= ! empty( $new_instance['show_content'] ) ? 1 : 0;
		$instance['content_words_limit']	= ! empty( $new_instance['content_words_limit'] ) ? $new_instance['content_words_limit'] : 20;

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
			'title'					=> esc_html__( 'Latest Posts', 'post-slider-and-carousel' ),
			'date'					=> 1, 
			'show_category'			=> 1,
			'show_thumb'			=> 1,
			'category'				=> 0,
			'height'				=> 400,      
			'pause'					=> 4000,                
			'speed'					=> 600,
			'link_target'			=> 0,
			'query_offset'			=> '',
			'content_words_limit'	=> 20,
			'show_content'			=> 0,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title', 'post-slider-and-carousel' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<!-- Display Category -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'post-slider-and-carousel' ); ?>:</label>
			<?php
				$dropdown_args = array(
										'taxonomy'          => PSAC_CAT,
										'class'             => 'widefat',
										'show_option_all'   => __( 'All', 'post-slider-and-carousel' ),
										'id'                => $this->get_field_id( 'category' ),
										'name'              => $this->get_field_name( 'category' ),
										'selected'          => $instance['category'],
									);
				wp_dropdown_categories( $dropdown_args );
			?>
		</p>

		<!-- Number of Items -->
		<p>
			<label for="<?php echo $this->get_field_id('num_items'); ?>"><?php esc_html_e( 'Number of Items', 'post-slider-and-carousel' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo $instance['num_items']; ?>" />
		</p>

		<!-- Query Offset -->
		<p>
			<label for="<?php echo $this->get_field_id('query_offset'); ?>"><?php esc_html_e( 'Query Offset', 'post-slider-and-carousel' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('query_offset'); ?>" name="<?php echo $this->get_field_name('query_offset'); ?>" type="text" value="<?php echo $instance['query_offset']; ?>"  />
			<em><?php _e('Query `offset` parameter to exclude number of post. Leave empty for default.', 'post-slider-and-carousel'); ?></em><br/>
			<em><?php _e('Note: This parameter will not work when Number of Items is set to -1.', 'post-slider-and-carousel'); ?></em>
		</p>

		<!-- Display Date -->
		<p>
			<input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox" value="1" <?php checked( $instance['date'], 1 ); ?> />
			<label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'post-slider-and-carousel' ); ?></label>
		</p>

		<!-- Display Category -->
		<p>
			<input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_category'], 1 ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'post-slider-and-carousel' ); ?></label>
		</p>

		<!-- Show Thumb -->
		<p>
			<input id="<?php echo $this->get_field_id( 'show_thumb' ); ?>" name="<?php echo $this->get_field_name( 'show_thumb' ); ?>" type="checkbox" value="1" <?php checked( $instance['show_thumb'], 1 ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_thumb' ); ?>"><?php _e( 'Display Thumbnail', 'post-slider-and-carousel' ); ?></label>
		</p>

		<!-- Open Link in a New Tab -->
		<p>
			<input id="<?php echo $this->get_field_id( 'link_target' ); ?>" name="<?php echo $this->get_field_name( 'link_target' ); ?>" type="checkbox"<?php checked( $instance['link_target'], 1 ); ?> />
			<label for="<?php echo $this->get_field_id( 'link_target' ); ?>"><?php _e( 'Open Link in a New Tab', 'post-slider-and-carousel' ); ?></label>
		</p>

		<!--  Display Short Content -->
		<p>
			<input type="checkbox" value="1" id="<?php echo $this->get_field_id( 'show_content' ); ?>" name="<?php echo $this->get_field_name( 'show_content' ); ?>" <?php checked( $instance['show_content'], 1 ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Display Short Content', 'post-slider-and-carousel' ); ?></label>
		</p>
		
		<!-- Number of content_words_limit -->
		<p>
			<label for="<?php echo $this->get_field_id('content_words_limit'); ?>"><?php esc_html_e( 'Content words limit', 'post-slider-and-carousel' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('content_words_limit'); ?>" name="<?php echo $this->get_field_name('content_words_limit'); ?>" type="text" value="<?php echo $instance['content_words_limit']; ?>"  />
			<em><?php _e('Content words limit will only work if Display Short Content checked', 'post-slider-and-carousel'); ?></em>
	   </p>

		<!-- Height -->
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height', 'post-slider-and-carousel' ); ?>:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'height' ); ?>"  value="<?php echo $instance['height']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" />
		</p>

		<!-- Pause -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pause' ); ?>"><?php _e( 'Pause', 'post-slider-and-carousel' ); ?>:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'pause' ); ?>"  value="<?php echo $instance['pause']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" />
		</p>

		<!-- Speed -->
		<p>
			<label for="<?php echo $this->get_field_id( 'speed' ); ?>"><?php _e( 'Speed', 'post-slider-and-carousel' ); ?>:</label>
			<input type="text" name="<?php echo $this->get_field_name( 'speed' ); ?>"  value="<?php echo $instance['speed']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'speed' ); ?>" />
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

		$title          = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'Latest Posts', 'post-slider-and-carousel' ), $instance, $this->id_base );
		$num_items      = $instance['num_items'];
		$query_offset   = isset($instance['query_offset'])  ? $instance['query_offset'] : '';
		$date			= $instance['date'];
		$show_thumb		= $instance['show_thumb'];
		$show_category	= $instance['show_category'];
		$category       = $instance['category'];
		$height         = $instance['height'];
		$pause          = $instance['pause'];
		$speed          = $instance['speed'];
		$link_target    = (isset($instance['link_target']) && $instance['link_target'] == 1) ? '_blank' : '_self';
		$words_limit	= $instance['content_words_limit'];
		$show_content	= ( isset($instance['show_content']) && ($instance['show_content'] == 1) ) ? "true" : "false";
		$unique			= psac_get_unique();

		// Slider configuration
		$slider_conf = compact( 'speed', 'height', 'pause' );

		// Enqueue required script        
		wp_enqueue_script( 'jquery-vticker' );
		wp_enqueue_script( 'psac-public-script' );
		psac_enqueue_script();

		// Taking some global
		global $post;

		// WP Query Parameter
		$post_args = array(
					'post_type'             => PSAC_POST_TYPE,
					'post_status'           => array( 'publish' ),
					'posts_per_page'        => $num_items,
					'order'                 => 'DESC',
					'ignore_sticky_posts'   => true,
					'offset'                => $query_offset,
				);

		// Category Parameter
		if( ! empty($category) ) {
			$post_args['tax_query'] = array(
										array(
											'taxonomy'  => PSAC_CAT,
											'field'     => 'term_id',
											'terms'     => $category
									));
		}

		// WP Query
		$cust_loop = new WP_Query($post_args);

		// Start Widget Output
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		// If Post is there
		if ($cust_loop->have_posts()) {
	?>
	<div class="psac-widget-wrp psac-recent-post-items">
		<div class="psac-vticker-scrolling-wdgt" id="psac-post-ticker-<?php echo $unique; ?>" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>">
			<ul>
				<?php while ($cust_loop->have_posts()) : $cust_loop->the_post();

					$cat_links		= array();
					$feat_image		= psac_get_post_featured_image( $post->ID, array(100,100) );
					$post_link		= psac_get_post_link( $post->ID );
					$terms			= get_the_terms( $post->ID, PSAC_CAT );

					if( ! is_wp_error( $terms ) && $terms ) {
					  foreach ( $terms as $term ) {
							$term_link		= get_term_link( $term );
							$cat_links[]	= '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
					}
					$cate_name = join( " ", $cat_links );
				?>
					<li class="psac-post-li">
						<div class="psac-post-list-content psac-clearfix">
							<?php if( $show_thumb && !empty($feat_image)) { ?>
							<div class="psac-post-left-img">
								<a  href="<?php echo esc_url( $post_link ); ?>" target="<?php echo $link_target; ?>">
									<?php if( ! empty( $feat_image ) ) { ?>
									<img src="<?php echo esc_url( $feat_image ); ?>" alt="<?php the_title_attribute(); ?>" />
									<?php } ?>
								</a>
							</div>
							<?php } ?>

							<div class="<?php if( $show_thumb && ! empty( $feat_image ) ) { echo 'psac-post-right-content'; } else { echo 'psac-post-full-content'; } ?>">
								<?php if( $show_category && $cate_name !='' ) { ?>
								<div class="psac-post-categories">	
									<?php echo $cate_name; ?>
								</div>
								<?php } ?>
								
								<h4 class="psac-post-title">
									<a href="<?php echo esc_url( $post_link ); ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
								</h4>

								<?php if( $date ) { ?>
								<div class="psac-post-date" <?php if($show_content != "true") { ?>  style="margin:0px;" <?php } ?>>
								   <span class="psac-time"> <?php echo get_the_date(); ?></span>
								</div>
								<?php }

								if($show_content == "true") { ?>
									<div class="psac-post-content">    
										<div><?php echo psac_get_post_excerpt( $post->ID, get_the_content(), $words_limit ); ?></div>
									</div>
								<?php } ?>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>

	<?php } // End of have_post()

		wp_reset_postdata(); // Reset WP Query

		echo $after_widget;
	}
}