( function($) {

	'use strict';
	
	/* Slider */
	bdp_init_post_slider();

	/* Carousel Slider */
	bdp_init_post_carousel();
	
	/* Masonry */
	bdp_init_post_masonry();
	
	/* vticker */
	bdp_init_post_vticker();
	
	/* hticker */
	bdp_init_post_hticker();
	
	/* Load More Post */
	jQuery(document).on('click', '.bdp-load-more-btn', function(){

		var current_obj = jQuery(this);
		var site_html 	= jQuery('body');
		var masonry_obj = current_obj.closest('.bdp-post-masonry-wrp').find('.bdp-post-masonry').attr('id');
		var paged 		= (parseInt(current_obj.attr('data-paged')) + 1);
		var shortcode_param = jQuery.parseJSON(current_obj.closest('.bdp-ajax-btn-wrap').attr('data-conf'));

		jQuery('.bdp-info').remove();
		current_obj.addClass('bdp-btn-active');
		current_obj.attr('disabled', 'disabled');

		var shortcode_obj = {};

		jQuery.each(shortcode_param, function (key,val) {
			shortcode_obj[key] = val;
		});

		var data = {
						action		: 'bdp_get_more_post',
						paged 		: paged,
						shrt_param 	: shortcode_obj
					};

		jQuery.post(Wpbdp.ajaxurl,data,function(result) {
			
			if( result.sucess = 1 && (result.data != '') ) {

				current_obj.attr('data-paged', paged);

				var $content = jQuery( result.data );
				$content.hide();
				jQuery('#'+masonry_obj).append($content).imagesLoaded(function(){
					$content.show();
					jQuery('#'+masonry_obj).append( $content ).masonry( 'appended', $content );

					current_obj.removeAttr('disabled', 'disabled');
					current_obj.removeClass('bdp-btn-active');
				});

			} else if(result.data == '') {
				
				current_obj.parent('.bdp-ajax-btn-wrap').hide();
				var info_html = '<div class="bdp-info">'+Wpbdp.no_post_msg+'</div>';

				current_obj.parent().after(info_html);
				setTimeout(function() {
					jQuery(".bdp-info").fadeOut("normal", function() {
						jQuery(this).remove();
					});
				}, 2000 );

				current_obj.removeAttr('disabled', 'disabled');
				current_obj.removeClass('bdp-btn-active');
			}
		});
	});
})( jQuery );

/* Initialize slick slider */
function bdp_init_post_slider() {

	jQuery( '.bdp-post-slider' ).each(function( index ) {

		if( jQuery(this).hasClass('slick-initialized') ) {
			return;
		}

		var slider_id   = jQuery(this).attr('id');
		var slider_conf = jQuery.parseJSON( jQuery(this).closest('.bdp-post-slider-wrp').find('.bdp-slider-conf').text() );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {		
			
			jQuery('#'+slider_id).slick({
				dots            : (slider_conf.dots) == "true" ? true : false,
				infinite        : (slider_conf.loop) == "true" ? true : false,
				arrows          : (slider_conf.arrows) == "true" ? true : false,
				speed           : parseInt(slider_conf.speed),
				autoplay        : (slider_conf.autoplay) == "true" ? true : false,
				autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
				slidesToShow    : 1,
				slidesToScroll  : 1,
				rtl             : (Wpbdp.is_rtl == 1) ? true : false, 
				mobileFirst     : (Wpbdp.is_mobile == 1) ? true : false, 				
			});
		}
	});
}	

/* Initialize slick carousel */
function bdp_init_post_carousel() {

	jQuery( '.bdp-post-carousel' ).each(function( index ) {

		if( jQuery(this).hasClass('slick-initialized') ) {
			return;
		}

		var slider_id   = jQuery(this).attr('id');
		var slider_conf = jQuery.parseJSON( jQuery(this).closest('.bdp-post-carousel-wrp').find('.bdp-slider-conf').text() );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {		
			
			jQuery('#'+slider_id).slick({
				dots            : (slider_conf.dots) == "true" ? true : false,
				infinite        : (slider_conf.loop) == "true" ? true : false,
				arrows          : (slider_conf.arrows) == "true" ? true : false,
				speed           : parseInt(slider_conf.speed),
				autoplay        : (slider_conf.autoplay) == "true" ? true : false,
				autoplaySpeed   : parseInt(slider_conf.autoplay_interval),
				slidesToShow    : parseInt(slider_conf.slide_show),
				slidesToScroll  : parseInt(slider_conf.slide_scroll),
				rtl             : (Wpbdp.is_rtl == 1) ? true : false, 	
				mobileFirst     : (Wpbdp.is_mobile == 1) ? true : false,
				responsive: [{
			  breakpoint: 1023,
			  settings: {
				slidesToShow  : (parseInt(slider_conf.slide_show) > 3) ? 3 : parseInt(slider_conf.slide_show),
				slidesToScroll  : 1
			  }
			},{
			  breakpoint: 640,
			  settings: {
				slidesToShow  : (parseInt(slider_conf.slide_show) > 2) ? 2 : parseInt(slider_conf.slide_show),
				slidesToScroll  : 1
			  }
			},{
			  breakpoint: 479,
			  settings: {
				slidesToShow  : 1,
				slidesToScroll  : 1
			  }
			},{
			  breakpoint: 319,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}]	
			});
		}
	});
}

/* Masonry */
function bdp_init_post_masonry() {
	
	jQuery('.bdp-post-masonry').each(function( index ) {
		
		var obj_id = jQuery(this).attr('id');
		var masonry_param_obj = {itemSelector: '.bdp-post-grid'};
		
		if( !jQuery(this).hasClass('bdp-effect-1') ) {
			masonry_param_obj['transitionDuration'] = 0;
		}
		
		jQuery('#'+obj_id).imagesLoaded(function() {
			jQuery('#'+obj_id).masonry(masonry_param_obj);
		});
	});
}

/* Initialize Post Ticker */
function bdp_init_post_vticker() {	
	jQuery( '.post-ticker-jcarousellite' ).each(function( index ) {

		var slider_id   = jQuery(this).attr('id');
		var slider_conf = jQuery.parseJSON( jQuery(this).closest('.bdp-widget-wrp').find('.bdp-slider-conf').text() );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

			jQuery('#'+slider_id).vTicker({
				speed     : parseInt(slider_conf.speed),
				height    : parseInt(slider_conf.height),             
				pause     : parseInt(slider_conf.pause)
			});
		}
	});
}

/* Initialize news ticker */
function bdp_init_post_hticker() {
	jQuery( '.bdp-ticker-wrp' ).each(function( index ) {
		
		var ticker_id   = jQuery(this).attr('id');
		var ticker_conf = jQuery.parseJSON( jQuery(this).find('.bdp-ticker-conf').text() );

		if( typeof(ticker_id) != 'undefined' && ticker_id != '' && ticker_conf != 'undefined' ) {
			jQuery("#"+ticker_id).bdpTicker({
				effect      : ticker_conf.ticker_effect,
				autoplay    : (ticker_conf.autoplay == 'false') ? false : true,
				timer       : parseInt(ticker_conf.speed),
				border      : true,
				fontstyle   : ticker_conf.font_style,
			});
		}
	});
}