<?php
/**
 * Plugin Name: AnWP Post Grid and Post Carousel Slider for Elementor
 * Plugin URI:  https://anwppro.userecho.com/communities/50-anwp-post-grid-for-elementor
 * Description: Easily create awesome post grids and post carousel sliders. Different widget types, powerful filters, "load more" button and many customizable options.
 * Version:     0.8.1
 * Author:      Andrei Strekozov <anwppro>
 * Author URI:  https://anwp.pro
 * License:     GPLv2+
 * Requires PHP: 5.6
 * Text Domain: anwp-post-grid
 * Domain Path: /languages
 * Elementor tested up to: 3.1.3
 */

/**
 * Copyright (c) 2020-2021 Andrei Strekozov <anwppro> (email: anwp.pro@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using generator-plugin-wp (https://github.com/WebDevStudios/generator-plugin-wp)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Check for required PHP version
if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {

	add_action( 'admin_notices', 'anwp_post_grid_requirements_not_met_notice' );

} else {

	// Require the main plugin class
	require_once plugin_dir_path( __FILE__ ) . 'class-anwp-post-grid.php';

	// Kick it off.
	add_action( 'plugins_loaded', array( anwp_post_grid(), 'hooks' ) );

	// Activation
	register_activation_hook( __FILE__, array( anwp_post_grid(), 'activate' ) );
}

/**
 * Adds a notice to the dashboard if the plugin requirements are not met.
 *
 * @since  0.2.0
 * @return void
 */
function anwp_post_grid_requirements_not_met_notice() {

	$details = '';

	if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
		/* translators: %s minimum PHP version */
		$details .= '<small>' . sprintf( esc_html__( 'AnWP Post Grid cannot run on PHP versions older than %s. Please contact your hosting provider to update your site.', 'anwp-post-grid' ), '5.6.0' ) . '</small><br />';
	}

	// Output errors.
	?>
	<div id="message" class="error">
		<p><?php echo wp_kses_post( $details ); ?></p>
	</div>
	<?php
}

/**
 * Grab the AnWP_Post_Grid object and return it.
 * Wrapper for AnWP_Post_Grid::get_instance().
 *
 * @since  0.1.0
 * @return AnWP_Post_Grid  Singleton instance of plugin class.
 */
function anwp_post_grid() {
	return AnWP_Post_Grid::get_instance();
}
