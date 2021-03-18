<h3>Help us keep Sticky Menu updated &amp; free!</h3>

<?php
  $options = get_option('sticky_anything_options');
  $dismiss_url = add_query_arg(array('action' => 'sticky_hide_review_notification', 'redirect' => urlencode($_SERVER['REQUEST_URI'])), admin_url('admin.php'));
    $dismiss_url = wp_nonce_url($dismiss_url, 'sticky_hide_review_notification');
?>

<div class="inner">

Glad to see Sticky is helping you make things stick 😎<br>Please help other users learn about Sticky by rating it. It takes only a few clicks but it keeps the plugin free, updated and supported! <b>Thank you!</b>

</div>

<p><a href="https://wordpress.org/support/plugin/sticky-menu-or-anything-on-scroll/reviews/#new-post" class="button button-primary" target="_blank">I want to rate &amp; keep Sticky Menu free!</a> &nbsp; <a href="<?php echo $dismiss_url; ?>">I already rated it</a></p>

