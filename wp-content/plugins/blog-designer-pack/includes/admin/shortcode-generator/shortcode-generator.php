<?php
/**
 * Featured and Trending Post Pro Shortcode Mapper Page 
 *
 * @package Blog Designer Pack 
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$valid					= true;
$registered_shortcodes 	= bdp_registered_shortcodes();
$shortcodes_arr 		= bdp_registered_shortcodes( false );
$preview_shortcode 		= !empty($_GET['shortcode']) ? $_GET['shortcode'] : apply_filters('bdp_default_preview_shortcode', 'bdp_post' );
$tmpl_id				= ( !empty( $_GET['tmpl_id'] ) ) ? $_GET['tmpl_id'] : false;
$preview_url 			= add_query_arg( array( 'page' => 'bdp-shortcode-preview', 'shortcode' => $preview_shortcode), admin_url('admin.php') );
$shrt_generator_url 	= add_query_arg( array('page' => 'bdp-shrt-generator'), admin_url('admin.php') );

// Instantiate the shortcode builder
if( !class_exists( 'BDP_Shortcode_Generator' ) ) { 
	include_once( BDP_DIR . '/includes/admin/shortcode-generator/class-bdp-shortcode-generator.php' );
}

$shortcode_val		= '';
$shortcode_fields 	= array();
$shortcode_sanitize = str_replace('-', '_', $preview_shortcode);

?>
<div class="wrap bdp-customizer-settings">

	<h2><?php _e( 'Blog Designer Pack  - Shortcode Builder', 'blog-designer-pack' ); ?></h2>

	<?php
	// If invalid shortcode is passed then simply return
	if( !empty($_GET['shortcode']) && !isset( $registered_shortcodes[ $_GET['shortcode'] ] ) ) {
		
		$valid = false;

		echo '<div id="message" class="error notice">
				<p><strong>'.__('Sorry, Something happened wrong.', 'blog-designer-pack').'</strong></p>
			 </div>';
	}

	// Check valid shortcode template is there
	if( ! empty( $tmpl_id ) ) {
		$templates_data = get_option( 'bdp_shrt_tmpl' );
		$template_data	= !empty( $templates_data[ $tmpl_id ] ) ? $templates_data[ $tmpl_id ] : false;

		if( ! $template_data ) {
			$valid = false;

			echo '<div id="message" class="error notice">
					<p><strong>'.__('Sorry, No shortcode template found.', 'blog-designer-pack').'</strong></p>
			 	</div>';
		} else {
			
			echo "<div class'bdp-tmpl-view-sub-title'>View result for template id #{$tmpl_id} - {$template_data['name']}</div>";

			$shortcode_val = ( $preview_shortcode == $template_data['type'] ) ? $template_data['shortcode'] : '';
		}
	}
	?>

	<?php if( $valid ) : ?>
	<div class="bdp-shrt-toolbar">
		<?php if( !empty( $registered_shortcodes ) ) { ?>
			<select class="bdp-shrt-switcher" id="bdp-shrt-switcher">
				<option value=""><?php _e('-- Choose Shortcode --', 'blog-designer-pack'); ?></option>
				<?php foreach ($shortcodes_arr as $shrt_grp_key => $shrt_grp_val) {

					// Creating OPT group
					if( is_array( $shrt_grp_val ) && ! empty( $shrt_grp_val['shortcodes'] ) ) {

						$option_grp_name = !empty( $shrt_grp_val['name'] ) ? $shrt_grp_val['name'] : __('General', 'blog-designer-pack');
				?>
						<optgroup label="<?php echo bdp_esc_attr( $option_grp_name ); ?>">
						<?php foreach ($shrt_grp_val['shortcodes'] as $shrt_key => $shrt_val) {

							if( empty($shrt_key) ) {
								continue;
							}

							$shrt_val 		= !empty($shrt_val) ? $shrt_val : $shrt_key;
							$shortcode_url 	= add_query_arg( array('shortcode' => $shrt_key, 'tmpl_id' => $tmpl_id), $shrt_generator_url );
						?>
							<option value="<?php echo $shrt_key; ?>" <?php selected( $preview_shortcode, $shrt_key); ?> data-url="<?php echo esc_url( $shortcode_url ); ?>"><?php echo $shrt_val; ?></option>
						<?php } ?>
						</optgroup>

					<?php } else { 
							$shrt_val 		= !empty($shrt_grp_val) ? $shrt_grp_val : $shrt_grp_key;
							$shortcode_url 	= add_query_arg( array('shortcode' => $shrt_grp_key, 'tmpl_id' => $tmpl_id), $shrt_generator_url );
					?>
						<option value="<?php echo $shrt_grp_key; ?>" <?php selected( $preview_shortcode, $shrt_grp_key); ?> data-url="<?php echo esc_url( $shortcode_url ); ?>"><?php echo $shrt_grp_val; ?></option>
				<?php } // End of else
				} ?>
			</select>
		<?php } ?>

		<span class="bdp-shrt-generate-help bdp-tooltip" title="<?php _e("The shortcode builder allows you to preview plugin shortcode. You can choose your desired shortcode from the dropdown and check various parameters from left panel. \n\nYou can paste shortcode to below and press Generate button to preview so each and every time you do not have to choose each parameters!!!", 'blog-designer-pack'); ?>"><i class="dashicons dashicons-editor-help"></i></span>
	</div><!-- end .bdp-shrt-toolbar -->

	<div class="bdp-customizer bdp-clearfix" data-shortcode="<?php echo $preview_shortcode; ?>" data-template="<?php echo $tmpl_id; ?>">
		<div class="bdp-shrt-fields-panel bdp-clearfix">
			<div class="bdp-shrt-heading"><?php _e('Shortcode Parameters', 'blog-designer-pack'); ?></div>
			<?php
				if ( function_exists( $shortcode_sanitize.'_lite_shortcode_fields' ) ) {
					$shortcode_fields = call_user_func( $shortcode_sanitize.'_lite_shortcode_fields', $preview_shortcode );
				}
				$shortcode_fields = apply_filters('bdp_shortcode_generator_fields', $shortcode_fields, $preview_shortcode );

				$shortcode_mapper = new BDP_Shortcode_Generator();
				$shortcode_mapper->render( $shortcode_fields );
			?>
		</div>

		<div class="bdp-shrt-preview-wrap bdp-clearfix">
			<div class="bdp-shrt-box-wrp">
				<div class="bdp-shrt-heading"><?php _e('Shortcode', 'blog-designer-pack'); ?> <span class="bdp-cust-heading-info bdp-tooltip" title="<?php _e('Paste below shortcode to any page or post to get output as preview.', 'blog-designer-pack'); ?>">[?]</span>
					<div class="bdp-shrt-tool-wrap">
						<button type="button" class="button button-primary button-small bdp-cust-shrt-generate"><?php _e('Regenerate Shortcode', 'blog-designer-pack') ?></button>						
				 		<i title="<?php _e('Full Preview Mode', 'blog-designer-pack'); ?>" class="bdp-tooltip bdp-shrt-dwp dashicons dashicons-editor-expand"></i>
				 	</div>
				 </div>
				<form action="<?php echo esc_url($preview_url); ?>" method="post" class="bdp-customizer-shrt-form" id="bdp-customizer-shrt-form" target="bdp_shortcode_preview_frame">
					<textarea name="bdp_customizer_shrt" class="bdp-shrt-box" id="bdp-shrt-box" placeholder="<?php _e('Copy or Paste Shortcode', 'blog-designer-pack'); ?>"><?php echo $shortcode_val; ?></textarea> <br />
					<em class="bdp-shrt-note"><?php _e('* Kindly copy the above shortcode and paste it inside any page or post or inside any section.', 'blog-designer-pack'); ?></em>
				</form>
			</div>
			<div class="bdp-shrt-heading"><?php _e('Preview Window', 'blog-designer-pack'); ?> <span class="bdp-cust-heading-info bdp-tooltip" title="<?php _e('Preview will be displayed according to responsive layout mode. You can check with `Full Preview` mode for better visualization.', 'blog-designer-pack'); ?>">[?]</span></div>
			<div class="bdp-shrt-preview-window">
				<iframe class="bdp-shrt-preview-frame" name="bdp_shortcode_preview_frame" src="<?php echo esc_url($preview_url); ?>" scrolling="auto" frameborder="0"></iframe>
				<div class="bdp-shrt-loader"></div>
				<div class="bdp-shrt-error"><?php _e('Sorry, Something happened wrong.', 'blog-designer-pack'); ?></div>
			</div>
		</div>
	</div><!-- bdp-customizer -->

	<br/>
	<div class="bdp-cust-footer-note"><span class="description"><?php _e('Note: Preview will be displayed according to responsive layout mode. Live preview may display differently when added to your page based on inheritance from some styles.', 'blog-designer-pack'); ?></span></div>
	<?php endif ?>

</div><!-- end .wrap -->

