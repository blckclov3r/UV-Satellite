<?php
/**
 * freemius helper function for easy SDK access. 
 * 
 * @package Blog Designer Pack Pro
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !function_exists( 'bdp_fs' ) ) {
	
	// Create a helper function for easy SDK access.
	function bdp_fs() {
		
		global $bdp_fs;

		if ( !isset( $bdp_fs ) ) {
			
			// Include Freemius SDK.
			require_once dirname( __FILE__ ) . '/freemius/start.php';
			
			$bdp_fs = fs_dynamic_init( array(
				'id'				=> '5311',
				'slug'				=> 'blog-designer-pack',
				'premium_slug'		=> 'blog-designer-pack-pro',
				'type'				=> 'plugin',
				'public_key'		=> 'pk_69ea3fbbc33c94a77c0ff3e51ca59',
				'is_premium'		=> false,
				'premium_suffix'	=> 'Pro',
				'has_addons'		=> false,
				'has_paid_plans'	=> true,
				'menu'				=> array(
										'slug'			=> 'bdp-about',										
									),
				'is_live'			=> true,
			) );
		}

		return $bdp_fs;
	}

	// Init Freemius.
	bdp_fs();

	// Signal that SDK was initiated.
	do_action( 'bdp_fs_loaded' );
}