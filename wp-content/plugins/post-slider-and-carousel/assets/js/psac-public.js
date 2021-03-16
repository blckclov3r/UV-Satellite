( function($) {

	'use strict';
	
	/* Slider */
	psac_init_post_slider();

	/* Carousel Slider */
	psac_init_post_carousel();
	
	/* vticker */
	psac_init_post_vticker();
	
})( jQuery );


/* Initialize slider */
function psac_init_post_slider() {
	jQuery( '.psac-post-slider' ).each(function( index ) {

		var slider_id	= jQuery(this).attr('id');
		var conf		= jQuery.parseJSON( jQuery(this).attr('data-conf') );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

			jQuery('#'+slider_id).owlCarousel({
				loop 				: conf.loop,
				items 				: 1,
				nav 				: conf.arrows,
				dots 				: conf.dots,
				autoplay 			: conf.autoplay,
				autoplayTimeout		: parseInt( conf.autoplay_interval ),
				autoplaySpeed		: (conf.speed == 'false') ? false : parseInt( conf.speed ),				
				navElement 			: 'span',
				autoplayHoverPause	: true,
				rtl					: ( Psac.is_rtl == 1 ) ? true : false,
			});
		}
	});
}

/* Initialize carousel */
function psac_init_post_carousel() {
	
	jQuery( '.psac-post-carousel' ).each(function( index ) {

		var slider_id   = jQuery(this).attr('id');
		var conf		= jQuery.parseJSON( jQuery(this).attr('data-conf') );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

			jQuery('#'+slider_id).owlCarousel({
				loop 				: conf.loop,
				items				: parseInt( conf.slide_show ),
				slide_scroll		: parseInt( conf.slide_scroll ),
				nav 				: conf.arrows,
				dots 				: conf.dots,
				autoplay 			: conf.autoplay,
				autoplayTimeout		: parseInt( conf.autoplay_interval ),
				autoplaySpeed		: (conf.speed == 'false') ? false : parseInt( conf.speed ),
				margin				: 20,
				navElement 			: 'span',
				autoplayHoverPause	: true,
				rtl					: ( Psac.is_rtl == 1 ) ? true : false,
				responsive:{
					0:{
						items 		: 1,
						slide_scroll: 1,
					},
					568:{
						slideBy : ( conf.slide_scroll >= 2 ) ? 2 : conf.slide_scroll,
						items	: ( conf.slide_show >= 2 ) ? 2 : conf.slide_show,
					},
					768:{
						items			: parseInt( conf.slide_show ),
						slide_scroll	: parseInt( conf.slide_scroll ),
					}
				}
			});
		}
	});
}

/* Initialize Vertical Post Ticker */
function psac_init_post_vticker() {	
	
	jQuery( '.psac-vticker-scrolling-wdgt' ).each(function( index ) {

		var slider_id   = jQuery(this).attr('id');
		var conf		= jQuery.parseJSON( jQuery(this).attr('data-conf') );

		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {

			jQuery('#'+slider_id).vTicker({
				speed     : parseInt(conf.speed),
				pause     : parseInt(conf.pause),
				height    : ( conf.height > 0 ) ? parseInt(conf.height) : '',
				mousePause: true,
			});
		}
	});
}