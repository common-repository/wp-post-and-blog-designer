<?php
/**
 * Masonry Design template
 * 
 * @package WP Post and Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="wpbd-post-grid  wpbd-medium-<?php echo $grids; ?> wpbd-cell ">
	<div class="wpbd-post-grid-content <?php if ( !has_post_thumbnail() ) { echo 'wpbd-no-thumb-image'; } ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="wpbd-post-image-bg">
			<a href="<?php echo esc_url( $post_link ); ?>">
				<img src="<?php echo esc_url( $post_featured_image ); ?>" alt="<?php the_title_attribute(); ?>" />
			</a>
			<div class="wpbd-masonary-img-content">
		<?php }
		if($showCategory == "true" && $cate_name !='') { ?>
		<div class="wpbd-post-categories">
			<?php echo $cate_name; ?>
		</div>
		<?php } ?>
		<div class="wpbd-post-title">
			<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
		</div>
		
		<?php if($showDate == "true" || $showAuthor == 'true' || $show_comments =="true") { ?>
			<div class="wpbd-post-date">
				<?php if($showAuthor == 'true') { ?>
					<span class="wpbd-user-img"><i class="fa fa-user" aria-hidden="true"></i><?php the_author(); ?></span>
				<?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '/' : '' ?>
				<?php if($showDate == "true") { ?>
					<span class="wpbd-time"> <i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?> </span>
				<?php } ?>
				<?php echo ($showAuthor == 'true' && $showDate == 'true' && $show_comments == 'true' && !empty($comments)) ? '/' : '' ?>
				<?php if(!empty($comments) && $show_comments == 'true') { ?>
					<span class="wpbd-post-comments">
						<a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comments" aria-hidden="true"></i><?php echo $comments.' '.$reply;  ?></a>
					</span>
				<?php } ?>
			</div>
				</div>
		</div>
		<div class="wpbd-masonary-inner-content">
		<?php }
		if($showContent == "true") { ?>
		<div class="wpbd-post-content">
			<div class="wpbd-post-short-content"><p><?php echo wpbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit ); ?></p></div>
			<?php if($showreadmore == 'true') { ?>
				<a href="<?php echo esc_url( $post_link ); ?>" class="wpbd-readmorebtn"><?php echo _e('Read More', 'blog-designer-pack'); ?></a>
			<?php } ?>
		</div>
		<?php }
		
		if(!empty($tags) && $show_tags == 'true') { ?>
			<div class="wpbd-post-tags"><i class="fa fa-tags" aria-hidden="true"></i><?php echo $tags; ?></div>
		<?php } ?>
	</div>
</div>
</div>