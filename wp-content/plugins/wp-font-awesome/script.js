(function() {
  tinymce.PluginManager.add('shortcode_wp_font_awesome_insert', function( editor, url ) {

  	editor.addButton( 'shortcode_wp_font_awesome_insert', {
			text: 'WP Font Awesome',
	    type: 'menubutton',
	    tooltip: 'Add WP FontAwesome Shortcodes',
	    menu: [
	    	{
          text: 'Solid Icons',
          icon: 'icon dashicons-lightbulb',
          value: '[wpfa5s icon="fa-address-book"]',
          onclick: function(e) {
            e.stopPropagation();
            editor.insertContent(this.value());
          }       
     		},
     		{
          text: 'Regular Icons',
          icon: 'icon dashicons-forms',
          value: '[wpfa5r icon="user"]',
          onclick: function(e) {
            e.stopPropagation();
            editor.insertContent(this.value());
          }       
     		},
     		{
          text: 'Brands Icons',
          icon: 'icon dashicons-wordpress',
          value: '[wpfa5b icon="facebook"]',
          onclick: function(e) {
            e.stopPropagation();
            editor.insertContent(this.value());
          }       
     		},
     		{
          text: 'Color Icons',
          icon: 'icon dashicons-art',
          value: '[wpfa5b icon="facebook" color="#336699"]',
          onclick: function(e) {
            e.stopPropagation();
            editor.insertContent(this.value());
          }       
     		},
     		{
          text: 'Sizes',
          icon: 'icon dashicons-editor-expand',
          menu: [
            {
              text: '2x',
              value: '[wpfa5b icon="facebook" size="2x"]',
              onclick: function(e) {
                e.stopPropagation();
                editor.insertContent(this.value());
              }       
            },
            {
              text: '3x',
              value: '[wpfa5b icon="facebook" size="3x"]',
              onclick: function(e) {
                e.stopPropagation();
                editor.insertContent(this.value());
              }       
            },
            {
              text: '4x',
              value: '[wpfa5b icon="facebook" size="4x"]',
              onclick: function(e) {
                e.stopPropagation();
                editor.insertContent(this.value());
              }       
            },
            {
              text: '5x',
              value: '[wpfa5b icon="facebook" size="5x"]',
              onclick: function(e) {
                e.stopPropagation();
                editor.insertContent(this.value());
              }       
            },
            {
              text: '7x',
              value: '[wpfa5b icon="facebook" size="7x"]',
              onclick: function(e) {
                e.stopPropagation();
                editor.insertContent(this.value());
              }       
            },
            {
              text: '10x',
              value: '[wpfa5b icon="facebook" size="10x"]',
              onclick: function(e) {
                e.stopPropagation();
                editor.insertContent(this.value());
              }       
            },
          ]
        },
      ]
  	});

  });
})();