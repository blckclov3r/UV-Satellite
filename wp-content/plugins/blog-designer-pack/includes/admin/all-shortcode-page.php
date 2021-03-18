<?php
/**
 * Getting Started Page
 *
 * @package Blog Designer Pack
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variables
$upgrade_link = add_query_arg( array('page' => 'bdp-about-pricing'), admin_url('admin.php') );
?>
<style type="text/css">
	.bdp-pro-box .hndle{background-color:#0073AA; color:#fff;}
	.bdp-pro-box.postbox{background:#dbf0fa; border:1px solid #0073aa; color:#191e23;}
	.postbox-container .bdp-list li{list-style:square inside;}
	.postbox-container .bdp-list .bdp-tag{display: inline-block; background-color: #fd6448; padding: 1px 5px; color: #fff; border-radius: 3px; font-weight: 600; font-size: 12px;}
	.bdp-wrap .bdp-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
	.bdp-shortcode-preview{background-color: #e7e7e7; font-weight:bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	.bdpp-feedback{clear:both; text-align:center;}
	.bdpp-feedback h3{font-size:24px; margin-bottom:0px;}
	.bdpp-feedback p{font-size:15px;}
	.bdpp-feedback .bdpp-feedback-btn { font-weight: 600;  color: #fff;text-decoration: none;text-transform: uppercase;padding: 1em 2em; background: #008ec2; border-radius: 0.2em;}
</style>

<div class="wrap bdp-wrap">
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
				<div class="meta-box-sortables">
					
					<div class="postbox">
						<h3 class="hndle">
							<span><?php _e( 'Shortcodes - Blog Designer Pack', 'blog-designer-pack' ); ?></span>
						</h3>

						<div class="inside">
							<table class="form-table">
								<tbody>		
									<tr>
										<th>
											<label><?php _e('All Shortcodes', 'blog-designer-pack'); ?></label>
										</th>
										<td>														
											<span class="bdp-shortcode-preview">[bdp_post]</span> – <?php _e('Post Grid Shortcode', 'blog-designer-pack'); ?> <br />
											<span class="bdp-shortcode-preview">[bdp_post_list]</span> – <?php _e('Post List Shortcode', 'blog-designer-pack'); ?> <br />
											<span class="bdp-shortcode-preview">[bdp_masonry]</span> – <?php _e('Post Masonry Shortcode', 'blog-designer-pack'); ?> <br />
											<span class="bdp-shortcode-preview">[bdp_post_slider]</span> – <?php _e('Post Slider Shortcode', 'blog-designer-pack'); ?> <br />
											<span class="bdp-shortcode-preview">[bdp_post_carousel]</span> – <?php _e('Post Carousel Shortcode', 'blog-designer-pack'); ?> <br />
											<span class="bdp-shortcode-preview">[bdp_post_gridbox]</span> – <?php _e('Post gridbox Shortcode', 'blog-designer-pack'); ?> <br />
											<span class="bdp-shortcode-preview">[bdp_ticker]</span> – <?php _e('Post Ticker Shortcode', 'blog-designer-pack'); ?><br />
											<span class="bdp-shortcode-preview">[bdp_timeline]</span> – <?php _e('Post Timeline Shortcode', 'blog-designer-pack'); ?> - <a href="https://premium.infornweb.com/blog-designer-pack-pro-timeline-designs/" target="_blank"><?php _e('Check Demo', 'blog-designer-pack'); ?></a> <br/>
											<span class="bdp-shortcode-preview">[bdp_post_gridbox_slider]</span> – <?php _e('Post gridbox Slider Shortcode', 'blog-designer-pack'); ?> - <a href="https://premium.infornweb.com/blog-designer-pack-pro-gridbox-slider-designs/" target="_blank"><?php _e('Check Demo', 'blog-designer-pack'); ?></a> <br/>
											<span class="bdp-shortcode-preview">[bdp_post type="featured"]</span> – <?php _e('Featured Post Functionality', 'blog-designer-pack'); ?> - <a href="https://premium.infornweb.com/blog-designer-pack-pro-featured-and-trending-post/" target="_blank"><?php _e('Check Demo', 'blog-designer-pack'); ?></a> <br/>
											<span class="bdp-shortcode-preview">[bdp_post type="trending"]</span> – <?php _e('Trending Post Functionality', 'blog-designer-pack'); ?> - <a href="https://premium.infornweb.com/blog-designer-pack-pro-featured-and-trending-post/" target="_blank"><?php _e('Check Demo', 'blog-designer-pack'); ?></a> <br/>
											<span class="bdp-shortcode-preview">[bdp_post post_type="page"]</span> – <?php _e('Works with any Custom Post type.', 'blog-designer-pack'); ?> <br/>
											<span class="bdp-shortcode-preview">[bdp_post sharing="true"]</span> – <?php _e('Social Sharing Functionality', 'blog-designer-pack'); ?> <br/>
											<span class="bdp-shortcode-preview">[bdp_cat_grid]</span> – <?php _e('Category Grid Shortcode', 'blog-designer-pack'); ?> - <a href="https://premium.infornweb.com/category-grid/" target="_blank"><?php _e('Check Demo', 'blog-designer-pack'); ?></a> <br/>
											<span class="bdp-shortcode-preview">[bdp_cat_slider]</span> – <?php _e('Category Slider Shortcode', 'blog-designer-pack'); ?> - <a href="https://premium.infornweb.com/category-slider/" target="_blank"><?php _e('Check Demo', 'blog-designer-pack'); ?></a> <br/>
											<br/>
											<p>You can find all shortcode parameters on <a href="https://wordpress.org/plugins/blog-designer-pack/" target="_blank">WordPress Page</a></p>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="bdpp-feedback">
							<h3 class="text-center">Want to Check Premium Demo?</h3>
							<p>Checkout the premium demo with 9+ Layouts and 90+ Designs</p>
							<a href="https://premium.infornweb.com/news-blog-designer-pack-pro/" class="bdpp-feedback-btn bdp-button-full" target="_blank">Premium Demo</a>
							</div>
						</div><!-- .inside -->
						
					</div><!-- .postbox -->
				
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->

			<div id="postbox-container-1" class="postbox-container">
				<div class="postbox bdp-pro-box">
					<h3 class="hndle">
						<span><?php _e( 'Blog Designer Pack Pro', 'blog-designer-pack' ); ?></span>
					</h3>

					<div class="inside">
						<ul class="bdp-list">
							<li>90+ Designs</li>
							<li>Elementor Page Builder Supports <span class="bdp-tag">Hot</span></li>
							<li>Slider and Carousel layouts <span class="bdp-tag">Hot</span></li>
							<li>Timeline layout</li>
							<li>Category Grid and Slider layouts <span class="bdp-tag">Hot</span></li>
							<li>Works with any Custom Post Type <span class="bdp-tag">Hot</span></li>
							<li>Custom Tags Support</li>
							<li>Featured & Trending Post Functionality</li>
							<li>Infinite Scroll Pagination <span class="bdp-tag">Hot</span></li>
							<li>Load More Pagination <span class="bdp-tag">Hot</span></li>
							<li>5 types of different paginations</li>
							<li>Social Sharing Options</li>
							<li>Shortcode Builder</li>
							<li>Template Functionality - Override designs from your theme</li>
							<li>And Many More...</li>
						</ul>

						<a href="https://premium.infornweb.com/news-blog-designer-pack-pro/" class="button button-primary bdp-button-full" target="_blank">Check Premium Demo</a>
						<br/>
						<a href="<?php echo $upgrade_link; ?>" class="button button-primary bdp-button-full">Upgrade Now</a>
					</div><!-- end .inside -->
				</div>
			</div><!-- #post-body -->
	</div><!-- #poststuff -->
</div><!-- end .wrap -->