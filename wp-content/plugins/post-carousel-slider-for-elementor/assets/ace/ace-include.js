( function( global, $ ) {
    if( jQuery('#wb_ps_custom_css').length > 0 ){
        var custom_css_editor,
            syncCSS = function() {
                $( '#custom_css_textarea' ).val( custom_css_editor.getSession().getValue() );
            },
            loadAce = function() {
                custom_css_editor = ace.edit( 'wb_ps_custom_css' );
                global.safecss_editor = custom_css_editor;
                custom_css_editor.getSession().setUseWrapMode( true );
                custom_css_editor.setShowPrintMargin( false );
                custom_css_editor.setTheme( false );
                custom_css_editor.getSession().setValue( $( '#custom_css_textarea' ).val() );
                custom_css_editor.getSession().setMode( "ace/mode/css" );
                jQuery.fn.spin&&$( '#custom_css_container' ).spin( false );
                $( '#custom_css_form' ).submit( syncCSS );
            };

        $( global ).load( loadAce );
        global.aceSyncCSS = syncCSS;
    }

    if( jQuery('#wb_ps_custom_js').length > 0 ){
        var custom_js_editor,
            syncJS = function() {
                $( '#custom_js_textarea' ).val( custom_js_editor.getSession().getValue() );
            },
            loadAceJS = function() {
                custom_js_editor = ace.edit( 'wb_ps_custom_js' );
                global.safejs_editor = custom_js_editor;
                custom_js_editor.getSession().setUseWrapMode( true );
                custom_js_editor.setShowPrintMargin( false );
                custom_js_editor.setTheme( false );
                custom_js_editor.getSession().setValue( $( '#custom_js_textarea' ).val() );
                custom_js_editor.getSession().setMode( "ace/mode/javascript" );
                jQuery.fn.spin&&$( '#custom_js_container' ).spin( false );
                $( '#custom_js_form' ).submit( syncJS );
            };
        $( global ).load( loadAceJS );
        global.aceSyncJS = syncJS;
    }
} )( this, jQuery );