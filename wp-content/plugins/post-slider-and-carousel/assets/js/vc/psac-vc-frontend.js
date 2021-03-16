(function ( $ ) { 

	window.InlineShortcodeView_vc_column_text = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_vc_column_text.__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function (){
				if( typeof this.psac_iframe.common === 'function' ) {
					this.psac_iframe.common( model_id );
				}
			});
			return this;
		}
	});

	window.InlineShortcodeView_vc_raw_html = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window.InlineShortcodeView_vc_raw_html.__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function (){
				if( typeof this.psac_iframe.common === 'function' ) {
					this.psac_iframe.common( model_id );
				}
			});
			return this;
		}
	});

})( window.jQuery );