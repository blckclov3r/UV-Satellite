(function() {    
    tinymce.PluginManager.add('wp_posts_carousel_button', function(ed, url) {
            ed.addButton('wp_posts_carousel_button', {
                title : 'WP Posts Carousel',
                image : url+'/../images/shortcode-icon.png',
                onclick : function() {
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 750 : width - 50;
                    H = H - 150;                       
                    tb_show('WP Posts Carousel','admin-ajax.php?action=wp_posts_carousel_shortcode_generator&width=' + W + '&height=' + H );
               }
            });        
    });
})();