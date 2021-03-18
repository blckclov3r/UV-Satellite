(function ($) {
	"use strict";

	var BdpElementorInit = function () {

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
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/shortcode.default', BdpElementorInit);	

	});
}(jQuery));