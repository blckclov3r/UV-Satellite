(function() {
    tinymce.create('tinymce.plugins.wp_posts_carousel_button', {
        init : function(ed, url) {
            ed.addButton('wp_posts_carousel_button', {
                title : 'WP Posts Carousel',
                image : url+'/../images/shortcode-icon.png',
                onclick : function() {
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = 300;
                    tb_show('WP Posts Carousel','admin-ajax.php?action=wp_posts_carousel_shortcode_generator&width=' + W + '&height=' + H );
               }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('wp_posts_carousel_button', tinymce.plugins.wp_posts_carousel_button);
})();