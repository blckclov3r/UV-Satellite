<?php
/**
 * Template Loader
 * AnWP Post Grid :: Template.
 *
 * @since   0.1.0
 * @package AnWP_Post_Grid
 */

/**
 * AnWP_Post_Grid :: Template class.
 *
 * @since 0.1.0
 */
class AnWP_Post_Grid_Template extends Gamajo_Template_Loader {

	/**
	 * Parent plugin class.
	 *
	 * @var AnWP_Post_Grid
	 */
	protected $plugin = null;

	/**
	 * Reference to the root directory path of this plugin.
	 * Can either be a defined constant, or a relative reference from where the subclass lives.
	 *
	 * @var string
	 */
	protected $plugin_directory = null;

	/**
	 * Prefix for filter names.
	 *
	 * @var string
	 */
	protected $filter_prefix = 'anwp-post-grid';

	/**
	 * Directory name where custom templates for this plugin should be found in the theme.
	 *
	 * @var string
	 */
	protected $theme_template_directory = 'anwp-post-grid';

	/**
	 * Constructor.
	 *
	 * @param  AnWP_Post_Grid $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {

		$this->plugin           = $plugin;
		$this->plugin_directory = $this->plugin->path;
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  0.1.0
	 *
	 * @param  string $field Field to get.
	 *
	 * @throws Exception     Throws an exception if the field is invalid.
	 * @return mixed         Value of the field.
	 */
	public function __get( $field ) {

		if ( property_exists( $this, $field ) ) {
			return $this->$field;
		}

		throw new Exception( 'Invalid ' . __CLASS__ . ' property: ' . $field );
	}
}
