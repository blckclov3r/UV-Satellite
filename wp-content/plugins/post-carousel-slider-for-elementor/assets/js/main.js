'use strict';
(function ($) {
	jQuery(window).on('elementor/frontend/init', function(){
		elementorFrontend.hooks.addAction('frontend/element_ready/wb-post-slider.default', function ($scope, $) {
			var elem = $scope.find('.wbel_post_slider_wrapper');
			
			var display_dots = $scope.find('.wbel_post_slider_wrapper').data('display-dots');
			if( display_dots == 'yes' ){
				display_dots = true;
			}else{
				display_dots = false;
			}

			var slides_to_show = $scope.find('.wbel_post_slider_wrapper').data('slide-to-show');
			if( slides_to_show > 0 ){
				slides_to_show  = $scope.find('.wbel_post_slider_wrapper').data('slide-to-show');
			}else{
				slides_to_show = 3
			}

			var slides_to_scroll = $scope.find('.wbel_post_slider_wrapper').data('slides-to-scroll');
			if( slides_to_scroll > 0 ){
				slides_to_scroll  = $scope.find('.wbel_post_slider_wrapper').data('slides-to-scroll');
			}else{
				slides_to_scroll = 3
			}

			var prev_arrow = $scope.find('.wb-arrow-prev');
			var next_arrow = $scope.find('.wb-arrow-next');
			elem.slick({
				infinite: true,
				slidesToShow: slides_to_show,
				slidesToScroll: slides_to_scroll,
				autoplay: false,
				arrows: true,
				prevArrow: prev_arrow,
				nextArrow: next_arrow,
				dots: display_dots,
				draggable: true,
				focusOnSelect: true,
				pauseOnHover: true,
				swipe: true,
				adaptiveHeight: true,
				autoplaySpeed: 3000,
				speed: 1000,
				autoplaySpeed: 3000,
				 responsive: [
				    {
				      breakpoint: 768,
				      settings: {
				        slidesToShow: 2,
				        slidesToScroll: 2,
				      }
				    },
				    {
				      breakpoint: 480,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1,
				      }
				    },
				]
			});
		});
	});
})(jQuery);