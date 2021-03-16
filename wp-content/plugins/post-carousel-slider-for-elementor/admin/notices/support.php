<?php
function wb_nt_help_support_notice() {
?>
	<div class="notice notice-info is-dismissible">
		<h3>News Ticker for Elementor</h3>
		<p class="wb-nt-font-16">Facing Problem or need your Custom Project Done? Don't hesitate to contact with our support team. Just send us an email at <a class=" wb-nt-bold wb-text-decoration-none" href='mailto:webbuilders03@gmail.com'><strong>webbuilders03@gmail.com</strong></a> </p>.
	</div>
<?php
}
add_action( 'admin_notices', 'wb_nt_help_support_notice' );