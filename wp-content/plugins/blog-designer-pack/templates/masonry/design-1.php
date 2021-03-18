<?php
/**
 * Masonry Design 1
 * 
 * @package Blog Designer Pack
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if($grid == '2') {
	$bdpgrid = "6";
} else if($grid == '3') {
	$bdpgrid = "4";
}  else if($grid == '4') {
	$bdpgrid = "3";
}  else if($grid == '5') {
	$bdpgrid = "c5";	
} else if ($grid == '1') {
	$bdpgrid = "12";
} else {
	$bdpgrid = "12";
}
?>
<div class="bdp-post-grid  bdp-medium-<?php echo $bdpgrid; ?> bdp-columns">
	<div class="bdp-post-grid-content <?php if ( !has_post_thumbnail() ) { echo 'bdp-no-thumb-image'; } ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="bdp-post-image-bg">
			<a href="<?php echo esc_url( $post_link ); ?>">
				<img src="<?php echo esc_url( $post_featured_image ); ?>" alt="<?php the_title_attribute(); ?>" />
			</a>
		</div>
		<?php }

		if($showCategory == "true" && $cate_name !='') { ?>
		<div class="bdp-post-categories">
			<?php echo $cate_name; ?>
		</div>
		<?php } ?>

		<h2 class="bdp-post-title">
			<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
		</h2>
		
		<?php if($showDate == "true" || $showAuthor == 'true' || $show_comments =="true") { ?>
			<div class="bdp-post-meta">
				<?php if($showAuthor == 'true') { ?>
					<span class="bdp-post-meta-innr bdp-user-img"><?php the_author(); ?></span>
				<?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '<span class="bdpp-post-meta-sep">/</span>' : '' ?>
				<?php if($showDate == "true") { ?>
					<span class="bdp-post-meta-innr bdp-time"> <?php echo get_the_date(); ?> </span>
				<?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true' && $show_comments == 'true' && !empty($comments)) ? '<span class="bdpp-post-meta-sep">/</span>' : '' ?>
				<?php if(!empty($comments) && $show_comments == 'true') { ?>
					<span class="bdp-post-meta-innr bdp-post-comments">
						<a href="<?php the_permalink(); ?>#comments"><?php echo $comments.' '.$reply;  ?></a>
					</span>
				<?php } ?>
			</div>
		<?php }

		if($showContent == "true") { ?>
		<div class="bdp-post-content">
			<div class="bdp-post-short-content"><?php echo bdp_get_post_excerpt( $post->ID, get_the_content(), $words_limit ); ?></div>
			<?php if($showreadmore == 'true') { ?>
				<a href="<?php echo esc_url( $post_link ); ?>" class="bdp-readmorebtn"><?php echo _e('Read More', 'blog-designer-pack'); ?></a>
			<?php } ?>
		</div>
		<?php }
		
		if(!empty($tags) && $show_tags == 'true') { ?>
			<div class="bdp-post-tags"><?php echo $tags; ?></div>
		<?php } ?>
	</div>
</div>