var bdp_iframe = {};
( function($) {

	/* Common Modules */
	window.bdp_iframe.common = function( model_id ) {
		var element = $("[data-model-id='" + model_id + "']");
		bdp_init_post_slider();
		bdp_init_post_carousel();
		bdp_init_post_hticker();
		bdp_init_post_masonry();
	};

})(window.jQuery);