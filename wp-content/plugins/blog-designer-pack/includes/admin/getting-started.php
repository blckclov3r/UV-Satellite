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
$show_on_front		= get_option( 'show_on_front' );
$page_for_posts_id	= get_option( 'page_for_posts' );
$page_on_front_id	= get_option( 'page_on_front' );
$reading_page_url	= admin_url( 'options-reading.php' );
$new_page_url		= add_query_arg( array('post_type' => 'page', 'post_title' => 'Blog Page', 'content' => '[bdp_post limit="5"]'), admin_url('post-new.php') );
$about_page_url		= add_query_arg( array('page' => 'bdp-about'), admin_url('admin.php') );
$shortcode_page_url	= add_query_arg( array('page' => 'bdp-shrt-generator'), admin_url('admin.php') );
$upgrade_link		= add_query_arg( array('page' => 'bdp-about-pricing'), admin_url('admin.php') );
?>
<style type="text/css">
	.bdp-wrap *{-webkit-box-sizing: border-box; -moz-box-sizing:border-box; box-sizing: border-box; }
	.bdp-pro-box .hndle{background-color:#0073AA; color:#fff;}
	.bdp-pro-box.postbox{background:#dbf0fa; border:1px solid #0073aa; color:#191e23;}
	.postbox-container .bdp-list li{list-style:square inside;}
	.postbox-container .bdp-list .bdp-tag{display: inline-block; background-color: #fd6448; padding: 1px 5px; color: #fff; border-radius: 3px; font-weight: 600; font-size: 12px;}
	.bdp-wrap .bdp-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
	.bdp-box{border-bottom:2px solid #f1f1f1; }
	.bdp-box .bdp-box-content p{ font-size:15px;}
	#dashboard-widgets .inside .bdp-box h3{color: #23282d;font-size: 1.3em;margin: 1em 0;}
	.bdp-box > h3 span { font-size: 13px;  font-weight: 400;}
	.bdp-box .bdp-box-content span{background:#f1f1f1; font-weight:bold; padding:3px;}
	.bdp-box .bdp-box-content ul { margin: 0 0 5% 0;  background: #F8F8F8; padding: 20px 20px 20px 30px; list-style-type: square; font-size: 15px;  line-height: 1.8;}
	.bdp-notice{background-color: #43AC6A; border-color: #3a945b; color:#fff; font-size:15px; padding:10px; border-radius:5px;}
	.bdp-notice a{color:#fff; text-decoration:underline; font-weight:bold;}
	.bdp-notice span{ font-weight:bold;}
	.bdp-layout-box{width:33%; float:left; padding:10px; text-align:center; font-weight:bold; }
	.bdp-layout-box-inner{border:1px solid #f1f1f1; position:relative;}
	.bdp-layout-box-inner label{padding:5px 2px; display:inline-block;}
	.bdp-layout-box-inner img{filter: grayscale(100%);}
	.bdp-layout-box-inner a{display: flex;}
	.bdp-layout-box-inner:hover a:after{content:"Create Shortcode";  display: flex;  align-items: center;  justify-content: center;color:#000; text-decoration:underline;  position:absolute; top:0; bottom:0; left:0; width:100%; background:rgba(249,168,65,0.9); }
	.bdp-layout-box-inner:hover a.bdp-upgrade-pro:after{content:"Upgrade To Pro"}
	.bdp-clearfix:before, .bdp-clearfix:after{content: "";display: table;}
	.bdp-clearfix:after{clear: both;}
	.bdp-free-tag { padding: 4px 7px 4px 5px;color:#fff;  background-color: #43AC6A;  position: absolute; right:0; z-index:2; font-size: 10px;  display: inline-block;  line-height: 1.1;}
	.bdp-free-tag:before { content: ""; left: -10px; top: 0;  border-top: 10px solid transparent;  border-right: 10px solid #43AC6A;  border-bottom: 10px solid transparent;  position: absolute;}
	.bdp-pro-tag { padding: 4px 7px 4px 5px;color:#fff;  background-color: #ed1e1e;  position: absolute; right:0; z-index:2; font-size: 10px;  display: inline-block;  line-height: 1.1;}
	.bdp-pro-tag:before { content: ""; left: -10px; top: 0;  border-top: 10px solid transparent;  border-right: 10px solid #ed1e1e;  border-bottom: 10px solid transparent;  position: absolute;}
	.bdp-feedback{clear:both; text-align:center; background:#f1f1f1; padding:15px; margin-top:20px;}
	#dashboard-widgets .bdp-feedback h3{font-size:24px; margin-bottom:0px;}
	#dashboard-widgets .bdp-feedback p{font-size:15px;}
	#dashboard-widgets .bdp-feedback .bdpp-feedback-btn { font-weight: 600;  color: #fff;text-decoration: none;text-transform: uppercase;padding: 1em 2em; background: #008ec2; border-radius: 0.2em;}
	.bdp-pro-features { padding:15px; margin-top:10px; display:flex;flex-wrap: wrap;}
	.bdp-pro-features ul{display:flex;flex-wrap: wrap;}
	.bdp-pro-features li{width:48%; display:inline-block; background:#f1f1f1; margin-right:1%; padding:10px 10px 10px 30px; position:relative;}	
	.bdp-pro-features li:before{font-size:25px;position:absolute; content: "\f147"; left:0px; top:3px; font-family:'dashicons'; color:#43AC6A;}
	#dashboard-widgets .bdp-pro-features h3{font-size:20px; margin-bottom:0px;}
	.bdp-getting-started .dashicons, .bdp-pro-features .dashicons{font-size:25px; color:#43AC6A; margin-right:10px;}
	.bdp-pro-features .dashicons{position:relative; top:3px;}
</style>

<div class="wrap bdp-wrap">
	<h2>Blog Designer Pack Dashboard</h2>

	<div id="welcome-panel" class="welcome-panel">
		<div class="welcome-panel-content">
			<h2>Success, The Blog Designer Pack is now activated! 😊</h2>
			<p class="about-description">Would you like to create one test blog page to check usage of Blog Designer Pack plugin?</p>
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<h3>Get Started</h3>
						<a class="button button-primary button-hero" href="<?php echo esc_url( $new_page_url ); ?>">Yes, Create A New Blog Page</a>
						<p> or, <a href="https://docs.infornweb.com/blog-designer-pack/#setup-blog-page" target="_blank" >No, I will configure my self (Give me steps) </a></p>
				</div>
				<div class="welcome-panel-column">
					<h3>Next Steps</h3>
					<ul>
						<li><a href="<?php echo esc_url( $shortcode_page_url ); ?>" class="welcome-icon welcome-edit-page">Create Shortcode</a></li>
						<li><a href="#Usages-of-bdp" class="welcome-icon welcome-widgets">Usages</a></li>	
						<li><a href="https://premium.infornweb.com/news-blog-designer-pack-pro/" target="_blank" class="welcome-icon welcome-view-site">Premium Demo</a></li>
					</ul>
				</div>
				<div class="welcome-panel-column welcome-panel-last">
					<h3>Documentation & Support</h3>
					<ul>
						<li><a href="https://docs.infornweb.com/blog-designer-pack/" target="_blank" class="welcome-icon welcome-learn-more">Documentation</a></li>
						<li><a href="https://wordpress.org/support/plugin/blog-designer-pack/" target="_blank" class="welcome-icon welcome-menus">Support Forum</a></li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="dashboard-widgets-wrap">
		<div id="dashboard-widgets" class="metabox-holder columns-2">
			<div class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'Looking to customize your existing blog page?', 'blog-designer-pack' ); ?></span>
							</h2>
						</div>	
						<div class="inside">							
							<div class="bdp-getting-started bdp-box"> 
								<h3>Getting Started <span>(Must Read)</span></h3>
								<div class="bdp-box-content">
									<p>Once you've activated your plugin, you’ll be redirected to this page (Blog Designer Pack Dashboard). Here, you can view the required and helpful steps to use plugin.</p>
									<p>We recommend that please read the below sections for more details.</p>
								</div>
							</div>
							
							<div class="bdp-important-things bdp-box">
								
								<h3>Important things <span>(Required)</span></h3>

								<?php if($show_on_front == "posts") { ?>
									<div class="bdp-post-page">	
										<div class="bdp-notice">
											Your current homepage is set to <span>"Your latest posts"</span>. If you want to customize and change the design of your current blog page with plugin layout and design then kindly go to <a href="<?php echo esc_url( $reading_page_url ); ?>" target="_blank">Settings > Reading</a> and change that selection to <span>"A static page"</span> and then select <span>"Homepage"</span> to any page (that you want to display as a homepage) from the drop down.
										</div>
										<div class="bdp-box-content">
											<p>We recommend you to refresh this page once you done with above changes.</p>
										</div>
									</div>
								<?php } else if( ! empty( $page_for_posts_id ) ) { ?>
									<div class="bdp-static-page">

										<div class="bdp-notice">
											Your current blog page is set to <span> <?php echo get_the_title( $page_for_posts_id ); ?> </span>. If you want to customize and change the design of your current blog page with plugin layout and design then kindly go to <a href="<?php echo esc_url( $reading_page_url ); ?>" target="_blank">Settings > Reading</a> and change that selection to default one (<strong> " — Select — " </strong>) from the dropdown.
										</div>

										<div class="bdp-box-content">
											<p> Blog page content is handled by WordPress it self.<br />
												To enable Blog Designer Pack plugin design on Blog page, you need to make sure that Blog page should not be selected on <span>Posts page</span> of <span>Reading settings</span>. ( <a href="<?php echo esc_url( $reading_page_url ); ?>" target="_blank">Settings > Reading</a>)
											</p>
											<p>First, We recommed you to refresh this page once you done with above changes.</p>
											<p>We recommed you to read the below sections in case if you need more details.</p>
											<ul>
												<li>
													<h4>Blog page is already created</h4>
														If "Blog" page is already created and assigned that page as a <span>Posts page</span> under <a href="<?php echo esc_url( $reading_page_url ); ?>" target="_blank">WordPress Settings > Reading</a> then please change that selection to default one (<strong> " — Select — " </strong>) from the dropdown.
														Once you de-select this setting, open your "Blog" page in edit mode and add the plugin shortcode (Shortcodes that created under "Blog Designer Pack > Shortcode Builder")
												</li>
												<li>
													<h4>Blog page is not created</h4>
														If Blog page is not created then go to Pages > Add New and create a blog page OR some other name as per your need and add the shortcode.
												</li>
											</ul>
											<p>If still you have any question, please feel free to contact us on <a href="https://wordpress.org/support/plugin/blog-designer-pack/" target="_blank">Support Forum. </a> </p>
										</div>
									</div>
								<?php } else { ?>
									<div class="bdp-static-page">
										<div class="bdp-box-content">
											<p>Well done 😊 !!</p>
											<p>Edit your Blog page OR Home page (a static page created by you OR Chosen by you) and add the desired <a href="<?php echo esc_url( $shortcode_page_url ); ?>" class="welcome-icon welcome-edit-page">Shortcode</a> in it.</p>
											<p>If still you have any question, please feel free to contact us on <a href="https://wordpress.org/support/plugin/blog-designer-pack/" target="_blank">Support Forum. </a> </p>
										</div>	
									</div>
								<?php } ?>
							</div>
						</div><!-- .inside -->
					</div><!-- .postbox -->
				</div><!-- .meta-box-sortables -->
					
				<div id="Usages-of-bdp" class="meta-box-sortables">
					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'Usage of Blog Designer Pack', 'blog-designer-pack' ); ?></span>
							</h2>
						</div>	
						<div class="inside">
							<div class="bdp-getting-started bdp-box">
								<h3><span class="dashicons dashicons-yes-alt"></span> Create a Blog OR News Website</h3>
								<div class="bdp-box-content">
									<p>This is very helpful plugin to create a Blog website or News/Magazine website. Just use the layouts with the help of shortcode and design your page.</p>
									<p>Check sample <a href="https://premium.infornweb.com/blog-3/" target="_blank">Blog-1</a>, <a href="https://premium.infornweb.com/blog-4/" target="_blank">Blog-2</a>  and <a href="https://premium.infornweb.com/news-magazine/" target="_blank">News/Magazine</a> page here created with Blog Designer Pack.</p>
								</div>
							</div>	
							<div class="bdp-getting-started bdp-box">
								<h3><span class="dashicons dashicons-yes-alt"></span> Display latest post on home page from blog </h3>
								<div class="bdp-box-content">
									<p>You can display latest post from your blog on home page. You can use 9+ layout for this e.g. grid view OR slider view OR Carousel View etc</p>
									<p>Check sample <a href="https://premium.infornweb.com/blog-designer-pack-pro-slider-designs/" target="_blank">Slider</a>, <a href="https://premium.infornweb.com/blog-designer-pack-pro-carousel-designs/" target="_blank">Carousel</a>  and <a href="https://premium.infornweb.com/blog-designer-pack-pro-carousel-with-partial-slide-designs/" target="_blank">Partial Slide</a> created with Blog Designer Pack.</p>
								</div>
							</div>
							<div class="bdp-getting-started bdp-box">
								<h3><span class="dashicons dashicons-yes-alt"></span> Display Featured and Trending Post</h3>
								<div class="bdp-box-content">
									<p>Highlights your Featured and most Popular/Trending post. You can use 9+ layout for this e.g. grid view OR slider view OR Carousel View etc</p>
									<p>Check sample <a href="https://premium.infornweb.com/blog-designer-pack-pro-featured-and-trending-post/" target="_blank">Demo</a> created with Blog Designer Pack.</p>
								</div>
							</div>
							<div class="bdp-getting-started bdp-box">
								<h3><span class="dashicons dashicons-yes-alt"></span> Display Post Timeline</h3>
								<div class="bdp-box-content">
									<p>Display posts in timeline view.</p>
									<p>Check sample <a href="https://premium.infornweb.com/blog-designer-pack-pro-timeline-designs/" target="_blank">Demo</a> created with Blog Designer Pack.</p>
								</div>
							</div>
							
						</div><!-- .inside -->
					</div><!-- .postbox -->
				</div><!-- .meta-box-sortables -->
			</div><!-- .postbox-container -->

			<div class="postbox-container">
				<div class="meta-box-sortables">
					<div class="postbox">
						<div class="postbox-header">
							<h2 class="hndle">
								<span><?php _e( 'Free and Premium Layouts', 'blog-designer-pack' ); ?></span>
							</h2>
						</div>	
						<div class="inside bdp-clearfix">
							<h4><strong>Please click on layouts below and create the shortcode.</strong><br /> 
							Free layouts only having 2 designs option each. If you are looking for more options and 10+ designs for each layout please check <a href="#Premium-Demo-Section">Premium Demo</a> for more details.</h4>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-free-tag">FREE</span>
									<a href="<?php echo esc_url($shortcode_page_url); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/grid.png" /></a>
									<label>Grid</label>
								</div>
							</div>
							
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-free-tag">FREE</span>
									<a href="<?php echo esc_url($shortcode_page_url); ?>&shortcode=bdp_post_slider"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/slider.png" /></a>
									<label>Slider</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-free-tag">FREE</span>
									<a href="<?php echo esc_url($shortcode_page_url); ?>&shortcode=bdp_post_carousel"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/carousel.png" /></a>
									<label>Carousel</label>
								</div>
							</div>
							
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-free-tag">FREE</span>
									<a href="<?php echo esc_url($shortcode_page_url); ?>&shortcode=bdp_post_gridbox"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/grid-box-layout-2.png" /></a>
									<label>Grid Box-1</label>
								</div>
							</div>
							
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-free-tag">FREE</span>
									<a href="<?php echo esc_url($shortcode_page_url); ?>&shortcode=bdp_post_list"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/list.png" /></a>
									<label>List</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-free-tag">FREE</span>
									<a href="<?php echo esc_url($shortcode_page_url); ?>&shortcode=bdp_masonry"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/masonry.png" /></a>
									<label>Masonry</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-free-tag">FREE</span>
									<a href="<?php echo esc_url($shortcode_page_url); ?>&shortcode=bdp_ticker"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/ticker.png" /></a>
									<label>Ticker</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/slider-with-thumb.png" /></a>
									<label>Slider with Thumb</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/carousel-with-partial-slide.png" /></a>
									<label>Partial Slide</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/grid-box-layot.png" /></a>
									<label>Grid Box-2</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/grid-box-layout-1.png" /></a>
									<label>Grid Box-3</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/grid-box-layout-1.png" /></a>
									<label>Grid Box Slider</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/list-alt.png" /></a>
									<label>List Alternate</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/timeline.png" /></a>
									<label>Timeline</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/category-grid.png" /></a>
									<label>Category Grid/Slider</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/category-grid.png" /></a>
									<label>Featured and Trending Post</label>
								</div>
							</div>
							<div class="bdp-layout-box">
								<div class="bdp-layout-box-inner">
									<span class="bdp-pro-tag">PRO</span>
									<a class="bdp-upgrade-pro" href="<?php echo esc_url($upgrade_link); ?>"><img src="<?php echo BDP_URL; ?>/assets/images/getinstarted/category-grid.png" /></a>
									<label>Widgets – Slider and Grid</label>
								</div>
							</div>
							<div id="Premium-Demo-Section" class="bdp-feedback bdp-clearfix">
								<h3 class="text-center">Want to Check Premium Demo?</h3>
								<p>Checkout the premium demo with 9+ Layouts and 90+ Designs</p>
								<a href="https://premium.infornweb.com/news-blog-designer-pack-pro/" class="bdpp-feedback-btn bdp-button-full" target="_blank">Premium Demo</a>
							</div>
							<div class="bdp-pro-features bdp-clearfix">
								<h3 class="text-center"><span class="dashicons dashicons-yes-alt"></span> Premium Features Highlights</h3>
								<ul>
									<li><strong>90+ Designs and 9+ Layouts - </strong> Grid, Slider, Carousel, List, Masonry , Gridbox, Gridbox Slider, Timeline, Partial Slide, Slider with Thumbnails, Category Grid & Slider, Creative etc </li>
									<li><strong>5 Type of Pagination -</strong> Infinite Scroll, Load More, Prev & Next with Ajax, Numeric etc</li>
									<li><strong>3 Widgets with 10+ Designs -</strong> Slider, List, Vertical Scrolling</li>
									<li><strong>Style Manager - </strong>Manage post title, content, meta and read more button color and fount size</li>
									<li><strong>Featured & Trending Post Functionality - </strong> Work with all layouts and designs</li>
									<li><strong>Template Functionality -</strong> Override designs from your theme</li>
									<li>Elementor & WPBakery Page Builder Support</li>
									<li>Custom Post Type, Taxonomy and  Tags Support</li>
									<li>Social Sharing Options</li>
									<li>Category Image Upload Option</li>
									<li>Sticky Post Options</li>
									<li>Drag & Drop Post Order Change</li>
									<li>Custom Read More Link and Read More Text for Post</li>
									<li><a href="<?php echo esc_url($upgrade_link); ?>">Know More..</a></li>
								</ul>
							</div>
						</div><!-- .inside -->
					</div><!-- .postbox -->
				</div><!-- .meta-box-sortables -->
			</div><!-- .postbox-container -->
			
		</div><!-- #dashboard-widgets -->	
	</div><!-- #dashboard-widgets-wrap -->
</div><!-- end .wrap -->