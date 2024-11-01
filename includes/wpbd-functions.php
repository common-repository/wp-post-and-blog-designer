<?php
/**
 * All functions file
 *
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Function to get Post content word limit
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_words_limit($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
		array_pop($words);
	return implode(' ', $words);
}
/**
 * WP Escape Tags & Slashes
 *
 * For Handles escapping the slashes and tags
 *
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}
/**
 * WP Strip Slashes From Array
 * If it is flag variable is passed then it will allow HTML
 *
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_slashes_deep($data = array(), $flag = false){	
	if($flag != true) {
		$data = wpbd_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}
/**
 * Strip Html Tags 
 * 
 * It will sanitize text input fields. Strip html tags and escape characters)
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_nohtml_kses($data = array()){	
	if ( is_array($data) ) {		
		$data = array_map('wtwp_nohtml_kses', $data);		
	} elseif ( is_string( $data ) ) {		
		$data = wp_filter_nohtml_kses($data);
	}	
	return $data;
}
/**
 * Function to unique number value
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_get_fix() {
	static $fix = 0;
	$fix++;

	return $fix;
}

/**
 * Function to add array after specific key
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_add_array(&$array, $value, $index, $from_last = false) {    
    if( is_array($array) && is_array($value) ) {
        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }    
    return $array;
}
/**
 * Function to get post excerpt
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_get_post_excerpt( $post_id = null, $content = '', $word_length = '45', $more = '...' ) {
	$has_excerpt 	= false;
	$word_length 	= !empty($word_length) ? $word_length : '45';
	// If post id is passed
	if( !empty($post_id) ) {
		if (has_excerpt($post_id)) {
			$has_excerpt 	= true;
			$content 		= get_the_excerpt();
		} else {
			$content = !empty($content) ? $content : get_the_content();
		}
	}
	if( !empty($content) && (!$has_excerpt) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}	
	return $content;
}
/**
 * Function to get post featured image
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_get_post_featured_image( $post_id = '', $size = 'full' ) {
    
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
    $image 	= isset($image[0]) ? $image[0] : '';
    return $image;
}
/**
 * Function to get post permalink  
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_get_post_link( $post_id = '' ) {

	$post_link = '';

	if( !empty($post_id) ) {

		if( empty($post_link) ) {
			$post_link = get_permalink( $post_id );	
		}
	}
	return $post_link;
}
/**
 * Pagination function for grid
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_post_pagination($args = array()){
	
	$large = 999999999; // for infinet integer variable value
	
	$total_paging = array(
					'base' 		=> str_replace( $large, '%#%', esc_url( get_pagenum_link( $large ) ) ),
					'format' 	=> '?paged=%#%',
					'current' 	=> max( 1, $args['paged'] ),
					'total'		=> $args['total'],
					'prev_next'	=> true,
					'prev_text'	=> __('« Previous', 'wp-post-and-blog-designer'),
					'next_text'	=> __('Next »', 'wp-post-and-blog-designer'),
				);
	return paginate_links($total_paging);
}
/**
 * Function to get 'wpbd post Slider' shortcode template
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_post_template() {
	$template_arr = array(
		'template-1'	=> __('Template 1', 'wp-post-and-blog-designer'),
		'template-2'	=> __('Template 2', 'wp-post-and-blog-designer'),
		'template-3'	=> __('Template 3', 'wp-post-and-blog-designer'),
		'template-4'	=> __('Template 4', 'wp-post-and-blog-designer'),
		'template-5'	=> __('Template 5', 'wp-post-and-blog-designer'),		
	);
	return $template_arr;
}

/**
 * Function to get for masonry effect
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_post_masonry_effects() {
	$effects_arr = array(
						'effect-1'	=> __('Effect 1', 'wp-post-and-blog-designer'),
						'effect-2'	=> __('Effect 2', 'wp-post-and-blog-designer'),	
					);
	return $effects_arr;
}