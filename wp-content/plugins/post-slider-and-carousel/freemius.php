<?php
/**
 * freemius helper function for easy SDK access. 
 * 
 * @package Post Slider and Carouse
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !function_exists( 'psac_fs' ) ) {

	// Create a helper function for easy SDK access.
	function psac_fs() {

		global $psac_fs;

		if ( !isset( $psac_fs ) ) {

			// Include Freemius SDK.
			require_once dirname( __FILE__ ) . '/freemius/start.php';

			$psac_fs = fs_dynamic_init( array(
				'id'				=> '5986',
				'slug'				=> 'post-slider-and-carousel',
				'premium_slug'		=> 'post-slider-and-carousel-pro',
				'type'				=> 'plugin',
				'public_key'		=> 'pk_3b6ceaf94b273c77243afe9a6e993',
				'is_premium'		=> false,
				'premium_suffix'	=> 'Pro',
				'has_addons'		=> false,
				'has_paid_plans'	=> true,
				'menu'				=> array(
										'slug' => 'psac-about',		
									),
				'is_live'			=> true,
			) );
		}

		return $psac_fs;
	}

	// Init Freemius.
	psac_fs();

	// Signal that SDK was initiated.
	do_action( 'psac_fs_loaded' );
}