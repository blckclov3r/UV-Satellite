<?php

/*******************************
 * Add Ajax Object at the head part
 *******************************/
add_action('wp_head', 'wbelps_support_form_ajax_header');

if( !function_exists('wbelps_support_form_ajax_header') )
{
	function wbelps_support_form_ajax_header() 
	{

	   echo '<script type="text/javascript">
	           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
	         </script>';

	} //End of wbelps_support_form_ajax_header

} //End of function_exists

/*******************************
 * Handle Ajex Request for Form Processing
 *******************************/
add_action( 'wp_ajax_process_wbelps_promo_form', 'process_wbelps_promo_form' );

if( !function_exists('process_wbelps_promo_form') )
{
	function process_wbelps_promo_form()
	{
		
		$data['status'] = 'failed';
		$data['message'] = __('Problem in processing your form submission request! Apologies for the inconveniences.<br> 
Please email to <span style="color:#22A0C9;font-weight:bold !important;font-size:14px "> webbuilders03@gmail.com </span> with any feedback. We will get back to you right away!', '');

		$name = trim(sanitize_text_field($_POST['post_name']));
		$email = trim(sanitize_email($_POST['post_email']));
		$subject = trim(sanitize_text_field($_POST['post_subject']));
		$message = trim(sanitize_text_field($_POST['post_message']));
		$plugin_name = trim(sanitize_text_field($_POST['post_plugin_name']));

		if( $name == "" || $email == "" || $subject == "" || $message == "" )
		{
			$data['message'] = 'Please fill up all the requried form fields.';
		}
		else if ( filter_var($email, FILTER_VALIDATE_EMAIL) === false ) 
		{
			$data['message'] = 'Invalid email address.';
		}
		else
		{

			//build email body

			$bodyContent = "";
				
			$bodyContent .= "<p><strong>Support Request Details:</strong></p><hr>";

			$bodyContent .= "<p>Name : ".$name."</p>";
			$bodyContent .= "<p>Email : ".$email."</p>";
			$bodyContent .= "<p>Subject : ".$subject."</p>";
			$bodyContent .= "<p>Message : ".$message."</p>";

			$bodyContent .= "<p>Sent Via the Plugin: ".$plugin_name."</p>";

			$bodyContent .="<p></p><p>Mail sent from: <strong>".get_bloginfo('name')."</strong>, URL: [".get_bloginfo('url')."].</p>";
			$bodyContent .="<p>Mail Generated on: " . date("F j, Y, g:i a") . "</p>";			
			
			$toEmail = "webbuilders03@gmail.com"; //Receivers email address
			//$toEmail = "wbelnt.kadir@gmail.com"; //Receivers email address

			//Extract Domain
			$url = get_site_url();
			$url = parse_url($url);
			$domain = $url['host'];
			

			$fakeFromEmailAddress = "wordpress@" . $domain;
			
			$to = $toEmail;
			$body = $bodyContent;
			$headers = array();
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: '.$name.' <'.$fakeFromEmailAddress.'>';
			$headers[] = 'Reply-To: '.$name.' <'.$email.'>';

			$finalSubject = "From Plugin Support Page: " . $subject;
			
			$result = wp_mail( $to, $finalSubject, $body, $headers );

			if( $result )
			{
				$data['status'] = 'success';
				$data['message'] = __('Your email was sent successfully. Thanks!', '');
			}

		}

		ob_clean();

		
		echo json_encode($data);
	
		die();
	}
}





/*******************************
 * Main Class to Display Support
 * form and the promo pages
 *******************************/
if( !class_exists('WBELPSSupportPage') ){


	class WBELPSSupportPage{
	
		public $plugin_menu_slug = "";
		public $plugin_slug = ""; //Should be unique, like: wbelntsld_p123
		public $promo_page_title = 'More WordPress Goodies for You!';
		public $promo_menu_title = 'Support';
		public $plugin_name = '';
		
		public $page_slug = "";
		
		public $relative_folder_url;
		
		//public $relative_folder_url = plugin_dir_url( __FILE__ );
		
		function __construct( $plugin_slug = null )
		{
		
			if(!function_exists('wp_get_current_user')) {
				include(ABSPATH . "wp-includes/pluggable.php"); 
			}
			
			$this->page_slug = 'wb-page-' . $plugin_slug;
			$this->relative_folder_url = plugin_dir_url( __FILE__ );
			
			add_action('admin_enqueue_scripts', array(&$this, 'include_promo_page_scripts'));
			
			//add_action( 'wp_ajax_process_wbelps_promo_form', array(&$this,'process_wbelps_promo_form') );
			
		} //End of Constructor
		
		function include_promo_page_scripts( $hook )
		{                                 
		   if( $hook == 'post-carousel-slider-for-elementor_page_wb-page-wbelps-support' ){	   	
			   wp_enqueue_script( 'jquery' );
			   wp_enqueue_script( 'jquery-ui-core');
			   wp_enqueue_script( 'jquery-ui-tabs' );
			   wp_enqueue_script( 'jquery-custom-form-processor', $this->relative_folder_url . '/js/support-form-script.js',  array('jquery', 'jquery-ui-core','jquery-ui-tabs') );

			   wp_enqueue_style('wl_support_font', "https://fonts.googleapis.com/css?family=Lato");
			   wp_enqueue_style('wl_font_awesome', $this->relative_folder_url. "/css/font-awesome.min.css");
			   wp_enqueue_style('wl_style', $this->relative_folder_url. "/css/style.css");
			   wp_enqueue_style('wl_responsive', $this->relative_folder_url. "/css/responsive.css");
		   }
		   
		}
		
		function show_promo_page()
		{
		
			if( $this->plugin_menu_slug == "" ){
			   return;
			}
			
			add_action( 'admin_menu', array(&$this, 'show_promo_page_callback_func') );
			
		  
		} //End of function show_promo_page
		
		/*******************************
		 * Callback function to add the menu
		 *******************************/
		function show_promo_page_callback_func()
		{
			add_submenu_page(
				$this->plugin_menu_slug,
				$this->promo_page_title,
				$this->promo_menu_title,
				'manage_options',
				$this->page_slug,
				array(&$this, 'wbelpspromo_support_page_callback_func' )
			);
		} //show_promo_page_callback_func
		
		/*******************************
		 * Callback function to show the HTML
		 *******************************/
		function wbelpspromo_support_page_callback_func()
		{
			
			?>
				
				<div class="wbelps-support-page-wrapper">
					<div id="tabs" class="main-container">
						<div class="tab-header">
							<div class="container-wrapper">
								<div class="logo-left">
									<a href="https://www.plugin-devs.com" target="_blank" title="Web Lodge">
										<!-- <img src="<?php echo $this->relative_folder_url; ?>/images/logo.png"  alt="QuantumClous"/> -->
									</a>
								</div>
								<div class="tab tab-link">
									<ul class="tabs">
										<li class="current">
											<a href="#tab-one">
												<i class="fa fa-wrench"></i>
												Support
											</a>
										</li>
										<li>
											<a href="#tab-two">
												<i class="fa fa-wordpress"></i>
												More Plugins
											</a>
										</li>
										<li>
											<a href="#tab-three">
												<i class="fa fa-cog"></i>
												Wordpress Services
											</a>
										</li>
										<li>
											<a href="#tab-four">
												<i class="fa fa-cog"></i>
												Shopify Services
											</a>
										</li>
										<li>
											<a href="#tab-five">
												<i class="fa fa-cog"></i>
												Other Services
											</a>
										</li>
									</ul> <!-- / tabs -->
								</div> <!-- / tab -->
							   </div>
							</div><!---tab header---->
							<div id="tab-one" class="tab-content-main">
								<div class="container-wrapper">
									<div class="tab-item">
									<div class="contact-support-left">
										<div class="title-part">
											<h2><span>Contact Us</span>For Support</h2>
										</div>
										<div class="support-form">
											<form class="form" id="wbebaic-support-form" method="POST">

											  <input name="plugin_name" id="plugin_name" type="hidden" value="<?php echo ( $this->plugin_name != "" ) ? $this->plugin_name : "not-set-via-instance"; ?>"/>

											  <div class="name">
												<i class="fa fa-user"></i>
												<input name="name" type="text" class="form-control-input" placeholder="Name*" id="name" />
											  </div>
											  
											  <div class="email">
												<i class="fa fa-envelope"></i>
												<input name="email" type="text" class="form-control-input" id="email" placeholder="Email*" />
											  </div>
											  
											   <div class="subject">
											   <i class="fa fa-envelope"></i>
												<input name="subject" type="text" class="form-control-input" id="subject" placeholder="Subject*" />
											  </div>
											  
											  <div class="message">
											  <i class="fa fa-comment"></i>
												<textarea id="message" class="form-control-input message-control" name="message" placeholder="Message*"></textarea>
											  </div>

											  <div id="support-form-result" class="support-form-result">
											  	<div id="support-form-loading" class="support-form-loading"></div>
											  	<div id="support-form-status" class="support-form-status output-success">
											  		
											  	</div>
											  </div>
											  
											  
											  <div class="submit">
												<input type="submit" value="Send Message" class="button-blue" id="wbebaicpg-query-submit-btn"/>
												<div class="ease"></div>
											  </div>
											</form>
										</div>
									</div>
									
									<div class="feature-plugin-right">
										<div class="title-part">
											<h2>
												<span>Featured</span>Plugins
											</h2>
										</div>
										<div class="bottom-feature-plugin">
											<div class="feature feature-plugin-01">
												<!-- <div class="icon-box-x18">
													<img src="" alt="">
												</div> -->
												<h3>
													<a href="https://plugin-devs.com/product/shopify-to-woocommerce-migration/" target="_blank">
														Shopify to WooCommerce Migration
													</a>
												</h3>
												<p>
													You can migrate all of your <strong>Shopify Products</strong>, <strong>Categories</strong>, <strong>Orders</strong>, <strong>Customers</strong> to your WooCommerce Store with this plugin.
												</p>
											</div>
											<div class="feature feature-plugin-01">
												<!-- <div class="icon-box-x18">
													<img src="" alt="">
												</div> -->
												<h3>
													<a href="https://plugin-devs.com/product/before-after-slider-for-elementor/" target="_blank">
														Before After Image Comparison Slider for Elementor
													</a>
												</h3>
												<p>
													This plugin allows you to create the effect for comparing two before and after images. You will find lots of options to customize this slider fully.
												</p>
											</div>
											<div class="wbelnt-clear"></div>

											<div class="feature feature-plugin-02">
												<!-- <div class="icon-box-x18">
													<img src="" alt="">
												</div> -->
												<h3>
													<a href="https://plugin-devs.com/product/news-ticker-for-elementor/" target="_blank">
														News Ticker for Elementor
													</a>
												</h3>
												<p>
													News Ticker for Elementor lets you add news ticker with the Elementor Page builder.You can use any of your blog post as news ticker. You can also add custom texts as as news ticker.
												</p>
											</div>

											<div class="feature feature-plugin-03">
												<!-- <div class="icon-box-x18">
													<img src="" alt="">
												</div> -->
												<h3>
													<a href="https://plugin-devs.com/product/before-after-slider-for-visual-composer/" target="_blank">
														Before After Image Comparison Slider for Visual Composer
													</a>
												</h3>
												<p>
													This plugin allows you to create the effect for comparing two before and after images. You will find lots of options to customize this slider fully.
												</p>
											</div>
										
											<div class="clear"></div>
											<div class="button-plugin">
												<a href="https://plugin-devs.com/product-category/plugin/" class="feature-button button-blue" target="_blank">See All Plugins</a>
											</div>
										</div>
									</div>
									<div class="clear"></div>
								</div>
								</div>
							</div><!---tab-content-main---->
							
							<div id="tab-two" class="tab-content-main">
								<div class="container-wrapper">
									
									<!--Services:Start-->
									<div class="tlist-wrapper-x18">
										<div class="tlist-holder-x18">
											<div class="bottom-row-x18">

												<div class="feature feature-plugin-01">
													<!-- <div class="icon-box-x18">
														<img src="" alt="">
													</div> -->
													<h3>
														<a href="https://plugin-devs.com/product/shopify-to-woocommerce-migration/" target="_blank">
															Shopify to WooCommerce Migration
														</a>
													</h3>
													<p>
														You can migrate all of your <strong>Shopify Products</strong>, <strong>Categories</strong>, <strong>Orders</strong>, <strong>Customers</strong> to your WooCommerce Store with this plugin.
													</p>
												</div>
																
												<div class="feature feature-plugin-01">
														<!-- <div class="icon-box-x18">
															<img src="" alt="">
														</div> -->
														<h3>
															<a href="https://plugin-devs.com/product/before-after-slider-for-elementor/" target="_blank">
																Before After Image Comparison Slider for Elementor
															</a>
														</h3>
														<p>
															This plugin allows you to create the effect for comparing two before and after images. You will find lots of options to customize this slider fully.
														</p>
													</div>

													<div class="clear"></div>

													<div class="feature feature-plugin-02">
														<!-- <div class="icon-box-x18">
															<img src="" alt="">
														</div> -->
														<h3>
															<a href="https://plugin-devs.com/product/news-ticker-for-elementor/" target="_blank">
																News Ticker for Elementor
															</a>
														</h3>
														<p>
															News ticker for Elementor lets you add news ticker with the Elementor Page builder.You can use any of your blog post as news ticker. You can also add custom texts as as news ticker.
														</p>
													</div>

													<div class="feature feature-plugin-03">
														<!-- <div class="icon-box-x18">
															<img src="" alt="">
														</div> -->
														<h3>
															<a href="https://plugin-devs.com/product/before-after-slider-for-visual-composer/" target="_blank">
																Before After Image Comparison Slider for Visual Composer
															</a>
														</h3>
														<p>
															This plugin allows you to create the effect for comparing two before and after images. You will find lots of options to customize this slider fully.
														</p>
													</div>

											</div>
											
										</div>		
									</div>
									<!--Plugins:End-->
								</div>
							</div><!---tab-content-main---->
							
							<div id="tab-three" class="tab-content-main">
								<div class="container-wrapper">
									<div class="button-plugin service-button-quote">
										<a href="https://plugin-devs.com/#contact" class="feature-button button-blue" target="_blank">
											Request a Quote
										</a>
									</div>
									<div class="clear"></div>
											<!--Plugins:Start-->
									<div class="tlist-wrapper-x18">
										<div class="tlist-holder-x18">
											<div class="bottom-row-x18">
												<div class="single-item-x18">					
													
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>Custom WORDPRESS THEME Development</h2>
														</a>
														<p>
															Looking for PSD to WordPress responsive theme conversion services? if you want quality WordPress development services & on time delivery then just contact us will give you fast designing services.
														</p>
														
													</div>
												</div>

												<div class="single-item-x18">					
													 
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>
																WORDPRESS PLUGINS DEVELOPMENT
															</h2>
														</a>
														<p>
															Plugins are programs, or a set of functions which adds a specific set of features to your WordPress site. Our developers can add custom features to modify our existing plugins in a way that best suits your needs, or create a totally unique plugin from scratch.
														</p>
														
													</div>
												</div>
												<div class="single-item-x18">					
													 
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>
																WOOCOMMERCE DESIGN & CUSTOMIZATIONS
															</h2>
														</a>
														<p>
															Looking for PSD to WooCommerce responsive theme conversion services? if you want quality WooCommerce development services & on time delivery then just contact us will give you fast designing services.
														</p>
													   
													</div>
												</div>

												<div class="single-item-x18">					
													
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>WORDPRESS THEME DESIGN & CUSTOMIZATION</h2>
														</a>
														<p>
															Giving you the nice designs, convenient structures and high business efficiency is the goal of our work. We have a team of professional designers with extensive experience and creativity does not stop.
														</p>
														
													</div>
												</div>

												<div class="single-item-x18">					
													
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>WORDPRESS Plugin CUSTOMIZATION</h2>
														</a>
														<p>
															Customize existing Premium and free plugins according to your need so that you can accomplish your fullfilment
														</p>
														
													</div>
												</div>
						
											</div>
											
										</div>		
									</div>
									<!--Services:End-->
									
									<div class="tlist-wrapper-x18">
										<div class="tlist-holder-x18">
											<div class="bottom-row-x18">
											
										

												<div class="button-plugin">
													<a href="https://plugin-devs.com/#contact" class="feature-button button-blue" target="_blank">
														Request a Quote
													</a>
												</div>
						
											</div>
											
										</div>		
									</div>
								</div>
							</div><!---tab-content-main---->

							<div id="tab-four" class="tab-content-main">
								<div class="container-wrapper">
									<div class="button-plugin service-button-quote">
										<a href="https://plugin-devs.com/#contact" class="feature-button button-blue" target="_blank">
											Request a Quote
										</a>
									</div>
									<div class="clear"></div>
											<!--Plugins:Start-->
									<div class="tlist-wrapper-x18">
										<div class="tlist-holder-x18">
											<div class="bottom-row-x18">
												<div class="single-item-x18">					
													
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>Custom Shopify THEME Development</h2>
														</a>
														<p>
															Looking for PSD to Shopify responsive theme conversion services? if you want quality Shopify development services & on time delivery then just contact us will give you fast designing services.
														</p>
														
													</div>
												</div>

												<div class="single-item-x18">					
													 
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>
																SHOPIFY THEME DESIGN & CUSTOMIZATIONS
															</h2>
														</a>
														<p>
															Shopify Development 100% in-house. We have technical, knowledgeable and experienced Shopify developers to bring your online store to life.
														</p>
														
													</div>
												</div>
												<div class="single-item-x18">					
													 
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>
																SHOPIFY APPS DEVELOPMENT
															</h2>
														</a>
														<p>
															Whether you are thinking of creating a brand new public or private app, want to enhance your store functionality, we are there for you. Our expert developers are equipped with knowledge and skills to meet your requirements in a unique fashion.
														</p>
													   
													</div>
												</div>
						
											</div>
											
										</div>		
									</div>
									<!--Services:End-->
									
									<div class="tlist-wrapper-x18">
										<div class="tlist-holder-x18">
											<div class="bottom-row-x18">
											
										

												<div class="button-plugin">
													<a href="https://plugin-devs.com/#contact" class="feature-button button-blue" target="_blank">
														Request a Quote
													</a>
												</div>
						
											</div>
											
										</div>		
									</div>
								</div>
							</div><!---tab-content-main---->

							<div id="tab-five" class="tab-content-main">
								<div class="container-wrapper">
									<div class="button-plugin service-button-quote">
										<a href="https://plugin-devs.com/#contact" class="feature-button button-blue" target="_blank">
											Request a Quote
										</a>
									</div>
									<div class="clear"></div>
											<!--Plugins:Start-->
									<div class="tlist-wrapper-x18">
										<div class="tlist-holder-x18">
											<div class="bottom-row-x18">
												<div class="single-item-x18">					
													
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>RESPONSIVE WEBSITE</h2>
														</a>
														<p>
															We convert your PSD design into a high quality, hand coded, SEO optimized, cross browser compatible, Responsive html/css markup ready for any Website. You will get a pixel perfect html like PSD.
														</p>
														
													</div>
												</div>

												<div class="single-item-x18">					
													 
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>
																CUSTOM JQUERY
															</h2>
														</a>
														<p>
															We have expertise in development in jquery along with other front end technologies. Our developers have hands on experience in jquery features like DOM management to make dynamic modifications to website.
														</p>
														
													</div>
												</div>
												<div class="single-item-x18">					
													 
													<div class="content-box-x18 service-heading">
														<a href="https://www.plugin-devs.com/services/" target="_blank">
															<h2>
																Custom PHP Application
															</h2>
														</a>
														<p>
															With the right combination of creative and technical expertise, we provide broad range of services including PHP website design, website development, custom web application, web portal, dynamic application, ecommerce application with on time delivery and budget. 
														</p>
													   
													</div>
												</div>
						
											</div>
											
										</div>		
									</div>
									<!--Services:End-->
									
									<div class="tlist-wrapper-x18">
										<div class="tlist-holder-x18">
											<div class="bottom-row-x18">
												<div class="button-plugin">
													<a href="https://plugin-devs.com/#contact" class="feature-button button-blue" target="_blank">
														Request a Quote
													</a>
												</div>
											</div>
										</div>		
									</div>
								</div>
							</div><!---tab-content-main---->
					 </div>       
				  
					<script type="text/javascript">
						jQuery(document).ready(function($) {
						
						 var myAnimations = {
						 show: { effect: "slideDown", duration: 1000 }

						  };
						  jQuery("#tabs").tabs(myAnimations);

						});
					</script>
					
				</div>
				
			<?php
		} //End of wbelpspromo_support_page_callback_function
		
		
	
	} //End of the class WBELPSSupportPage


} //End of class_exists


/*
* Create Instance, set instance variables and then call appropriate worker.
*/

//Supply Unique Promo Page Slug as the constructor parameter of the class WBELPSSupportPage. ex: sld-page-2124a to the constructor

//Please create an unique instance for your use, example: $instance_sldf2

$instance = new WBELPSSupportPage('wbelps-support');

if( is_admin() )
{
	$instance->plugin_menu_slug = "wbel-post-slider"; //Edit Value
	$instance->plugin_name = "Post Carousel Slider for Elementor"; //Edit Value
	$instance->show_promo_page();
}
