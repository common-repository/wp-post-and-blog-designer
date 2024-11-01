<?php
/**
 * Gridbox Design tempalte
 * 
 * @package WP Post and Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if($grid_count == "0") {
$wpbd_post_large_image = wpbd_get_post_featured_image( $post->ID, 'large' ); ?>
<div class="wpbd-post-image-content">
	<div class="wpbd-medium-8 wpbd-cell wpbd-left-block">
		<?php if(!empty($wpbd_post_large_image)) { ?>
			<div class="wpbd-post-image-bg">
				<a href="<?php echo esc_url( $post_link ); ?>">
					<img src="<?php echo esc_url( $wpbd_post_large_image ); ?>" alt="<?php the_title_attribute(); ?>" />
				</a>
				<div class="wpbd-img-overlay"></div>
			</div>
<div class="wpbd-image-inner-content">
		<?php }
		if($postCategory == "true" && $cate_name !='') { ?>
		<div class="wpbd-post-categories">
			<?php echo $cate_name; ?>
		</div>
		<?php } ?>
		<div class="wpbd-post-title">
			<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
		</div>
		<?php if($postDate == "true" || $postAuthor == 'true' || $post_comments =="true") { ?>
			<div class="wpbd-post-date">
				<?php if($postAuthor == 'true') { ?>
					<span class="wpbd-user-img"><?php the_author(); ?></span>
				<?php } ?>
				<?php echo ($postAuthor == 'true' && $postDate == 'true') ? '/' : '' ?>
				<?php if($postDate == "true") { ?>
					<span class="wpbd-time">  <?php echo get_the_date(); ?> </span>
				<?php } ?>
				<?php echo ($postAuthor == 'true' && $postDate == 'true' && $post_comments == 'true' && !empty($comments)) ? '/' : '' ?>
				<?php if(!empty($comments) && $post_comments == 'true') { ?>
					<span class="wpbd-post-comments">
						<a href="<?php the_permalink(); ?>#comments"><?php echo $comments.' '.$reply;  ?></a>
					</span>
				<?php } ?>
			</div>
		<?php }
		if($postContent == "true") { ?>
			<div class="wpbd-post-content">
				<div class="wpbd-post-short-content"><p><?php echo wpbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?></p></div>
				<?php if($postreadmore == 'true') { ?>
				<a href="<?php echo esc_url( $post_link ); ?>" class="wpbd-readmorebtn"><?php echo _e('Read More', 'blog-designer-pack'); ?></a>
				<?php } ?>
			</div>
		<?php }
		if(!empty($tags) && $post_tags == 'true') { ?>
			<div class="wpbd-post-tags"><?php echo $tags; ?></div>
		<?php } ?>
	</div>
</div>
</div>
<?php } else {
	$wpbd_post_large_image = wpbd_get_post_featured_image( $post->ID );
?>
	<div class="wpbd-medium-4 wpbd-cell <?php if($grid_count <= 3) { echo 'flotRight'; } ?> <?php if($grid_count == 3) { echo 'clearboth'; } ?>" >
		<div class="wpbd-post-right-block wpbd-medium-12 wpbd-cell">
			<?php if(!empty($wpbd_post_large_image)) { ?>
				<div class="wpbd-medium-12 wpbd-cell">
					<div class="wpbd-post-image-bg">
						<a href="<?php echo esc_url( $post_link ); ?>">
							<img src="<?php echo esc_url( $wpbd_post_large_image ); ?>" alt="<?php the_title_attribute(); ?>" />
						</a>
						<div class="wpbd-img-overlay"></div>
						<div class="wpbd-image-inner-content">
						<div class="<?php if(!empty($wpbd_post_large_image)) { echo 'wpbd-medium-12 wpbd-cell'; } else { echo 'wpbd-medium-12 wpbd-cell'; } ?> ">
					<?php if($postCategory == "true" && $cate_name !='') { ?>
					<div class="wpbd-post-categories">
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>
					<div class="wpbd-post-title">
						<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
					</div>
					<?php if($postDate == "true" || $postAuthor == 'true' || $post_comments =="true") { ?>
						<div class="wpbd-post-date">
							<?php if($postAuthor == 'true') { ?>
								<span class="wpbd-user-img"><?php the_author(); ?></span>
							<?php } ?>
							<?php echo ($postAuthor == 'true' && $postDate == 'true') ? '/' : '' ?>
							<?php if($postDate == "true") { ?>
								<span class="wpbd-time"> <?php echo get_the_date(); ?> </span>
							<?php } ?>
							<?php echo ($postAuthor == 'true' && $postDate == 'true' && $post_comments == 'true' && !empty($comments)) ? '/' : '' ?>
							<?php if(!empty($comments) && $post_comments == 'true') { ?>
								<span class="wpbd-post-comments">
									<a href="<?php the_permalink(); ?>#comments"><?php echo $comments.' '.$reply;  ?></a>
								</span>
							<?php } ?>
						</div>
					<?php }
					if($postContent == "true") { ?>
					<div class="wpbd-post-content">
						<div class="wpbd-post-short-content"><p><?php echo wpbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit); ?></p></div>
						<?php if($postreadmore == 'true') { ?>
						<a href="<?php echo esc_url( $post_link ); ?>" class="wpbd-readmorebtn"><?php echo _e('Read More', 'blog-designer-pack'); ?></a>
						<?php } ?>
					</div>
					<?php }
					if(!empty($tags) && $post_tags == 'true') { ?>
						<div class="wpbd-post-tags"><i class="fa fa-tags" aria-hidden="true"></i><?php echo $tags; ?></div>
					<?php } ?>
			</div>
		</div>
					</div>
				</div>
				<?php } ?>
				
		</div>
	</div>
<?php } ?>