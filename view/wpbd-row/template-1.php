<?php
/**
 * List Design 1
 * 
 * @package WP Post and Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="wpbd-post-row wpbd-clear-all">
	<div class="wpbd-post-row-content">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="wpbd-medium-6 wpbd-cell">
			<div class="wpbd-post-image">
				<a href="<?php echo esc_url( $post_link ); ?>">
					<img src="<?php echo esc_url( $post_image ); ?>" alt="<?php the_title_attribute(); ?>" />
				</a>
			</div>
		</div>
		<?php } ?>
		<div class="<?php if ( !has_post_thumbnail() ) { echo 'wpbd-medium-12 wpbd-cell'; } else { echo 'wpbd-medium-6 wpbd-cell'; } ?>">
			<div class="wpbd-inner-content">
			<?php if($PostCategory == "true" && $cate_name !='') { ?>
				<div class="wpbd-post-categories">
					<?php echo $cate_name; ?>
				</div>
			<?php } ?>
				<div class="wpbd-post-title">
					<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
				</div>
				
				<?php if($PostDate == "true" || $PostAuthor == 'true' || $Post_Comments =="true") { ?>
					<div class="wpbd-post-date">
						<?php if($PostAuthor == 'true') { ?>
							<span class="wpbd-post-author"><i class="fa fa-user" aria-hidden="true"></i><?php the_author(); ?></span>
						<?php } ?>
						<?php echo ($PostAuthor == 'true' && $PostDate == 'true') ? '/' : '' ?>
						<?php if($PostDate == "true") { ?>
							<span class="wpbd-post-time"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?> </span>
						<?php } ?>
						<?php echo ($PostAuthor == 'true' && $PostDate == 'true' && $Post_Comments == 'true' &&!empty($comments)) ? '/' : '' ?>
						<?php if(!empty($comments) && $Post_Comments == 'true') { ?>
							<span class="wpbd-post-comments">
								<a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comments" aria-hidden="true"></i><?php echo $comments.' '.$reply;  ?></a>
							</span>
						<?php } ?>	
					</div>
				<?php }
				if($PostContent == "true") { ?>
				<div class="wpbd-post-content">
					<div class="wpbd-post-short-content"><p><?php echo wpbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?></p></div>
					<?php if($postreadmore == 'true') { ?>
					<a href="<?php echo esc_url( $post_link ); ?>" class="wpbd-btn"><?php echo _e('Read More', 'wp-post-and-blog-designer'); ?></a>
					<?php } ?>
				</div>
				<?php }
			if(!empty($tags) && $show_tags == 'true') { ?>
			<div class="wpbd-post-tags"><i class="fa fa-tags" aria-hidden="true"></i><?php echo $tags; ?></div>
			<?php } ?>
		</div>
	</div>
	</div>
</div>