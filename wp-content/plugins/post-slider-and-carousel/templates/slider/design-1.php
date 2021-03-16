<?php
/**
 * Slider Design 1
 * 
 * @package Post Slider and Carousel
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="psac-post-slides">
	<a href="<?php echo esc_url( $post_link ); ?>" class="psac-link-overlay"></a>
	<div class="psac-post-image-bg" style="<?php echo $image_bg_css; ?>"></div>
	<div class="psac-post-overlay">
		<?php if($show_category) { ?>
			<div class="psac-post-categories"><?php echo $cate_name; ?></div>
		<?php } ?>

		<h2 class="psac-post-title">
			<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
		</h2>

		<?php if( $show_date || $show_author || $show_comments ) { ?>
			<div class="psac-post-meta">
				<?php if($show_author) { ?>
					<span class="psac-post-meta-innr psac-user-img"><?php the_author(); ?></span>
				<?php } ?>
				<?php echo ($show_author && $show_date) ? '<span class="psac-sep">/</span>' : '' ?>
				<?php if($show_date) { ?>
					<span class="psac-post-meta-innr psac-time"> <?php echo get_the_date(); ?> </span>
				<?php } ?>
				<?php echo ($show_author && $show_date && $show_comments && !empty($comments)) ? '<span class="psac-sep">/</span>' : '' ?>
				<?php if( !empty($comments) && $show_comments ) { ?>
					<span class="psac-post-meta-innr psac-post-comments">
						<a href="<?php the_permalink(); ?>#comments"><?php echo $comments.' '.$reply;  ?></a>
					</span>
				<?php } ?>
			</div>
		<?php }

		if( $show_content ) { ?>
			<div class="psac-post-content">
				<div class="psac-post-short-content"><?php echo psac_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?></div>				
				<?php if( $show_read_more ) { ?>
				<a href="<?php echo esc_url( $post_link ); ?>" class="psac-readmorebtn"><?php _e('Read More', 'post-slider-and-carousel'); ?></a>
				<?php } ?>
			</div>
		<?php }

		if( !empty($tags) && $show_tags ) { ?>
			<div class="psac-post-tags"><?php echo $tags; ?></div>
		<?php } ?>
	</div>
</div>