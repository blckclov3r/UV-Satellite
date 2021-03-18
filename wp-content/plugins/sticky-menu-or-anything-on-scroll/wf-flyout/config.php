<?php
$config = array();

$config['plugin_screen'] = 'settings_page_stickyanythingmenu';
$config['icon_border'] = '1px solid #00000099';
$config['icon_right'] = '35px';
$config['icon_bottom'] = '35px';
$config['icon_image'] = 'sticky.png';
$config['icon_padding'] = '9px';
$config['icon_size'] = '55px';
$config['menu_accent_color'] = '#ffde66';
$config['custom_css'] = '#wf-flyout .wff-menu-item .dashicons.dashicons-universal-access { font-size: 30px; padding: 0px 10px 0px 0; } #wf-flyout .ucp-icon .wff-icon img { max-width: 70%; } #wf-flyout .ucp-icon .wff-icon { line-height: 57px; } #wf-flyout .wff-menu-item .dashicons.dashicons-admin-post { color: #3f3e40; } #wf-flyout .wp301-icon .wff-icon img { max-width: 70%; } #wf-flyout .wp301-icon .wff-icon { line-height: 57px; }';

$config['menu_items'] = array(
  array('href' => '#', 'label' => 'Get WP Sticky PRO with 50% off', 'icon' => 'dashicons-admin-post', 'class' => 'accent open-sticky-pro-dialog', 'data' => 'data-pro-feature="flyout"'),
  array('href' => 'https://wp301redirects.com/?ref=wff-sticky&coupon=50off', 'label' => 'Get WP 301 Redirects PRO with 50% off', 'icon' => '301-logo.png', 'class' => 'wp301-icon'),
  array('href' => 'https://wpreset.com/?ref=wff-sticky&coupon=50off', 'target' => '_blank', 'label' => 'Get WP Reset PRO with 50% off', 'icon' => 'wp-reset.png'),
  array('href' => 'https://underconstructionpage.com/?ref=wff-sticky&coupon=welcome', 'target' => '_blank', 'label' => 'Create the perfect Under Construction Page', 'icon' => 'ucp.png', 'class' => 'ucp-icon'),
  array('href' => 'https://wordpress.org/support/plugin/sticky-menu-or-anything-on-scroll/reviews/?filter=5#new-post', 'target' => '_blank', 'label' => 'Rate the Plugin', 'icon' => 'dashicons-thumbs-up'),
  array('href' => 'https://wordpress.org/support/plugin/sticky-menu-or-anything-on-scroll/#new-post', 'target' => '_blank', 'label' => 'Get Support', 'icon' => 'dashicons-sos'),
);
