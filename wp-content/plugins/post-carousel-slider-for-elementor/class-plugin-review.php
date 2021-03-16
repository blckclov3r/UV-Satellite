<?php
 /**
  * Plugin Review Class
  */
 
 class PDPCS_Review
 {
 	public $plugin_name='';
 	public $transient_name='';
 	public $review_url='';
 	public $installed_time='';
 	function __construct( $plugin_name, $transient_name, $installed_time, $review_url )
 	{
 		$this->plugin_name = $plugin_name;
 		$this->transient_name = $transient_name;
 		$this->installed_time = get_option($installed_time);
 		$this->review_url = $review_url;
 		
 		add_action( 'admin_notices',  array($this, 'leave_a_review') );
 		add_action( 'admin_footer',  array($this, 'review_script') );
		add_action( 'wp_ajax_wb_ps_review_transient', array($this, 'set_review_transient') );
 	}

 	/**
	 * Admin notice
	 *
	 * Request for leave a review
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function leave_a_review() {
		$review_transient = get_transient($this->transient_name);
		// delete_transient($this->transient_name);
		$current_time = current_time('timestamp');
		$first_active_time = $this->installed_time;
		$next_review_time = strtotime('+10 days', $first_active_time);
		// echo $next_review_time;die();

		if( ($review_transient  != 'reviewed') && ( isset($next_review_time) && ($next_review_time > 0) && ($current_time > $next_review_time) ) ){
	?>
			<div class="notice notice-error">
				<p class="wb-ps-font-16">Hello! Seems like you've been using <strong><?php esc_html_e($this->plugin_name); ?></strong> for a long time.</p>
				<p class="wb-ps-font-16">Could you please do us a BIG favor and give it a <a target="_blank" href="<?php echo esc_url( $this->review_url ); ?>">5-star rating</a> on WordPress? This would boost our motivation and help other users make a comfortable decision while choosing the <strong><?php esc_html_e($this->plugin_name); ?></strong> Plugin</p>
				<p>
					<a class="wb-ps-color-red wb-ps-extra-bold wb-ps-font-16 text-decoration-none button button-primary" target="_blank" href="<?php echo esc_url( $this->review_url ); ?>">Sure! I'd like to Review</a>
					<!-- <span  class="wb-ps-color-blue wb-ps-font-16 wb-ps-mx-10">|</span> -->
					<a style="margin-left: 5px;"  class="wb-ps-already-reviewed wb-ps-bold text-decoration-none" href="#">Already Reviewed</a>
				</p>

			</div>
	<?php
		}
	}

	/**
	 * Set Review Transient
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function set_review_transient(){
		if ( is_admin() ) {
			$set_review_transient = get_transient( $this->transient_name );
			if( $set_review_transient  != 'reviewed' ){
				if( set_transient( $this->transient_name , 'reviewed', 1*YEAR_IN_SECONDS ) ){
					echo 'already_reviewed';
				}
			}
			wp_die();
		}
	}

	/**
	 * Review Script
	 *
	 * @since 1.0.1
	 *
	 * @access public
	 */
	public function review_script(){
		?>
			<script>
				jQuery(document).ready(function(){
					jQuery('.wb-ps-already-reviewed').on('click', function(e){
						e.preventDefault();
						var _this = this;
						jQuery.ajax({
							type: 'post',
							url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
							data: {
								action: 'wb_ps_review_transient',
							},
							success: function( result ){
								jQuery(_this).parents('.notice').slideUp();
							}
						});
					});
				});
			</script>
		<?php
	}

 }

$review = new PDPCS_Review(
				'Post Carousel Slider for Elementor',
				'post_carousel_slider_elementor_review',
				'pdpcs_installed_time',
				'https://wordpress.org/support/plugin/post-carousel-slider-for-elementor/reviews/?filter=5#new-post'
			);