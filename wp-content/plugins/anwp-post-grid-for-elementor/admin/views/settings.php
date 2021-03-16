<?php
/**
 * Settings page for AnWP_Post_Grid
 *
 * @link       https://anwp.pro
 * @since      0.7.1
 *
 * @package    AnWP_Post_Grid
 * @subpackage AnWP_Post_Grid/admin/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'anwp-post-grid' ) );
}

$app_id = apply_filters( 'anwp-pg-el/settings/vue_app_id', 'anwp-pg-app-settings' );

// Settings Text
$settings_text = [
	'show'               => esc_html__( 'Show', 'anwp-post-grid' ),
	'hide'               => esc_html__( 'Hide', 'anwp-post-grid' ),
	'nothing_to_update'  => esc_html__( 'Nothing to Update', 'anwp-post-grid' ),
	'data_save_error'    => esc_html__( 'Data Save Error', 'anwp-post-grid' ),
	'select_image'       => esc_html__( 'Select Image', 'anwp-post-grid' ),
	'save_options'       => esc_html__( 'Save Options', 'anwp-post-grid' ),
	'saved_successfully' => esc_html__( 'Saved Successfully', 'anwp-post-grid' ),
	'remove_image'       => esc_html__( 'remove image', 'anwp-post-grid' ),
	'ajaxNonce'          => wp_create_nonce( 'ajax_anwp_pg_admin_nonce' ),
];

// Fields Data
$fields_data = [
	'category_color_option'  => [
		'label'       => esc_html__( 'Category Color Option', 'anwp-post-grid' ),
		'description' => esc_html__( 'Allow users to create initial category colors which will be used in Post Grid widgets.', 'anwp-post-grid' ) . '<br><a target="_blank" href="https://anwppro.userecho.com/en/knowledge-bases/51/articles/1053-plugin-settings">' . esc_html__( 'More info', 'anwp-post-grid' ) . '</a>',
	],
	'default_featured_image' => [
		'label'       => esc_html__( 'Default Featured Image', 'anwp-post-grid' ),
		'description' => esc_html__( 'Selected image will be used in posts when no featured image is set.', 'anwp-post-grid' ),
	],
	'post_icons'             => [
		'label'       => esc_html__( 'Post Icons', 'anwp-post-grid' ),
		'description' => esc_html__( 'You can display custom icon for the selected category, tag, or post format.', 'anwp-post-grid' ),
	],
];

/*
|--------------------------------------------------------------------
| Prepare plugin options
|--------------------------------------------------------------------
*/
$plugin_options = get_option( 'anwp_pg_plugin_settings', [] );

$plugin_options = wp_parse_args(
	$plugin_options,
	[
		'show_category_color'    => 'no',
		'default_featured_image' => '',
		'post_icons'             => [],
	]
);

// Default Featured Image
if ( ! empty( $plugin_options['default_featured_image'] ) ) {
	$default_featured_image_url = wp_get_attachment_image_url( $plugin_options['default_featured_image'], 'medium' );

	if ( $default_featured_image_url ) {
		$plugin_options['default_featured_image__url'] = $default_featured_image_url;
	}
}

/*
|--------------------------------------------------------------------
| Type Options
|--------------------------------------------------------------------
*/
$type_options = [
	'tag'         => [],
	'category'    => [],
	'post_format' => [],
	'map'         => [],
];

$type_options_tags = get_terms(
	[
		'taxonomy'   => 'post_tag',
		'hide_empty' => false,
		'orderby'    => 'name',
		'number'     => 0,
	]
);

foreach ( $type_options_tags as $type_option ) {
	$type_options['tag'][] = [
		'id'    => $type_option->term_id,
		'title' => $type_option->name,
	];

	$type_options['map'][ $type_option->term_id ] = $type_option->name;
}

$type_options_category = (object) get_terms(
	[
		'taxonomy'   => 'category',
		'hide_empty' => false,
		'orderby'    => 'name',
		'number'     => 0,
	]
);

foreach ( $type_options_category as $type_option ) {
	$type_options['category'][] = [
		'id'    => $type_option->term_id,
		'title' => $type_option->name,
	];

	$type_options['map'][ $type_option->term_id ] = $type_option->name;
}

if ( current_theme_supports( 'post-formats' ) ) {
	$post_formats = get_theme_support( 'post-formats' );

	if ( is_array( $post_formats[0] ) ) {
		foreach ( $post_formats[0] as $post_format_item ) {
			$type_options['post_format'][] = [
				'id'    => $post_format_item,
				'title' => $post_format_item,
			];

			$type_options['map'][ $post_format_item ] = $post_format_item;
		}
	}
}
?>
<script type="text/javascript">
	var _anwp_pg_settings_text   = <?php echo wp_json_encode( $settings_text ); ?>;
	var _anwp_pg_settings_fields = <?php echo wp_json_encode( $fields_data ); ?>;
	var _anwp_pg_settings_data   = <?php echo wp_json_encode( $plugin_options ); ?>;
	var _anwp_pg_settings_types  = <?php echo wp_json_encode( $type_options ); ?>;
	var _anwp_pg_octi_icons      = <?php echo wp_json_encode( anwp_post_grid()->settings->get_octi_icons() ); ?>;
</script>
<div class="wrap anwp-pg-wrap">
	<div class="postbox mt-4 ml-1 py-3 px-4 anwp-container">
		<h1 class="mb-5"><?php echo esc_html__( 'AnWP Post Grid Settings', 'anwp-post-grid' ); ?></h1>
		<hr class="mb-0">

		<div id="<?php echo esc_attr( $app_id ); ?>"></div>
	</div>

	<?php do_action( 'anwp-pg-el/settings/after_config' ); ?>
</div>
