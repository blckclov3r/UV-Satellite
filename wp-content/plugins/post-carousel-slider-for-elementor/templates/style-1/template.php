<div class="wb_ps_item">
	<div class="wb_ps_single_item">
		<?php if( isset($settings['display_image']) && ( $settings['display_image'] == 'yes' ) ){ ?>
			<div class="wb_ps_thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php
						if( $thumbnail_id ){
							$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $thumbnail_id, 'thumbnail_size', $settings );
							echo sprintf( '<img src="%s" title="%s" alt="%s"%s />', esc_url( $image_src ), get_the_title( $thumbnail_id ), wb_get_attachment_alt($thumbnail_id), '' ); 
						}
					?>
				</a>
			</div>
		<?php } ?>
		<div class="wb_ps_content">

			<div class="wb_ps_title">
				<h2 ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>

			<div class="wb_ps_description">

				<div class="wb_ps_text"><?php echo wpautop(wb_get_excerpt()); ?></div>

			<?php if( trim($read_more_text) != '' ){ ?>
				<div class="wb_ps_readmore">
					<a class="wb_ps_readmore_link" href="<?php the_permalink(); ?>"><?php echo esc_html($read_more_text) ?></a>
				</div>
			<?php } ?>

			</div>
		
		</div>
	</div>
</div>