<?php
/**
 * Gridbox Design 1
 * 
 * @package Blog Designer Pack
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if($bdpcount == "0") {
$bdp_post_large_image = bdp_get_post_featured_image( $post->ID, 'large' ); ?>
	<div class="bdp-medium-6 bdp-columns bdp-left-block">
		<?php if(!empty($bdp_post_large_image)) { ?>
			<div class="bdp-post-image-bg">
				<a href="<?php echo esc_url( $post_link ); ?>">
					<img src="<?php echo esc_url( $bdp_post_large_image ); ?>" alt="<?php the_title_attribute(); ?>" />
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
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '<span class="bdpp-post-meta-sep">/<span>' : '' ?>
				<?php if($showDate == "true") { ?>
					<span class="bdp-post-meta-innr bdp-time">  <?php echo get_the_date(); ?> </span>
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
				<div class="bdp-post-short-content"><?php echo bdp_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?></div>
				<?php if($showreadmore == 'true') { ?>
				<a href="<?php echo esc_url( $post_link ); ?>" class="bdp-readmorebtn"><?php echo _e('Read More', 'blog-designer-pack'); ?></a>
				<?php } ?>
			</div>
		<?php }

		if(!empty($tags) && $show_tags == 'true') { ?>
			<div class="bdp-post-tags"><?php echo $tags; ?></div>
		<?php } ?>
	</div>
<?php } else {
	$bdp_post_medium_image = bdp_get_post_featured_image( $post->ID, 'thumbnail' );
?>
	<div class="bdp-medium-6 bdp-columns bdp-inline-grid" >
		<div class="bdp-post-right-block bdp-medium-12 bdp-columns">
			<?php if(!empty($bdp_post_medium_image)) { ?>
				<div class="bdp-s-medium-3 bdp-columns">
					<div class="bdp-post-image-bg">
						<a href="<?php echo esc_url( $post_link ); ?>">
							<img src="<?php echo esc_url( $bdp_post_medium_image ); ?>" alt="<?php the_title_attribute(); ?>" />
						</a>
					</div>
				</div>
				<?php } ?>
				<div class="<?php if(!empty($bdp_post_medium_image)) { echo 'bdp-s-medium-9 bdp-columns'; } else { echo 'bdp-s-medium-12 bdp-columns'; } ?> ">
					<?php if($showCategory == "true" && $cate_name !='') { ?>
					<div class="bdp-post-categories">
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>

					<h4 class="bdp-post-title">
						<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
					</h4>

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

					if(!empty($tags) && $show_tags == 'true') { ?>
						<div class="bdp-post-tags"><?php echo $tags; ?></div>
					<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>