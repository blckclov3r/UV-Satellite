<?php
/*
Plugin Name: Sticky Menu (or Anything!) on Scroll
Plugin URI: https://wpsticky.com/
Description: Pick any element on the page, and it will stick when it reaches the top of the page when you scroll down. Handy for navigation menus, but can be used for any element on the page.
Author: WebFactory Ltd
Author URI: https://www.webfactoryltd.com/
Version: 2.31
Requires at least: 3.6
Tested up to: 5.6
Requires PHP: 5.2
*/

defined('ABSPATH') or die('INSERT COIN');

require_once dirname(__FILE__) . '/wf-flyout/wf-flyout.php';
new wf_flyout(__FILE__);

/**
 * === FUNCTIONS ========================================================================================
 */

/**
 * --- TRIGGERED ON ACTIVATION --------------------------------------------------------------------------
 * --- IF DATABASE VALUES ARE NOT SET AT ALL, ADD DEFAULT OPTIONS TO DATABASE ---------------------------
 */
if (!function_exists('sticky_anything_activate')) {
	function sticky_anything_activate() {
		$versionNum = '2.31';
		if (get_option('sticky_anything_options') === false) {
			$new_options['sa_version'] = $versionNum;
			$new_options['sa_element'] = '';
			$new_options['sa_topspace'] = '';
			$new_options['sa_adminbar'] = true;
			$new_options['sa_minscreenwidth'] = '';
			$new_options['sa_maxscreenwidth'] = '';
			$new_options['sa_zindex'] = '';
			$new_options['sa_legacymode'] = false;
			$new_options['sa_dynamicmode'] = false;
			$new_options['sa_debugmode'] = false;
			$new_options['sa_pushup'] = '';
      $new_options['sa_hide_review_notification'] = false;
      $new_options['sa_dismiss_upsell_auto_open'] = false;
			add_option('sticky_anything_options',$new_options);
		}
	}
}

/**
 * --- IF DATABASE VALUES EXIST, THEN THIS IS AN UPGRADE, SO CHECK IF NEWER OPTIONS EXIST --------------
 * --- IF NOT, ADD THESE OPTIONS WITH DEFAULT VALUES ---------------------------------------------------
 * --- AND UPDATE VERSION NUMBER FOR SURE --------------------------------------------------------------
 */
if (!function_exists('sticky_anything_update')) {
	function sticky_anything_update() {
		$versionNum = '2.1.1';
		$existing_options = get_option('sticky_anything_options');

		if(!isset($existing_options['sa_minscreenwidth'])) {
			// Introduced in version 1.1
			$existing_options['sa_minscreenwidth'] = '';
			$existing_options['sa_maxscreenwidth'] = '';
		}

		if(!isset($existing_options['sa_dynamicmode'])) {
			// Introduced in version 1.2
			$existing_options['sa_dynamicmode'] = false;
		}

		if(!isset($existing_options['sa_pushup'])) {
			// Introduced in version 1.3
			$existing_options['sa_pushup'] = '';
			$existing_options['sa_adminbar'] = true;
		}

		if(!isset($existing_options['sa_legacymode'])) {
			// Introduced in version 2.0
			// Keep the old/legacy mode, since that mode obviously worked before the upgrade.
			$existing_options['sa_legacymode'] = true;
    }

		$existing_options['sa_version'] = $versionNum;
		update_option('sticky_anything_options',$existing_options);
	}
}


/**
 * --- LOAD MAIN .JS FILE AND CALL IT WITH PARAMETERS (BASED ON DATABASE VALUES) -----------------------
 */
if (!function_exists('load_sticky_anything')) {
    function load_sticky_anything() {

		$options = get_option('sticky_anything_options');
		$versionNum = $options['sa_version'];

		// Main jQuery plugin file
			if($options['sa_debugmode']==true){
	    		wp_register_script('stickyAnythingLib', plugins_url('/assets/js/jq-sticky-anything.js', __FILE__), array( 'jquery' ), $versionNum);
	    	} else {
	    		wp_register_script('stickyAnythingLib', plugins_url('/assets/js/jq-sticky-anything.min.js', __FILE__), array( 'jquery' ), $versionNum);
	    	}
	    	wp_enqueue_script('stickyAnythingLib');

		// Set defaults for by-default-empty elements (because '' does not work with the JQ plugin)
		if (!$options['sa_topspace']) {
			$options['sa_topspace'] = '0';
		}

		if (!$options['sa_minscreenwidth']) {
			$options['sa_minscreenwidth'] = '0';
		}

		if (!$options['sa_maxscreenwidth']) {
			$options['sa_maxscreenwidth'] = '999999';
		}

		// If empty, set to 1 - not to 0. Also, if set to "0", keep it at 0.
		if (strlen($options['sa_zindex']) == "0") {		// LENGTH is 0 (not the actual value)
			$options['sa_zindex'] = '1';
		}

		$script_vars = array(
		      'element' => $options['sa_element'],
		      'topspace' => $options['sa_topspace'],
		      'minscreenwidth' => $options['sa_minscreenwidth'],
		      'maxscreenwidth' => $options['sa_maxscreenwidth'],
		      'zindex' => $options['sa_zindex'],
		      'legacymode' => $options['sa_legacymode'],
		      'dynamicmode' => $options['sa_dynamicmode'],
		      'debugmode' => $options['sa_debugmode'],
		      'pushup' => $options['sa_pushup'],
		      'adminbar' => $options['sa_adminbar']
		);

		wp_enqueue_script('stickThis', plugins_url('/assets/js/stickThis.js', __FILE__), array( 'jquery' ), $versionNum, true);
		wp_localize_script( 'stickThis', 'sticky_anything_engage', $script_vars );

    }
}


/**
 * --- ADD LINK TO SETTINGS PAGE TO SIDEBAR ------------------------------------------------------------
 */
if (!function_exists('sticky_anything_menu')) {
    function sticky_anything_menu() {
		add_options_page( 'Sticky Menu (or Anything!) Configuration', 'Sticky Menu (or Anything!)', 'manage_options', 'stickyanythingmenu', 'sticky_anything_config_page' );
    }
}


/**
 * --- ADD LINK TO SETTINGS PAGE TO PLUGIN ------------------------------------------------------------
 */
if (!function_exists('sticky_anything_settings_link')) {
function sticky_anything_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=stickyanythingmenu">Settings</a>';
  array_unshift($links, $settings_link);
  $links[] = '<a href="https://wpsticky.com/?ref=sticky-free-plugins-table" target="_blank"><b>Get PRO</b></a>';

  return $links;
}
}

function sticky_plugin_meta_links($links, $file) {
  $support_link = '<a target="_blank" href="https://wpsticky.com/documentation/?ref=sticky-free-support" title="Get help">Support</a>';

  if ($file == plugin_basename(__FILE__)) {
    $links[] = $support_link;
  }

  return $links;
} // sticky_plugin_meta_links

// additional powered by text in admin footer; only on Sticky page
function sticky_admin_footer_text($text) {
  $screen = get_current_screen();
  if ($screen->id != 'settings_page_stickyanythingmenu') {
    return;
  }

  $plugin_data = get_file_data(__FILE__, array('version' => 'Version'), 'plugin');

  $text = '<i><a href="https://wpsticky.com/?ref=sticky-free-footer" title="Visit WP Sticky site for more info" target="_blank">WP Sticky</a> v' . $plugin_data['version'] . ' by <a href="https://www.webfactoryltd.com/" title="Visit our site to get more great plugins" target="_blank">WebFactory Ltd</a>. Please <a target="_blank" href="https://wordpress.org/support/plugin/sticky-menu-or-anything-on-scroll/reviews/#new-post" title="Rate the plugin">rate the plugin <span>★★★★★</span></a> to help us spread the word. Thank you!</i>';

  return $text;
} // admin_footer_text


/**
 * --- THE WHOLE ADMIN SETTINGS PAGE -------------------------------------------------------------------
 */
if (!function_exists('sticky_anything_config_page')) {
	function sticky_anything_config_page() {
	// Retrieve plugin configuration options from database
  $sticky_anything_options = get_option( 'sticky_anything_options' );
	?>

	<div id="sticky-anything-settings-general" class="wrap">
		<h2 style="margin-bottom: 12px;"><img class="header-logo" src="<?php echo plugin_dir_url(__FILE__); ?>assets/img/wp-sticky-pro.png" alt="<?php _e('Sticky Menu (or Anything!) on Scroll','sticky-menu-or-anything-on-scroll'); ?>" title="<?php _e('Sticky Menu (or Anything!) on Scroll','sticky-menu-or-anything-on-scroll'); ?>"><?php _e('Sticky Menu (or Anything!) on Scroll','sticky-menu-or-anything-on-scroll'); ?></h2>

    <p><?php _e('Pick any element on the page, and it will stick when it reaches the top of the page when you scroll down. Great for headers and navigation menus, but can be used for any page element.','sticky-menu-or-anything-on-scroll'); ?><br><br></p>
<?php
  if (!empty($sticky_anything_options['sa_element']) && empty($sticky_anything_options['sa_hide_review_notification'])) {
    $dismiss_url = add_query_arg(array('action' => 'sticky_hide_review_notification', 'redirect' => urlencode($_SERVER['REQUEST_URI'])), admin_url('admin.php'));
    $dismiss_url = wp_nonce_url($dismiss_url, 'sticky_hide_review_notification');
?>
    <div class="notice-info notice notice-rate"><p><strong>Help us keep Sticky Menu updated &amp; free!</strong></p>
  <p>Glad to see Sticky is helping you make things stick 😎<br>Please help other users learn about Sticky by rating it. It takes only a few clicks but it keeps the plugin free, updated and supported! <b>Thank you!</b></p>
  <p><a href="https://wordpress.org/support/plugin/sticky-menu-or-anything-on-scroll/reviews/#new-post" class="button button-primary" target="_blank">I want to rate &amp; keep Sticky Menu free!</a> &nbsp; <a href="<?php echo $dismiss_url; ?>">I already rated it</a></p>
  </div>
<?php
  }
?>
		<div class="main-content">

			<?php
				if ( isset( $_GET['tab'] )) {
					$activeTab = $_GET['tab'];
				} else {
					$activeTab = 'main';
				}
        if ($activeTab != 'main' && $activeTab != 'advanced' && $activeTab != 'faq') {
          $activeTab = 'main';
        }
			?>

			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ($activeTab == 'main') { echo 'nav-tab-active'; } ?>" href="#main"><?php _e('Basic settings','sticky-menu-or-anything-on-scroll'); ?></a>
				<a class="nav-tab <?php if ($activeTab == 'advanced') { echo 'nav-tab-active'; } ?>" href="#advanced"><?php _e('Advanced settings','sticky-menu-or-anything-on-scroll'); ?></a>
        <a class="nav-tab <?php if ($activeTab == 'faq') { echo ' nav-tab-active'; } ?>" href="#faq"><?php _e('Support/FAQ','sticky-menu-or-anything-on-scroll'); ?></a>
        <a class="nav-tab nav-tab-pro open-sticky-pro-dialog" href="#" data-pro-feature="tab">Get Sticky PRO</a>
			</h2>

			<br>

			<?php

				$warnings = false;

				if ( isset( $_GET['message'] )) {
					if ($_GET['message'] == '1') {
						echo '<div id="message" class="fade updated"><p><strong>'.__('Settings Updated.','sticky-menu-or-anything-on-scroll').'</strong></p></div>';
					}
				}

				if ( isset( $_GET['message'] )) {
					if ($sticky_anything_options['sa_element'] == '') {
						$warnings = true;
					}
				}

				if ( (!is_numeric(@$sticky_anything_options['sa_topspace'])) && (@$sticky_anything_options['sa_topspace'] != '')) {
					// Top space is not empty and has bad value
					$warnings = true;
				}

				if ( (!is_numeric($sticky_anything_options['sa_minscreenwidth'])) && ($sticky_anything_options['sa_minscreenwidth'] != '')) {
					// Minimum width is not empty and has bad value
					$warnings = true;
				}

				if ( (!is_numeric($sticky_anything_options['sa_maxscreenwidth'])) && ($sticky_anything_options['sa_maxscreenwidth'] != '')) {
					// Maximum width is not empty and has bad value
					$warnings = true;
				}

				if ( ($sticky_anything_options['sa_minscreenwidth'] != '') && ($sticky_anything_options['sa_maxscreenwidth'] != '') && ( ($sticky_anything_options['sa_minscreenwidth']) >= ($sticky_anything_options['sa_maxscreenwidth']) ) ) {
					// Minimum width is larger than the maximum width
					$warnings = true;
				}

				if ((!is_numeric(@$sticky_anything_options['sa_zindex'])) && (@$sticky_anything_options['sa_zindex'] != '')) {
					// Z-index is not empty and has bad value
					$warnings = true;
				}

				// IF THERE ARE ERRORS, SHOW THEM
				if ( $warnings == true ) {
					echo '<div id="message" class="error"><p><strong>'.__('Please review the current settings:','sticky-menu-or-anything-on-scroll').'</strong></p>';
					echo '<ul style="list-style-type:disc; margin:0 0 20px 24px;">';

					if ($sticky_anything_options['sa_element'] == '') {
						echo '<li>'.__('<b>Sticky Element</b> is a required field. If you do not want anything sticky, consider disabling the plugin.','sticky-menu-or-anything-on-scroll').'</li>';
					}

					if ( (!is_numeric($sticky_anything_options['sa_topspace'])) && ($sticky_anything_options['sa_topspace'] != '')) {
						echo '<li>'.__('<b>Top Position</b> has to be a number (do not include "px" or "pixels", or any other characters).','sticky-menu-or-anything-on-scroll').'</li>';
					}

					if ( (!is_numeric($sticky_anything_options['sa_minscreenwidth'])) && ($sticky_anything_options['sa_minscreenwidth'] != '')) {
						echo '<li>'.__('<b>Minimum Screen Width</b> has to be a number (do not include "px" or "pixels", or any other characters).','sticky-menu-or-anything-on-scroll').'</li>';
					}

					if ( (!is_numeric($sticky_anything_options['sa_maxscreenwidth'])) && ($sticky_anything_options['sa_maxscreenwidth'] != '')) {
						echo '<li>'.__('<b>Maximum Screen Width</b> has to be a number (do not include "px" or "pixels", or any other characters).','sticky-menu-or-anything-on-scroll').'</li>';
					}

					if ( ($sticky_anything_options['sa_minscreenwidth'] != '') && ($sticky_anything_options['sa_maxscreenwidth'] != '') && ( ($sticky_anything_options['sa_minscreenwidth']) >= ($sticky_anything_options['sa_maxscreenwidth']) ) ) {
						echo '<li>'.__('MAXIMUM screen width has to have a larger value than the MINIMUM screen width.','sticky-menu-or-anything-on-scroll').'</li>';
					}

					if ((!is_numeric($sticky_anything_options['sa_zindex'])) && ($sticky_anything_options['sa_zindex'] != '')) {
						echo '<li>'.__('<b>Z-Index</b> has to be a number (do not include any other characters).','sticky-menu-or-anything-on-scroll').'</li>';
					}

					echo '</ul></div>';
				}

			?>

			<div class="tabs-content">

				<form method="post" action="admin-post.php">

					<div class="tab-content tab-sticky-main <?php if ($activeTab != 'main') {echo 'hide';} ?>">

						<input type="hidden" name="action" value="save_sticky_anything_options" />
						<!-- Adding security through hidden referrer field -->
						<?php wp_nonce_field( 'sticky_anything' ); ?>

						<table class="form-table">

							<tr>
								<th scope="row"><label for="sa_element"><?php _e('Sticky Element:','sticky-menu-or-anything-on-scroll'); ?> (required)</label> <span tooltip="<?php _e('The element that needs to be sticky once you scroll. This can be your menu, or any other element like a sidebar, ad banner, etc. Make sure this is a unique identifier.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
									<input type="text" id="sa_element" name="sa_element" value="<?php
										if (@$sticky_anything_options['sa_element'] != '#NO-ELEMENT') {
											echo esc_html( @$sticky_anything_options['sa_element'] );
										}
                  ?>"/> <em><?php _e('(choose ONE element, e.g. <strong>#main-navigation</strong>, OR <strong>.main-menu-1</strong>, OR <strong>header nav</strong>, etc.)','sticky-menu-or-anything-on-scroll'); ?></em>
                  <p>Don't know the element's ID or class? Don't even know what that is? Use the <a href="#" class="open-sticky-pro-dialog pro-feature" data-pro-feature="visual-elements-picker">visual element picker</a> and just point to the element you want.</p>
								</td>
              </tr>

              <tr>
								<th scope="row"><label for=""><?php _e('Add Another Sticky Element:','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('Need more than one element sticky on your site?','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
                  <p>Need two, three or ten elements on the site to be sticky? Upgrade to WP Sticky PRO and <a href="#" class="open-sticky-pro-dialog pro-feature" data-pro-feature="multiple-elements">make as many elements sticky as you need</a> and configure settings for each element individually.</p>
								</td>
							</tr>

							<tr>
								<th scope="row"><label for="sa_topspace"><?php _e('Space between top of page and sticky element: (optional)','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('If you don\'t want the element to be sticky at the very top of the page, but a little lower, add the number of pixels that should be between your element and the \'ceiling\' of the page.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
                  <input type="number" id="sa_topspace" name="sa_topspace" value="<?php echo esc_html( @$sticky_anything_options['sa_topspace'] ); ?>" style="width:80px;"> pixels
								</td>
              </tr>

              <tr>
								<th scope="row"><label for="sa_opacity"><?php _e('Sticky element opacity when scrolling: (optional)','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('Sticky element opacity when element is sticky/scrolling','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
                  <input type="number" id="sa_opacity" name="sa_opacity" value="100" style="width:80px;" disabled> %
                  <em>This option is available in <a href="#" class="open-sticky-pro-dialog pro-feature" data-pro-feature="opacity">WP Sticky PRO</a>.</em>
								</td>
							</tr>

							<tr>
								<th scope="row"><?php _e('Check for Admin Toolbar:','sticky-menu-or-anything-on-scroll'); ?> <span tooltip="<?php _e('If the sticky element gets obscured by the Administrator Toolbar for logged in users (or vice versa), check this box.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
									<input type="checkbox" id="sa_adminbar" name="sa_adminbar" <?php if ($sticky_anything_options['sa_adminbar']  ) echo ' checked="checked" ';?> />
									<label for="sa_adminbar"><?php _e('Move the sticky element down a little if there is an Administrator Toolbar at the top (for logged in users).','sticky-menu-or-anything-on-scroll'); ?></label>
								</td>
              </tr>

              <tr>
								<th scope="row"><label for="sa_effects"><?php _e('Effects:','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('Effects are added to the sticky element when scrolling','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
                <input type="checkbox" disabled> <label>Fade-in</label><br>
                <input type="checkbox" disabled> <label>Slide-down</label>
                <br>
                  <p>Effects are available in <a href="#" class="open-sticky-pro-dialog pro-feature" data-pro-feature="effects">WP Sticky PRO</a>.</p>
								</td>
              </tr>

              <tr>
								<th scope="row"><label for="sa_bg_color"><?php _e('Background Color When Sticky:','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('Element\'s background color when it\'s sticky','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
                <input class="sticky-color-field" type="text" id="sa_bg_color" value="" style="width:80px;">
                <br>
                  <p>Set a background color for the element when it's sticky.<br>
                    Background color is available in <a href="#" class="open-sticky-pro-dialog pro-feature" data-pro-feature="bgcolor">WP Sticky PRO</a>.</p>
								</td>
              </tr>

              <tr>
								<th scope="row"><label for="custom_css"><?php _e('Custom CSS:','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('Custom CSS that\'s added to the element when it\'s sticky','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
                <textarea id="custom_css" cols="40" rows="3" placeholder="border: 2px solid black;" disabled></textarea>
                <br>
                  <p>CSS properties that will be applied to the element when it's sticky.<br>
                  Do not wrap the properties in any selector, instead of <code>.classname{ color: #FFF; }</code> just write <code>color: #FFF;</code>
                    <br>Custom CSS is available in <a href="#" class="open-sticky-pro-dialog pro-feature" data-pro-feature="customcss">WP Sticky PRO</a>.</p>
								</td>
							</tr>

							<tr>
								<th scope="row"><label for="sa_minscreenwidth"><?php _e('Do not stick element when screen is smaller than: (optional)','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('Sometimes you do not want your element to be sticky when your screen is small (responsive menus, etc). If you enter a value here, your menu will not be sticky when your screen width is smaller than his value.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
									<input type="number" id="sa_minscreenwidth" name="sa_minscreenwidth" value="<?php echo esc_html( $sticky_anything_options['sa_minscreenwidth'] ); ?>" style="width:80px;" /> pixels
								</td>
							</tr>

							<tr>
								<th scope="row"><label for="sa_maxscreenwidth"><?php _e('Do not stick element when screen is larger than: (optional)','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('Sometimes you do not want your element to be sticky when your screen is large (responsive menus, etc). If you enter a value here, your menu will not be sticky when your screen width is wider than this value.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
									<input type="number" id="sa_maxscreenwidth" name="sa_maxscreenwidth" value="<?php echo esc_html( $sticky_anything_options['sa_maxscreenwidth'] ); ?>" style="width:80px;" /> pixels
								</td>
							</tr>

						</table>

					</div>

					<div class="tab-content tab-sticky-advanced <?php if ($activeTab != 'advanced') {echo 'hide';}?>">

						<input type="hidden" name="action" value="save_sticky_anything_options" />
						<!-- Adding security through hidden referrer field -->
						<?php wp_nonce_field( 'sticky_anything' ); ?>

						<table class="form-table">

							<tr>
								<th scope="row"><label for="sa_zindex"><?php _e('Z-index: (optional)','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('If there are other elements on the page that obscure/overlap the sticky element, adding a Z-index might help. If you have no idea what that means, try entering 99999.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
									<input type="number" id="sa_zindex" name="sa_zindex" value="<?php echo esc_html( @$sticky_anything_options['sa_zindex'] ); ?>" style="width:80px;" />
								</td>
							</tr>

							<tr>
								<th scope="row"><label for="sa_pushup"><?php _e('Push-up element (optional):','sticky-menu-or-anything-on-scroll'); ?></label> <span tooltip="<?php _e('If you want your sticky element to be \'pushed up\' again by another element lower on the page, enter it here. Make sure this is a unique identifier.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
									<input type="text" id="sa_pushup" name="sa_pushup" value="<?php
										if ($sticky_anything_options['sa_pushup'] != '#NO-ELEMENT') {
											echo esc_html( $sticky_anything_options['sa_pushup'] );
										}
                  ?>"/> <em><?php _e('(choose ONE element, e.g. <strong>#footer</strong>, OR <strong>.widget-bottom</strong>, etc.)','sticky-menu-or-anything-on-scroll'); ?></em>
                   <p>Don't know the element's ID or class? Don't even know what that is? Use the <a href="#" class="open-sticky-pro-dialog pro-feature" data-pro-feature="visual-elements-picker-2">visual element picker</a> and just point to the element you want.</p>
								</td>
							</tr>

							<tr>
								<th scope="row"><!-- <span class="new"><?php _e('NEW!','sticky-menu-or-anything-on-scroll'); ?></span>--> <?php _e('Legacy mode:','sticky-menu-or-anything-on-scroll'); ?> <span tooltip="<?php _e('If you upgraded from an earlier version and it always worked before, use legacy mode to keep using the old method.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
									<input type="checkbox" id="sa_legacymode" name="sa_legacymode" <?php if ($sticky_anything_options['sa_legacymode'] == true ) echo ' checked="checked" ';?> />
									<label for="sa_legacymode"><strong><?php _e('Legacy Mode (only recommended if you upgraded from earlier version).','sticky-menu-or-anything-on-scroll'); ?></strong></label>
									<p class="description"><?php _e('In version 2.0, a new/better method for making elements sticky was introduced. However, if you upgraded this plugin from an earlier version, and the old method always worked for you, there is no need to use the new method and you should keep this option checked.<br>More information about this setting can be found in the <a href="#faq" class="faq">FAQ</a>.','sticky-menu-or-anything-on-scroll'); ?></p>
								</td>
              </tr>

              <tr>
              <th scope="row"><?php _e('Don\'t use sticky on selected pages/posts:','sticky-menu-or-anything-on-scroll'); ?> <span tooltip="<?php _e('Pick pages, posts, categories, tags, or post types where sticky will not be active.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
              <td>
                    Posts: <select disabled><option>This option is available in the PRO version</option></select><br>
                    Pages: <select disabled><option>This option is available in the PRO version</option></select><br>
                    Categories: <select disabled><option>This option is available in the PRO version</option></select><br>
                    Tags: <select disabled><option>This option is available in the PRO version</option></select><br>
                    Post types: <select disabled><option>This option is available in the PRO version</option></select>
                    <p>If you need sticky elements only on some pages instead of the whole site check out <a href="#" class="open-sticky-pro-dialog pro-feature" data-pro-feature="page-picker">WP Sticky PRO</a>.</p>
              </td>
              </tr>

							<tr id="row-dynamic-mode" <?php if ($sticky_anything_options['sa_legacymode'] == false ) echo 'class="disabled-feature"';?>>
								<th scope="row"><div class="showhide" <?php if ($sticky_anything_options['sa_legacymode'] == false ) echo 'style="display:none;"';?>><?php _e('Dynamic mode:','sticky-menu-or-anything-on-scroll'); ?> <span tooltip="<?php _e('When Dynamic Mode is OFF, a cloned element will be created upon page load. If this mode is ON, a cloned element will be created every time your scrolled position hits the \'sticky\' point (option available in Legacy Mode only).','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></div></th>
								<td><div class="showhide" <?php if ($sticky_anything_options['sa_legacymode'] == false ) echo 'style="display:none;"';?>>
									<input type="checkbox" id="sa_dynamicmode" name="sa_dynamicmode" <?php if ($sticky_anything_options['sa_dynamicmode']  ) echo ' checked="checked" ';?> />
									<label for="sa_dynamicmode"><strong><?php _e('If the plugin doesn\'t work in your theme (often the case with responsive themes), try it in Dynamic Mode.','sticky-menu-or-anything-on-scroll'); ?></strong></label>
									<p class="description"><?php _e('NOTE: this is not a \'Magic Checkbox\' that fixes all problems. It simply solves some issues that frequently appear with some responsive themes, but doesn\'t necessarily work in ALL situations.','sticky-menu-or-anything-on-scroll'); ?></p>
									</div>
								</td>
							</tr>

							<tr>
								<th scope="row"><?php _e('Debug mode:','sticky-menu-or-anything-on-scroll'); ?> <span tooltip="<?php _e('When Debug Mode is on, error messages will be shown in your browser\'s console when the element you selected either doesn\'t exist, or when there are more elements on the page with your chosen selector.','sticky-menu-or-anything-on-scroll'); ?>"><span class="dashicons dashicons-editor-help"></span></span></th>
								<td>
									<input type="checkbox" id="sa_debugmode" name="sa_debugmode" <?php if (@$sticky_anything_options['sa_debugmode']  ) echo ' checked="checked" ';?> />
									<label for="sa_debugmode"><strong><?php _e('Log plugin errors in browser console','sticky-menu-or-anything-on-scroll'); ?></strong></label>
									<p class="description"><?php _e('This will help debugging the plugin in case of problems. Do NOT check this option in production environments.','sticky-menu-or-anything-on-scroll'); ?></p>
								</td>
							</tr>

						</table>

					</div>

					<div class="tab-content tab-sticky-main tab-sticky-advanced <?php if (($activeTab != 'main') && ($activeTab != 'advanced')) {echo 'hide';} ?>">

						<input type="hidden" name="sa_tab" value="<?php echo $activeTab ?>">

						&nbsp;<br><input type="submit" value="<?php _e('Save Changes','sticky-menu-or-anything-on-scroll'); ?>" class="button-primary"/>

					</div>

				</form>

				<div class="tab-content tab-sticky-faq <?php if ($activeTab != 'faq') {echo 'hide';} ?>">
					<?php include 'assets/faq.php'; ?>
				</div>

			</div>

		</div>


      <?php
      if (empty($sticky_anything_options['sa_hide_review_notification'])) {
        echo '<div class="main-sidebar">';
        include 'assets/sidebar.php';
        echo '</div>';
      }
      $plugin_url = plugin_dir_url(__FILE__);
       ?>

<div class="pro-ad-sidebar">
<a title="WP Sticky PRO" href="#" class="open-sticky-pro-dialog" data-pro-feature="sidebar">
<div class="inner center logo">
  <img style="max-height: 100px;" src="<?php echo $plugin_url; ?>assets/img/wp-sticky-pro.png" alt="WP Sticky PRO" title="WP Sticky PRO"><br>
  <h3>WP Sticky PRO is here!<br>Grab the <u>50% OFF</u> launch DISCOUNT 🚀</h3>
</div></a>
</div>

	</div>

	<?php
	}
}


if (!function_exists('sticky_anything_admin_init')) {
	function sticky_anything_admin_init() {
		add_action( 'admin_post_save_sticky_anything_options', 'process_sticky_anything_options' );
	}
}

/**
 * --- PROCESS THE SETTINGS FORM AFTER SUBMITTING ------------------------------------------------------
 */
if (!function_exists('process_sticky_anything_options')) {
	function process_sticky_anything_options() {

		if ( !current_user_can( 'manage_options' ))
			wp_die( 'Not allowed');

		check_admin_referer('sticky_anything');
		$options = get_option('sticky_anything_options');

		foreach ( array('sa_element') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			}
		}

		foreach ( array('sa_topspace') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			}
		}

		foreach ( array('sa_minscreenwidth') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			}
		}

		foreach ( array('sa_maxscreenwidth') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			}
		}

		foreach ( array('sa_zindex') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			}
		}

		foreach ( array('sa_pushup') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			}
		}

		foreach ( array('sa_adminbar') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sa_legacymode') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sa_dynamicmode') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sa_debugmode') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('sa_tab') as $option_name ) {
			if ( isset( $_POST[$option_name] ) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			}
		}

		$tabValue = $_POST['sa_tab'];

		update_option( 'sticky_anything_options', $options );
 		wp_redirect( add_query_arg(
 			array('page' => 'stickyanythingmenu', 'message' => '1', 'tab' => $tabValue),
 			admin_url( 'options-general.php' )
 			)
 		);

		exit;
	}
}


/**
 * --- ADD THE .CSS AND .JS TO ADMIN MENU --------------------------------------------------------------
 */
if (!function_exists('sticky_anything_styles')) {
	function sticky_anything_styles($hook) {

    // welcome pointer is shown on all pages except Sticky, only to admins, until dismissed
    $pointers = sticky_get_pointers();
    $dismissed_notices = sticky_get_dismissed_notices();

    foreach ($dismissed_notices as $notice_name => $tmp) {
      if ($tmp) {
        unset($pointers[$notice_name]);
      }
    } // foreach

    if (current_user_can('administrator') && !empty($pointers) && 'settings_page_stickyanythingmenu' != $hook) {
      $pointers['_nonce_dismiss_notice'] = wp_create_nonce('sticky_dismiss_notice');

      wp_enqueue_style('wp-pointer');

      wp_enqueue_script('wp-sticky-pointers', plugins_url('assets/js/sticky-admin-pointers.js', __FILE__), array('jquery'), 1, true);
      wp_enqueue_script('wp-pointer');
      wp_localize_script('wp-pointer', 'sticky_pointers', $pointers);
    }

		if ($hook != 'settings_page_stickyanythingmenu') {
			return;
		}

    $sticky_anything_options = get_option( 'sticky_anything_options' );

		wp_register_script('stickyAnythingAdminScript', plugins_url('/assets/js/sticky-anything-admin.js', __FILE__), array( 'jquery' ), '2.1.1');
		wp_enqueue_script('stickyAnythingAdminScript');

		wp_register_style('stickyAnythingAdminStyle', plugins_url('/assets/css/sticky-anything-admin.css', __FILE__) );
    wp_enqueue_style('stickyAnythingAdminStyle');

    wp_enqueue_style('wp-jquery-ui-dialog');
    wp_enqueue_script('jquery-ui-dialog');

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');

    $js_vars = array(
      'auto_open_pro_dialog' => empty($sticky_anything_options['sa_dismiss_upsell_auto_open']),
    );

    wp_localize_script('jquery-ui-dialog', 'wpsticky', $js_vars);

    $sticky_anything_options['sa_dismiss_upsell_auto_open'] = true;
    update_option('sticky_anything_options', $sticky_anything_options);
	}
}

function sticky_anything_admin_footer() {
  $screen = get_current_screen();
  if ($screen->id != 'settings_page_stickyanythingmenu') {
    return;
  }

  $out = '';
  $out .= '<div id="sticky-pro-dialog" style="display: none;" title="WP Sticky PRO is here!"><span class="ui-helper-hidden-accessible"><input type="text"/></span>';

  $plugin_url = plugin_dir_url(__FILE__);

  //$out .= '<div class="center logo"><a href="https://wpsticky.com/?ref=sticky-free-popup" target="_blank"><img style="max-height: 100px;" src="' . $plugin_url . 'assets/img/wp-sticky-pro.png' . '" alt="WP Sticky PRO" title="WP Sticky PRO"></a><br>
  $out .= '<div class="center logo"><b><a href="https://wpsticky.com/?ref=sticky-free-popup" target="_blank">WP Sticky PRO</a> is here!<br>Grab the <i>50% OFF</i> launch DISCOUNT 🚀</b></div>';

  $out .= '<table id="sticky-table">';
  $out .= '<tr>';
  $out .= '<td class="center">Lifetime<br>Single License</td>';
  $out .= '<td class="center">Lifetime<br>Team License</td>';
  $out .= '<td class="center">Lifetime<br>Agency License</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-yes"></span><b>1 Site License</b></td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span><b>3 Sites License</b></td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span><b>100 Sites License</b></td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-no"></span>Install on Client Sites</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Install on Client Sites</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Install on Client Sites</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-no"></span>White-Label Mode</td>';
  $out .= '<td><span class="dashicons dashicons-no"></span>White-Label Mode</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>White-Label Mode</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>One Time Payment</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>One Time Payment</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>One Time Payment</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Lifetime Updates &amp; Support</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Lifetime Updates &amp; Support</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Lifetime Updates &amp; Support</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Priority email support</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Priority email support</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Priority email support</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>All Plugin Features</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>All Plugin Features</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>All Plugin Features</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Unlimited Sticky Elements</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Unlimited Sticky Elements</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Unlimited Sticky Elements</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Visual Elements Picker</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Visual Elements Picker</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Visual Elements Picker</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Advanced Options &amp; Effects</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Advanced Options &amp; Effects</td>';
  $out .= '<td><span class="dashicons dashicons-yes"></span>Advanced Options &amp; Effects</td>';
  $out .= '</tr>';

  $out .= '<tr>';
  $out .= '<td><span>20% discount</span><a class="button button-buy" data-href-org="https://wpsticky.com/buy/?product=single-launch&ref=pricing-table" href="https://wpsticky.com/buy/?product=single-launch&ref=pricing-table" target="_blank">BUY NOW <del>$49</del> $39</a><br>-or-<br><a class="button button-buy" data-href-org="https://wpsticky.com/buy/?product=single-monthly&ref=pricing-table" href="https://wpsticky.com/buy/?product=single-monthly&ref=pricing-table" target="_blank">ONLY $5.99 <small>/month</small></a></td>';
  $out .= '<td><span>40% discount</span><a class="button button-buy" data-href-org="https://wpsticky.com/buy/?product=team-launch&ref=pricing-table" href="https://wpsticky.com/buy/?product=team-launch&ref=pricing-table" target="_blank">BUY NOW <del>$79</del> $49</a></td>';
  $out .= '<td><span>$100 discount</span><a class="button button-buy" data-href-org="https://wpsticky.com/buy/?product=agency-launch&ref=pricing-table" href="https://wpsticky.com/buy/?product=agency-launch&ref=pricing-table" target="_blank">BUY NOW <del>$199</del> $99</a></td>';
  $out .= '</tr>';

  $out .= '</table>';

  $out .= '<div class="center footer"><b>100% No-Risk Money Back Guarantee!</b> If you don\'t like the plugin over the next 7 days, we\'ll refund 100% of your money. No questions asked! Payments are processed by our merchant of records - <a href="https://paddle.com" target="_blank">Paddle</a>.</div></div>';

  echo $out;
} // sticky_anything_admin_footer


  function sticky_hide_review_notification() {
    if (false == wp_verify_nonce(@$_GET['_wpnonce'], 'sticky_hide_review_notification')) {
      wp_die('Please click back, reload the page and try again.');
    }

    $sticky_anything_options = get_option( 'sticky_anything_options' );
    $sticky_anything_options['sa_hide_review_notification'] = true;
    update_option('sticky_anything_options', $sticky_anything_options);

    if (!empty($_GET['redirect'])) {
      wp_safe_redirect(esc_url($_GET['redirect']));
    } else {
      wp_safe_redirect(admin_url('options-general.php?page=stickyanythingmenu'));
    }

    exit;
  } // sticky_hide_review_notification


   /**
   * Returns all WP pointers
   *
   * @return array
   */
  function sticky_get_pointers()
  {
    $pointers = array();

    $pointers['welcome'] = array('target' => '#menu-settings', 'edge' => 'left', 'align' => 'right', 'content' => 'Thank you for using the <b style="font-weight: 700;">Sticky Menu (or Anything!) on Scroll</b> plugin.<br>Open <a href="' . admin_url('options-general.php?page=stickyanythingmenu') . '">Settings - Sticky Menu</a> to make anything sticky.');

    return $pointers;
  } // sticky_get_pointers


  /**
   * Get all dismissed notices, or check for one specific notice.
   *
   * @param string  $notice_name  Optional. Check if specified notice is dismissed.
   *
   * @return bool|array
   */
  function sticky_get_dismissed_notices($notice_name = '')
  {
    $notices = get_option('sticky_dismissed_notices', array());

    if (empty($notice_name)) {
      return $notices;
    } else {
      if (empty($notices[$notice_name])) {
        return false;
      } else {
        return true;
      }
    }
  } // sticky_get_dismissed_notices


  /**
   * Dismiss notice via AJAX call
   *
   * @return null
   */
  function sticky_ajax_dismiss_notice()
  {
    check_ajax_referer('sticky_dismiss_notice');

    if (empty($_POST['notice_name'])) {
      wp_send_json_error('Notice name is undefined.');
    } else {
      $notice_name = substr(sanitize_key($_POST['notice_name']), 0, 64);
    }

    $notices = get_option('sticky_dismissed_notices', array());
    $notices[$notice_name] = true;
    update_option('sticky_dismissed_notices', $notices);

    wp_send_json_success();
  } // sticky_ajax_dismiss_notice


  function sticky_anything_deactivate() {
    delete_option('sticky_dismissed_notices');

    $sticky_anything_options = get_option('sticky_anything_options');
    unset($sticky_anything_options['sa_dismiss_upsell_auto_open']);
    update_option('sticky_anything_options', $sticky_anything_options);
  }

/**
 * === HOOKS AND ACTIONS AND FILTERS AND SUCH ==========================================================
 */

$plugin = plugin_basename(__FILE__);

register_activation_hook( __FILE__, 'sticky_anything_activate' );
register_deactivation_hook( __FILE__, 'sticky_anything_deactivate' );
add_action('init','sticky_anything_update',1);
add_action('wp_enqueue_scripts', 'load_sticky_anything');
add_action('admin_menu', 'sticky_anything_menu');
add_action('admin_init', 'sticky_anything_admin_init');
add_action('admin_footer', 'sticky_anything_admin_footer');
add_action('admin_enqueue_scripts', 'sticky_anything_styles' );
add_filter("plugin_action_links_$plugin", 'sticky_anything_settings_link' );
add_filter('plugin_row_meta', 'sticky_plugin_meta_links', 10, 2);
add_filter('admin_footer_text', 'sticky_admin_footer_text');
add_action('admin_action_sticky_hide_review_notification', 'sticky_hide_review_notification');
add_action('wp_ajax_sticky_dismiss_notice', 'sticky_ajax_dismiss_notice');
