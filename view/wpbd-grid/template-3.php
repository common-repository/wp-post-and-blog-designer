<?php
/**
 * Grid Design template
 * 
 * @package WP Post and Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="wpbd-post-grid  wpbd-medium-<?php echo $grids; ?> wpbd-cell <?php echo $css_class; ?>">		
	<div class="wpbd-grid-content <?php if ( !has_post_thumbnail() ) { echo 'wpbd-no-image'; } ?>">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="wpbd-post-image-outter">
			<a href="<?php echo esc_url( $post_link ); ?>">
				<img src="<?php echo esc_url( $post_image ); ?>" alt="<?php the_title_attribute(); ?>" />
			</a>
		
	</div>
		<?php } ?>
		<div class="wpbd-post-margin-content">
				<div class="post-image-content">
			
			<div class="wpbd-title-content">
			<div class="wpbd-post-title">
				<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
			</div>
			<?php if($PostDate == "true" || $PostAuthor == 'true' || $Post_Comments =="true") { ?>
				<div class="wpbd-post-other-content">
					<?php if($PostAuthor == 'true') { ?>
						<span class="wpbd-post-author"><i class="fa fa-user" aria-hidden="true"></i><?php the_author(); ?></span>
					<?php } ?>
					<?php echo ($PostAuthor == 'true' && $PostDate == 'true') ? '/' : '' ?>
					<?php if($PostDate == "true") { ?>
						<span class="wpbd-post-date"> <i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?> </span>
					<?php } ?>
					<?php echo ($PostAuthor == 'true' && $PostDate == 'true' && $Post_Comments == 'true' && !empty($comments)) ? '/' : '' ?>
					<?php if(!empty($comments) && $Post_Comments == 'true') { ?>
						<span class="wpbd-post-comments">
							<a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comments" aria-hidden="true"></i><?php echo $comments.' '.$reply;  ?></a>
						</span>
					<?php } ?>
				</div>
			</div>
		</div>
			<?php }
           
			if($PostContent == "true") { ?>
				<div class="wpbd-post-content">
					<div class="wpbd-sub-content"><p>
					<?php echo wpbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit ); ?></p>
					</div>
					<?php }
			if(!empty($tags) && $post_tags == 'true') { ?>
				<div class="wpbd-post-tags"><i class="fa fa-tags" aria-hidden="true"></i><?php echo $tags; ?></div>
			<?php } ?>
					<?php if($postreadmore == 'true') { ?>
						
						<a href="<?php echo esc_url( $post_link ); ?>" class="wpbd-btn"><?php echo _e('<span>Read More</span>', 'wp-post-and-blog-designer'); ?></a>
					<?php } ?>
				</div>
			
			<?php if($PostCategory  == "true" && $cate_name !='') { ?>
			<div class="wpbd-post-categories">
				<?php echo $cate_name; ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>