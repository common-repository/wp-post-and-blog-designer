<?php
/**
 * widget Grid Design tempalte
 * 
 * @package WP Post and Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
} ?>
<div class="wpbd-recent-post-widget-inner">
   <?php if( !empty($feat_image) ) { ?>
       <div class="wpbd-post-image-wrap">
        <a  href="<?php echo esc_url( $post_link ); ?>" target="<?php echo $link_target; ?>">
            <img src="<?php echo esc_url( $feat_image ); ?>" alt="<?php the_title_attribute(); ?>" />
        </a>
    </div>
<?php }                    
if($post_category == 'true' && $cate_name !='') { ?>
    <div class="wpbd-post-categories"><?php echo $cate_name; ?></div>
<?php } ?>
<h4 class="wpbd-post-title">
    <a href="<?php echo esc_url( $post_link ); ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
</h4>

<?php if($date == "true") { ?>
    <div class="wpbd-post-date" <?php if($post_content != "true") { ?>  style="margin:0px;" <?php } ?> >
     <span class="wpbd-post-time"><?php echo get_the_date(); ?></span>
 </div>
<?php }

if($post_content == "true") { ?>
    <div class="wpbd-post-content">
        <div><?php echo wpbd_get_post_excerpt( $post->ID, get_the_content(), $words_limit ); ?></div>
    </div>
<?php } ?>
</div>