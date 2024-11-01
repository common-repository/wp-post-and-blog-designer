<?php
/**
 * Public Class
 * Handling shortcodes functionality of post plugin * 
 * @package WP Post and Blog Designer
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wpbd_Public {
	function __construct() { //define default constructer  
		// Ajax call to update option
		add_action( 'wp_ajax_wpbd_fetch_more_post', array($this, 'wpbd_fetch_more_post') );
		add_action( 'wp_ajax_nopriv_wpbd_fetch_more_post', array($this, 'wpbd_fetch_more_post') );
	}
	/**
	 * fetch more post througn ajax
	 *
	 * @since 1.0.0
	 */
	function wpbd_fetch_more_post() {	
		
		// Taking some defaults variable
		$result = array();		
		if( !empty($_POST['shrt_param']) ) {
			
			global $post, $wpbd_in_shrtcode;
			
			sanitize_text_field(extract( $_POST['shrt_param'] ));
			
			$template_file_path 	= WPBD_DIR . '/view/wpbd-masonry/' . $template . '.php';
			$template_file 		= (file_exists($template_file_path)) 	? $template_file_path 	: '';			
			$count 				= (isset($_POST['count'])) 			? (int)$_POST['count'] 	: 0;			
			$shortcode_atts 	= sanitize_text_field($_POST['shrt_param']); // Assigning to post variable


if($gridcol == '2') {
	$grids = "6";
} else if($gridcol == '3') {
	$grids = "4";
}  else if($gridcol == '4') {
	$grids = "3";
}  else if($gridcol == '5') {
	$grids = "b5";	
} else if ($gridcol == '1') {
	$grids = "12";
} else {
	$grids = "12";
}
			
			$args = array (
					'post_type'      	=> WPBD_POST_TYPE, 
					'orderby'        	=> !empty($orderby) 	? $orderby : 'post_date',
					'order'          	=> !empty($order) 		? $order 	: 'DESC',
					'posts_per_page' 	=> !empty($posts_per_page) 		? $posts_per_page 	: '10',
					'paged'          	=> sanitize_text_field(!empty($_POST['paged']))		? sanitize_text_field($_POST['paged']) 	: '1',
					
				);

			if($cat != "") {
				$args['tax_query'] = array( array( 'taxonomy' => WPBD_CAT, 'field' => 'id', 'terms' => $cat) );
			}

			$blog_posts = new WP_Query($args);

			ob_start();

			if ( $blog_posts->have_posts() ) {				

				while ( $blog_posts->have_posts() ) : $blog_posts->the_post();
					
					$count++;
					$blog_cat_links  		= array();
					$terms 					= get_the_terms( $post->ID, WPBD_CAT );
		            $post_link 				= wpbd_get_post_link( $post->ID );
					$post_author 			= get_the_author();
					$post_featured_image    = wpbd_get_post_featured_image( $post->ID, $media_size );						
					$terms 					= get_the_terms( $post->ID, WPBD_CAT );
					$tags 			        = get_the_tag_list(' ',', ');
					$comments 		        = get_comments_number( $post->ID );
					$reply			        = ($comments <= 1)  ? 'Reply' : 'Replies';
					
					if($terms) {
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$blog_cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
	                }
	                $cate_name = join( " ", $blog_cat_links );	                
				if( $template_file ) {
              		include( $template_file );
              	}
				endwhile; // End while loop
			}			
				$data = ob_get_clean();				
						
				$result['success'] 		= 1;
				$result['data'] 		= $data;
				$result['count']		= $count;				
				
		} else {
			$result['success'] 	= 0;
		}
		echo json_encode($result);
		die();
	}
}

$wpbd_public = new Wpbd_Public();