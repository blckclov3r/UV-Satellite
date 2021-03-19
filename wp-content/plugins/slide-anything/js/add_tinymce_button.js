/*
############################################################################
### SLIDE ANYTHING PLUGIN - JAVASCRIPT/JQUERY FOR TINYMCE EDITOR BUTTOND ###
############################################################################
*/
(function() {
	tinymce.PluginManager.add('tinymce_button', function(editor, url) {
		// get a list of shortcode values from previously defined array 'sa_title_arr' and 'sa_id_arr'
		var shortcode_values = [];
		jQuery.each(sa_title_arr, function(i) {
			shortcode_values.push({text: sa_title_arr[i], value:sa_id_arr[i]});
		});

		// add TinyMCE editor button, which opens a popup containing a dropdown list of slider titles
		// when a slider title is selected the corresponing SA shortcode is generated and displayed within the editor content
		editor.addButton('tinymce_button', {
			title: 'Slide Anything Sliders',
			type: 'menubutton',
			icon: 'icon dashicons-images-alt2',
			onClick: function() {
				editor.windowManager.open({
					title: 'Insert Slider Anywhere Shortcode',
					body: [{
						type: 'listbox',
						name: 'sa_id',
						label: 'Slider Title',
						values: shortcode_values
					}],
					onsubmit: function(e) {
						editor.insertContent("[slide-anything id='" + e.data.sa_id + "']");
					}
				});
			}
		});
	});
})();
