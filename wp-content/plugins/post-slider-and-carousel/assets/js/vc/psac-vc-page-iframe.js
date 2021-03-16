var psac_iframe = {};
( function($) {

	/* Common Modules */
	window.psac_iframe.common = function( model_id ) {
		var element = $("[data-model-id='" + model_id + "']");
		psac_init_post_slider();
		psac_init_post_carousel();		
	};

})(window.jQuery);