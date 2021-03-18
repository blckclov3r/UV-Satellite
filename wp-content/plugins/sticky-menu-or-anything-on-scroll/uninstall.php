<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

delete_option('sticky_anything_options');
delete_option('sticky_dismissed_notices');
