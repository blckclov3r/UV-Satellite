<?php
/**
 * Featured and Trending Post Pro Shortcode Mapper Page 
 *
 * @package Post Slider and Carousel Pro
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$valid					= true;
$registered_shortcodes 	= psac_registered_shortcodes();
$shortcodes_arr 		= psac_registered_shortcodes( false );
$preview_shortcode 		= !empty($_GET['shortcode']) ? $_GET['shortcode'] : apply_filters('psac_default_preview_shortcode', 'psac_post_slider' );
$preview_url 			= add_query_arg( array( 'page' => 'psac-shortcode-preview', 'shortcode' => $preview_shortcode), admin_url('admin.php') );
$shrt_generator_url 	= add_query_arg( array('page' => 'psac-shrt-generator'), admin_url('admin.php') );

// Instantiate the shortcode builder
if( ! class_exists( 'PSAC_Shortcode_Generator' ) ) {
	include_once( PSAC_DIR . '/includes/admin/shortcode-generator/class-psac-shortcode-generator.php' );
}

$shortcode_val		= '';
$shortcode_fields 	= array();
$shortcode_sanitize = str_replace('-', '_', $preview_shortcode);
?>
<div class="wrap psac-customizer-settings">

	<h2><?php _e( 'Post Slider and Carousel - Shortcode Builder', 'post-slider-and-carousel' ); ?></h2>

	<?php
	// If invalid shortcode is passed then simply return
	if( !empty($_GET['shortcode']) && !isset( $registered_shortcodes[ $_GET['shortcode'] ] ) ) {
		
		$valid = false;

		echo '<div id="message" class="error notice">
				<p><strong>'.__('Sorry, Something happened wrong.', 'post-slider-and-carousel').'</strong></p>
			 </div>';
	}
	?>

	<?php if( $valid ) : ?>
	<div class="psac-shrt-toolbar">
		<?php if( !empty( $registered_shortcodes ) ) { ?>
			<select class="psac-shrt-switcher" id="psac-shrt-switcher">
				<option value=""><?php esc_html_e('-- Choose Shortcode --', 'post-slider-and-carousel'); ?></option>
				<?php foreach ($shortcodes_arr as $shrt_grp_key => $shrt_grp_val) {

					// Creating OPT group
					if( is_array( $shrt_grp_val ) && ! empty( $shrt_grp_val['shortcodes'] ) ) {

						$option_grp_name = !empty( $shrt_grp_val['name'] ) ? $shrt_grp_val['name'] : __('General', 'post-slider-and-carousel');
				?>
						<optgroup label="<?php echo psac_esc_attr( $option_grp_name ); ?>">
						<?php foreach ($shrt_grp_val['shortcodes'] as $shrt_key => $shrt_val) {

							if( empty($shrt_key) ) {
								continue;
							}

							$shrt_val 		= !empty($shrt_val) ? $shrt_val : $shrt_key;
							$shortcode_url 	= add_query_arg( array('shortcode' => $shrt_key), $shrt_generator_url );
						?>
							<option value="<?php echo $shrt_key; ?>" <?php selected( $preview_shortcode, $shrt_key); ?> data-url="<?php echo esc_url( $shortcode_url ); ?>"><?php echo $shrt_val; ?></option>
						<?php } ?>
						</optgroup>

					<?php } else { 
							$shrt_val 		= !empty($shrt_grp_val) ? $shrt_grp_val : $shrt_grp_key;
							$shortcode_url 	= add_query_arg( array('shortcode' => $shrt_grp_key), $shrt_generator_url );
					?>
						<option value="<?php echo $shrt_grp_key; ?>" <?php selected( $preview_shortcode, $shrt_grp_key); ?> data-url="<?php echo esc_url( $shortcode_url ); ?>"><?php echo $shrt_grp_val; ?></option>
				<?php } // End of else
				} ?>
			</select>
		<?php } ?>

		<span class="psac-shrt-generate-help psac-tooltip" title="<?php _e("The shortcode builder allows you to preview plugin shortcode. You can choose your desired shortcode from the dropdown and check various parameters from left panel. \n\nYou can paste shortcode to below and press Generate button to preview so each and every time you do not have to choose each parameters!!!", 'post-slider-and-carousel'); ?>"><i class="dashicons dashicons-editor-help"></i></span>
	</div><!-- end .psac-shrt-toolbar -->

	<div class="psac-customizer psac-clearfix" data-shortcode="<?php echo $preview_shortcode; ?>">
		<div class="psac-shrt-fields-panel psac-clearfix">
			<div class="psac-shrt-heading"><?php _e('Shortcode Parameters', 'post-slider-and-carousel'); ?></div>
			<?php
				if ( function_exists( $shortcode_sanitize.'_lite_shortcode_fields' ) ) {
					$shortcode_fields = call_user_func( $shortcode_sanitize.'_lite_shortcode_fields', $preview_shortcode );
				}
				$shortcode_fields = apply_filters('psac_shortcode_generator_fields', $shortcode_fields, $preview_shortcode );

				$shortcode_mapper = new PSAC_Shortcode_Generator();
				$shortcode_mapper->render( $shortcode_fields );
			?>
		</div>

		<div class="psac-shrt-preview-wrap psac-clearfix">
			<div class="psac-shrt-box-wrp">
				<div class="psac-shrt-heading"><?php _e('Shortcode', 'post-slider-and-carousel'); ?> <span class="psac-cust-heading-info psac-tooltip" title="<?php _e('Paste below shortcode to any page or post to get output as preview.', 'post-slider-and-carousel'); ?>">[?]</span>
					<div class="psac-shrt-tool-wrap">
						<button type="button" class="button button-primary button-small psac-cust-shrt-generate"><?php _e('Regenerate Shortcode', 'post-slider-and-carousel') ?></button>
				 		<i title="<?php _e('Full Preview Mode', 'post-slider-and-carousel'); ?>" class="psac-tooltip psac-shrt-dwp dashicons dashicons-editor-expand"></i>
				 	</div>
				 </div>
				<form action="<?php echo esc_url($preview_url); ?>" method="post" class="psac-customizer-shrt-form" id="psac-customizer-shrt-form" target="psac_shortcode_preview_frame">
					<textarea name="psac_customizer_shrt" class="psac-shrt-box" id="psac-shrt-box" placeholder="<?php _e('Copy or Paste Shortcode', 'post-slider-and-carousel'); ?>"><?php echo $shortcode_val; ?></textarea> <br />
					<em class="psac-shrt-note"><?php esc_html_e('* Kindly copy the above shortcode and paste it inside any page or post or inside any section.', 'post-slider-and-carousel'); ?></em>
				</form>
			</div>
			<div class="psac-shrt-heading"><?php _e('Preview Window', 'post-slider-and-carousel'); ?> <span class="psac-cust-heading-info psac-tooltip" title="<?php _e('Preview will be displayed according to responsive layout mode. You can check with `Full Preview` mode for better visualization.', 'post-slider-and-carousel'); ?>">[?]</span></div>
			<div class="psac-shrt-preview-window">
				<iframe class="psac-shrt-preview-frame" name="psac_shortcode_preview_frame" src="<?php echo esc_url($preview_url); ?>" scrolling="auto" frameborder="0"></iframe>
				<div class="psac-shrt-loader"></div>
				<div class="psac-shrt-error"><?php _e('Sorry, Something happened wrong.', 'post-slider-and-carousel'); ?></div>
			</div>
		</div>
	</div><!-- psac-customizer -->

	<br/>
	<div class="psac-cust-footer-note"><span class="description"><?php _e('Note: Preview will be displayed according to responsive layout mode. Live preview may display differently when added to your page based on inheritance from some styles.', 'post-slider-and-carousel'); ?></span></div>
	<?php endif ?>

</div><!-- end .wrap -->