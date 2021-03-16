<?php
/**
 * Welcome page for AnWP_Post_Grid
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
?>
<div class="anwp-pg-wrap">

	<div class="my-4 p-3 bg-white">
		<h1 class="entry-title text-primary mr-2 mb-3"><?php echo esc_html__( 'Welcome to AnWP Post Grid', 'anwp-post-grid' ); ?>!</h1>

		<p><?php echo esc_html__( 'Simply type', 'anwp-post-grid' ); ?> <b>"anwp"</b> <?php echo esc_html__( 'in the "Search Widget" field and start building your new page', 'anwp-post-grid' ); ?>.</p>
		<p><img src="<?php echo esc_url( AnWP_Post_Grid::url( 'admin/img/anwp_typing.gif' ) ); ?>" alt="typing example"></p>

		<h1 class="entry-title text-primary mb-3 mt-5"><?php echo esc_html__( 'Useful Links', 'anwp-post-grid' ); ?></h1>

		<div class="d-flex my-3">
			<a href="https://anwppro.userecho.com/communities/50-anwp-post-grid-for-elementor" class="btn btn-success mr-2 border-secondary text-decoration-none" target="_blank"><?php echo esc_html__( 'Online Community and Support Forum', 'anwp-post-grid' ); ?></a>
			<a href="https://anwppro.userecho.com/knowledge-bases/52-anwp-post-grid-for-elementor-changelog/categories/131-basic-version/articles" class="btn btn-primary mr-2 border-secondary text-decoration-none" target="_blank"><?php echo esc_html__( 'Change Log', 'anwp-post-grid' ); ?></a>
			<a href="https://anwp.pro/anwp-post-grid-for-elementor-premium/" target="_blank" class="btn btn-warning mr-2 border-secondary text-decoration-none"><?php echo esc_html__( 'Premium Version', 'anwp-post-grid' ); ?></a>
		</div>

		<?php
		/**
		 * Welcome Page - Before End.
		 *
		 * @since 0.7.0
		 */
		do_action( 'anwp-pg-el/welcome/before_end' );
		?>
	</div>
</div>
