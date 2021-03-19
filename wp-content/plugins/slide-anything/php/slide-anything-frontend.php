<?php
// #####################################################################
// ### SLIDE ANYTHING PLUGIN - PHP FUNCTIONS FOR WORDPRESS FRONT-END ###
// #####################################################################

add_shortcode('slide-anything', 'slide_anything_shortcode');

/* ##### ROOT FUNCTION THAT IS CALLED TO BY THE 'slide-anything' SHORTCODE ##### */
function slide_anything_shortcode($atts) {
	$sa_pro_version = esc_attr(get_option('sap_valid_license'));
	wp_enqueue_script('jquery');
	wp_register_script('owl_carousel_js', SA_PLUGIN_PATH.'owl-carousel/owl.carousel.min.js', array('jquery'), '2.2.1', true);
	wp_enqueue_script('owl_carousel_js');
	wp_register_style('owl_carousel_css', SA_PLUGIN_PATH.'owl-carousel/owl.carousel.css', array(), '2.2.1.1', 'all');
	wp_enqueue_style('owl_carousel_css');
	wp_register_style('owl_theme_css', SA_PLUGIN_PATH.'owl-carousel/sa-owl-theme.css', array(), '2.0', 'all');
	wp_enqueue_style('owl_theme_css');
	wp_register_style('owl_animate_css', SA_PLUGIN_PATH.'owl-carousel/animate.min.css', array(), '2.0', 'all');
	wp_enqueue_style('owl_animate_css');
	if ($sa_pro_version) {
		// JAVASCRIPT/CSS FOR MAGNIFIC POPUP
		wp_register_script('magnific-popup_js', SA_PLUGIN_PATH.'magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true);
		wp_enqueue_script('magnific-popup_js');
		wp_register_style('magnific-popup_css', SA_PLUGIN_PATH.'magnific-popup/magnific-popup.css', array(), '1.1.0', 'all');
		wp_enqueue_style('magnific-popup_css');
		wp_register_script('owl_thumbs_js', SA_PLUGIN_PATH.'owl-carousel/owl.carousel2.thumbs.min.js', array('jquery'), '0.1.8', true);
		wp_enqueue_script('owl_thumbs_js');
	}

	// EXTRACT SHORTCODE ATTRIBUTES
	extract(shortcode_atts(array(
		'id' => 0,
	), $atts));
	$output = '';
	if ($id == 0) {
		// SHORTCODE 'id' PARAMETER PROVIDED IS INVALID
		$output .= "<div id='sa_invalid_postid'>Slide Anything shortcode error: A valid ID has not been provided</div>\n";
	} else {
		$post_status = get_post_status($id);
		if ($post_status == 'publish') {
			$metadata = get_metadata('post', $id);
			$post_type = get_post_type($id);
		}
		if (($post_status != 'publish') || (count($metadata) == 0) || ($post_type != 'sa_slider')) {
			// SHORTCODE 'id' PARAMETER PROVIDED IS INVALID
			$output .= "<div id='sa_invalid_postid'>Slide Anything shortcode error: A valid ID has not been provided</div>\n";
		} else {
			// ### VALID 'id' PROVIDED - PROCESS SHORTCODE ###
			// GET SLIDE DATA FROM DATABASE AND SAVE IN ARRAY
			$slide_data = array();
			$slide_data['num_slides'] = $metadata['sa_num_slides'][0];
			$slide_data['shortcodes'] = $metadata['sa_shortcodes'][0];
			if ($slide_data['shortcodes'] == '1') {
				$slide_data['shortcodes'] = 'true';
			} else {
				$slide_data['shortcodes'] = 'false';
			}
			$slide_data['css_id'] = $metadata['sa_css_id'][0];
			for ($i = 1; $i <= $slide_data['num_slides']; $i++) {
				$slide_data["slide".$i."_num"] = $i;
				// apply 'the_content' filter to slide content to process any shortcodes
				if ($slide_data['shortcodes'] == 'true') {
					$slide_data["slide".$i."_content"] = do_shortcode($metadata["sa_slide".$i."_content"][0]);
				} else {
					$slide_data["slide".$i."_content"] = $metadata["sa_slide".$i."_content"][0];
				}
				$slide_image_data = '';
				if (isset($metadata["sa_slide".$i."_image_data"])) {
					$slide_image_data = $metadata["sa_slide".$i."_image_data"][0];
				}
				if (isset($slide_image_data) && ($slide_image_data != '')) {
					$data_arr = explode("~", $slide_image_data);
					$slide_data["slide".$i."_image_id"] = $data_arr[0];
					$slide_data["slide".$i."_image_pos"] = $data_arr[1];
					$slide_data["slide".$i."_image_size"] = $data_arr[2];
					$slide_data["slide".$i."_image_repeat"] = $data_arr[3];
					$slide_data["slide".$i."_image_color"] = $data_arr[4];
				} else {
					$slide_data["slide".$i."_image_id"] = $metadata["sa_slide".$i."_image_id"][0];
					$slide_data["slide".$i."_image_pos"] = $metadata["sa_slide".$i."_image_pos"][0];
					$slide_data["slide".$i."_image_size"] = $metadata["sa_slide".$i."_image_size"][0];
					$slide_data["slide".$i."_image_repeat"] = $metadata["sa_slide".$i."_image_repeat"][0];
					$slide_data["slide".$i."_image_color"] = $metadata["sa_slide".$i."_image_color"][0];
				}
				$slide_data["slide".$i."_link_url"] = $metadata["sa_slide".$i."_link_url"][0];
				$slide_data["slide".$i."_link_target"] = $metadata["sa_slide".$i."_link_target"][0];
				if ($slide_data["slide".$i."_link_target"] == '') {
					$slide_data["slide".$i."_link_target"] = '_self';
				}
				if ($sa_pro_version) {
					// ### PRO VERSION - GET POPUP DATA ###
					$slide_data["slide".$i."_popup_type"] = "NONE";
					$slide_data["slide".$i."_popup_imageid"] = "";
					$slide_data["slide".$i."_popup_imagetitle"] = "";
					$slide_data["slide".$i."_popup_video_id"] = "";
					$slide_data["slide".$i."_popup_video_type"] = "";
					$slide_data["slide".$i."_popup_html"] = "";
					$slide_data["slide".$i."_popup_shortcode"] = "";
					$slide_data["slide".$i."_popup_bgcol"] = "#ffffff";
					$slide_data["slide".$i."_popup_width"] = "600";
					if (isset($metadata["sa_slide".$i."_popup_type"])) {
						$slide_data["slide".$i."_popup_type"] = $metadata["sa_slide".$i."_popup_type"][0];
					}
					if (isset($metadata["sa_slide".$i."_popup_imageid"])) {
						$slide_data["slide".$i."_popup_imageid"] = $metadata["sa_slide".$i."_popup_imageid"][0];
					}
					if (isset($metadata["sa_slide".$i."_popup_imagetitle"])) {
						$slide_data["slide".$i."_popup_imagetitle"] = $metadata["sa_slide".$i."_popup_imagetitle"][0];
					}
					$slide_data["slide".$i."_popup_image"] = '';
					$slide_data["slide".$i."_popup_background"] = 'no';
					if ($slide_data["slide".$i."_popup_type"] == 'IMAGE') {
						if (($slide_data["slide".$i."_popup_imageid"] != '') && ($slide_data["slide".$i."_popup_imageid"] != 0)) {
							$popup_full_images = wp_get_attachment_image_src($slide_data["slide".$i."_popup_imageid"], 'full');
							$slide_data["slide".$i."_popup_image"] = $popup_full_images[0];
							$slide_data["slide".$i."_popup_background"] = $metadata["sa_slide".$i."_popup_background"][0];
							if ($slide_data["slide".$i."_popup_background"] == '') {
								$slide_data["slide".$i."_popup_background"] = 'no';
							}
						}
					}
					if (isset($metadata["sa_slide".$i."_popup_video_id"])) {
						$slide_data["slide".$i."_popup_video_id"] = $metadata["sa_slide".$i."_popup_video_id"][0];
					}
					if (isset($metadata["sa_slide".$i."_popup_video_type"])) {
						$slide_data["slide".$i."_popup_video_type"] = $metadata["sa_slide".$i."_popup_video_type"][0];
					}
					if (isset($metadata["sa_slide".$i."_popup_html"])) {
						$slide_data["slide".$i."_popup_html"] = $metadata["sa_slide".$i."_popup_html"][0];
					}
					if (isset($metadata["sa_slide".$i."_popup_shortcode"])) {
						$slide_data["slide".$i."_popup_shortcode"] = $metadata["sa_slide".$i."_popup_shortcode"][0];
					}
					if (isset($metadata["sa_slide".$i."_popup_bgcol"])) {
						$slide_data["slide".$i."_popup_bgcol"] = $metadata["sa_slide".$i."_popup_bgcol"][0];
					}
					if (isset($metadata["sa_slide".$i."_popup_width"])) {
						$slide_data["slide".$i."_popup_width"] = $metadata["sa_slide".$i."_popup_width"][0];
					}
					if ($slide_data["slide".$i."_popup_type"] == 'HTML') {
						$slide_data["slide".$i."_popup_css_id"] = $slide_data['css_id']."_popup".$i;
					} else {
						$slide_data["slide".$i."_popup_css_id"] = '';
					}
				}
			}
			$slide_data['slide_duration'] = floatval($metadata['sa_slide_duration'][0]) * 1000;
			$slide_data['slide_transition'] = floatval($metadata['sa_slide_transition'][0]) * 1000;
			if (isset($metadata['sa_slide_by'][0]) && ($metadata['sa_slide_by'][0] != '')) {
				$slide_data['slide_by'] = $metadata['sa_slide_by'][0];
				if ($slide_data['slide_by'] == '0') {
					$slide_data['slide_by'] = 'page';
				}
			} else {
				$slide_data['slide_by'] = 1;
			}
			$slide_data['loop_slider'] = $metadata['sa_loop_slider'][0];
			if ($slide_data['loop_slider'] == '1') {
				$slide_data['loop_slider'] = 'true';
			} else {
				$slide_data['loop_slider'] = 'false';
			}
			$slide_data['stop_hover'] = $metadata['sa_stop_hover'][0];
			if ($slide_data['stop_hover'] == '1') {
				$slide_data['stop_hover'] = 'true';
			} else {
				$slide_data['stop_hover'] = 'false';
			}
			$slide_data['random_order'] = $metadata['sa_random_order'][0];
			if ($slide_data['random_order'] == '1') {
				$slide_data['random_order'] = 'true';
			} else {
				$slide_data['random_order'] = 'false';
			}
			$slide_data['reverse_order'] = $metadata['sa_reverse_order'][0];
			if ($slide_data['reverse_order'] == '1') {
				$slide_data['reverse_order'] = 'true';
			} else {
				$slide_data['reverse_order'] = 'false';
			}
			$slide_data['nav_arrows'] = $metadata['sa_nav_arrows'][0];
			if ($slide_data['nav_arrows'] == '1') {
				$slide_data['nav_arrows'] = 'true';
			} else {
				$slide_data['nav_arrows'] = 'false';
			}
			$slide_data['pagination'] = $metadata['sa_pagination'][0];
			if ($slide_data['pagination'] == '1') {
				$slide_data['pagination'] = 'true';
			} else {
				$slide_data['pagination'] = 'false';
			}
			$slide_data['mouse_drag'] = $metadata['sa_mouse_drag'][0];
			if ($slide_data['mouse_drag'] == '1') {
				$slide_data['mouse_drag'] = 'true';
			} else {
				$slide_data['mouse_drag'] = 'false';
			}
			$slide_data['touch_drag'] = $metadata['sa_touch_drag'][0];
			if ($slide_data['touch_drag'] == '1') {
				$slide_data['touch_drag'] = 'true';
			} else {
				$slide_data['touch_drag'] = 'false';
			}
			if (isset($metadata['sa_click_advance'])) {
				$slide_data['click_advance'] = $metadata['sa_click_advance'][0];
				if ($slide_data['click_advance'] == '1') {
					$slide_data['click_advance'] = 'true';
				} else {
					$slide_data['click_advance'] = 'false';
				}
			} else {
				$slide_data['click_advance'] = 'false';
			}
			if (isset($metadata['sa_auto_height'])) {
				$slide_data['auto_height'] = $metadata['sa_auto_height'][0];
				if ($slide_data['auto_height'] == '1') {
					$slide_data['auto_height'] = 'true';
				} else {
					$slide_data['auto_height'] = 'false';
				}
			} else {
				$slide_data['auto_height'] = 'false';
			}
			if (($metadata['sa_slide_min_height_perc'][0] == '0') || ($metadata['sa_slide_min_height_perc'][0] == '0px')) {
				$slide_data['vert_center'] = 'false';
			} else {
				if (isset($metadata['sa_vert_center'])) {
					$slide_data['vert_center'] = $metadata['sa_vert_center'][0];
					if ($slide_data['vert_center'] == '1') {
						$slide_data['vert_center'] = 'true';
					} else {
						$slide_data['vert_center'] = 'false';
					}
				} else {
					$slide_data['vert_center'] = 'false';
				}
			}
			$slide_data['items_width1'] = $metadata['sa_items_width1'][0];
			$slide_data['items_width2'] = $metadata['sa_items_width2'][0];
			$slide_data['items_width3'] = $metadata['sa_items_width3'][0];
			$slide_data['items_width4'] = $metadata['sa_items_width4'][0];
			$slide_data['items_width5'] = $metadata['sa_items_width5'][0];
			$slide_data['items_width6'] = $metadata['sa_items_width6'][0];
			if ($slide_data['items_width6'] == '') {
				$slide_data['items_width6'] = $slide_data['items_width5'];
			}
			$slide_data['transition'] = $metadata['sa_transition'][0];
			$slide_data['background_color'] = $metadata['sa_background_color'][0];
			$slide_data['border_width'] = $metadata['sa_border_width'][0];
			$slide_data['border_color'] = $metadata['sa_border_color'][0];
			$slide_data['border_radius'] = $metadata['sa_border_radius'][0];
			$slide_data['wrapper_padd_top'] = $metadata['sa_wrapper_padd_top'][0];
			$slide_data['wrapper_padd_right'] = $metadata['sa_wrapper_padd_right'][0];
			$slide_data['wrapper_padd_bottom'] = $metadata['sa_wrapper_padd_bottom'][0];
			$slide_data['wrapper_padd_left'] = $metadata['sa_wrapper_padd_left'][0];
			$slide_data['slide_min_height_perc'] = $metadata['sa_slide_min_height_perc'][0];
			$slide_data['slide_padding_tb'] = $metadata['sa_slide_padding_tb'][0];
			$slide_data['slide_padding_lr'] = $metadata['sa_slide_padding_lr'][0];
			$slide_data['slide_margin_lr'] = $metadata['sa_slide_margin_lr'][0];
			$slide_data['slide_icons_location'] = $metadata['sa_slide_icons_location'][0];
			$slide_data['autohide_arrows'] = $metadata['sa_autohide_arrows'][0];
			if ($slide_data['autohide_arrows'] == '1') {
				$slide_data['autohide_arrows'] = 'true';
			} else {
				$slide_data['autohide_arrows'] = 'false';
			}
			$slide_data['dot_per_slide'] = '0';
			if (isset($metadata['sa_dot_per_slide'])) {
				$slide_data['dot_per_slide'] = $metadata['sa_dot_per_slide'][0];
				if ($slide_data['dot_per_slide'] != '1') {
					$slide_data['dot_per_slide'] = '0';
				}
			} else {
				$slide_data['dot_per_slide'] = '0';
			}
			$slide_data['slide_icons_visible'] = $metadata['sa_slide_icons_visible'][0];
			if ($slide_data['slide_icons_visible'] == '1') {
				$slide_data['slide_icons_visible'] = 'true';
			} else {
				$slide_data['slide_icons_visible'] = 'false';
			}
			$slide_data['slide_icons_color'] = $metadata['sa_slide_icons_color'][0];
			if ($slide_data['slide_icons_color'] != 'black') {
				$slide_data['slide_icons_color'] = 'white';
			}
			// FETCH OTHER SETTINGS POST META
			$other_settings = '';
			if (isset($metadata['sa_other_settings'])) {
				$other_settings = $metadata['sa_other_settings'][0];
				if (isset($other_settings) && ($other_settings != '')) {
					$other_settings_arr = explode("|", $other_settings);
				}
			}
			// setting 1 - sa_window_onload
			$slide_data['sa_window_onload'] = '0';
			if (isset($other_settings_arr) && ($other_settings_arr[0] != '')) {
				$slide_data['sa_window_onload'] = $other_settings_arr[0];
			} else {
				if (isset($metadata['sa_window_onload'])) {
					$slide_data['sa_window_onload'] = $metadata['sa_window_onload'][0];
					if ($slide_data['sa_window_onload'] != '1') {
						$slide_data['sa_window_onload'] = '0';
					}
				}
			}
			// setting 2 - sa_strip_javascript
			$slide_data['strip_javascript'] = '0';
			if (isset($other_settings_arr) && ($other_settings_arr[1] != '')) {
				$slide_data['strip_javascript'] = $other_settings_arr[1];
			} else {
				if (isset($metadata['sa_strip_javascript'])) {
					$slide_data['strip_javascript'] = $metadata['sa_strip_javascript'][0];
					if ($slide_data['strip_javascript'] != '1') {
						$slide_data['strip_javascript'] = '0';
					}
				}
			}
			// setting 3 - sa_lazy_load_images
			$slide_data['lazy_load_images'] = '0';
			if (isset($other_settings_arr) && ($other_settings_arr[2] != '')) {
				$slide_data['lazy_load_images'] = $other_settings_arr[2];
			} else {
				if (isset($metadata['sa_lazy_load_images'])) {
					$slide_data['lazy_load_images'] = $metadata['sa_lazy_load_images'][0];
					if ($slide_data['lazy_load_images'] != '1') {
						$slide_data['lazy_load_images'] = '0';
					}
				}
			}
			// setting 4 - sa_ulli_containers
			$slide_data['ulli_containers'] = '0';
			if (isset($other_settings_arr) && ($other_settings_arr[3] != '')) {
				$slide_data['ulli_containers'] = $other_settings_arr[3];
			} else {
				if (isset($metadata['sa_ulli_containers'])) {
					$slide_data['ulli_containers'] = $metadata['sa_ulli_containers'][0];
					if ($slide_data['ulli_containers'] != '1') {
						$slide_data['ulli_containers'] = '0';
					}
				}
			}
			// setting 5 - sa_rtl_slider
			$slide_data['rtl_slider'] = '0';
			if (isset($other_settings_arr) && ($other_settings_arr[4] != '')) {
				$slide_data['rtl_slider'] = $other_settings_arr[4];
			}
			// setting 7 - bg_image_size
			$slide_data['bg_image_size'] = 'full';
			if (isset($other_settings_arr) && (count($other_settings_arr)) > 6) {
				if ($other_settings_arr[6] != '') {
					$slide_data['bg_image_size'] = $other_settings_arr[6];
				}
			}
			// Start Position
			$slide_data['start_pos'] = 0;
			if (isset($metadata['sa_start_pos'])) {
				$slide_data['start_pos'] = $metadata['sa_start_pos'][0];
				if ($slide_data['start_pos'] != '') {
					$slide_data['start_pos'] = abs(intval($slide_data['start_pos']));
					if ($slide_data['start_pos'] > 0) {
						$slide_data['start_pos'] = $slide_data['start_pos'] - 1;
					}
				}
			}
			
			// hero slider and slider thumbnails
			$slide_data['hero_slider'] = '0';
			$slide_data['thumbs_active'] = '0';
			if ($sa_pro_version) {
				if (isset($metadata['sa_hero_slider'])) {
					$slide_data['hero_slider'] = $metadata['sa_hero_slider'][0];
					if ($slide_data['hero_slider'] != '1') {
						$slide_data['hero_slider'] = '0';
					}
				} else {
					$slide_data['hero_slider'] = '0';
				}
				if (isset($metadata['sa_thumbs_active'])) {
					$slide_data['thumbs_active'] = $metadata['sa_thumbs_active'][0];
					if ($slide_data['thumbs_active'] != '1') {
						$slide_data['thumbs_active'] = '0';
					}
				} else {
					$slide_data['thumbs_active'] = '0';
				}
				if (isset($metadata['sa_thumbs_location'])) {
					$slide_data['thumbs_location'] = $metadata['sa_thumbs_location'][0];
				} else {
					$slide_data['thumbs_location'] = 'inside_bottom';
				}
				if (isset($metadata['sa_thumbs_image_size'])) {
					$slide_data['thumbs_image_size'] = $metadata['sa_thumbs_image_size'][0];
				} else {
					$slide_data['thumbs_image_size'] = 'thumbnail';
				}
				if (isset($metadata['sa_thumbs_padding'])) {
					$slide_data['thumbs_padding'] = $metadata['sa_thumbs_padding'][0];
				} else {
					$slide_data['thumbs_padding'] = '3';
				}
				if (isset($metadata['sa_thumbs_width'])) {
					$slide_data['thumbs_width'] = $metadata['sa_thumbs_width'][0];
				} else {
					$slide_data['thumbs_width'] = '150';
				}
				if (isset($metadata['sa_thumbs_height'])) {
					$slide_data['thumbs_height'] = $metadata['sa_thumbs_height'][0];
				} else {
					$slide_data['thumbs_height'] = '85';
				}
				if (isset($metadata['sa_thumbs_opacity'])) {
					$slide_data['thumbs_opacity'] = $metadata['sa_thumbs_opacity'][0];
				} else {
					$slide_data['thumbs_opacity'] = '50';
				}
				if (isset($metadata['sa_thumbs_border_width'])) {
					$slide_data['thumbs_border_width'] = $metadata['sa_thumbs_border_width'][0];
				} else {
					$slide_data['thumbs_border_width'] = '0';
				}
				if (isset($metadata['sa_thumbs_border_color'])) {
					$slide_data['thumbs_border_color'] = $metadata['sa_thumbs_border_color'][0];
				} else {
					$slide_data['thumbs_border_color'] = '#ffffff';
				}
				if (isset($metadata['sa_thumbs_resp_tablet'])) {
					$slide_data['thumbs_resp_tablet'] = $metadata['sa_thumbs_resp_tablet'][0];
				} else {
					$slide_data['thumbs_resp_tablet'] = '75';
				}
				if (isset($metadata['sa_thumbs_resp_mobile'])) {
					$slide_data['thumbs_resp_mobile'] = $metadata['sa_thumbs_resp_mobile'][0];
				} else {
					$slide_data['thumbs_resp_mobile'] = '50';
				}
			}
			// showcase carousel
			$slide_data['showcase_slider'] = '0';
			if ($sa_pro_version) {
				if (isset($metadata['sa_showcase_slider'])) {
					$slide_data['showcase_slider'] = $metadata['sa_showcase_slider'][0];
					if ($slide_data['showcase_slider'] != '1') {
						$slide_data['showcase_slider'] = '0';
					}
				} else {
					$slide_data['showcase_slider'] = '0';
				}
				if (isset($metadata['sa_showcase_width'])) {
					$slide_data['showcase_width'] = $metadata['sa_showcase_width'][0];
				} else {
					$slide_data['showcase_width'] = '120';
				}
				if (isset($metadata['sa_showcase_tablet'])) {
					$slide_data['showcase_tablet'] = $metadata['sa_showcase_tablet'][0];
					if ($slide_data['showcase_tablet'] != '1') {
						$slide_data['showcase_tablet'] = '0';
					}
				} else {
					$slide_data['showcase_tablet'] = '0';
				}
				if (isset($metadata['sa_showcase_width_tab'])) {
					$slide_data['showcase_width_tab'] = $metadata['sa_showcase_width_tab'][0];
				} else {
					$slide_data['showcase_width_tab'] = '130';
				}
				if (isset($metadata['sa_showcase_mobile'])) {
					$slide_data['showcase_mobile'] = $metadata['sa_showcase_mobile'][0];
					if ($slide_data['showcase_mobile'] != '1') {
						$slide_data['showcase_mobile'] = '0';
					}
				} else {
					$slide_data['showcase_mobile'] = '0';
				}
				if (isset($metadata['sa_showcase_width_mob'])) {
					$slide_data['showcase_width_mob'] = $metadata['sa_showcase_width_mob'][0];
				} else {
					$slide_data['showcase_width_mob'] = '140';
				}
			}



			// REVERSE THE ORDER OF THE SLIDES IF 'Random Order' CHECKBOX IS CHECKED OR
			// RE-ORDER SLIDES IN A RANDOM ORDER IF 'Random Order' CHECKBOX IS CHECKED
			if (($slide_data['reverse_order'] == 'true') || ($slide_data['random_order'] == 'true')) {
				$reorder_arr = array();
				for ($i = 1; $i <= $slide_data['num_slides']; $i++) {
					$reorder_arr[$i-1]['num'] = $slide_data["slide".$i."_num"];
					$reorder_arr[$i-1]['content'] = $slide_data["slide".$i."_content"];
					$reorder_arr[$i-1]['image_id'] = $slide_data["slide".$i."_image_id"];
					$reorder_arr[$i-1]['image_pos'] = $slide_data["slide".$i."_image_pos"];
					$reorder_arr[$i-1]['image_size'] = $slide_data["slide".$i."_image_size"];
					$reorder_arr[$i-1]['image_repeat'] = $slide_data["slide".$i."_image_repeat"];
					$reorder_arr[$i-1]['image_color'] = $slide_data["slide".$i."_image_color"];
					$reorder_arr[$i-1]['link_url'] = $slide_data["slide".$i."_link_url"];
					$reorder_arr[$i-1]['link_target'] = $slide_data["slide".$i."_link_target"];
					if ($sa_pro_version) {
						$reorder_arr[$i-1]['popup_type'] = $slide_data["slide".$i."_popup_type"];
						$reorder_arr[$i-1]['popup_imageid'] = $slide_data["slide".$i."_popup_imageid"];
						$reorder_arr[$i-1]['popup_imagetitle'] = $slide_data["slide".$i."_popup_imagetitle"];
						$reorder_arr[$i-1]['popup_image'] = $slide_data["slide".$i."_popup_image"];
						$reorder_arr[$i-1]['popup_background'] = $slide_data["slide".$i."_popup_background"];
						$reorder_arr[$i-1]['popup_video_id'] = $slide_data["slide".$i."_popup_video_id"];
						$reorder_arr[$i-1]['popup_video_type'] = $slide_data["slide".$i."_popup_video_type"];
						$reorder_arr[$i-1]['popup_html'] = $slide_data["slide".$i."_popup_html"];
						$reorder_arr[$i-1]['popup_shortcode'] = $slide_data["slide".$i."_popup_shortcode"];
						$reorder_arr[$i-1]['popup_bgcol'] = $slide_data["slide".$i."_popup_bgcol"];
						$reorder_arr[$i-1]['popup_width'] = $slide_data["slide".$i."_popup_width"];
						$reorder_arr[$i-1]['popup_css_id'] = $slide_data["slide".$i."_popup_css_id"];
					}
				}
				if ($slide_data['random_order'] == 'true') {
					// SORT SLIDE ARRAY DATA IN A RANDOM ORDER
					shuffle($reorder_arr);
				} else {
					// REVERSE THE ORDER OF THE SLIDE DATA ARRAY
					$reverse_arr = array_reverse($reorder_arr);
					$reorder_arr = $reverse_arr;
				}
				for ($i = 1; $i <= $slide_data['num_slides']; $i++) {
					$slide_data["slide".$i."_num"] = $reorder_arr[$i-1]['num'];
					$slide_data["slide".$i."_content"] = $reorder_arr[$i-1]['content'];
					$slide_data["slide".$i."_image_id"] = $reorder_arr[$i-1]['image_id'];
					$slide_data["slide".$i."_image_pos"] = $reorder_arr[$i-1]['image_pos'];
					$slide_data["slide".$i."_image_size"] = $reorder_arr[$i-1]['image_size'];
					$slide_data["slide".$i."_image_repeat"] = $reorder_arr[$i-1]['image_repeat'];
					$slide_data["slide".$i."_image_color"] = $reorder_arr[$i-1]['image_color'];
					$slide_data["slide".$i."_link_url"] = $reorder_arr[$i-1]['link_url'];
					$slide_data["slide".$i."_link_target"] = $reorder_arr[$i-1]['link_target'];
					if ($sa_pro_version) {
						$slide_data["slide".$i."_popup_type"] = $reorder_arr[$i-1]['popup_type'];
						$slide_data["slide".$i."_popup_imageid"] = $reorder_arr[$i-1]['popup_imageid'];
						$slide_data["slide".$i."_popup_imagetitle"] = $reorder_arr[$i-1]['popup_imagetitle'];
						$slide_data["slide".$i."_popup_image"] = $reorder_arr[$i-1]['popup_image'];
						$slide_data["slide".$i."_popup_background"] = $reorder_arr[$i-1]['popup_background'];
						$slide_data["slide".$i."_popup_video_id"] = $reorder_arr[$i-1]['popup_video_id'];
						$slide_data["slide".$i."_popup_video_type"] = $reorder_arr[$i-1]['popup_video_type'];
						$slide_data["slide".$i."_popup_html"] = $reorder_arr[$i-1]['popup_html'];
						$slide_data["slide".$i."_popup_shortcode"] = $reorder_arr[$i-1]['popup_shortcode'];
						$slide_data["slide".$i."_popup_bgcol"] = $reorder_arr[$i-1]['popup_bgcol'];
						$slide_data["slide".$i."_popup_width"] = $reorder_arr[$i-1]['popup_width'];
						$slide_data["slide".$i."_popup_css_id"] = $reorder_arr[$i-1]['popup_css_id'];
					}
				}
			}

			// GENERATE HTML CODE FOR THE OWL CAROUSEL SLIDER
			$wrapper_style =  "background:".$slide_data['background_color']."; ";
			$wrapper_style .=  "border:solid ".$slide_data['border_width']."px ".$slide_data['border_color']."; ";
			$wrapper_style .=  "border-radius:".$slide_data['border_radius']."px; ";
			$wrapper_style .=  "padding:".$slide_data['wrapper_padd_top']."px ";
			$wrapper_style .= $slide_data['wrapper_padd_right']."px ";
			$wrapper_style .= $slide_data['wrapper_padd_bottom']."px ";
			$wrapper_style .= $slide_data['wrapper_padd_left']."px;";
			if ($slide_data['showcase_slider'] == '1') {
				$wrapper_style .= " overflow:hidden;";
			}
			$output .= "<div class='".$slide_data['slide_icons_color']."' style='".esc_attr($wrapper_style)."'>\n";
			$additional_classes = '';
			if ($slide_data['pagination'] == 'true') {
				if ($slide_data['autohide_arrows'] == 'true') {
					$additional_classes = "owl-pagination-true autohide-arrows";
				} else {
					$additional_classes = "owl-pagination-true";
				}
			} else {
				if ($slide_data['autohide_arrows'] == 'true') {
					$additional_classes = "autohide-arrows";
				}
			}
			// hero slider
			if ($slide_data['hero_slider'] == '1') {
				$additional_classes .= " sa_hero_slider";
			}
			$slider_style = "visibility:hidden;";
			// showcase slider
			if ($slide_data['showcase_slider'] == '1') {
				$left_perc = (intval($slide_data['showcase_width']) - 100) / 2;
				$slider_style .= " width:".$slide_data['showcase_width']."%;";
				$slider_style .= " left:-".$left_perc."%;";
				if ($slide_data['showcase_tablet'] == '1') {
					$left_perc_tab = (intval($slide_data['showcase_width_tab']) - 100) / 2;
					$slider_style .= " --widthtab:".$slide_data['showcase_width_tab']."%;";
					$slider_style .= " --lefttab:-".$left_perc_tab."%;";
					$additional_classes .= " showcase_tablet";
				} else {
					$additional_classes .= " showcase_hide_tablet";
				}
				if ($slide_data['showcase_mobile'] == '1') {
					$left_perc_mob = (intval($slide_data['showcase_width_mob']) - 100) / 2;
					$slider_style .= " --widthmob:".$slide_data['showcase_width_mob']."%;";
					$slider_style .= " --leftmob:-".$left_perc_mob."%;";
					$additional_classes .= " showcase_mobile";
				} else {
					$additional_classes .= " showcase_hide_mobile";
				}
			}
			$output .= "<div id='".esc_attr($slide_data['css_id'])."' class='owl-carousel sa_owl_theme ".$additional_classes."' ";
			$output .= "data-slider-id='".esc_attr($slide_data['css_id'])."' style='".$slider_style."'>\n";
			if ($sa_pro_version) {
				// PRO VERSION - INITIALISE VAIRABLES FOR MAGNIFIC POPUP
				$lightbox_function = "open_lightbox_gallery_".$slide_data['css_id'];
				$lightbox_gallery_id = "lightbox_button_".$slide_data['css_id'];
				$lightbox_count = 0;
			}
			for ($i = 1; $i <= $slide_data['num_slides']; $i++) {
				$slide_content = $slide_data["slide".$i."_content"];
				if ($slide_data['bg_image_size'] != 'full') {
					// use predefined wordpress image size (from 'other settings')
					$slide_image_src = wp_get_attachment_image_src($slide_data["slide".$i."_image_id"], $slide_data['bg_image_size']);
				} else {
					// use "full" wordpress image size
					$slide_image_src = wp_get_attachment_image_src($slide_data["slide".$i."_image_id"], 'full');
				}
				// SA PRO VERSION - USE POPUP IMAGE AS SLIDE BACKGROUND IMAGE (IF THIS OPTION SELECTED)
				if (($sa_pro_version) && ($slide_data["slide".$i."_popup_type"] == 'IMAGE')) {
					if (($slide_data["slide".$i."_popup_background"] != 'no') && ($slide_data["slide".$i."_popup_image"] != '')) {
						$slide_image_src = wp_get_attachment_image_src($slide_data["slide".$i."_popup_imageid"], $slide_data["slide".$i."_popup_background"]);
					}
				} elseif (($sa_pro_version) && ($slide_data["slide".$i."_popup_type"] == 'VIDEO')) {
					if ($slide_data["slide".$i."_popup_video_type"] == "youtube") {
						if ($slide_data["slide".$i."_image_id"] == '99999999') {
							$slide_image_src = array();
							$popup_video_id = $slide_data["slide".$i."_popup_video_id"];
							$slide_image_src[0] = "https://img.youtube.com/vi/".$popup_video_id."/hqdefault.jpg";
						}
					}
				}
				$slide_image_size = $slide_data["slide".$i."_image_size"];
				$slide_image_pos = $slide_data["slide".$i."_image_pos"];
				$slide_image_repeat = $slide_data["slide".$i."_image_repeat"];
				$slide_image_color = $slide_data["slide".$i."_image_color"];
				$slide_style =  "padding:".$slide_data['slide_padding_tb']."% ".$slide_data['slide_padding_lr']."%; ";
				$slide_style .= "margin:0px ".$slide_data['slide_margin_lr']."%; ";
				if (!empty($slide_image_src[0])) {
					$slide_style .= "background-image:url(\"".$slide_image_src[0]."\"); ";
					$slide_style .= "background-position:".$slide_image_pos."; ";
					$slide_style .= "background-size:".$slide_image_size."; ";
					$slide_style .= "background-repeat:".$slide_image_repeat."; ";
				}
				if (!empty($slide_image_color) && ($slide_image_color != "rgba(0,0,0,0)")) {
					$slide_style .= "background-color:".$slide_image_color."; ";
				}
				if (strpos($slide_data['slide_min_height_perc'], 'px') !== false) {
					$slide_style .= "min-height:".$slide_data['slide_min_height_perc']."; ";
				}

				// BUILD SLIDE LINK HOVER BUTTON
				$link_output = '';
				if ($slide_data["slide".$i."_link_url"] != '') {
					$link_output =  "<a class='sa_slide_link_icon' href='".$slide_data["slide".$i."_link_url"]."' ";
					$link_output .= "target='".$slide_data["slide".$i."_link_target"]."'></a>";
				}

				// BUILD POPUP HOVER BUTTON - PRO VERSION ONLY!
				$popup_output = '';
				if ($sa_pro_version) {
					if (($slide_data["slide".$i."_popup_type"] == 'IMAGE') && ($slide_data["slide".$i."_popup_image"] != '')) {
						$lightbox_count++;
						$popup_output =  "<div class='sa_popup_zoom_icon' onClick='".$lightbox_function."(".$lightbox_count.");'></div>";
					}
					if (($slide_data["slide".$i."_popup_type"] == 'VIDEO') && ($slide_data["slide".$i."_popup_video_id"] != '')) {
						$lightbox_count++;
						$popup_output =  "<div class='sa_popup_video_icon' onClick='".$lightbox_function."(".$lightbox_count.");'></div>";
					}
					if ($slide_data["slide".$i."_popup_type"] == 'HTML') {
						$lightbox_count++;
						$popup_output =  "<div class='sa_popup_zoom_icon' onClick='".$lightbox_function."(".$lightbox_count.");'></div>";
					}
				}

				// DISPLAY SLIDE OUTPUT
				//$data_hash = $slide_data['css_id']."_slide".sprintf('%02d', $i);
				//$output .= "<div class='sa_hover_container' data-hash='".$data_hash."' style='".esc_attr($slide_style)."'>";
				$css_id = $slide_data['css_id']."_slide".sprintf('%02d', $slide_data["slide".$i."_num"]);
				if ($slide_data['vert_center'] == 'true') {
					$output .= "<div id='".$css_id."' class='sa_hover_container sa_vert_center_wrap' style='".esc_attr($slide_style)."'>";
				} else {
					$output .= "<div id='".$css_id."' class='sa_hover_container' style='".esc_attr($slide_style)."'>";
				}
				if (($link_output != '') || ($popup_output != '')) {
					if ($slide_data['slide_icons_location'] == 'Top Left') {
						// icons location - top left
						$style = "top:0px; left:0px; margin:0px;";
					} elseif ($slide_data['slide_icons_location'] == 'Top Center') {
						// icons location - top center
						if (($link_output != '') && ($popup_output != ''))	{ $hov_marginL = '-40px'; }
						else																{ $hov_marginL = '-20px'; }
						$style = "top:0px; left:50%; margin-left:".$hov_marginL.";";
					} elseif ($slide_data['slide_icons_location'] == 'Top Right') {
						// icons location - top right
						$style = "top:0px; right:0px; margin:0px;";
					} elseif ($slide_data['slide_icons_location'] == 'Bottom Left') {
						// icons location - bottom left
						$style = "bottom:0px; left:0px; margin:0px;";
					} elseif ($slide_data['slide_icons_location'] == 'Bottom Center') {
						// icons location - bottom center
						if (($link_output != '') && ($popup_output != ''))	{ $hov_marginL = '-40px'; }
						else																{ $hov_marginL = '-20px'; }
						$style = "bottom:0px; left:50%; margin-left:".$hov_marginL.";";
					} elseif ($slide_data['slide_icons_location'] == 'Bottom Right') {
						// icons location - bottom right
						$style = "bottom:0px; right:0px; margin:0px;";
					} else {
						// icons location - center center (default)
						if (($link_output != '') && ($popup_output != '')) { $hov_marginL = '-40px'; }
						else																{ $hov_marginL = '-20px'; }
						$style = "top:50%; left:50%; margin-top:-20px; margin-left:".$hov_marginL.";";
					}
					if ($slide_data['slide_icons_visible'] == 'true') {
						$output .= "<div class='sa_hover_buttons always_visible' style='".$style."'>";
					} else {
						$output .= "<div class='sa_hover_buttons' style='".$style."'>";
					}
					if ($link_output != '') {
						$output .= $link_output;
					}
					if ($popup_output != '') {
						$output .= $popup_output;
					}
					$output .= "</div>\n"; // .sa_hover_buttons
				}
				if ($slide_data['strip_javascript'] == '1') {
					// strip JavaScript code (<script> tags) from slide content
					$slide_content = remove_javascript_from_content($slide_content);
				}
				if ($slide_data['lazy_load_images'] == '1') {
					// modify images (<img> tag) within slide content to enable owl carousel lazy load
					$slide_content = set_slide_images_to_lazy_load($slide_content);
				}
				if ($slide_data['vert_center'] == 'true') {
					// vertically center content within each slide
					// (we do this by wrapping slide content in a '<div>' wrapper
					$slide_content = "<div class='sa_vert_center'>".$slide_content."</div>";
				}
				$output .= $slide_content."</div>\n"; // .sa_hover_container
			}
			$output .= "</div>\n"; // .owl-carousel



			// PRO VERSION - THUMBNAIL PAGINATION
			if (($sa_pro_version) && ($slide_data['thumbs_active'] == '1')) {
				$thumbs_loc = $slide_data['thumbs_location'];
				$thumbs_opacity = $slide_data['thumbs_opacity'] / 100;
				// thumbnail container - set style
				$thumbs_style = " padding:".$slide_data['thumbs_padding']."%;";
				if ($thumbs_loc == 'inside_left') {
					$thumbs_style .= "left:".$slide_data['thumbs_padding']."%; width:".$slide_data['thumbs_width']."px;";
				} elseif ($thumbs_loc == 'inside_right') {
					$thumbs_style .= "right:".$slide_data['thumbs_padding']."%; width:".$slide_data['thumbs_width']."px;";
				} elseif ($thumbs_loc == 'outside_bottom') {
					$thumbs_style .= " padding-bottom:0px;";
				}
				$add_classes = '';
				if ($slide_data['thumbs_resp_tablet'] == 0) { $add_classes .= ' sa_thumbs_hide_tablet'; }
				if ($slide_data['thumbs_resp_mobile'] == 0) { $add_classes .= ' sa_thumbs_hide_mobile'; }
				$output .= "<div id='".esc_attr($slide_data['css_id'])."_thumbs' class='sa_owl_thumbs_wrap sa_thumbs_".$thumbs_loc.$add_classes."' style='".$thumbs_style."'>";
				$output .= "<div class='owl-thumbs' data-slider-id='".esc_attr($slide_data['css_id'])."'>";
				for ($i = 1; $i <= $slide_data['num_slides']; $i++) {
					// get background image for the thumb (slide image background)
					if (($slide_data["slide".$i."_popup_type"] == 'IMAGE') &&
						 ($slide_data["slide".$i."_popup_background"] != 'no') &&
						 ($slide_data["slide".$i."_popup_image"] != '')) {
						$thumb_image_arr = wp_get_attachment_image_src($slide_data["slide".$i."_popup_imageid"], $slide_data["slide".$i."_popup_background"]);
						$thumb_image_src = $thumb_image_arr[0];
					} elseif (($slide_data["slide".$i."_popup_type"] == 'VIDEO') &&
								 ($slide_data["slide".$i."_popup_video_type"] == "youtube") &&
								 ($slide_data["slide".$i."_image_id"] == '99999999')) {
						$thumb_image_src = array();
						$popup_video_id = $slide_data["slide".$i."_popup_video_id"];
						$thumb_image_src = "https://img.youtube.com/vi/".$popup_video_id."/hqdefault.jpg";
					} elseif ($slide_data["slide".$i."_image_id"] != 0) {
						$thumb_image_src = wp_get_attachment_image_src($slide_data["slide".$i."_image_id"], $slide_data['thumbs_image_size']);
						$thumb_image_src = $thumb_image_src[0];
					} else {
						// use a placeholder image if slide has no background image
						$thumb_image_src = SA_PLUGIN_PATH."images/image_placeholder.jpg";
					}
					// thumbnail - set style
					$thumb_style =  "background-image:url(\"".$thumb_image_src."\"); ";
					$thumb_style .= "width:".$slide_data['thumbs_width']."px; ";
					$thumb_style .= "height:".$slide_data['thumbs_height']."px; ";
					$thumb_style .= "background-position:".$slide_data["slide".$i."_image_pos"]."; ";
					$thumb_style .= "background-size:".$slide_data["slide".$i."_image_size"]."; ";
					$thumb_style .= "background-repeat:".$slide_data["slide".$i."_image_repeat"]."; ";
					$thumb_style .= "opacity:".$thumbs_opacity."; ";
					$thumb_style .= "border:solid ".$slide_data['thumbs_border_width']."px transparent";
					$output .= "<div class='owl-thumb-item' style='".$thumb_style."' title='Slide ".$i."'></div>";
				}
				$output .= "</div>";		// .sa_owl_thumbs
				$output .= "</div>\n";	// .sa_owl_thumbs_wrap
			}



			// SHOWCASE CAROUSEL - NAVIGATION CONTAINER
			if ($slide_data['showcase_slider'] == '1') {
				if ($slide_data['autohide_arrows'] == 'true') {
					$output .= "<div id='showcase_".esc_attr($id)."' class='showcase_nav owl-nav autohide_arrows'></div>\n";
				} else {
					$output .= "<div id='showcase_".esc_attr($id)."' class='showcase_nav owl-nav'></div>\n";
				}
			}



			$output .= "</div>\n"; // .white or .black



			// PRO VERSION - CREATE A (HIDDEN) DIV FOR EACH 'HTML' POPUP
			if ($sa_pro_version) {
				for ($i = 1; $i <= $slide_data['num_slides']; $i++) {
					if ($slide_data["slide".$i."_popup_type"] == 'HTML') {
						$popup_css_id = $slide_data["slide".$i."_popup_css_id"];
						$popup_bgcol = $slide_data["slide".$i."_popup_bgcol"];
						$popup_width = $slide_data["slide".$i."_popup_width"];
						$output .= "<div id='".$popup_css_id."' class='mfp-hide sa_custom_popup' ";
						$output .= "style='background:".$popup_bgcol."; max-width:".$popup_width."px;'>\n";
						if ($slide_data["slide".$i."_popup_shortcode"] == '1') {
							$output .= do_shortcode($slide_data["slide".$i."_popup_html"]);
						} else {
							$output .=  $slide_data["slide".$i."_popup_html"];
						}
						$output .=  "</div>\n";
					}
				}
			}



			// ### ENQUEUE JQUERY SCRIPT IF IT HAS NOT ALREADY BEEN LOADED ###
			if (!wp_script_is('jquery', 'done')) {
				wp_enqueue_script('jquery', false, array(), false, false);
			}



			// ### GENERATE JQUERY CODE FOR THE OWL CAROUSEL SLIDER ###
			if (($slide_data['items_width1'] == 1) && ($slide_data['items_width2'] == 1) && ($slide_data['items_width3'] == 1) &&
				 ($slide_data['items_width4'] == 1) && ($slide_data['items_width5'] == 1) && ($slide_data['items_width6'] == 1)) {
				$single_item = 1;
			} else {
				$single_item = 0;
			}

			$output .= "<script type='text/javascript'>\n";
			if ($slide_data['sa_window_onload'] == '1') {
				$output .= "	document.addEventListener('DOMContentLoaded', function() {\n";
			} else {
				$output .= "	jQuery(document).ready(function() {\n";
			}

			// JQUERY CODE FOR OWN CAROUSEL
			$output .= "		jQuery('#".esc_attr($slide_data['css_id'])."').owlCarousel({\n";
			if ($single_item == 1) {
				$output .= "			items : 1,\n";
				if (($slide_data['transition'] == 'Fade') || ($slide_data['transition'] == 'fade')) {
					$output .= "			animateOut : 'fadeOut',\n";
				} elseif (($slide_data['transition'] == 'Slide Down') || ($slide_data['transition'] == 'goDown')) {
					$output .= "			animateOut : 'slideOutDown',\n";
					$output .= "			animateIn : 'fadeIn',\n";
				} elseif ($slide_data['transition'] == 'Zoom In') {
					$output .= "			animateOut : 'fadeOut',\n";
					$output .= "			animateIn : 'zoomIn',\n";
				} elseif ($slide_data['transition'] == 'Zoom Out') {
					$output .= "			animateOut : 'zoomOut',\n";
					$output .= "			animateIn : 'fadeIn',\n";
				} elseif ($slide_data['transition'] == 'Flip Out X') {
					$output .= "			animateOut : 'flipOutX',\n";
					$output .= "			animateIn : 'fadeIn',\n";
				} elseif ($slide_data['transition'] == 'Flip Out Y') {
					$output .= "			animateOut : 'flipOutY',\n";
					$output .= "			animateIn : 'fadeIn',\n";
				} elseif ($slide_data['transition'] == 'Rotate Left') {
					$output .= "			animateOut : 'rotateOutDownLeft',\n";
					$output .= "			animateIn : 'fadeIn',\n";
				} elseif ($slide_data['transition'] == 'Rotate Right') {
					$output .= "			animateOut : 'rotateOutDownRight',\n";
					$output .= "			animateIn : 'fadeIn',\n";
				} elseif ($slide_data['transition'] == 'Bounce Out') {
					$output .= "			animateOut : 'bounceOut',\n";
					$output .= "			animateIn : 'fadeIn',\n";
				} elseif ($slide_data['transition'] == 'Roll Out') {
					$output .= "			animateOut : 'rollOut',\n";
					$output .= "			animateIn : 'fadeIn',\n";
				}
				$output .= "			smartSpeed : ".esc_attr($slide_data['slide_transition']).",\n";
			} else {
				$output .= "			responsive:{\n";
				$output .= "				0:{ items:".esc_attr($slide_data['items_width1'])." },\n";
				$output .= "				480:{ items:".esc_attr($slide_data['items_width2'])." },\n";
				$output .= "				768:{ items:".esc_attr($slide_data['items_width3'])." },\n";
				$output .= "				980:{ items:".esc_attr($slide_data['items_width4'])." },\n";
				$output .= "				1200:{ items:".esc_attr($slide_data['items_width5'])." },\n";
				$output .= "				1500:{ items:".esc_attr($slide_data['items_width6'])." }\n";
				$output .= "			},\n";
			}
			if ($slide_data['slide_duration'] == 0) {
				$output .= "			autoplay : false,\n";
				$output .= "			autoplayHoverPause : false,\n";
			} else {
				$output .= "			autoplay : true,\n";
				$output .= "			autoplayTimeout : ".esc_attr($slide_data['slide_duration']).",\n";
				$output .= "			autoplayHoverPause : ".esc_attr($slide_data['stop_hover']).",\n";
			}
			$output .= "			smartSpeed : ".esc_attr($slide_data['slide_transition']).",\n";
			$output .= "			fluidSpeed : ".esc_attr($slide_data['slide_transition']).",\n";
			$output .= "			autoplaySpeed : ".esc_attr($slide_data['slide_transition']).",\n";
			$output .= "			navSpeed : ".esc_attr($slide_data['slide_transition']).",\n";
			$output .= "			dotsSpeed : ".esc_attr($slide_data['slide_transition']).",\n";
			if ($slide_data['dot_per_slide'] == '1') {
				$output .= "			dotsEach : 1,\n";
			}
			$output .= "			loop : ".esc_attr($slide_data['loop_slider']).",\n";
			$output .= "			nav : ".esc_attr($slide_data['nav_arrows']).",\n";
			$output .= "			navText : ['Previous','Next'],\n";
			if ($slide_data['showcase_slider'] == '1') {
				$output .= "			navContainer : '#showcase_".esc_attr($id)."',\n";
			}
			$output .= "			dots : ".esc_attr($slide_data['pagination']).",\n";
			$output .= "			responsiveRefreshRate : 200,\n";
			if ($slide_data['slide_by'] == 'page') {
				$output .= "			slideBy : 'page',\n";
			} else {
				$output .= "			slideBy : ".esc_attr($slide_data['slide_by']).",\n";
			}
			$output .= "			mergeFit : true,\n";
			$output .= "			autoHeight : ".esc_attr($slide_data['auto_height']).",\n";
			if ($slide_data['lazy_load_images'] == '1') {
				$output .= "			lazyLoad : true,\n";
				$output .= "			lazyLoadEager: 1,\n";
			}
			if (($sa_pro_version) && ($slide_data['thumbs_active'] == '1')) {
				$output .= "			thumbs : true,\n";
				$output .= "			thumbsPrerendered : true,\n";
			}
			if ($slide_data['ulli_containers'] == '1') {
				$output .= "			stageElement : 'ul',\n";
				$output .= "			itemElement : 'li',\n";
			}
			if ($slide_data['rtl_slider'] == '1') {
				$output .= "			rtl : true,\n";
			}
			
			if ($slide_data['start_pos'] != 0) {
				$output .= "			startPosition : ".$slide_data['start_pos'].",\n";
			}
			$output .= "			mouseDrag : ".esc_attr($slide_data['mouse_drag']).",\n";
			$output .= "			touchDrag : ".esc_attr($slide_data['touch_drag'])."\n";
			$output .= "		});\n";

			// MAKE SLIDER VISIBLE (AFTER 'WINDOW ONLOAD' OR 'DOCUMENT READY' EVENT)
			$output .= "		jQuery('#".esc_attr($slide_data['css_id'])."').css('visibility', 'visible');\n";

			// JAVASCRIPT 'WINDOW RESIZE' EVENT TO SET CSS 'min-height' OF SLIDES WITHIN THIS SLIDER
			if ($slide_data['hero_slider'] != '1') {
				$slide_min_height = $slide_data['slide_min_height_perc'];
				if (strpos($slide_min_height, 'px') !== false) {
					$slide_min_height = 0;
				}
				if (($slide_min_height != '') && ($slide_min_height != '0')) {
					$output .= "		sa_resize_".esc_attr($slide_data['css_id'])."();\n";	// initial call of resize function
					$output .= "		window.addEventListener('resize', sa_resize_".esc_attr($slide_data['css_id']).");\n"; // create resize event
											// RESIZE EVENT FUNCTION (to set slide CSS 'min-heigh')
					$output .= "		function sa_resize_".esc_attr($slide_data['css_id'])."() {\n";
												// get slide min height setting
					$output .= "			var min_height = '".$slide_min_height."';\n";
												// get window width
					$output .= "			var win_width = jQuery(window).width();\n";
					$output .= "			var slider_width = jQuery('#".esc_attr($slide_data['css_id'])."').width();\n";
												// calculate slide width according to window width & number of slides
					$output .= "			if (win_width < 480) {\n";
					$output .= "				var slide_width = slider_width / ".esc_attr($slide_data['items_width1']).";\n";
					$output .= "			} else if (win_width < 768) {\n";
					$output .= "				var slide_width = slider_width / ".esc_attr($slide_data['items_width2']).";\n";
					$output .= "			} else if (win_width < 980) {\n";
					$output .= "				var slide_width = slider_width / ".esc_attr($slide_data['items_width3']).";\n";
					$output .= "			} else if (win_width < 1200) {\n";
					$output .= "				var slide_width = slider_width / ".esc_attr($slide_data['items_width4']).";\n";
					$output .= "			} else if (win_width < 1500) {\n";
					$output .= "				var slide_width = slider_width / ".esc_attr($slide_data['items_width5']).";\n";
					$output .= "			} else {\n";
					$output .= "				var slide_width = slider_width / ".esc_attr($slide_data['items_width6']).";\n";
					$output .= "			}\n";
					$output .= "			slide_width = Math.round(slide_width);\n";
												// calculate CSS 'min-height' using the captured 'min-height' data settings for this slider
					$output .= "			var slide_height = '0';\n";
					$output .= "			if (min_height == 'aspect43') {\n";
					$output .= "				slide_height = (slide_width / 4) * 3;";
					$output .= "				slide_height = Math.round(slide_height);\n";
					$output .= "			} else if (min_height == 'aspect169') {\n";
					$output .= "				slide_height = (slide_width / 16) * 9;";
					$output .= "				slide_height = Math.round(slide_height);\n";
					$output .= "			} else {\n";
					$output .= "				slide_height = (slide_width / 100) * min_height;";
					$output .= "				slide_height = Math.round(slide_height);\n";
					$output .= "			}\n";
												// set the slide 'min-height' css value
					$output .= "			jQuery('#".esc_attr($slide_data['css_id'])." .owl-item .sa_hover_container').css('min-height', slide_height+'px');\n";
					$output .= "		}\n";
				}
			}



			// JAVASCRIPT FOR SHOWCASE CAROUSELS ONLY
			// DYNAMICALLY SET CLASS NAMES FOR LEFTMOST (FIRST) AND RIGHTMOST (LAST) ACTIVE (DISPLAYED) SLIDES
			if ($slide_data['showcase_slider'] == '1') {
				$output .= "		set_first_last_active_classes('".esc_attr($slide_data['css_id'])."');\n";
				$output .= "		jQuery('#".esc_attr($slide_data['css_id'])."').on('translated.owl.carousel resized.owl.carousel', function(event) {\n";
				$output .= "			set_first_last_active_classes('".esc_attr($slide_data['css_id'])."');\n";
				$output .= "		});\n";
				$output .= "		function set_first_last_active_classes(css_id) {\n";
				$output .= "			var total = jQuery('#".esc_attr($slide_data['css_id'])." .owl-stage .owl-item.active').length;\n";
				$output .= "			jQuery('#".esc_attr($slide_data['css_id'])." .owl-stage .owl-item').removeClass('sc_partial');\n";
				$output .= "			jQuery('#".esc_attr($slide_data['css_id'])." .owl-stage .owl-item.active').each(function(index){\n";
				$output .= "				if (index === 0) {\n"; // this is the first active slide
				$output .= "					jQuery(this).addClass('sc_partial');\n";
				$output .= "				}\n";
				$output .= "				if (index === total - 1 && total > 1) {\n"; // this is the last active slide
				$output .= "					jQuery(this).addClass('sc_partial');\n";
				$output .= "				}\n";
				$output .= "			});\n";
				$output .= "		}\n";
			}



			// JAVASCRIPT FOR 'CLICK TO ADVANCE' OPTION ONLY
			if ($slide_data['click_advance'] == 'true') {
				if (($slide_data['touch_drag'] == 'false') && ($slide_data['mouse_drag'] == 'false')) {
					$output .= "		var cta_".$id." = jQuery('#".esc_attr($slide_data['css_id'])."');\n";
					$output .= "		jQuery('#".esc_attr($slide_data['css_id'])."').click(function() {\n";
					$output .= "			cta_".$id.".trigger('next.owl.carousel');\n";
					$output .= "		});\n";
				}
			}
			
			
			
			// JAVASCRIPT FOR 'SLIDE GOTO LINKS"
			$output .= "		var owl_goto = jQuery('#".esc_attr($slide_data['css_id'])."');\n";
			for ($i = 1; $i <= $slide_data['num_slides']; $i++) {
				$output .= "		jQuery('.".esc_attr($slide_data['css_id'])."_goto".$i."').click(function(event){\n";
				$output .= "			owl_goto.trigger('to.owl.carousel', ".($i-1).");\n";
				$output .= "		});\n";
			}
			
			
			
			// ### PRO VERSION - JQUERY/JAVASCRIPT CODE FOR THUMBNAIL PAGINATION ###
			if (($sa_pro_version) && ($slide_data['thumbs_active'] == '1')) {

				// BORDER WIDTH IS SET - SET BORDER COLOUR TO THE ACTIVE THUMB
				if ($slide_data['thumbs_border_width'] > 0) {
					// 					set border colour of the active (first) thumb
					$output .= "		jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .active').css('border-color', '".$slide_data['thumbs_border_color']."');\n";
					$output .= "		var owl = jQuery('#".esc_attr($slide_data['css_id'])."');\n";
					// 					owl carousel change event - set border colour of the active thumb
					$output .= "		owl.on('changed.owl.carousel', function(event) {\n";
					$output .= "			jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .owl-thumb-item').css('border-color', 'transparent');\n";
					$output .= "			jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .active').css('border-color', '".$slide_data['thumbs_border_color']."');\n";
					$output .= "		})\n";
				}

				//	RESIZE WINDOW EVENT - RESIZE THUMBS WIDTH & HEIGHT DEPENDING ON WINDOW WIDTH BREAKPOINTS
				$output .= "		sa_resize_thumbs_".esc_attr($slide_data['css_id'])."();\n";	// initial call of resize function
				$output .= "		window.addEventListener('resize', sa_resize_thumbs_".esc_attr($slide_data['css_id']).");\n"; // create resize event
				$output .= "		function sa_resize_thumbs_".esc_attr($slide_data['css_id'])."() {\n";
				$output .= "			var win_width = jQuery(window).width();\n";
				$output .= "			var tablet_perc = parseFloat(".$slide_data['thumbs_resp_tablet']." / 100);\n";
				$output .= "			var mobile_perc = parseFloat(".$slide_data['thumbs_resp_mobile']." / 100);\n";
				$output .= "			var tablet_width = Math.round(".$slide_data['thumbs_width']." * tablet_perc) + 'px';\n";
				$output .= "			var tablet_height = Math.round(".$slide_data['thumbs_height']." * tablet_perc) + 'px';\n";
				$output .= "			var mobile_width = Math.round(".$slide_data['thumbs_width']." * mobile_perc) + 'px';\n";
				$output .= "			var mobile_height = Math.round(".$slide_data['thumbs_height']." * mobile_perc) + 'px';\n";
				$output .= "			if ((mobile_perc != 0) && (win_width < 768)) {\n";
				$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .owl-thumb-item').css('width', mobile_width);\n";
				$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .owl-thumb-item').css('height', mobile_height);\n";
				$output .= "			} else if ((tablet_perc != 0) && (win_width < 1000)) {\n";
				$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .owl-thumb-item').css('width', tablet_width);\n";
				$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .owl-thumb-item').css('height', tablet_height);\n";
				$output .= "			} else {\n";
				$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .owl-thumb-item').css('width', '".$slide_data['thumbs_width']."px');\n";
				$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs .owl-thumbs .owl-thumb-item').css('height', '".$slide_data['thumbs_height']."px');\n";
				$output .= "			}\n";
				// THUMBS POSITION 'Inside Left' or 'Inside Right' - RESIZE CONTAINER WIDTH DEPENDING ON WINDOW WIDTH BREAKPOINTS
				if (($thumbs_loc == 'inside_left') || ($thumbs_loc == 'inside_right')) {
					$output .= "			if ((mobile_perc != 0) && (win_width < 768)) {\n";
					$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs').css('width', mobile_width);\n";
					$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs').css('height', mobile_height);\n";
					$output .= "			} else if ((tablet_perc != 0) && (win_width < 1000)) {\n";
					$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs').css('width', tablet_width);\n";
					$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs').css('height', tablet_height);\n";
					$output .= "			} else {\n";
					$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs').css('width', '".$slide_data['thumbs_width']."px');\n";
					$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."_thumbs').css('height', '".$slide_data['thumbs_height']."px');\n";
					$output .= "			}\n";
				}
				$output .= "		}\n";
			}
			
			// CALL THE WINDOW RESIZE EVENT AFTER THE OWL CAROUSEL SLIDER HAS BEEN INITIALIZED
			$output .= "		var resize_".$id." = jQuery('.owl-carousel');\n";
			$output .= "		resize_".$id.".on('initialized.owl.carousel', function(e) {\n";
			$output .= "			if (typeof(Event) === 'function') {\n";
			//								modern browsers
			$output .= "				window.dispatchEvent(new Event('resize'));\n";
			$output .= "			} else {\n";
			//								for IE and other old browsers (causes deprecation warning on modern browsers)
			$output .= "				var evt = window.document.createEvent('UIEvents');\n";
			$output .= "				evt.initUIEvent('resize', true, false, window, 0);\n";
			$output .= "				window.dispatchEvent(evt);\n";
			$output .= "			}\n";
			$output .= "		});\n";
			$output .= "	});\n";
			$output .= "</script>\n";



			// ### GENERATE JQUERY CODE FOR THE MAGNIFIC POPUP ###
			if (($sa_pro_version) && ($lightbox_count > 0)) {
				$output .= "<script type='text/javascript'>\n";
				$output .= "jQuery(document).ready(function() {\n";
				$output .= "	jQuery('#".$lightbox_gallery_id."').magnificPopup({\n";
				$output .= "		items: [\n";
				$count = 0;
				for ($i = 1; $i <= $slide_data['num_slides']; $i++) {
					// LOOP THROUGH EACH SLIDE
					if (($slide_data["slide".$i."_popup_type"] == 'IMAGE') && ($slide_data["slide".$i."_popup_image"] != '')) {
						// SLIDE CONTAINS AN IMAGE POPUP
						$img_url = $slide_data["slide".$i."_popup_image"];
						$img_title = $slide_data["slide".$i."_popup_imagetitle"];
						if ($img_title != '') {
							$output .= "			{ src: '".esc_attr($img_url)."', title: '".esc_attr($img_title)."' }";
						} else {
							$output .= "			{ src: '".esc_attr($img_url)."' }";
						}
						$count++;
						if ($count < $lightbox_count) {	$output .= ",\n"; }
						else {									$output .= "\n"; }
					}
					if (($slide_data["slide".$i."_popup_type"] == 'VIDEO') && ($slide_data["slide".$i."_popup_video_id"] != '')) {
						// SLIDE CONTAINS A VIDEO POPUP
						$video_id = $slide_data["slide".$i."_popup_video_id"];
						$video_type = $slide_data["slide".$i."_popup_video_type"];
						if ($video_type == 'youtube') {
							$video_url = "http://www.youtube.com/watch?v=".$video_id;
						} elseif ($video_type == 'vimeo') {
							$video_url = "http://vimeo.com/".$video_id;
						}
						$output .= "			{ src: '".esc_attr($video_url)."', type: 'iframe' }";
						$count++;
						if ($count < $lightbox_count) {	$output .= ",\n"; }
						else {									$output .= "\n"; }
					}
					if ($slide_data["slide".$i."_popup_type"] == 'HTML') {
						// SLIDE CONTAINS A HTML POPUP
						$popup_css_id = "#".$slide_data["slide".$i."_popup_css_id"];
						$output .= "			{ src: '".esc_attr($popup_css_id)."', type: 'inline' }";
						$count++;
						if ($count < $lightbox_count) {	$output .= ",\n"; }
						else {									$output .= "\n"; }
					}
				}
				$output .= "		],\n";
				$output .= "		gallery: { enabled: true, tCounter: '' },\n";
				$output .= "		mainClass: 'sa_popup',\n";
				$output .= "		closeBtnInside: true,\n";
				$output .= "		fixedContentPos: true,\n";
				if ($slide_data['slide_duration'] != 0) {
					$output .= "		callbacks: {\n";
					$output .= "			open: function() {\n";
					$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."').trigger('stop.owl.autoplay');\n";
					$output .= "			},\n";
					$output .= "			close: function() {\n";
					$output .= "				jQuery('#".esc_attr($slide_data['css_id'])."').trigger('play.owl.autoplay');\n";
					$output .= "			}\n";
					$output .= "		},\n";
				}
				$output .= "		type: 'image'\n";
				$output .= "	});\n";
				$output .= "});\n";

				// JAVASCRIPT FUNCTION WHICH OPENS THIS MAGNIFIC POPUP ON A SPECIFIED SLIDE
				$output .= "function ".$lightbox_function."(slide) {\n";
				$output .= "	jQuery('#".$lightbox_gallery_id."').magnificPopup('open');\n";
				$output .= "	jQuery('#".$lightbox_gallery_id."').magnificPopup('goTo', slide-1);\n";
				$output .= "}\n";
				$output .= "</script>\n";

				// DIV CONTAINER WHICH HOLDS THIS MAGNIFIC POPUP CONTENT (HIDDEN)
				$output .= "<div id='".$lightbox_gallery_id."' style='display:none;'></div>\n";
			}
		}
	}
	return $output;
}



// ### STRIP JAVASCRIPT ('<script>' tags) FROM SUPPLIED STRING ARGUMENT ###
function remove_javascript_from_content($slide_content) {
	if ($slide_content != '') {
		$dom = new DOMDocument();
		$dom->loadHTML($slide_content);
		//$dom->loadHTML($slide_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		$script = $dom->getElementsByTagName('script');
		$remove = array();
		foreach($script as $item) {
			$item->parentNode->removeChild($item);
		}
		//$slide_content = $dom->saveHTML();
		$slide_content = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());
	}
	return $slide_content;
}



// ### MODIFY IMAGES (<img> tag) WITHIN STRING PASSED (SLIDE CONTENT) TO ENABLE OWL CAROUSEL LAZY LOAD ###
function set_slide_images_to_lazy_load($slide_content) {
	if (trim($slide_content) != '') {
		// 1) REPLACE 'src=' WITH 'data-src=' WITHIN <IMG> TAGS
		$slide_content = preg_replace('~<img[^>]*\K(?=src)~i','data-', $slide_content);

		// 2) FOR EACH <IMG> TAG WITHIN THE SLIDE CONTENT, ADD THE 'owl-lazy' CLASS
		$dom = new DOMDocument();
		$dom->loadHTML(mb_convert_encoding($slide_content, 'HTML-ENTITIES', 'UTF-8'));
		//$dom->loadHTML(mb_convert_encoding($slide_content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
		$imgs = $dom->getElementsByTagName('img');
		foreach ($imgs as $img) {
			$curr_class = $img->getAttribute('class');
			if ($curr_class != '') {
				$img->setAttribute('class', $curr_class.' owl-lazy');
			} else {
				$img->setAttribute('class', 'owl-lazy');
			}
		}

		//$slide_content = $dom->saveHTML();
		$slide_content = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $dom->saveHTML());
	}
	
	return $slide_content;
}
?>