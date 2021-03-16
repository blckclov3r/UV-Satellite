<?php
/**
 * Plugin Settings
 * AnWP Post Grid :: Settings.
 *
 * @since   0.7.1
 * @package AnWP_Post_Grid
 */

/**
 * AnWP_Post_Grid :: Settings class.
 *
 * @since 0.7.1
 */
class AnWP_Post_Grid_Settings {

	/**
	 * Parent plugin class.
	 *
	 * @var AnWP_Post_Grid
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @param AnWP_Post_Grid $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {

		$this->plugin = $plugin;

		// Init Hooks
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since 0.7.1
	 */
	public function hooks() {
		/*
		|--------------------------------------------------------------------
		| Add Category colorpicker.
		| Based on - https://wordpress.stackexchange.com/questions/112866/adding-colorpicker-field-to-category/113041#113041
		|--------------------------------------------------------------------
		*/
		add_action( 'category_add_form_fields', [ $this, 'category_colorpicker_add_term_page' ] );
		add_action( 'category_edit_form_fields', [ $this, 'category_colorpicker_edit_term_page' ] );

		add_action( 'created_category', [ $this, 'save_category_colorpicker' ] );
		add_action( 'edited_category', [ $this, 'save_category_colorpicker' ] );

		add_action( 'admin_enqueue_scripts', [ $this, 'category_colorpicker_enqueue' ] );
		add_action( 'admin_print_scripts', [ $this, 'colorpicker_init_inline' ], 20 );

		// Modifies columns in Admin tables
		add_action( 'manage_category_custom_column', [ $this, 'columns_display' ], 10, 3 );
		add_filter( 'manage_edit-category_columns', [ $this, 'columns' ] );

		/*
		|--------------------------------------------------------------------
		| Settings Page
		|--------------------------------------------------------------------
		*/
		add_action( 'admin_enqueue_scripts', [ $this, 'settings_enqueue_scripts' ] );
		add_action( 'wp_ajax_anwp_pg_save_options', [ $this, 'save_options' ] );
	}

	/**
	 * Add new colorpicker field to "Add new Category" screen
	 *
	 * @return void
	 * @since 0.7.1
	 */
	public function category_colorpicker_add_term_page() {

		if ( 'no' === self::get_value( 'show_category_color' ) ) {
			return;
		}
		?>
		<div class="form-field term-colorpicker-wrap">
			<label for="anwp-pg-term-colorpicker"><?php echo esc_html__( 'Category Color to use in AnWP Post Grid widgets', 'anwp-post-grid' ); ?></label>
			<input name="_anwp_pg_category_color" value="" class="anwp-pg-colorpicker" id="anwp-pg-term-colorpicker"/>
			<p><small><?php echo esc_html__( 'If you don\'t need this field, hide it in the AnWP Post Grid plugin Settings.', 'anwp-post-grid' ); ?></small></p>
		</div>
		<?php
	}

	/**
	 * Add new colorpicker field to "Edit Category" screen
	 *
	 * @param WP_Term $term
	 *
	 * @return void
	 * @since 0.7.1
	 */
	public function category_colorpicker_edit_term_page( $term ) {

		if ( 'no' === self::get_value( 'show_category_color' ) ) {
			return;
		}

		$color = get_term_meta( $term->term_id, '_anwp_pg_category_color', true );
		$color = empty( $color ) ? '' : "#{$color}";
		?>
		<tr class="form-field term-colorpicker-wrap">
			<th scope="row">
				<label for="anwp-pg-term-colorpicker"><?php echo esc_html__( 'Category Color to use in AnWP Post Grid widgets', 'anwp-post-grid' ); ?></label>
			</th>
			<td>
				<input name="_anwp_pg_category_color" value="<?php echo esc_html( $color ); ?>" class="anwp-pg-colorpicker" id="anwp-pg-term-colorpicker"/>
				<p><small><?php echo esc_html__( 'If you don\'t need this field, hide it in the AnWP Post Grid plugin Settings.', 'anwp-post-grid' ); ?></small></p>
			</td>
		</tr>
		<?php
	}

	/**
	 * Print javascript to initialize the colorpicker
	 *
	 * @return void
	 * @since 0.7.1
	 */
	public function colorpicker_init_inline() {

		if ( 'no' === self::get_value( 'show_category_color' ) ) {
			return;
		}

		$current_screen = get_current_screen();

		if ( null !== $current_screen && 'edit-category' !== $current_screen->id ) {
			return;
		}
		?>
		<script>
			jQuery( document ).ready( function( $ ) {
				$( '.anwp-pg-colorpicker' ).wpColorPicker();
			} ); // End Document Ready JQuery
		</script>
		<?php
	}

	/**
	 * Save category color
	 *
	 * @param Integer $term_id
	 *
	 * @return void
	 * @since 0.7.1
	 */
	public function save_category_colorpicker( $term_id ) {

		if ( 'no' === self::get_value( 'show_category_color' ) ) {
			return;
		}

		// Save term color if possible
		if ( isset( $_POST['_anwp_pg_category_color'] ) && ! empty( $_POST['_anwp_pg_category_color'] ) ) {
			update_term_meta( $term_id, '_anwp_pg_category_color', sanitize_hex_color_no_hash( $_POST['_anwp_pg_category_color'] ) );
		} else {
			delete_term_meta( $term_id, '_anwp_pg_category_color' );
		}
	}

	/**
	 * Enqueue colorpicker styles and scripts.
	 *
	 * @return void
	 * @since 0.7.1
	 */
	public function category_colorpicker_enqueue() {

		if ( 'no' === self::get_value( 'show_category_color' ) ) {
			return;
		}

		$current_screen = get_current_screen();

		if ( null !== $current_screen && 'edit-category' !== $current_screen->id ) {
			return;
		}

		// Colorpicker Scripts
		wp_enqueue_script( 'wp-color-picker' );

		// Colorpicker Styles
		wp_enqueue_style( 'wp-color-picker' );
	}

	/**
	 * Enqueue settings scripts.
	 *
	 * @return void
	 * @since 0.8.0
	 */
	public function settings_enqueue_scripts() {

		$current_screen = get_current_screen();

		if ( empty( $current_screen ) ) {
			return;
		}

		$page_prefix = sanitize_title( _x( 'AnWP Post Grid', 'admin menu title', 'anwp-post-grid' ) );

		if ( ! in_array( $current_screen->id, [ 'anwp-post-grid_page_anwp_pg_settings', $page_prefix . '_page_anwp_pg_settings' ], true ) ) {
			return;
		}

		wp_enqueue_media();

		/*
		|--------------------------------------------------------------------------
		| Vue.js
		|--------------------------------------------------------------------------
		*/
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
		wp_enqueue_script( 'vuejs', AnWP_Post_Grid::url( 'vendor/vuejs/vue' . $suffix . '.js' ), [], '2.6.12', true );

		/*
		|--------------------------------------------------------------------------
		| Toastr
		|
		| @license  MIT
		| @link     https://github.com/CodeSeven/toastr
		|--------------------------------------------------------------------------
		*/
		wp_enqueue_script( 'toastr', AnWP_Post_Grid::url( 'vendor/toastr/toastr.min.js' ), [], '2.1.4', false );
		wp_enqueue_style( 'toastr', AnWP_Post_Grid::url( 'vendor/toastr/toastr.min.css' ), [], '2.1.4', false );

		/*
		|--------------------------------------------------------------------------
		| Modaal
		|
		| @license  MIT
		| @link     https://github.com/humaan/Modaal
		|--------------------------------------------------------------------------
		*/
		wp_enqueue_script( 'modaal', AnWP_Post_Grid::url( 'vendor/modaal/modaal.min.js' ), [ 'jquery' ], '0.4.0', false );

		/*
		|--------------------------------------------------------------------------
		| Plugin Scripts
		|--------------------------------------------------------------------------
		*/
		wp_enqueue_script( 'anwp-pg-admin-vue-script', AnWP_Post_Grid::url( 'admin/js/pg-premium-admin-vue.min.js' ), [ 'vuejs', 'jquery', 'underscore', 'toastr' ], AnWP_Post_Grid::VERSION, true );

		/*
		|--------------------------------------------------------------------------
		| Load styles
		|--------------------------------------------------------------------------
		*/
		if ( is_rtl() ) {
			wp_enqueue_style( 'anwp-pg-admin-styles-rtl', AnWP_Post_Grid::url( 'admin/css/styles-rtl.min.css' ), [], AnWP_Post_Grid::VERSION );
		} else {
			wp_enqueue_style( 'anwp-pg-admin-styles', AnWP_Post_Grid::url( 'admin/css/styles.min.css' ), [], AnWP_Post_Grid::VERSION );
		}
	}

	/**
	 * Registers admin columns to display.
	 *
	 * @param  array $columns Array of registered column names/labels.
	 *
	 * @return array          Modified array.
	 * @since  0.7.1
	 */
	public function columns( $columns ) {

		if ( 'no' === self::get_value( 'show_category_color' ) ) {
			return $columns;
		}

		// add Color column
		$columns['anwp_pg_category_color'] = esc_html__( 'Color', 'anwp-post-grid' );

		return $columns;
	}

	/**
	 * Handles admin column display.
	 *
	 * @param array   $column   Column currently being rendered.
	 * @param integer $term_id  ID of post to display column for.
	 *
	 * @since  0.7.1
	 */
	public function columns_display( $deprecated, $column, $term_id ) {

		if ( 'anwp_pg_category_color' === $column && 'no' !== self::get_value( 'show_category_color' ) ) {
			$category_color = get_term_meta( $term_id, '_anwp_pg_category_color', true );
			echo '<span style="display: inline-block; background-color: #' . esc_attr( $category_color ) . '; width: 30px; height: 20px; border: 1px solid #ccc;"></span>';
		}
	}

	/**
	 * Wrapper function around get_option.
	 *
	 * @param string $key     Options array key
	 * @param mixed  $default Optional default value
	 *
	 * @return mixed           Option value
	 * @since  0.7.1
	 *
	 */
	public static function get_value( $key = '', $default = false ) {

		$options = get_option( 'anwp_pg_plugin_settings', $default );

		if ( ! empty( $options ) && is_array( $options ) && array_key_exists( $key, $options ) && false !== $options[ $key ] ) {
			return $options[ $key ];
		}

		return $default;
	}

	/**
	 * Sanitize plugin options.
	 *
	 * @param $options
	 *
	 * @return array
	 */
	public function sanitize_options( $options ) {

		$options = wp_parse_args(
			$options,
			[
				'show_category_color'    => true,
				'default_featured_image' => '',
				'post_icons'             => [],
			]
		);

		$sanitized_options = [];

		$sanitized_options['show_category_color']    = AnWP_Post_Grid::string_to_bool( $options['show_category_color'] ) ? 'yes' : 'no';
		$sanitized_options['default_featured_image'] = absint( $options['default_featured_image'] ) ? absint( $options['default_featured_image'] ) : '';
		$sanitized_options['post_icons']             = empty( $options['post_icons'] ) ? [] : $this->recursive_sanitize( $options['post_icons'] );

		return $sanitized_options;
	}

	/**
	 * Save Options Data
	 *
	 * @since 0.8.0
	 */
	public function save_options() {

		// Check if our nonce is set.
		if ( ! isset( $_POST['nonce'] ) ) {
			wp_send_json_error( 'Error : Unauthorized action' );
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['nonce'], 'ajax_anwp_pg_admin_nonce' ) ) {
			wp_send_json_error( 'Error : Unauthorized action' );
		}

		// Check the user's permissions.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Error : Unauthorized action' );
		}

		$post_data      = wp_unslash( $_POST );
		$old_value      = get_option( 'anwp_pg_plugin_settings', [] );
		$plugin_options = isset( $post_data['pg_options'] ) ? $this->sanitize_options( $post_data['pg_options'] ) : [];

		if ( $plugin_options === $old_value || maybe_serialize( $plugin_options ) === maybe_serialize( $old_value ) ) {
			wp_send_json_error( 'Nothing to Update' );
		}

		if ( ! update_option( 'anwp_pg_plugin_settings', $plugin_options, true ) ) {
			wp_send_json_error( 'Error : Update Problem' );
		}

		wp_send_json_success();
	}

	/**
	 * Recursive sanitization.
	 *
	 * @param string|array
	 *
	 * @return string|array
	 */
	public function recursive_sanitize( $value ) {
		if ( is_array( $value ) ) {
			return array_map( [ $this, 'recursive_sanitize' ], $value );
		} else {
			return is_scalar( $value ) ? sanitize_text_field( $value ) : $value;
		}
	}

	/**
	 * Get predefined octi icons.
	 *
	 * @since 0.8.0
	 * @return array
	 */
	public function get_octi_icons() {

		static $options = null;

		if ( null === $options ) {

			$icons = [
				'alert',
				'archive',
				'beaker',
				'bell',
				'book',
				'bookmark',
				'broadcast',
				'bug',
				'check-circle',
				'device-camera',
				'device-camera-video',
				'file-media',
				'flame',
				'gift',
				'globe',
				'heart',
				'home',
				'hourglass',
				'issue-opened',
				'key',
				'law',
				'light-bulb',
				'location',
				'mail',
				'megaphone',
				'milestone',
				'mortar-board',
				'paper-airplane',
				'pin',
				'play',
				'repo',
				'rocket',
				'shield-check',
				'smiley',
				'star',
				'stopwatch',
				'sun',
				'telescope',
				'unmute',
				'video',
				'zap',
			];

			$options = [];

			foreach ( $icons as $icon ) {
				$options[] =
					[
						'slug' => $icon,
						'url'  => AnWP_Post_Grid::url( 'icons/' . $icon . '.svg' ),
					];
			}

			/**
			 * Extend list of predefined icons.
			 *
			 * @param array  List default icons.
			 *
			 * @since 0.8.0
			 */
			$options = apply_filters( 'anwp-pg-el/config/octi_icons_default', $options );
		}

		return $options;
	}

	/**
	 * Get post icon.
	 *
	 * @param int $post_id
	 *
	 * @since 0.8.0
	 * @return string
	 */
	public function get_post_icon( $post_id ) {

		static $icon_options = null;
		static $options_data = null;
		static $post_icons   = [];

		if ( null === $icon_options ) {
			$icon_options = self::get_value( 'post_icons', [] );
		}

		// Return empty icon if options is not set
		if ( empty( $icon_options ) ) {
			return '';
		}

		if ( null === $options_data ) {
			foreach ( $icon_options as $icon_option ) {
				switch ( $icon_option['type'] ) {

					case 'category':
						$options_data['category'][] = $icon_option['type_id'];
						break;

					case 'tag':
						$options_data['tag'][] = $icon_option['type_id'];
						break;

					case 'post_format':
						$options_data['post_format'][] = $icon_option['type_id'];
						break;
				}
			}
		}

		// Return cached icon
		if ( ! empty( $post_icons ) && isset( $post_icons[ $post_id ] ) ) {
			return $post_icons[ $post_id ];
		}

		$post_icon_url = '';

		foreach ( $icon_options as $icon_option ) {
			switch ( $icon_option['type'] ) {

				case 'category':
					if ( has_term( $icon_option['type_id'], 'category', $post_id ) ) {
						$post_icon_url = $this->get_post_icon_url( $icon_option );
					}
					break;

				case 'tag':
					if ( has_term( $icon_option['type_id'], 'post_tag', $post_id ) ) {
						$post_icon_url = $this->get_post_icon_url( $icon_option );
					}
					break;

				case 'post_format':
					if ( has_post_format( $icon_option['type_id'], $post_id ) ) {
						$post_icon_url = $this->get_post_icon_url( $icon_option );
					}
					break;
			}

			if ( $post_icon_url ) {
				break;
			}
		}

		$post_icons[ $post_id ] = $post_icon_url;

		return $post_icons[ $post_id ];
	}

	/**
	 * Get post icon options URL
	 *
	 * @param $icon_option
	 *
	 * @since 0.8.0
	 * @return string
	 */
	private function get_post_icon_url( $icon_option ) {

		$icon_url = '';

		$icon_option = wp_parse_args(
			$icon_option,
			[
				'icon'           => '',
				'custom_icon_id' => '',
			]
		);

		if ( ! empty( $icon_option['icon'] ) ) {
			$icon_url = AnWP_Post_Grid::url( 'icons/' . sanitize_text_field( $icon_option['icon'] ) . '.svg' );
		}

		if ( empty( $icon_url ) && absint( $icon_option['custom_icon_id'] ) ) {
			$icon_url = AnWP_Post_Grid::url( 'icons/' . sanitize_text_field( $icon_option['icon'] ) . '.svg' );

			if ( absint( $icon_option['custom_icon_id'] ) ) {
				$icon_image_url = wp_get_attachment_image_url( $icon_option['custom_icon_id'], 'full' );

				if ( $icon_image_url ) {
					$icon_url = $icon_image_url;
				}
			}
		}

		return $icon_url;
	}
}
