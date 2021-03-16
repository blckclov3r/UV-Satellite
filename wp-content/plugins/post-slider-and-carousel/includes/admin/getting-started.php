<?php
/**
 * Getting Started Page
 *
 * @package Post Slider and Carousel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variables
$upgrade_link = add_query_arg( array('page' => 'psac-about-pricing'), admin_url('admin.php') );
$shortcode_link = add_query_arg( array('page' => 'psac-shrt-generator'), admin_url('admin.php') );
?>
<style type="text/css">
	.psac-clearfix:before, .psac-clearfix:after{content: "";display: table;}
	.psac-clearfix::after{clear: both;}
	.psac-clearfix{clear: both;}
	.psac-pro-box .hndle{background-color:#0073AA; color:#fff;}
	.psac-pro-box.postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
	.postbox-container .psac-list li{list-style:square inside;}
	.postbox-container .psac-list .psac-tag{display: inline-block; background-color: #fd6448; padding: 1px 5px; color: #fff; border-radius: 3px; font-weight: 600; font-size: 12px;}
	.psac-wrap .psac-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
	.psac-shortcode-preview{background-color: #e7e7e7; font-weight:bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	.psac-feedback{clear:both; text-align:center;}
	.psac-feedback h3{font-size:24px; margin-bottom:0px;}
	.psac-feedback p{font-size:15px;}
	.psac-box{width:50%; float: left; padding-left:10px; margin-bottom:20px; padding-right:10px;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;box-sizing: border-box;}
	.psac-box .psac-inside-box{ background:#f1f1f1; padding:15px;} 
	.psac-box-pro .psac-inside-box{background:#fdf0ed; border:1px solid #f7826c;}
	.psac-box .psac-inside-box h4{font-size:15px; margin-top:0px !important;}
	.psac-feedback .psac-feedback-btn { font-weight: 600;  color: #fff;text-decoration: none;text-transform: uppercase;padding: 1em 2em; background: #008ec2; border-radius: 0.2em;}
	.psac-header{background:#c2eeff; border-left:5px solid #50bfeb; padding:5px 10px; clear:both;}
	.psac-pro-header{background:#fde6e2; border-left:5px solid #f7826c;;}
</style>

<div class="wrap psac-wrap">
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">			
				<div class="meta-box-sortables">					
					<div class="postbox">
						<div class="postbox-header">
							<h3 class="hndle">
								<span><?php _e( 'Post Slider and Carousel - Getting Started', 'post-slider-and-carousel' ); ?></span>
							</h3>
						</div>
						<div class="inside">
							<h4 style="margin-bottom:0px;">This plugin is very simple and very easy to use. Simply add below shortcode to your desired page or post. That's it.</h4>
							<h3>Post Slider and Carousel works with shortcode as a result you can use this plugin with : </h3>
							<ul>
								<li><strong> - Gutenberg :</strong> Add shortcode in "Gutenberg shortcode block".</li>
								<li><strong> - Classic Editor :</strong> Add shortcode in "TEXT" tab.</li>
								<li><strong> - Elementor :</strong> Add shortcode in "Elementor Shortcode Widget". (<a href="<?php echo $upgrade_link; ?>">Upgrade to pro for built-in widgets</a>)</li>
								<li><strong> - WPBakery / Visual Composer :</strong> Add shortcode in "Raw HTML" OR "Text Block". (<a href="<?php echo $upgrade_link; ?>">Upgrade to pro for built-in elements</a>)</li>
								<li><strong> - Widget :  </strong> Add vertical post scrolling widget in your website </li>
							</ul>
							
							<h3 class="psac-header">1) Slider Shortcodes and Its Parameter Examples</h3>
						
							<div class="psac-shortcode-box psac-clearfix">
								<div class="psac-box">
									<div class="psac-inside-box">
										<h4>Slider with Post Limit</h4>
										<p>To display 5 posts in the slider use limit="5". To display all posts, use limit="-1"</p>
										<input class='large-text' type='text' value='[psac_post_slider limit="5"]' readonly />
									</div>
								</div>
								<div class="psac-box">
									<div class="psac-inside-box">
										<h4>Slider Category Wise</h4>
										<p>Use the category ID or Slug. You can also add multiple categories with comma separated e.g. 4,6,9 OR tech, beauty, hello etc</p>
										<input class='large-text' type='text' value='[psac_post_slider category="5"]' readonly />
									</div>
								</div>
								<div class="psac-box">
									<div class="psac-inside-box">
										<h4>Slider Designs</h4>
										<p>Manage the slider design. Free version having 2 design. <a href="https://premium.infornweb.com/post-slider-and-carousel-pro-slider-demo/" target="_blank">Also check 10+ Premium designs. </a></p>
										<input class='large-text' type='text' value='[psac_post_slider design="design-1"]' readonly />
									</div>
								</div>
								<div class="psac-box">
									<div class="psac-inside-box"> 
										<h4>Slider Arrows and Dots</h4>
										<p>Manage arrows, dots, speed as well as autoplay and autoplay interval</p>
										<input class='large-text' type='text' value='[psac_post_slider dots="false" arrows="false" autoplay="true" autoplay_interval="3000" speed="800"]' readonly />
									</div>
								</div>
								<div class="psac-box">
									<div class="psac-inside-box"> 
										<h4>Slider Meta Details</h4>
										<p>Manage slider meta data like show author, show category, show date, show content etc</p>
										<input class='large-text' type='text' value='[psac_post_slider show_author="false" show_category="false" show_date="true" show_content="false"]' readonly />
									</div>
								</div>
								
								<div class="psac-box">
									<div class="psac-inside-box"> 
										<h4>Slider Other Parameters</h4>
										<p>Manage other parameters like loop, content_words_limit, sliderheight. <a href="<?php echo esc_url($shortcode_link); ?>">Create Shortcode</a></p>
									</div>
								</div>
							</div>
							
							<h3 class="psac-header">2) Carousel Shortcodes and Its Parameter Examples</h3>
						
							<div class="psac-shortcode-box psac-clearfix">
								<div class="psac-box">
									<div class="psac-inside-box">
										<h4>Carousel with Post Limit</h4>
										<p>To display 5 posts in the carousel use limit="5". To display all posts, use limit="-1"</p>
										<input class='large-text' type='text' value='[psac_post_carousel limit="5"]' readonly />
									</div>
								</div>
								<div class="psac-box">
									<div class="psac-inside-box"> 
										<h4>Carousel Category Wise</h4>
										<p>Use the category ID or Slug. You can also add multiple categories with comma separated e.g. 4,6,9 OR tech, beauty, hello etc</p>
										<input class='large-text' type='text' value='[psac_post_carousel category="5"]' readonly />
									</div>
								</div>
								<div class="psac-box">
									<div class="psac-inside-box">
										<h4>Carousel Designs</h4>
										<p>Manage the carousel design. Free version having 2 design. <a href="https://premium.infornweb.com/post-slider-and-carousel-pro-carousel-demo/" target="_blank">Also check 15+ Premium designs. </a></p>
										<input class='large-text' type='text' value='[psac_post_carousel design="design-1"]' readonly />
									</div>
								</div>
								<div class="psac-box">
									<div class="psac-inside-box"> 
										<h4>Carousel Column, Arrows and Dots</h4>
										<p>Manage Column, arrows, dots, speed as well as autoplay and autoplay interval</p>
										<input class='large-text' type='text' value='[psac_post_carousel slide_show="3" dots="false" arrows="false" autoplay="true" autoplay_interval="3000" speed="800"]' readonly />
									</div>
								</div>
								<div class="psac-box">
									<div class="psac-inside-box"> 
										<h4>Carousel Meta Details</h4>
										<p>Manage carousel meta data like show author, show category, show date, show content etc</p>
										<input class='large-text' type='text' value='[psac_post_carousel show_author="false" show_category="false" show_date="true" show_content="false"]' readonly />
									</div>
								</div>
								
								<div class="psac-box">
									<div class="psac-inside-box"> 
										<h4>Carousel Other Parameters</h4>
										<p>Manage other parameters like loop, content_words_limit, sliderheight.  <a href="<?php echo esc_url($shortcode_link); ?>">Create Shortcode</a></p>
									</div>
								</div>
							</div>
								
							<h3 class="psac-header">3) Post Vertical Slider Widget</h3>	
							<div class="psac-shortcode-box psac-clearfix">
								<div class="psac-box">
									<div class="psac-inside-box">
										<h4>Add Post Vertical Slider Widgets</h4>
										<p>Please go to Appearance --> Widget and use "PSAC - Post Vertical Slider Widget" for Vertical Slider.</p>										
									</div>
								</div>
							</div>
							<h3 class="psac-header psac-pro-header">4) Premium Shortcodes and Parameters</h3>
								<div class="psac-shortcode-box psac-clearfix">
									<div class="psac-box psac-box-pro">
										<div class="psac-inside-box"> 
											<h4>Post Gridbox Slider</h4>
											<p>Display post slider in Gridbox slider view.</p>
											<input class='large-text' type='text' value='[psac_post_gridbox_slider]' disabled />
											<p><a class="button" href="https://premium.infornweb.com/post-slider-and-carousel-pro-gridbox-slider-demo/" target="_blank">View Demo</a>  <a class="button" href="<?php echo $upgrade_link; ?>">Upgrade Now</a></p>
										</div>
									</div>
									<div class="psac-box psac-box-pro">
										<div class="psac-inside-box"> 
											<h4>Post Slider with Thumbnails</h4>
											<p>Display post slider with Thumbnails</p>
											<input class='large-text' type='text' value='[psac_post_slider show_thumbnail="true"]' disabled />
											<p><a class="button" href="https://premium.infornweb.com/post-slider-and-carousel-pro-slider-with-thumbnails-demo/" target="_blank">View Demo</a>  <a class="button" href="<?php echo $upgrade_link; ?>">Upgrade Now</a></p>
										</div>
									</div>
									<div class="psac-box psac-box-pro">
										<div class="psac-inside-box"> 
											<h4>Slider/Carousel Partial Slide</h4>
											<p>Display partial slide of slider/carousel from left and right side.  </p>
										 	<input class='large-text' type='text' value='[psac_post_carousel stage_padding="50"]' disabled />
											<p><a class="button" href="https://premium.infornweb.com/post-slider-and-carousel-pro-partial-slide-demo/" target="_blank">View Demo</a>  <a class="button" href="<?php echo $upgrade_link; ?>">Upgrade Now</a></p>
										</div>
									</div>
									<div class="psac-box psac-box-pro">
										<div class="psac-inside-box"> 
											<h4>Featured and Trending Post</h4>
											<p>Display featured and trending post with the help of slider, carousel and gridbox slider </p>
											<input class='large-text' type='text' value='[psac_post_slider type="featured"]' disabled />
											<p><a class="button" href="https://premium.infornweb.com/post-slider-and-carousel-pro-featured-and-trending-post/" target="_blank">View Demo</a>  <a class="button" href="<?php echo $upgrade_link; ?>">Upgrade Now</a></p>
										</div>
									</div>
								</div>
						</div><!-- .inside -->
					</div><!-- .postbox -->

				</div><!-- .meta-box-sortables -->
			
				<div class="meta-box-sortables">
					
					<div class="postbox">
						<div class="postbox-header">
							<h3 class="hndle">
								<span><?php _e( 'Premium Demo - Post Slider and Carousel', 'post-slider-and-carousel' ); ?></span>
							</h3>
						</div>
						<div class="inside">
							<div class="psac-feedback">
								<h3 class="text-center"><?php _e('Want to Check Premium Demo and Features?', 'post-slider-and-carousel'); ?></h3>
								<p><?php _e('Checkout the premium demo with 5+ Layouts and 30+ Designs', 'post-slider-and-carousel'); ?></p>
								<a href="https://premium.infornweb.com/post-slider-and-carousel-pro/" class="psac-feedback-btn psac-button-full" target="_blank"><?php _e('Premium Demo', 'post-slider-and-carousel'); ?></a>
							</div>
						</div><!-- .inside -->
					</div><!-- .postbox -->

				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->

			<div id="postbox-container-1" class="postbox-container">
				<div class="postbox psac-pro-box">
					<h3 class="hndle">
						<span><?php _e( 'Post Slider and Carousel Pro', 'blog-designer-pack' ); ?></span>
					</h3>

					<div class="inside">
						<ul class="psac-list">
							<li>30+ Designs</li>							
							<li>Slider and Carousel layouts <span class="psac-tag">Hot</span></li>
							<li>Gridbox Slider layout</li>
							<li>Slider with Thumbnails <span class="psac-tag">Hot</span></li>
							<li>Partially Visible Slides <span class="psac-tag">Hot</span></li>
							<li>Elementor Page Builder Supports <span class="psac-tag">Hot</span></li>
							<li>Shortcode Builder with more parameters</li>
							<li>Visual Composer Page Builder Supports</li>
							<li>Style Manager -  Manage font size and color <span class="psac-tag">Hot</span></li>
							<li>Works with any Custom Post Type <span class="psac-tag">Hot</span></li>
							<li>Custom Tags Support</li>
							<li>Featured & Trending Post Functionality</li>
							<li>Social Sharing Options</li>
							<li>Image Lazy load Option <span class="psac-tag">Hot</span></li>
							<li>2 Types of different widgets.</li>							
							<li>Template Functionality - Override designs from your theme</li>
							<li>And Many More...</li>
						</ul>

						<a href="https://premium.infornweb.com/post-slider-and-carousel-pro/" class="button button-primary psac-button-full" target="_blank">Check Premium Demo</a>
						<br/>
						<a href="<?php echo $upgrade_link; ?>" class="button button-primary psac-button-full">Upgrade Now</a>
					</div><!-- end .inside -->
				</div>
			</div><!-- #postbox-container-1 -->
		</div><!-- #post-body -->
	</div><!-- #poststuff -->
</div><!-- end .wrap -->