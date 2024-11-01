<?php
/**
 * Getting Started Page
 *
 * @package WP Post and Blog Designer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<style type="text/css">
	.postbox-feedback.postbox{background:#48BF91; border:1px solid #48BF91; color:#fff; }
	.postbox-feedback.postbox p{font-size:15px;}
	.postbox-container .wpbd-list li{list-style:square inside;}
	.postbox-container .wpbd-list .wpbd-tag{display: inline-block; background-color: #fd6448; padding: 1px 5px; color: #fff; border-radius: 3px; font-weight: 600; font-size: 12px;}
	.wpbd-wrap .wpbd-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
	.wpbd-shortcode-preview{background-color: #e7e7e7; font-weight:bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	.wpbd-feedback{clear:both; text-align:center;}
	.wpbd-feedback h3{font-size:24px; margin-bottom:0px;}
	.wpbd-feedback p{font-size:15px;}
	.wpbd-feedback .wpbd-feedback-btn { font-weight: 600;  color: #fff;text-decoration: none;
		text-transform: uppercase;padding: 1em 2em; background:#0bf;    border-radius: 0.2em;}
</style>
<div class="wrap wpbd-wrap">
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<div id="post-body-content">
				<div class="meta-box-sortables">					
					<div class="postbox">
						<h3 class="hndle">
							<span><?php _e( 'How to Use - WP Post and Blog Designer', 'wp-post-and-blog-designer' ); ?></span>
						</h3>

						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th>
											<label><?php _e('How to add Post', 'wp-post-and-blog-designer'); ?></label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Go to "Post -- Add New".', 'wp-post-and-blog-designer'); ?></li>
												<li><?php _e('Step-2. Add Post Title, Description and Featured image with relevant fields.', 'wp-post-and-blog-designer'); ?></li>
												<li><?php _e('Step-3. Select post category and tag ( if need )', 'wp-post-and-blog-designer'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('Create Page', 'wp-post-and-blog-designer'); ?></label>
										</th>
										<td>
											<ul>
												<li><?php _e('Step-1. Create a page as per need', 'wp-post-and-blog-designer'); ?></li>
												<li><?php _e('Step-2. use below shortcode as per your need design.', 'wp-post-and-blog-designer'); ?></li>
											</ul>
										</td>
									</tr>

									<tr>
										<th>
											<label><?php _e('All Shortcodes', 'wp-post-and-blog-designer'); ?></label>
										</th>
										<td>														
											<span class="wpbd-shortcode-preview">[wpbd_grid]</span> – <?php _e('Post Grid Shortcode', 'wp-post-and-blog-designer'); ?> <br />
											<span class="wpbd-shortcode-preview">[wpbd_row]</span> – <?php _e('Post List Shortcode', 'wp-post-and-blog-designer'); ?> <br />
											<span class="wpbd-shortcode-preview">[wpbd_masonry]</span> – <?php _e('Post Masonry Shortcode', 'wp-post-and-blog-designer'); ?> <br />
											<span class="wpbd-shortcode-preview">[wpbd_slider]</span> – <?php _e('Post Slider Shortcode', 'wp-post-and-blog-designer'); ?> <br />
											<span class="wpbd-shortcode-preview">[wpbd_carousel]</span> – <?php _e('Post Carousel Shortcode', 'wp-post-and-blog-designer'); ?> <br />
											<span class="wpbd-shortcode-preview">[wpbd_cell_box]</span> – <?php _e('Post gridbox Shortcode', 'wp-post-and-blog-designer'); ?> <br />
											<span class="wpbd-shortcode-preview">[wpbd_ticker]</span> – <?php _e('Post Ticker Shortcode', 'wp-post-and-blog-designer'); ?><br />
											<span class="wpbd-shortcode-preview">[wpbd_filter]</span> – <?php _e('Post filter Shortcode', 'wp-post-and-blog-designer'); ?><br />

										</td>
									</tr>	
									<tr>
												<th>
													<label><?php _e('Please Contact us:', 'wp-logo-slider-and-widget'); ?></label>
												</th>
												<td>
													<a  href="mailto:help@wponlinehelp.com"></a><br/> <br/>
													<a class="button button-primary" href="http://demo.wponlinehelp.com/wp-post-and-blog-designer/" target="_blank"><?php _e('Live Demo', 'wp-logo-slider-and-widget'); ?></a>
													<a class="button button-primary" href="http://docs.wponlinehelp.com/docs-project/wp-post-blog-designer/" target="_blank"><?php _e('Documentation', 'wp-logo-slider-and-widget'); ?></a>
													
												</td>
											</tr>										
								</tbody>
							</table>
							
						</div><!-- .inside -->
						
					</div><!-- .postbox -->
				
				</div><!-- .meta-box-sortables -->
			</div><!-- #post-body-content -->			
	</div><!-- #poststuff -->
</div><!-- end .wrap -->