/*
Author: Marcin Gierada
Author URI: http://www.teastudio.pl/
Author Email: m.gierada@teastudio.pl
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
(function($, window, document) {
    $(document).ready(function() {
        $('body').on('change keyup', '.wp-posts-carousel-field.field-validate', function(event) {
            var plugin_field = $(this);

            if ( plugin_field.val() != '' ) {
                if ( typeof plugin_field.attr('pattern') !== typeof undefined && plugin_field.attr('pattern') !== false ) {
                    var reg = new RegExp( plugin_field.attr('pattern') );
                    if ( reg.test( plugin_field.val() ) ) {
                        $(this).removeClass('field-invalid');
                    } else {
                        $(this).addClass('field-invalid');
                    }
                }
            } else {
                if ( typeof plugin_field.attr('required') !== typeof undefined && plugin_field.attr('required') !== false ) {
                    $(this).addClass('field-invalid');
                } else {
                    $(this).removeClass('field-invalid');
                }
            }
        });
    });
})( jQuery );