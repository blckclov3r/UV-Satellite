<?php
/**
 * Shortcode Preview 
 *
 * @package Post Slider and Carousel 
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$authenticated          = true; 
$registered_shortcodes  = psac_registered_shortcodes();

// Getting shortcode value
if( ! empty( $_POST['psac_customizer_shrt'] ) ) {
	$shortcode_val = psac_clean( $_POST['psac_customizer_shrt'] );
} elseif ( !empty($_GET['shortcode']) && isset( $registered_shortcodes[ $_GET['shortcode'] ] ) ) {
	$shortcode_val = '['.$_GET['shortcode'].']';
} else {
	$shortcode_val = '';
}

// For authentication so no one can use page via URL
if( isset($_SERVER['HTTP_REFERER']) ) {
	$url_query  = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
	parse_str( $url_query, $referer );

	if( !empty($referer['page']) && $referer['page'] == 'psac-shrt-generator' ) {
		$authenticated = true;
	}
}

// Check Authentication else exit
if( ! $authenticated ) {
	wp_die( __('Sorry, you are not allowed to access this page.', 'post-slider-and-carousel') );
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="Imagetoolbar" content="No" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php esc_html_e("Shortcode Preview", "post-slider-and-carousel"); ?></title>

		<?php wp_print_styles('common'); ?>		
		<link rel="stylesheet" href="<?php echo PSAC_URL; ?>assets/css/owl.carousel.min.css?ver=<?php echo PSAC_VERSION; ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo PSAC_URL; ?>assets/css/psac-public.css?ver=<?php echo PSAC_VERSION; ?>" type="text/css" />
		<?php do_action( 'psac_shortcode_preview_head', $shortcode_val ); ?>

		<style type="text/css">
			body{background: #fff; overflow-x: hidden;}
			.psac-customizer-container{padding:0 16px;}
			.psac-customizer-container a[href^="http"]{cursor:not-allowed !important;}
			a:focus, a:active{box-shadow: none; outline: none;}
			.psac-link-notice{display: none; position: fixed; color: #a94442; background-color: #f2dede; border:1px solid #ebccd1; max-width:300px; width: 100%; left:0; right:0; bottom:30%; margin:auto; padding:10px; text-align: center; z-index: 1050;}
		</style>
		<?php wp_print_scripts( array('jquery') ); ?>
	</head>
	<body>
		<div id="psac-customizer-container" class="psac-customizer-container">
			<?php if( $shortcode_val ) {				
				echo do_shortcode( $shortcode_val );
			} ?>
		</div>
		<div class="psac-link-notice"><?php _e('Sorry, You can not visit the link in preview mode.', 'post-slider-and-carousel'); ?></div>

		<script type='text/javascript'> 
		/*<![CDATA[*/
		var Psac = <?php echo wp_json_encode(array(
												'ajax_url'			=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
												'is_mobile'			=> (wp_is_mobile()) ? 1 : 0,
												'is_rtl'			=> (is_rtl())       ? 1 : 0,												
											)); ?>;
		/*]]>*/
		</script>
		<script type="text/javascript" src="<?php echo PSAC_URL; ?>assets/js/owl.carousel.min.js?ver=<?php echo PSAC_VERSION; ?>"></script>		
		<script type="text/javascript" src="<?php echo PSAC_URL; ?>assets/js/psac-public.js?ver=<?php echo PSAC_VERSION; ?>"></script>
		<?php do_action( 'psac_shortcode_preview_footer', $shortcode_val ); ?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(document).on('click', 'a', function(event) {

				var href_val = $(this).attr('href');

				if( href_val.indexOf('javascript:') < 0 ) {
					$('.psac-link-notice').fadeIn();
				}
				event.preventDefault();

				setTimeout(function() {
					$(".psac-link-notice").fadeOut('normal');
				}, 4000 );
			});
		});
		</script>
	</body>
</html>