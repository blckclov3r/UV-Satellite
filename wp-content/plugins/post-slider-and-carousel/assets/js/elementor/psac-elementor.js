(function ($) {
	"use strict";

	var PsacElementorInit = function () {

		/* Slider */
		psac_init_post_slider();

		/* Carousel Slider */
		psac_init_post_carousel();
		
		/* vticker */
		psac_init_post_vticker();
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/shortcode.default', PsacElementorInit);
	});
}(jQuery));