// ##################################################################
// ### SLIDE ANYTHING PLUGIN - JAVASCRIPT FOR WORDPRESS DASHBOARD ###
// ##################################################################

jQuery(function() {
	// ##### JQUERY-UI TOOLTIPS #####
	jQuery(".sa_tooltip").tooltip();

	// ##### JQUERY-UI - SLIDE DURATION SLIDER/INPUT #####
	var init_value = jQuery("#sa_slide_duration").val();
	jQuery("#jq_slider_duration").slider({
		range:"max",
		min:0,
		max:30,
		step:0.1,
		value:init_value,
		slide:function(event, ui) {
			jQuery("#sa_slide_duration").val(ui.value);
		}
	});
	jQuery("#sa_slide_duration").val(jQuery("#jq_slider_duration").slider("value"));

	// ##### JQUERY-UI - SLIDE BY SLIDER/INPUT #####
	var init_value = jQuery("#sa_slide_by").val();
	jQuery("#jq_slider_by").slider({
		range:"max",
		min:0,
		max:12,
		step:1,
		value:init_value,
		slide:function(event, ui) {
			jQuery("#sa_slide_by").val(ui.value);
		}
	});
	jQuery("#sa_slide_by").val(jQuery("#jq_slider_by").slider("value"));
	
	// ##### JQUERY-UI - SLIDE TRANSITION SLIDER/INPUT #####
	var init_value = jQuery("#sa_slide_transition").val();
	jQuery("#jq_slider_transition").slider({
		range:"max",
		min:0,
		max:3,
		step:0.1,
		value:init_value,
		slide:function(event, ui) {
			jQuery("#sa_slide_transition").val(ui.value);
		}
	});
	jQuery("#sa_slide_transition").val(jQuery("#jq_slider_transition").slider("value"));
	
	// ##### CHANGE EVENT HANDLER FOR 'Disable Visual Editor' CHECKBOX #####
	jQuery('#sa_disable_visual_editor').change(function() {
		// save the custom post type
		jQuery('#sa_disable_visual_editor').css('cursor', 'wait');
		jQuery('body').css('cursor', 'wait');
		jQuery('#publish').click();
	})
	
	// ##### JQUERY-UI ACCORDION CONTAINING CONTENT FOR ALL SLIDES #####
	jQuery("#slider_accordion").accordion({
		heightStyle: "content"
	});

	// ##### JQUERY-UI TABS FOR EACH SLIDE #####
	var slide_count = jQuery("#num_slides_id").val();
	for (i = 1; i <= slide_count; i++) {
		var slide_tabs_id = 'slide_' + i + '_tabs';
		jQuery('#' + slide_tabs_id).tabs();
		change_slide_popup_background(i);
	}

	// ##### CLICK EVENT HANDLER FOR THE 'Add Slide' BUTTON #####
	// increment the hidden 'number of slides' input field and save the custom post type
	jQuery('#sa_add_slide').click(function() {
		var num = jQuery("#num_slides_id").val();
		var num = parseInt(num) + 1;
		jQuery("#num_slides_id").val(num);
		// set hidden input field to notify that a status message must be displayed
		var info_added = document.getElementById('sa_info_added');
		info_added.value = "1";
		// save the custom post type	
		jQuery('#sa_add_slide').css('cursor', 'wait');
		jQuery('body').css('cursor', 'wait');
		jQuery('#publish').click();
	});
	
	// ##### CLICK EVENT HANDLER FOR THE SHORTCODE 'Copy to Clipboard' BUTTON #####
	jQuery('#sa_shortcode_copy').click(function() {
		var shortcode = document.getElementById('sa_slider_shortcode').innerHTML;
		var aux = document.createElement("input"); // Create a "hidden" input
		aux.setAttribute("value", shortcode); // Assign it the value of the specified element
		document.body.appendChild(aux); // Append it to the body
		aux.select(); // Highlight its content
		document.execCommand("copy"); // Copy the highlighted text
		document.body.removeChild(aux); // Remove it from the body
		// DISPLAY 'Shortcode Copied' message 
		document.getElementById('sa_slider_shortcode').innerHTML = "Copied!";
		setTimeout(function(){ document.getElementById('sa_slider_shortcode').innerHTML = shortcode; }, 1000);
	});
	
	// ##### CHANGE EVENT HANDLER FOR CSS ID INPUT BOX #####
	jQuery('#sa_css_id').change(function() {
		var css_id = document.getElementById('sa_css_id').value;
		document.getElementById('css_note_value').innerHTML = '#' + css_id + ' .owl-item';
	});

	// ##### CLICK EVENT HANDLER FOR THE CSS SELECTOR 'Copy to Clipboard' BUTTON #####
	jQuery('#css_note_value').click(function() {
		var css_selector = document.getElementById('css_note_value').innerHTML;
		var aux = document.createElement("input"); // Create a "hidden" input
		aux.setAttribute("value", css_selector); // Assign it the value of the specified element
		document.body.appendChild(aux); // Append it to the body
		aux.select(); // Highlight its content
		document.execCommand("copy"); // Copy the highlighted text
		document.body.removeChild(aux); // Remove it from the body
		// DISPLAY 'Shortcode Copied' message
		document.getElementById('css_note_value').innerHTML = "Copied!";
		setTimeout(function(){ document.getElementById('css_note_value').innerHTML = css_selector; }, 1000);
	});

	// ##### SPECTRUM COLOR PICKER - SLIDER BACKGROUND COLOR #####
	if (document.getElementById('sa_background_color')) {
		var background_color = document.getElementById('sa_background_color').value;
		jQuery("#sa_background_color").spectrum({
			showPaletteOnly: true,
			togglePaletteOnly: true,
			togglePaletteMoreText: 'more',
			togglePaletteLessText: 'less',
			showInput: true,
			allowEmpty:true,
			preferredFormat: "rgb",
			showAlpha: true,
			color: background_color,
			palette: [
				["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
				["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
				["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
				["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
				["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
				["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
				["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
				["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
			]
		});
	}
	
	// ##### JQUERY-UI SPINNER - SLIDER BORDER WIDTH #####
	jQuery("#sa_border_width").spinner({
		step: 1,
		min: 0,
		max: 10,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - SLIDER BORDER WIDTH #####
	jQuery('#sa_border_width').change(function() {
		var border_width = document.getElementById('sa_border_width').value;
		if (jQuery.isNumeric(border_width)) {
			if ((border_width >= 0) && (border_width <= 10)) {
				// valid number
			} else {
				document.getElementById('sa_border_width').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_border_width').value = '0'; // not a valid number
		}
	});
	// ##### SPECTRUM COLOR PICKER - SLIDER BORDER COLOR #####
	if (document.getElementById('sa_border_color')) {
		var border_color = document.getElementById('sa_border_color').value;
		jQuery("#sa_border_color").spectrum({
			showPaletteOnly: true,
			togglePaletteOnly: true,
			togglePaletteMoreText: 'more',
			togglePaletteLessText: 'less',
			showInput: true,
			allowEmpty:true,
			preferredFormat: "rgb",
			showAlpha: true,
			color: border_color,
			palette: [
				["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
				["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
				["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
				["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
				["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
				["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
				["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
				["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
			]
		});
	}
	
	// ##### JQUERY-UI SPINNER - SLIDER BORDER RADIUS #####
	jQuery("#sa_border_radius").spinner({
		step: 1,
		min: 0,
		max: 20,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - SLIDER BORDER RADIUS #####
	jQuery('#sa_border_radius').change(function() {
		var border_radius = document.getElementById('sa_border_radius').value;
		if (jQuery.isNumeric(border_radius)) {
			if ((border_radius >= 0) && (border_radius <= 20)) {
				// valid number
			} else {
				document.getElementById('sa_border_radius').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_border_radius').value = '0'; // not a valid number
		}
	});
	
	// ##### JQUERY-UI SPINNERS - WRAPPER PADDING (TOP, RIGHT, BOTTOM, LEFT) #####
	jQuery("#sa_wrapper_padd_top").spinner({ step: 1, min: 0, max: 99, numberFormat: "n" });
	jQuery("#sa_wrapper_padd_right").spinner({ step: 1, min: 0, max: 99, numberFormat: "n" });
	jQuery("#sa_wrapper_padd_bottom").spinner({ step: 1, min: 0, max: 99, numberFormat: "n" });
	jQuery("#sa_wrapper_padd_left").spinner({ step: 1, min: 0, max: 99, numberFormat: "n" });
	// ##### CHANGE EVENT HANDLER - WRAPPER PADDING TOP #####
	jQuery('#sa_wrapper_padd_top').change(function() {
		var wrapper_padding = document.getElementById('sa_wrapper_padd_top').value;
		if (jQuery.isNumeric(wrapper_padding)) {
			if ((wrapper_padding >= 0) && (wrapper_padding <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_wrapper_padd_top').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_wrapper_padd_top').value = '0'; // not a valid number
		}
	});
	// ##### CHANGE EVENT HANDLER - WRAPPER PADDING RIGHT #####
	jQuery('#sa_wrapper_padd_right').change(function() {
		var wrapper_padding = document.getElementById('sa_wrapper_padd_right').value;
		if (jQuery.isNumeric(wrapper_padding)) {
			if ((wrapper_padding >= 0) && (wrapper_padding <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_wrapper_padd_right').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_wrapper_padd_right').value = '0'; // not a valid number
		}
	});
	// ##### CHANGE EVENT HANDLER - WRAPPER PADDING BOTTOM #####
	jQuery('#sa_wrapper_padd_bottom').change(function() {
		var wrapper_padding = document.getElementById('sa_wrapper_padd_bottom').value;
		if (jQuery.isNumeric(wrapper_padding)) {
			if ((wrapper_padding >= 0) && (wrapper_padding <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_wrapper_padd_bottom').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_wrapper_padd_bottom').value = '0'; // not a valid number
		}
	});
	// ##### CHANGE EVENT HANDLER - WRAPPER PADDING LEFT #####
	jQuery('#sa_wrapper_padd_left').change(function() {
		var wrapper_padding = document.getElementById('sa_wrapper_padd_left').value;
		if (jQuery.isNumeric(wrapper_padding)) {
			if ((wrapper_padding >= 0) && (wrapper_padding <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_wrapper_padd_left').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_wrapper_padd_left').value = '0'; // not a valid number
		}
	});

	// ##### CHANGE EVENT FOR SLIDE MINIMUM HEIGHT RADIO BUTTONS #####
	jQuery('.sa_slide_min_height_type').change(function() {
		var slide_min_height_type = this.value;
		if (slide_min_height_type == "percent") {
			document.getElementById('sa_slide_min_height').value = document.getElementById('sa_slide_min_height_hidden').value;
			document.getElementById('sa_slide_min_height_wrapper').style.display = 'block';
			document.getElementById('mh_suffix').innerHTML = '%';
		} else if (slide_min_height_type == 'px') {
			document.getElementById('sa_slide_min_height').value = document.getElementById('sa_slide_min_height_hidden').value;
			document.getElementById('sa_slide_min_height_wrapper').style.display = 'block';
			document.getElementById('mh_suffix').innerHTML = 'px';
		} else if (slide_min_height_type == '43') {
			document.getElementById('sa_slide_min_height').value = 'aspect43';
			document.getElementById('sa_slide_min_height_wrapper').style.display = 'none';
		} else if (slide_min_height_type == '169') {
			document.getElementById('sa_slide_min_height').value = 'aspect169';
			document.getElementById('sa_slide_min_height_wrapper').style.display = 'none';
		}
	});

	// ##### JQUERY-UI SPINNER FOR SLIDE MINIMUM HEIGHT (PIXELS) #####
	jQuery("#sa_slide_min_height").spinner({
		step: 1,
		min: 0,
		max: 999,
		numberFormat: "n"
	});
	jQuery('#sa_slide_min_height_wrapper .ui-spinner-button').click(function() {
		jQuery(this).siblings('input').change();
	});
	// ##### CHANGE EVENT HANDLER FOR SLIDE MINIMUM HEIGHT (PERCENT/PIXELS) #####
	jQuery('#sa_slide_min_height').change(function() {
		var slide_min_height = document.getElementById('sa_slide_min_height').value;
		var min_height_type = jQuery('input[name=sa_slide_min_height_type]:checked').val();
		if (jQuery.isNumeric(slide_min_height)) {
			if ((slide_min_height >= 0) && (slide_min_height <= 999)) {
				// valid number
				if (min_height_type == 'percent') {
					document.getElementById('sa_slide_min_height_hidden').value = slide_min_height;
				} else {
					document.getElementById('sa_slide_min_height_hidden').value = slide_min_height + 'px';
				}
			} else {
				document.getElementById('sa_slide_min_height').value = '0'; // number out of range
				document.getElementById('sa_slide_min_height_hidden').value = '0';
			}
		} else {
			document.getElementById('sa_slide_min_height').value = '0'; // not a valid number
			document.getElementById('sa_slide_min_height_hidden').value = '0';
		}
	});

	// ##### JQUERY-UI SPINNER FOR SLIDE PADDING TOP/BOTTOM #####
	jQuery("#sa_slide_padding_tb").spinner({
		step: 0.1,
		min: 0,
		max: 30,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER FOR SLIDE PADDING TOP/BOTTOM #####
	jQuery('#sa_slide_padding_tb').change(function() {
		var slide_padding_tb = document.getElementById('sa_slide_padding_tb').value;
		if (jQuery.isNumeric(slide_padding_tb)) {
			if ((slide_padding_tb >= 0) && (slide_padding_tb <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_slide_padding_tb').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_slide_padding_tb').value = '0'; // not a valid number
		}
	});
	
	// ##### JQUERY-UI SPINNER FOR SLIDE PADDING LEFT/RIGHT #####
	jQuery("#sa_slide_padding_lr").spinner({
		step: 0.1,
		min: 0,
		max: 30,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER FOR SLIDE PADDING LEFT/RIGHT #####
	jQuery('#sa_slide_padding_lr').change(function() {
		var slide_padding_lr = document.getElementById('sa_slide_padding_lr').value;
		if (jQuery.isNumeric(slide_padding_lr)) {
			if ((slide_padding_lr >= 0) && (slide_padding_lr <= 30)) {
				// valid number
			} else {
				document.getElementById('sa_slide_padding_lr').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_slide_padding_lr').value = '0'; // not a valid number
		}
	});
	
	// ##### JQUERY-UI SPINNER FOR SLIDE MARGIN LEFT/RIGHT #####
	jQuery("#sa_slide_margin_lr").spinner({
		step: 0.1,
		min: 0,
		max: 20,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER FOR SLIDE MARGIN LEFT/RIGHT #####
	jQuery('#sa_slide_margin_lr').change(function() {
		var slide_margin_lr = document.getElementById('sa_slide_margin_lr').value;
		if (jQuery.isNumeric(slide_margin_lr)) {
			if ((slide_margin_lr >= 0) && (slide_margin_lr <= 20)) {
				// valid number
			} else {
				document.getElementById('sa_slide_margin_lr').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_slide_margin_lr').value = '0'; // not a valid number
		}
	});

	// ##### CHANGE EVENT FOR ANY OF THE ITEMS DISPLAYED DROPDOWNS #####
	jQuery("select[name='sa_items_width1']").change(function() { items_displayed_changed(); });
	jQuery("select[name='sa_items_width2']").change(function() { items_displayed_changed(); });
	jQuery("select[name='sa_items_width3']").change(function() { items_displayed_changed(); });
	jQuery("select[name='sa_items_width4']").change(function() { items_displayed_changed(); });
	jQuery("select[name='sa_items_width5']").change(function() { items_displayed_changed(); });
	jQuery("select[name='sa_items_width6']").change(function() { items_displayed_changed(); });

	// ##### CHANGE EVENT FOR 'Hero Slider' CHECKBOX #####
	jQuery('#sa_hero_slider').click(function() {
		if (document.getElementById('sa_hero_slider').checked) {
			document.getElementById('sa_hero_slider_note').style.display = 'block';
		} else {
			document.getElementById('sa_hero_slider_note').style.display = 'none';
		}
	});

	// ##### CHANGE EVENT FOR 'Showcase Carousel' CHECKBOX #####
	jQuery('#sa_showcase_slider').click(function() {
		if (document.getElementById('sa_showcase_slider').checked) {
			document.getElementById('sa_showcase_slider_pro').style.display = 'block';
		} else {
			document.getElementById('sa_showcase_slider_pro').style.display = 'none';
		}
	});

	// ##### JQUERY-UI SPINNER - SHOWCASE CAROUSEL CONTAINER WIDTH #####
	jQuery("#sa_showcase_width").spinner({
		step: 1,
		min: 100,
		max: 180,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - SHOWCASE CAROUSEL CONTAINER WIDTH #####
	jQuery('#sa_showcase_width').change(function() {
		var showcase_width = document.getElementById('sa_showcase_width').value;
		if (jQuery.isNumeric(showcase_width)) {
			if ((showcase_width >= 100) && (showcase_width <= 180)) {
				// valid number
			} else {
				document.getElementById('sa_showcase_width').value = '120'; // number out of range
			}
		} else {
			document.getElementById('sa_showcase_width').value = '120'; // not a valid number
		}
	});

	// ##### JQUERY-UI SPINNER - SHOWCASE CAROUSEL CONTAINER WIDTH (TABLET) #####
	jQuery("#sa_showcase_width_tab").spinner({
		step: 1,
		min: 100,
		max: 180,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - SHOWCASE CAROUSEL CONTAINER WIDTH (TABLET) #####
	jQuery('#sa_showcase_width_tab').change(function() {
		var showcase_width_tab = document.getElementById('sa_showcase_width_tab').value;
		if (jQuery.isNumeric(showcase_width_tab)) {
			if ((showcase_width_tab >= 100) && (showcase_width_tab <= 180)) {
				// valid number
			} else {
				document.getElementById('sa_showcase_width_tab').value = '130'; // number out of range
			}
		} else {
			document.getElementById('sa_showcase_width_tab').value = '130'; // not a valid number
		}
	});

	// ##### JQUERY-UI SPINNER - SHOWCASE CAROUSEL CONTAINER WIDTH (MOBILE) #####
	jQuery("#sa_showcase_width_mob").spinner({
		step: 1,
		min: 100,
		max: 180,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - SHOWCASE CAROUSEL CONTAINER WIDTH (MOBILE) #####
	jQuery('#sa_showcase_width_mob').change(function() {
		var showcase_width_mob = document.getElementById('sa_showcase_width_mob').value;
		if (jQuery.isNumeric(showcase_width_mob)) {
			if ((showcase_width_mob >= 100) && (showcase_width_mob <= 180)) {
				// valid number
			} else {
				document.getElementById('sa_showcase_width_mob').value = '140'; // number out of range
			}
		} else {
			document.getElementById('sa_showcase_width_mob').value = '140'; // not a valid number
		}
	});

	// ##### CLICK EVENT HANDLER FOR THE SHOWCASE CSS 'Copy to Clipboard' BUTTON #####
	jQuery('#ss_css_value').click(function() {
		var css_selector = document.getElementById('ss_css_value').innerHTML;
		var aux = document.createElement("input"); // Create a "hidden" input
		aux.setAttribute("value", css_selector); // Assign it the value of the specified element
		document.body.appendChild(aux); // Append it to the body
		aux.select(); // Highlight its content
		document.execCommand("copy"); // Copy the highlighted text
		document.body.removeChild(aux); // Remove it from the body
		// DISPLAY 'Shortcode Copied' message
		document.getElementById('ss_css_value').innerHTML = "Copied!";
		setTimeout(function(){ document.getElementById('ss_css_value').innerHTML = css_selector; }, 1000);
	});

	// ##### CHANGE EVENT FOR 'Use Thumbnail Pagination' CHECKBOX #####
	jQuery('#sa_thumbs_active').click(function() {
		if (document.getElementById('sa_thumbs_active').checked) {
			document.getElementById('sa_thumbs_settings').style.display = 'block';
			jQuery('#sa_pagination').prop('checked', false); // uncheck 'Show Pagination' checkbox
		} else {
			document.getElementById('sa_thumbs_settings').style.display = 'none';
		}
	});

	// ##### JQUERY-UI SPINNER - THUMBS CONTAINER PADDING #####
	jQuery("#sa_thumbs_padding").spinner({
		step: 0.1,
		min: 0,
		max: 10,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER FOR THUMBS CONTAINER PADDING #####
	jQuery('#sa_thumbs_padding').change(function() {
		var thumbs_padding = document.getElementById('sa_thumbs_padding').value;
		if (jQuery.isNumeric(thumbs_padding)) {
			if ((thumbs_padding >= 0) && (thumbs_padding <= 10)) {
				// valid number
			} else {
				document.getElementById('sa_thumbs_padding').value = '3'; // number out of range
			}
		} else {
			document.getElementById('sa_thumbs_padding').value = '3'; // not a valid number
		}
	});

	// ##### JQUERY-UI SPINNER - THUMBS WIDTH #####
	jQuery("#sa_thumbs_width").spinner({
		step: 1,
		min: 10,
		max: 300,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - THUMBS WIDTH #####
	jQuery('#sa_thumbs_width').change(function() {
		var thumbs_width = document.getElementById('sa_thumbs_width').value;
		if (jQuery.isNumeric(thumbs_width)) {
			if ((thumbs_width >= 10) && (thumbs_width <= 300)) {
				// valid number
			} else {
				document.getElementById('sa_thumbs_width').value = '150'; // number out of range
			}
		} else {
			document.getElementById('sa_thumbs_width').value = '150'; // not a valid number
		}
	});

	// ##### JQUERY-UI SPINNER - THUMBS HEIGHT #####
	jQuery("#sa_thumbs_height").spinner({
		step: 1,
		min: 10,
		max: 300,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - THUMBS HEIGHT #####
	jQuery('#sa_thumbs_height').change(function() {
		var thumbs_height = document.getElementById('sa_thumbs_height').value;
		if (jQuery.isNumeric(thumbs_height)) {
			if ((thumbs_height >= 10) && (thumbs_height <= 300)) {
				// valid number
			} else {
				document.getElementById('sa_thumbs_height').value = '85'; // number out of range
			}
		} else {
			document.getElementById('sa_thumbs_height').value = '85'; // not a valid number
		}
	});

	// ##### JQUERY-UI SPINNER - THUMBS OPACITY #####
	jQuery("#sa_thumbs_opacity").spinner({
		step: 1,
		min: 0,
		max: 100,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - THUMBS OPACITY #####
	jQuery('#sa_thumbs_opacity').change(function() {
		var thumbs_opacity = document.getElementById('sa_thumbs_opacity').value;
		if (jQuery.isNumeric(thumbs_opacity)) {
			if ((thumbs_opacity >= 0) && (thumbs_opacity <= 100)) {
				// valid number
			} else {
				document.getElementById('sa_thumbs_opacity').value = '50'; // number out of range
			}
		} else {
			document.getElementById('sa_thumbs_opacity').value = '50'; // not a valid number
		}
	});

	// ##### JQUERY-UI SPINNER - THUMBS BORDER WIDTH #####
	jQuery("#sa_thumbs_border_width").spinner({
		step: 1,
		min: 0,
		max: 10,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - THUMBS BORDER WIDTH #####
	jQuery('#sa_thumbs_border_width').change(function() {
		var thumbs_border_width = document.getElementById('sa_thumbs_border_width').value;
		if (jQuery.isNumeric(thumbs_border_width)) {
			if ((thumbs_border_width >= 0) && (thumbs_border_width <= 10)) {
				// valid number
			} else {
				document.getElementById('sa_thumbs_border_width').value = '0'; // number out of range
			}
		} else {
			document.getElementById('sa_thumbs_border_width').value = '0'; // not a valid number
		}
	});

	// ##### SPECTRUM COLOR PICKER - THUMBS BORDER COLOR #####
	if (document.getElementById('sa_thumbs_border_color')) {
		var thumbs_border_color = document.getElementById('sa_thumbs_border_color').value;
		jQuery("#sa_thumbs_border_color").spectrum({
			showPaletteOnly: true,
			togglePaletteOnly: true,
			togglePaletteMoreText: 'more',
			togglePaletteLessText: 'less',
			showInput: true,
			allowEmpty:true,
			preferredFormat: "rgb",
			showAlpha: true,
			color: thumbs_border_color,
			palette: [
				["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
				["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
				["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
				["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
				["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
				["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
				["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
				["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
			]
		});
	}

	// ##### JQUERY-UI SPINNER - TABLET THUMBS SIZE (PERCENTAGE) #####
	jQuery("#sa_thumbs_resp_tablet").spinner({
		step: 1,
		min: 0,
		max: 100,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - TABLET THUMBS SIZE (PERCENTAGE) #####
	jQuery('#sa_thumbs_resp_tablet').change(function() {
		var thumbs_resp_tablet = document.getElementById('sa_thumbs_resp_tablet').value;
		if (jQuery.isNumeric(thumbs_resp_tablet)) {
			if ((thumbs_resp_tablet >= 0) && (thumbs_resp_tablet <= 100)) {
				// valid number
			} else {
				document.getElementById('sa_thumbs_resp_tablet').value = '75'; // number out of range
			}
		} else {
			document.getElementById('sa_thumbs_resp_tablet').value = '75'; // not a valid number
		}
	});

	// ##### JQUERY-UI SPINNER - MOBILE THUMBS SIZE (PERCENTAGE) #####
	jQuery("#sa_thumbs_resp_mobile").spinner({
		step: 1,
		min: 0,
		max: 100,
		numberFormat: "n"
	});
	// ##### CHANGE EVENT HANDLER - MOBILE THUMBS SIZE (PERCENTAGE) #####
	jQuery('#sa_thumbs_resp_mobile').change(function() {
		var thumbs_resp_mobile = document.getElementById('sa_thumbs_resp_mobile').value;
		if (jQuery.isNumeric(thumbs_resp_mobile)) {
			if ((thumbs_resp_mobile >= 0) && (thumbs_resp_mobile <= 100)) {
				// valid number
			} else {
				document.getElementById('sa_thumbs_resp_mobile').value = '50'; // number out of range
			}
		} else {
			document.getElementById('sa_thumbs_resp_mobile').value = '50'; // not a valid number
		}
	});
	
	
	
	// ################################
	// ##### RE-ORDER SLIDES PAGE #####
	// ################################
	
	// ##### RE-ORDER SLIDES PAGE - JQUERY-UI SORTABLE ELEMENT #####
	jQuery("#sar_sortable").sortable({
		placeholder: 'ui-state-highlight',
		cursor: 'move',
		opacity: 0.7,
		update: function(event, ui) {
			var slide_order = jQuery(this).sortable('toArray').toString();
			slide_order = slide_order.replace(/sar/g, "");
			document.getElementById('sar_sort_order').value = slide_order;
		}
	});
	jQuery("#sar_sortable" ).disableSelection();
	
	// ##### RE-ORDER SLIDES PAGE - A 'DELETE SLIDE' CHECKBOX HAS BEEN CLICKED #####
	jQuery('.sar_del_checkbox').click(function(event) {
		var clicked_id = event.target.id;
		var del_list = '';
		
		// loop thought all 'delete slide' checkboxes looking for ones that have been checked
		jQuery('.sar_del_checkbox').each(function (index, value) {
			var checkbox_id = jQuery(this).attr('id');
			if (jQuery('#' + checkbox_id).is(":checked")) {
				var slide_no = checkbox_id.replace("sar_del", "");
				if (del_list != '') { del_list += ','; }
				del_list += slide_no;
			}
		});
		
		// update the hidden 'delete slides' input box in the form
		document.getElementById("sar_del_slides").value = del_list;
		
		if (del_list == '') {
			document.getElementById("sar_delete_but").style.display = 'none';
			document.getElementById("sar_update_but").style.display = 'inline-block';
		} else {	
			document.getElementById("sar_delete_but").style.display = 'inline-block';
			document.getElementById("sar_update_but").style.display = 'none';
		}
	});
	
	// ##### RE-ORDER SLIDES PAGE - 'UPDATE ORDER' BUTTON CLICKED #####
	jQuery('#sar_update_but').click(function(event) {
		document.getElementById("sar_del_slides").value = '';
	});
	
	// ##### RE-ORDER SLIDES PAGE - 'DELETE SLIDES' BUTTON CLICKED #####
	jQuery('#sar_delete_but').click(function(event) {
		document.getElementById("sar_sort_order").value = '';
	});
})



// ##### ONE OF THE ITEMS DISPLAYED DROPDOWNS HAVE CHANGED #####
function items_displayed_changed() {
	var width1 = jQuery("select[name='sa_items_width1']").val();
	var width2 = jQuery("select[name='sa_items_width2']").val();
	var width3 = jQuery("select[name='sa_items_width3']").val();
	var width4 = jQuery("select[name='sa_items_width4']").val();
	var width5 = jQuery("select[name='sa_items_width5']").val();
	var width6 = jQuery("select[name='sa_items_width6']").val();
	if ((width1 == '1') && (width2 == '1') && (width3 == '1') && (width4 == '1') && (width5 == '1') && (width6 == '1')) {
		jQuery(".sa_items_all_one").css("display","block");
		jQuery("#sa_showcase_slider_wrapper").css("display","none");
		jQuery('#sa_showcase_slider').prop('checked', false); // uncheck 'Showcase Carousel' checkbox
		jQuery("#sa_showcase_slider_pro").css("display","none");
	} else {
		jQuery(".sa_items_all_one").css("display","none");
		jQuery('#sa_hero_slider').prop('checked', false); // uncheck 'Hero Slider' checkbox
		jQuery("#sa_hero_slider_note").css("display","none");
		jQuery("#sa_showcase_slider_wrapper").css("display","block");
	}
}



// ##### CHANGE EVENT HANDLER FOR 'Use Popup Image as Slide Background' #####
function change_slide_popup_background(slide_no) {
	var pro_version = document.getElementById('sa_pro_version').value;
	if (pro_version == '1') {
		var curr_value = jQuery('#sa_slide'+slide_no+'_popup_background').val();
		if (curr_value != 'no') {
			jQuery("#slide"+slide_no+"_thumb").css("display", "none");
			jQuery("#slide"+slide_no+"_image_add").css("display", "none");
			jQuery("#slide"+slide_no+"_imagebg_popup").css("display", "block");
		} else {
			jQuery("#slide"+slide_no+"_thumb").css("display", "block");
			jQuery("#slide"+slide_no+"_image_add").css("display", "inline-block");
			jQuery("#slide"+slide_no+"_imagebg_popup").css("display", "none");
		}
	}
}



jQuery(function() {
	// THE VAIRABLE THAT HOLDS THE IFRAME FOR WORDPRESS MEDIA UPLOADS
	var frame;

	// ##### CLICK EVENT HANDLER - 'Set Background Image' LINK (BUTTON) FOR ALL SLIDES #####
	jQuery('.slide_image_add').click(function(event) {
		// GET THE SLIDE NUMBER (GET parameter within anchor 'href' attribute)
		var anchor_element = event.target;
		var upload_url = anchor_element.getAttribute('href');
		var split_arr = upload_url.split("&slide=");
		var slide_no = split_arr[1];

		// PREVENT THE ANCHOR LINK FROM OPENING HREF TARGET PAGE
		event.preventDefault();

		// SET THE HTML ELEMENTS TO BE USED WITHIN THIS FUNCTION
		var thumb_preview = "#slide" + slide_no + "_thumb div";
		var image_id = "#sa_slide" + slide_no + "_image_id";
		var del_img_but = "#slide" + slide_no + "_image_del";

		// CREATE A NEW MEDIA UPLOAD FRAME
		frame = wp.media({
			title: 'Select the background image for your slide',
			button: {
				text: 'Use selected image'
			},
			multiple: false  // only a single file may be selected
		});

		// AN IMAGE HAS BEEN SELECTED WITHIN THE MEDIA UPLOAD FRAME...
		frame.on('select', function() {
			// Get media attachment details from the frame state
			var attachment = frame.state().get('selection').first().toJSON();
			// Set the background image of the thumbnail preview DIV to the attachment URL
			if (attachment.sizes.medium && attachment.sizes.medium.url) {
				jQuery(thumb_preview).css('background-image', 'url(' + attachment.sizes.medium.url + ')');
			} else {
				jQuery(thumb_preview).css('background-image', 'url(' + attachment.sizes.full.url + ')');
			}
			// Send the attachment id to our hidden input box
			jQuery(image_id).val(attachment.id);
			// Unhide the delete image button
			jQuery(del_img_but).removeClass('sa_hidden');
		});
		// Finally, open the modal on click
		frame.open();
	});
})



// ##### CLICK EVENT HANDLER - 'Remove Background Image' BUTTON FOR ALL SLIDES #####
function remove_slide_bg_image(slide_no) {
	// SET THE HTML ELEMENTS TO BE USED WITHIN THIS FUNCTION
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	var image_id = "#sa_slide" + slide_no + "_image_id";
	var del_img_but = "#slide" + slide_no + "_image_del";

	// Reset the background image of the thumbnail preview div
	jQuery(thumb_preview).css('background-image', '');
	// Delete the image id from the hidden input
	jQuery(image_id).val('');
	// Hide the delete image button
	jQuery(del_img_but).addClass('sa_hidden');
}



// ##### CHANGE EVENT HANDLER - BACKGROUND POSITION DROPDOWN FOR ALL SLIDES #####
function change_slide_image_pos(slide_no) {
	var background_pos = document.getElementById("sa_slide" + slide_no + "_image_pos").value;
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	jQuery(thumb_preview).css('background-position', background_pos);
}



// ##### CHANGE EVENT HANDLER - BACKGROUND SIZE DROPDOWN FOR ALL SLIDES #####
function change_slide_image_size(slide_no) {
	var background_size = document.getElementById("sa_slide" + slide_no + "_image_size").value;
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	jQuery(thumb_preview).css('background-size', background_size);
}



// ##### CHANGE EVENT HANDLER - BACKGROUND REPEAT DROPDOWN FOR ALL SLIDES #####
function change_slide_image_repeat(slide_no) {
	var background_repeat = document.getElementById("sa_slide" + slide_no + "_image_repeat").value;
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	jQuery(thumb_preview).css('background-repeat', background_repeat);
}



jQuery(function() {
	if (document.getElementById('num_slides_id')) {
		var num_slides = parseInt(document.getElementById('num_slides_id').value);
		// ##### LOOP THRU EACH SLIDE #####
		for (i = 1; i <= num_slides; i++) {
			// ##### SPECTRUM COLOR PICKER - SLIDE BACKGROUND COLOR #####
			var color_picker_id = 'sa_slide' + i + '_image_color';
			var background_color = document.getElementById(color_picker_id).value;
			jQuery('#' + color_picker_id).spectrum({
				showPaletteOnly: true,
				togglePaletteOnly: true,
				togglePaletteMoreText: 'more',
				togglePaletteLessText: 'less',
				showInput: true,
				allowEmpty: true,
				preferredFormat: "rgb",
				showAlpha: true,
				color: background_color,
				palette: [
					["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
					["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
					["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
					["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
					["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
					["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
					["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
					["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
				]
			});
		}
	}
})
// ##### CHANGE EVENT HANDLER - SLIDE BACKGROUND COLOR PICKER #####
function change_slide_image_color(slide_no) {
	var background_color = document.getElementById("sa_slide" + slide_no + "_image_color").value;
	var thumb_preview = "#slide" + slide_no + "_thumb div";
	jQuery(thumb_preview).css('background-color', background_color);
}


// ##############################################
// ##### SLIDE POPUP TAB - IMAGE POPUP TYPE #####
// ##############################################

// ##### CHANGE EVENT HANDLER - SA POPUP TYPE #####
function change_slide_popup_type(slide_no) {
	var popup_type = document.getElementById("sa_slide" + slide_no + "_popup_type").value;
	var image_popup_wrapper = "#slide" + slide_no + "_image_popup_wrapper";
	var video_popup_wrapper = "#slide" + slide_no + "_video_popup_wrapper";
	var html_popup_wrapper = "#slide" + slide_no + "_html_popup_wrapper";
	if (popup_type == 'IMAGE') {
		jQuery(image_popup_wrapper).css('display', 'block');
		jQuery(video_popup_wrapper).css('display', 'none');
		jQuery(html_popup_wrapper).css('display', 'none');
	} else if (popup_type == 'VIDEO') {
		jQuery(image_popup_wrapper).css('display', 'none');
		jQuery(video_popup_wrapper).css('display', 'block');
		jQuery(html_popup_wrapper).css('display', 'none');
	} else if (popup_type == 'HTML') {
		jQuery(image_popup_wrapper).css('display', 'none');
		jQuery(video_popup_wrapper).css('display', 'none');
		jQuery(html_popup_wrapper).css('display', 'block');
	} else {
		jQuery(image_popup_wrapper).css('display', 'none');
		jQuery(video_popup_wrapper).css('display', 'none');
		jQuery(html_popup_wrapper).css('display', 'none');
	}
}

jQuery(function() {
	if (jQuery('#sa_pro_version').length > 0) {
		var pro_version = document.getElementById('sa_pro_version').value;
		if (pro_version == '1') {
			// THE VAIRABLE THAT HOLDS THE IFRAME FOR WORDPRESS MEDIA UPLOADS
			var frame;

			// ##### CLICK EVENT HANDLER - SLIDE IMAGE POPUP 'Set Image' BUTTON FOR ALL SLIDES #####
			jQuery('.popup_image_add').click(function(event) {
				// GET THE SLIDE NUMBER (GET parameter within anchor 'href' attribute)
				var anchor_element = event.target;
				var upload_url = anchor_element.getAttribute('href');
				var split_arr = upload_url.split("&popup=");
				var slide_no = split_arr[1];

				// PREVENT THE ANCHOR LINK FROM OPENING HREF TARGET PAGE
				event.preventDefault();

				// SET THE HTML ELEMENTS TO BE USED WITHIN THIS FUNCTION
				var thumb_preview = "#slide" + slide_no + "_popup_thumb";
				var image_id = "#sa_slide" + slide_no + "_popup_imageid";
				var del_img_but = "#slide" + slide_no + "_popup_image_del";
				var preview_img_but = "#slide" + slide_no + "_popup_image_preview";
				var info_dim = "#slide" + slide_no + "_popup_info_dim";
				var info_size = "#slide" + slide_no + "_popup_info_size";

				// CREATE A NEW MEDIA UPLOAD FRAME
				frame = wp.media({
					title: 'Select the popup image for your slide',
					button: {
						text: 'Use selected image'
					},
					multiple: false  // only a single file may be selected
				});

				// AN IMAGE HAS BEEN SELECTED WITHIN THE MEDIA UPLOAD FRAME...
				frame.on('select', function() {
					// Get media attachment details from the frame state
					var attachment = frame.state().get('selection').first().toJSON();
					// Set the image source of the thumbnail preview IMG to the attachment URL
					if (attachment.sizes.medium && attachment.sizes.medium.url) {
						jQuery(thumb_preview+" div").html("<img src='" + attachment.sizes.medium.url + "'/>");
					} else {
						jQuery(thumb_preview+" div").html("<img src='" + attachment.sizes.full.url + "'/>");
					}
					// Send the attachment id to our hidden input box
					jQuery(image_id).val(attachment.id);
					// Unhide the delete image button
					jQuery(del_img_but).removeClass('sa_hidden');
					// Set the image URL for the popup
					jQuery(preview_img_but + " a").attr("href", attachment.url);
					// Update image info for the popup image
					display_image_info(attachment.url, info_dim, info_size);
				});
				// Finally, open the modal on click
				frame.open();
			});
		}
	}
})

// ##### CLICK EVENT HANDLER - 'Remove Popup Image' BUTTON FOR ALL SLIDES #####
function remove_popup_image(slide_no, placeholder) {
	// SET THE HTML ELEMENTS TO BE USED WITHIN THIS FUNCTION
	var thumb_preview = "#slide" + slide_no + "_popup_thumb";
	var image_id = "#sa_slide" + slide_no + "_popup_imageid";
	var del_img_but = "#slide" + slide_no + "_popup_image_del";
	var preview_img_but = "#slide" + slide_no + "_popup_image_preview";
	var info_dim = "#slide" + slide_no + "_popup_info_dim";
	var info_size = "#slide" + slide_no + "_popup_info_size";

	// Reset the image source of the thumbnail preview div
	jQuery(thumb_preview+" div").html("<div><img src='" + placeholder + "'/></div>");
	// Delete the image id from the hidden input
	jQuery(image_id).val('');
	// Hide the delete image button
	jQuery(del_img_but).addClass('sa_hidden');
	// Set the image URL for the popup to a placeholder image
	jQuery(preview_img_but + " a").attr("href", placeholder);
	// clear image info
	jQuery(info_dim).html('<strong>Dimensions:</strong>');
	jQuery(info_size).html('<strong>File Size:</strong>');
}

// ##### CHANGE EVENT HANDLER - 'Popup Title' TEXT INPUT BOX #####
function change_popup_image_title(new_title, preview_img_but) {
	var preview_link = "#" + preview_img_but + " a";
	jQuery(preview_link).attr("title", new_title);
}

// ###### GET IMAGE INFO (WIDTH, HEIGHT, SIZE) FOR PROVIDED IMAGE URL AND DISPLAY WITHIN PROVIDED DIV ID ######
function display_image_info(image_url, info_dim, info_size) {
	var img = new Image();
	var img_width = 0;
	var img_height = 0;
	img.onload = function() {
		img_width = this.width;
		img_height = this.height;
		jQuery(info_dim).html("<strong>Dimensions:</strong> " + img_width + " x " + img_height + " pixels");
	};
	img.src = image_url;

	var request;
	request = jQuery.ajax({
		type: "HEAD",
		url: image_url,
		success: function () {
			var img_size = request.getResponseHeader("Content-Length");
			if ((img_size != '') && (img_size != 'null') && (img_size != 0)) {
				var unit = 'bytes';
				if (img_size > 1048576) {
					img_size = img_size / 1048576;
					img_size = Math.round(img_size * 10) / 10;
					unit = 'MB';
				} else if (img_size > 1024) {
					img_size = img_size / 1024;
					img_size = Math.round(img_size * 10) / 10;
					unit = 'kb';
				}
				jQuery(info_size).html("<strong>File Size:</strong> " + img_size + " " + unit);
			}
		}
	});
}



// ##############################################
// ##### SLIDE POPUP TAB - VIDEO POPUP TYPE #####
// ##############################################

// ##### CLICK EVENT HANDLER - SLIDE VIDEO POPUP 'Set Video' BUTTON #####
function update_popup_video(slide_no) {
	// Get the contents of video URL input box
	var video_url = document.getElementById("sa_slide" + slide_no + "_video_url").value;
	var preview_button = "#slide" + slide_no + "_popup_video_preview a";
	var video_type = '';
	if (video_url != '') {
		// Check if the URL is a valid YouTube URL - if so then extract YouTube ID
		var video_id = video_url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
		if (video_id != null) {
			valid_video_id = video_id[1];
			video_type = 'youtube';
		} else {
			// Check if the URL is a valid Vimeo URL - if so then extract Vimeo ID
			var regex = new RegExp(/(https?:\/\/)?(www.)?(player.)?vimeo.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/);
			if (regex.test(video_url)) {
				valid_video_id = regex.exec(video_url)[5];
				video_type = 'vimeo';
			} else {
				// URL entered is not a valid YouTube or Vimeo video URL
				document.getElementById("sa_slide" + slide_no + "_video_url").value = '';
				document.getElementById("sa_slide" + slide_no + "_video_invalid_url").style.display = "block";
				setTimeout(function(){ document.getElementById("sa_slide" + slide_no + "_video_invalid_url").style.display = "none"; }, 3000);
			}
		}
	}
	if (video_type == 'youtube') {
		// ##### SET SLIDE BACKGROUND IMAGE TO YOUTUBE THUMB IMAGE - 14 MAY 2020 - START #####
		// Get the YouTube video thumbnail image
		var youtube_thumb = "https://img.youtube.com/vi/" + valid_video_id + "/hqdefault.jpg";
		// Set the "Use Popup Image as Slide Background" dropdown to "No"
		var popup_bg_dropdown = "#sa_slide" + slide_no + "_popup_background";
		jQuery(popup_bg_dropdown).val('no');
		// Set the slide background "Set Image" button to be visible
		var set_image_button = "#slide" + slide_no + "_image_add";
		jQuery(set_image_button).css("display", "inline-block");
		// Set slide background IMAGE ID to 99999999 (this value indicates the YouTube thumb must be used) 
		var slide_image_id = "#sa_slide" + slide_no + "_image_id";
		jQuery(slide_image_id).val(99999999);
		// Set the slide background "Preview Image" DIV background image to the YouTube Thumbnail
		var slide_imagebg_popup = "#slide" + slide_no + "_imagebg_popup";
		var slide_thumb = "#slide" + slide_no + "_thumb";
		jQuery(slide_thumb + " > div").css("background-image", "url('" + youtube_thumb + "')");
		jQuery(slide_imagebg_popup).css("display", "none");
		jQuery(slide_thumb).css("display", "block");
		// ##### SET SLIDE BACKGROUND IMAGE TO YOUTUBE THUMB IMAGE - 14 MAY 2020 - END #####
		
	 	// clear video url input field
		document.getElementById("sa_slide" + slide_no + "_video_url").value = '';
		// update hidden video id and video type fields
		document.getElementById("sa_slide" + slide_no + "_popup_video_id").value = valid_video_id;
		document.getElementById("sa_slide" + slide_no + "_popup_video_type").value = 'youtube';
		// Display YouTube video within video preview DIV
		var embed_html = "<iframe src='https://www.youtube.com/embed/" + valid_video_id + "' frameborder='0' allowfullscreen></iframe>";
		document.getElementById("slide" + slide_no + "_video_thumb").innerHTML = embed_html;
		// Set the video URL for the preview popup
		jQuery(preview_button).attr("href", "http://www.youtube.com/watch?v=" + valid_video_id);
	}
	if (video_type == 'vimeo') {
		// clear video url input field
		document.getElementById("sa_slide" + slide_no + "_video_url").value = '';
	 	// update hidden video id and video type fields
		document.getElementById("sa_slide" + slide_no + "_popup_video_id").value = valid_video_id;
		document.getElementById("sa_slide" + slide_no + "_popup_video_type").value = 'vimeo';
		// Display Vimeo video within video preview DIV
		var embed_html = "<iframe src='https://player.vimeo.com/video/" + valid_video_id + "' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
		document.getElementById("slide" + slide_no + "_video_thumb").innerHTML = embed_html;
		// Set the video URL for the preview popup
		jQuery(preview_button).attr("href", "http://vimeo.com/" + valid_video_id);
	}
}



// #############################################
// ##### SLIDE POPUP TAB - HTML POPUP TYPE #####
// #############################################

// ##### SLIDE HTML POPUP 'Background Color' & 'Popup Width' #####
jQuery(function() {
	if (jQuery('#sa_pro_version').length > 0) {
		var pro_version = document.getElementById('sa_pro_version').value;
		if (pro_version == '1') {
			var num_slides = parseInt(document.getElementById('num_slides_id').value);
			// ##### LOOP THRU EACH SLIDE #####
			for (i = 1; i <= num_slides; i++) {
				// ##### SPECTRUM COLOR PICKER - SLIDE HTML POPUP 'Background Color' #####
				var color_picker_id = 'sa_slide' + i + '_popup_bgcol';
				var background_color = document.getElementById(color_picker_id).value;
				jQuery('#' + color_picker_id).spectrum({
					showPaletteOnly: true,
					togglePaletteOnly: true,
					togglePaletteMoreText: 'more',
					togglePaletteLessText: 'less',
					showInput: true,
					allowEmpty: true,
					preferredFormat: "rgb",
					showAlpha: true,
					color: background_color,
					palette: [
						["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
						["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
						["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
						["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
						["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
						["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
						["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
						["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
					]
				});
				// ##### JQUERY-UI SPINNER - SLIDE HTML POPUP 'Popup Width' #####
				var spinner_id = 'sa_slide' + i + '_popup_width';
				jQuery("#" + spinner_id).spinner({
					step: 1,
					min: 200,
					max: 2000,
					numberFormat: "n"
				});

				// ##### CLICK EVENT FOR 'Popup CSS ID' (HTML POPUP) #####
				var popup_cssid = 'sa_slide' + i + '_popup_css';
				jQuery("#" + popup_cssid).click(function() {
					var css_selector = jQuery(this).html();
					var aux = document.createElement("input"); // Create a "hidden" input
					aux.setAttribute("value", css_selector); // Assign it the value of the specified element
					document.body.appendChild(aux); // Append it to the body
					aux.select(); // Highlight its content
					document.execCommand("copy"); // Copy the highlighted text
					document.body.removeChild(aux); // Remove it from the body
					var curr_col = jQuery(this).css("color");
					if (curr_col == "rgb(0, 0, 0)") {
						jQuery(this).css("color", "firebrick");
					} else {
						jQuery(this).css("color", "#000000");
					}
				});
			}
		}
	}
})



// ##### CLICK EVENT HANDLER FOR THE 'Delete Slide' BUTTON (FOR EACH SLIDE) #####
// Set the hidden 'delete status' input field to zero and save the custom post type
function delete_sa_slide(delete_id) {
	jQuery(function() {
		var dialog_box = document.getElementById('sa_dialog_box');
		dialog_box.innerHTML = "Click the <strong>OK</strong> button to delete this slide.";
		jQuery("#sa_dialog_box").dialog({ title: 'DELETE SLIDE' });
		jQuery("#sa_dialog_box").dialog({
			buttons: {
				OK: function() {
					var del_status = document.getElementById(delete_id);
					del_status.value = "0";
					// set hidden input field to notify that a status message must be displayed
					var info_deleted = document.getElementById('sa_info_deleted');
					info_deleted.value = "1";
					// save the custom post type
					jQuery('body').css('cursor', 'wait');
					jQuery('.ui-button').css('cursor', 'wait');
					jQuery('#publish').click();
				},
				Cancel: function() {
					jQuery(this).dialog("close");
				}
			}
		});
		jQuery("#sa_dialog_box").dialog("open");
	})
}

// ##### CLICK EVENT HANDLER FOR THE 'Duplicate Slide' BUTTON (FOR EACH SLIDE) #####
// Set the hidden 'duplicate slide' input field to the slide number to be duplicated and save the custom post type
function duplicate_slide(slide_no) {
	jQuery(function() {
		var dialog_box = document.getElementById('sa_dialog_box');
		dialog_box.innerHTML = "Click the <strong>OK</strong> button to make a duplicate (copy) of this slide.";
		jQuery("#sa_dialog_box").dialog({ title: 'DUPLICATE SLIDE' });
		jQuery("#sa_dialog_box").dialog({
			buttons: {
				OK: function() {
					// set hidden 'duplicate slide' input field to the slide number to be duplicated
					var duplicate_slide = document.getElementById('sa_duplicate_slide');
					duplicate_slide.value = slide_no;
					// set hidden input field to notify that a status message must be displayed
					var info_duplicated = document.getElementById('sa_info_duplicated');
					info_duplicated.value = "1";
					// save the custom post type
					jQuery('body').css('cursor', 'wait');
					jQuery('.ui-button').css('cursor', 'wait');
					jQuery('#publish').click();
				},
				Cancel: function() {
					jQuery(this).dialog("close");
				}
			}
		});
		jQuery("#sa_dialog_box").dialog("open");
	})
}

// ##### CLICK EVENT HANDLER FOR THE 'Move Slide Up' BUTTON (FOR EACH SLIDE) #####
// Set the hidden 'move slide up' input field to the slide number to be moved up and save the custom post type
function move_slide_up(slide_no) {
	jQuery(function() {
		var dialog_box = document.getElementById('sa_dialog_box');
		dialog_box.innerHTML = "Click the <strong>OK</strong> button to move this slide up within the slide order.";
		jQuery("#sa_dialog_box").dialog({ title: 'MOVE SLIDE UP' });
		jQuery("#sa_dialog_box").dialog({
			buttons: {
				OK: function() {
					// set hidden 'move slide up' input field to the slide number to be moved
					var move_slide_up = document.getElementById('sa_move_slide_up');
					move_slide_up.value = slide_no;
					// set hidden input field to notify that a status message must be displayed
					var info_moved = document.getElementById('sa_info_moved');
					info_moved.value = "1";
					// save the custom post type
					jQuery('body').css('cursor', 'wait');
					jQuery('.ui-button').css('cursor', 'wait');
					jQuery('#publish').click();
				},
				Cancel: function() {
					jQuery(this).dialog("close");
				}
			}
		});
		jQuery("#sa_dialog_box").dialog("open");
	})
}
