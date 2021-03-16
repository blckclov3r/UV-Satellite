<?php
/**
 * Support page for AnWP_Post_Grid
 *
 * @link       https://anwp.pro
 * @since      0.7.0
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

global $wp_version;
?>

<div class="about-wrap anwp-pg-wrap">
	<div class="postbox">
		<div class="inside">
			<h2 class="text-left text-uppercase mb-3"><?php echo esc_html__( 'Plugin Support', 'anwp-post-grid' ); ?></h2>

			<hr class="mt-3">
			<p>
				<?php echo esc_html_x( 'If you find a bug, need help, or would like to request a feature, please visit', 'support page', 'anwp-post-grid' ); ?>:
				<br>
				- <a href="https://anwppro.userecho.com/communities/50-anwp-post-grid-for-elementor" target="_blank"><?php echo esc_html_x( 'plugin support forum', 'support page', 'anwp-post-grid' ); ?></a>
			</p>

			<h4 class="mb-0 mt-5"><?php echo esc_html_x( 'Your System Info', 'support page', 'anwp-post-grid' ); ?></h4>

			<ul class="mt-1">
				<li>============================================</li>
				<li>
					<b>Plugin Version:</b> AnWP Post Grid and Post Carousel Slider for Elementor -- <?php echo esc_html( anwp_post_grid()->version ); ?>
				</li>

				<li>
					<b>WordPress version:</b> <?php echo esc_html( $wp_version ); ?>
				</li>

				<li>
					<b>Site Locale:</b> <?php echo esc_html( get_locale() ); ?>
				</li>

				<li>
					<b>PHP version:</b> <?php echo esc_html( phpversion() ); ?>
				</li>

				<li>
					<b><?php echo esc_html_x( 'Active Plugins', 'support page', 'anwp-post-grid' ); ?>:</b>
					<?php
					foreach ( get_option( 'active_plugins' ) as $value ) {
						$string = explode( '/', $value );
						echo '<br>--- ' . esc_html( $string[0] );
					}
					?>
				</li>
				<li>============================================</li>
			</ul>
		</div>
	</div>
</div>
