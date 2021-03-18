<?php
/**
 * `bdp_ticker` Shortcode
 * 
 * @package Blog Designer Pack
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function bdp_get_post_ticker( $atts, $content = null ) {

	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> 20,
		'ticker_title'			=> __('Latest Post', 'blog-designer-pack'),
		'theme_color'			=> '#2096cd',
		'heading_font_color'	=> '#fff',
		'font_color'			=> '#2096cd',
		'font_style'			=> 'normal',
		'ticker_effect'			=> 'slide-v',
		'autoplay'				=> 'true',
		'speed'					=> 3000,
		'category' 				=> '',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
	), $atts, 'bdp_ticker'));

	$limit				= (!empty($limit)) 					? $limit 						: 20;
	$ticker_title		= !empty($ticker_title)				? $ticker_title					: '';
	$cat 				= (!empty($category))				? explode(',',$category) 		: '';  
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 			= (!empty($orderby))				? $orderby						: 'date';
	$theme_color		= !empty($theme_color)				? $theme_color					: '#2096cd';
	$font_color			= !empty($font_color)				? $font_color					: '#2096cd';
	$heading_font_color	= !empty($heading_font_color)		? $heading_font_color			: '#fff';
	$ticker_effect		= !empty($ticker_effect)			? $ticker_effect				: 'fade';
	$autoplay 			= ($autoplay == 'false')			? 'false'						: 'true';
	$speed 				= !empty($speed)					? $speed						: 3000;
	$unique				= bdp_get_unique();

	// Enqueue required script
	wp_enqueue_script( 'bdp-ticker-script' );
	wp_enqueue_script( 'bdp-public-script' );
	bdp_enqueue_script();

	// Taking some globals
	global $post;

	// Ticker configuration
	$ticker_conf = compact('ticker_effect', 'autoplay', 'speed', 'font_style');

	// Query Parameter
	$args = array (
		'post_type'				=> BDP_POST_TYPE,
		'post_status'			=> array( 'publish' ),
		'order'					=> $order,
		'orderby'				=> $orderby,
		'posts_per_page'		=> $limit,
		'ignore_sticky_posts'	=> true,
		
	);

	// Category Parameter
	if( ! empty( $cat ) ) {
		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> BDP_CAT,
									'terms' 			=> $cat,
									'field' 			=> ( isset($cat[0]) && is_numeric($cat[0]) ) ? 'term_id' : 'slug',
							));
	}

	// WP Query
	$query = new WP_Query( $args );

	ob_start();

	// If post is there
	if ( $query->have_posts() ) {
?>

	<style type="text/css">
		#bdp-ticker-<?php echo $unique; ?>{border-color:<?php echo $theme_color ?>;}
		#bdp-ticker-<?php echo $unique; ?> >.bdp-ticker-title{background:<?php echo $theme_color ?>;}
		#bdp-ticker-<?php echo $unique; ?> >.bdp-ticker-title>span{border-left-color:<?php echo $theme_color ?>;}
		#bdp-ticker-<?php echo $unique; ?> >ul>li>a:hover, #bdp-ticker-<?php echo $unique; ?>>ul>li>a{color:<?php echo $font_color; ?>;}
		#bdp-ticker-<?php echo $unique; ?> > .bdp-ticker-title > .bdp-ticker-title-cnt{color: <?php echo $heading_font_color; ?>}
	</style>

	<div class="bdp-ticker-wrp bdp-clearfix" id="bdp-ticker-<?php echo $unique; ?>">
		<div class="bdp-ticker-title bdp-ticker-title">
			<?php if($ticker_title) { ?>
			<div class="bdp-ticker-title-cnt"><?php echo $ticker_title; ?></div>
			<?php } ?>
			<span></span>
		</div>
		<ul class="bdp-ticker-cnt">
			<?php while ( $query->have_posts() ) : $query->the_post();
				$post_link = bdp_get_post_link( $post->ID );
			?>
			<li class="bdp-ticker-ele"><a href="<?php echo esc_url( $post_link ); ?>" ><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
		<div class="bdp-ticker-navi bdp-ticker-navi">
			<span></span>
			<span></span>
		</div>
		<div class="bdp-ticker-conf"><?php echo htmlspecialchars(json_encode($ticker_conf)); ?></div>
	</div>

<?php
	} // End of have_post()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// Post Ticker Shortcode
add_shortcode( 'bdp_ticker', 'bdp_get_post_ticker' );