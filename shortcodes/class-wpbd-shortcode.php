<?php
/**
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Wpbd_Shortcode {
	var $model;
	function __construct() {
		global $wpbd_model;
		$this->model = $wpbd_model;
		// All post shortcode
		add_shortcode( 'wpbd_grid', array($this, 'wpbd_fetch_posts') );
		add_shortcode( 'wpbd_slider', array($this, 'wpbd_fetch_slider') );
        add_shortcode( 'wpbd_carousel', array($this, 'wpbd_post_carousel') );
        add_shortcode( 'wpbd_cell_box', array($this, 'wpbd_fetch_posts_cellbox') );
        add_shortcode( 'wpbd_row', array($this, 'wpbd_fetch_posts_row') );
        add_shortcode( 'wpbd_ticker', array($this, 'wpbd_fetch_post_ticker') );
        add_shortcode( 'wpbd_masonry', array($this, 'wpbd_fetch_post_masonry') );
        add_shortcode( 'wpbd_filter', array($this, 'get_wpbd_filter_shortcode') );
	}
/**
 * Function for the `wpbd_grid` shortcode
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_fetch_posts( $atts, $content = null ) {    
    // Post grid Shortcode Parameters  
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',		
		'grid' 					=> '3',
		'template' 				=> 'template-1',
		'pagination' 			=> 'true',		
		'post_image_size' 			=> 'large',		
		'content_words_limit' 	=> '20',		
		'order'					=> 'DESC',
		'orderby'				=> 'date',		
		'post_author' 			=> 'true',
		'post_tags'				=> 'true',
		'post_comments'			=> 'true',
		'post_category' 		=> 'true',		
		'post_content' 			=> 'true',
		'post_date' 			=> 'true',		
		'post_read_more' 		=> 'true',
		), $atts, 'wpbd_grid'));
	
    $shortcode_templates 	= wpbd_post_template();	
	$posts_per_page 	    = !empty($limit) 					? $limit 						: '20';
	$cat 				    = (!empty($category))				? explode(',',$category) 		: '';	
	$grid			        = !empty($grid) 					? $grid 						: '1';	
	$template 			    = ($template && (array_key_exists(trim($template), $shortcode_templates))) ? trim($template) 	: 'template-1';
	$pagination 		    = ($pagination == 'false')			? 'false'						: 'true';	
    $post_image_size 		    = (!empty($post_image_size))				? $post_image_size 					: 'large'; 
	$words_limit 		    = !empty( $content_words_limit ) 	? $content_words_limit 			: 20;
    $PostAuthor 		    = ($post_author == 'false')			? 'false'						: 'true';
	$Post_tags 			    = ( $post_tags == 'false' ) 		? 'false'						: 'true';
	$Post_Comments 		    = ( $post_comments == 'false' ) 	? 'false'						: 'true';
	$PostCategory 		    = ( $post_category == 'false' )? 'false' 						: 'true';
	$PostContent 		    = ( $post_content == 'false' ) 		? 'false' 						: 'true';	
	$PostDate 			    = ( $post_date == 'false' ) 		? 'false'						: 'true';
	$order 				    = ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 			    = !empty($orderby)					? $orderby 						: 'date';
	$postreadmore 		    = ( $post_read_more == 'false' )	? 'false' 						: 'true';
			
	// Shortcode file
	$post_template_file_path 	= WPBD_DIR . '/view/wpbd-grid/' . $template . '.php';
	$template_file 			= (file_exists($post_template_file_path)) ? $post_template_file_path : '';
	
	// Taking two globals
	global $post, $paged;
	// Taking some fix variables	
	$grid_count		= 1;
	// Query for post Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}	
	// WP post Query Parameters
	$args = array ( 
		'post_type'      		=> WPBD_POST_TYPE,
		'post_status' 			=> array('publish'),
		'order'          		=> $order,
		'orderby'        		=> $orderby, 
		'posts_per_page' 		=> $posts_per_page, 
		'paged'          		=> $paged,		
		'ignore_sticky_posts'	=> true,
	);
    // post Category Parameter
	if($cat != "") {		
		$args['tax_query'] = array(
								array( 
									'taxonomy' 			=> WPBD_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,									
								));
	}
	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;
	ob_start();	
if($grid == '1') {
	$grids = "12";
} else if($grid == '2') {
	$grids = "6";
}  else if($grid == '3') {
	$grids = "4";
}  else if($grid == '4') {
	$grids = "3";	
} else if ($grid == '5') {
	$grids = "b5";
	} else if ($grid == '6') {
	$grids = "2";
} else {
	$grids = "12";
}
	// If post is added
	if ( $query->have_posts() ) { ?>
		<div class="wpbd-post-grid-outter <?php echo 'wpbd-'.$template; ?> wpbd-clear-all">
		<?php while ( $query->have_posts() ) : $query->the_post();				
				$cat_links 		= array();
				$css_class 		= '';
				$post_image 	= wpbd_get_post_featured_image( $post->ID, $post_image_size );
				$post_link 		= wpbd_get_post_link( $post->ID );
				$terms 			= get_the_terms( $post->ID, WPBD_CAT );
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1)  ? 'comments' : 'Replies';				
				if($terms) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( " ", $cat_links );
				
				if( $grid_count == 1 ){
					$css_class = 'wpbd-first';
				} elseif ( $grid_count == $grid ) {
					$grid_count = 0;
					$css_class = 'wpbd-last';
				}	            
	            // Include shortcode html file
				if( $template_file ) {
					include( $template_file );
				}				
				$grid_count++;
			endwhile; ?>
		</div>
		<?php if($pagination == "true") { ?>
			<div class="wpbd-pagination wpbd-clear-all">
				<?php 				
					echo wpbd_post_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages ) );
				 ?>				
			</div>
		<?php }
	} // end of have_post()

	wp_reset_postdata(); // Reset WP Query

    $content .= ob_get_clean();
    return $content;
}

/**
 * Function to handle the `wpbd_post_slider` shortcode
 * 
 * @package WP Post and Blog Designer
 * @since 1.0.0
 */
function wpbd_fetch_slider( $atts, $content = null ) {	
    // Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',
		'post_read_more' 		=> 'true',
		'template' 				=> 'template-1',
		'post_author' 			=> 'true',
		'post_date' 			=> 'true',
		'post_category' 		=> 'true',		
		'post_content' 			=> 'true',
		'post_words_limit' 	    => '20',	
		'post_image_size' 		=> 'large',	
		'dots' 					=> 'true',
		'arrows'				=> 'true',
		'autoplay' 				=> 'false',
		'autoplay_interval' 	=> '2000',
		'speed' 				=> '300',
		'loop' 					=> 'true',		
		'order'					=> 'DESC',
		'orderby'				=> 'date',			
		'post_tags'				=> 'true',
		'post_comments'			=> 'true',
		), $atts, 'wpbd_fetch_slider'));	
	$shortcode_templates 	= wpbd_post_template();	
	$posts_per_page 		= !empty($limit) 						? $limit 						: '20';
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';	
	$template 				= ($template && (array_key_exists(trim($template), $shortcode_templates))) ? trim($template) 	: 'template-1';
	$postDate 				= ( $post_date == 'false' ) 			? 'false'						: 'true';
	$postCategory 			= ( $post_category == 'false' )			? 'false' 						: 'true';
	$postContent 			= ( $post_content == 'false' ) 			? 'false' 						: 'true';
	$post_image_size 		= (!empty($post_image_size))		? $post_image_size 	: 'large'; //thumbnail, medium, large, full	
	$words_limit 			= !empty( $post_words_limit ) 		    ? $post_words_limit 	 		: 20;	
	$dots 					= ( $dots == 'false' )					? 'false' 						: 'true';
	$arrows 				= ( $arrows == 'false' )				? 'false' 						: 'true';
	$autoplay 				= ( $autoplay == 'false' )				? 'false' 						: 'true';
	$autoplay_interval 		= !empty( $autoplay_interval ) 			? $autoplay_interval 			: 2000;
	$speed 					= !empty( $speed ) 						? $speed 						: 300;
	$loop 					= ( $loop == 'false' )					? 'false' 						: 'true';
	$postAuthor 			= ($post_author == 'false')				? 'false'						: 'true';
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= !empty($orderby) 						? $orderby 						: 'date';	
	$post_tags 				= ( $post_tags == 'false' ) 			? 'false'						: 'true';
	$post_comments 			= ( $post_comments == 'false' ) 		? 'false'						: 'true';
	$postreadmore 			= ( $post_read_more == 'false' ) 		? 'false'						: 'true';	
	
	// Shortcode file
	$post_template_file_path 	= WPBD_DIR . '/view/wpbd-slider/' . $template . '.php';
	$template_file 			= (file_exists($post_template_file_path)) ? $post_template_file_path : '';
	
	// Slider configuration
	$slider_conf = compact('dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'loop', 'template');
	
	// Enqueue required script
	wp_enqueue_style( 'wpoh-fontawesome-css');	
	wp_enqueue_script( 'wpoh-slick-js' );
	wp_enqueue_script( 'wpbd-custom-script');

	// Taking some globals
	global $post;

	// Taking some variables
	$fix			= wpbd_get_fix();
	$count 			= 0;
	$wpbdcount 		= 0;	
	$grid_count 	= 1;	

	// WP Query Parameters
	$args = array ( 
				'post_type'     	 	=> WPBD_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'orderby'        		=> $orderby, 
				'order'          		=> $order,
				'posts_per_page' 		=> $posts_per_page,				
				'ignore_sticky_posts'	=> true,
			);
	
	// Category Parameter
	if($cat != "") {

		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> WPBD_CAT,
									'field' 	=> 'term_id',
									'terms' 	=> $cat
								));

	} 

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>		

	<div class="wpbd-post-slider-outter wpbd-clearfix">
		<div class="wpbd-post-slider <?php echo 'wpbd-'.$template; ?>"  id="wpbd-slider-<?php echo $fix; ?>">
			<?php while ( $query->have_posts() ) : $query->the_post();				
				$count++;
				$terms 		= get_the_terms( $post->ID, WPBD_CAT );
				$cat_url = array();				
				if($terms) {
					foreach ( $terms as $term ) {
						$term_url = get_term_link( $term );
						$cat_url[] = '<a href="' . esc_url( $term_url ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name 		= join( " ", $cat_url );
				
				$feat_image 	= wpbd_get_post_featured_image( $post->ID, $post_image_size );
				$post_link 		= wpbd_get_post_link( $post->ID );				
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1)  ? __('Reply', 'wp-post-and-blog-designer') : __('Replies', 'wp-post-and-blog-designer');
				
				// Include shortcode html file
				if( $template_file ) {
					include( $template_file );
				}

				$wpbdcount++;
				$grid_count++;
			endwhile;
		?>
		</div>
		<div class="wpbd-slider-conf"><?php echo htmlspecialchars(json_encode( $slider_conf )); ?></div>
	</div>

	<?php
	} // End of have_post()
	
	wp_reset_postdata(); // Reset WP Query
	
	$content .= ob_get_clean();
	return $content;
}
/**
 * Function to handle the `wpbd_post_carousel` shortcode
 * 
 * @package WP Post and Blog Designer
 * @since 1.0.0
 */
function wpbd_post_carousel( $atts, $content = null ) {
	
    // Post Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',
		'post_read_more' 		=> 'true',
		'template' 				=> 'template-1',
		'order'					=> 'DESC',
		'orderby'				=> 'date',	
		'post_tags'				=> 'true',
		'post_comments'			=> 'true',
		'post_author' 			=> 'true',
		'post_date' 			=> 'true',
		'post_category' 		=> 'true',		
		'post_content' 			=> 'true',
		'post_words_limit' 	=> '20',
		'slide_post'            => '3',	
		'slide_scroll'          => '1',	
		'post_image_size' 		=> 'large',
		'dots' 					=> 'true',
		'arrows'				=> 'true',
		'autoplay' 				=> 'false',
		'autoplay_interval' 	=> '2000',
		'speed' 				=> '300',
		'loop' 					=> 'true',		
		
		), $atts, 'wpbd_post_carousel'));
	
	$shortcode_templates 		= wpbd_post_template();	
	$posts_per_page 		= !empty($limit) 						? $limit 						: '20';
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';
	$slide_post 			= !empty($slide_post) 					? $slide_post 					: '3';
	$slide_scroll 			= !empty($slide_scroll) 				? $slide_scroll 				: '1';
	$template 				= ($template && (array_key_exists(trim($template), $shortcode_templates))) ? trim($template) 	: 'template-1';
	$postDate 				= ( $post_date == 'false' ) 			? 'false'						: 'true';
	$postCategory 			= ( $post_category == 'false' )			? 'false' 						: 'true';
	$postContent 			= ( $post_content == 'false' ) 			? 'false' 						: 'true';
	$post_image_size 			= (!empty($post_image_size))					? $post_image_size 					: 'large'; //thumbnail, medium, large, full	
	$words_limit 			= !empty( $post_words_limit ) 		    ? $post_words_limit	 		: 20;	
	$dots 					= ( $dots == 'false' )					? 'false' 						: 'true';
	$arrows 				= ( $arrows == 'false' )				? 'false' 						: 'true';
	$autoplay 				= ( $autoplay == 'false' )				? 'false' 						: 'true';
	$autoplay_interval 		= !empty( $autoplay_interval ) 			? $autoplay_interval 			: 2000;
	$speed 					= !empty( $speed ) 						? $speed 						: 300;
	$loop 					= ( $loop == 'false' )					? 'false' 						: 'true';
	$postAuthor 			= ($post_author == 'false')				? 'false'						: 'true';
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= !empty($orderby) 						? $orderby 						: 'date';	
	$post_tags 				= ( $post_tags == 'false' ) 			? 'false'						: 'true';
	$post_comments 			= ( $post_comments == 'false' ) 		? 'false'						: 'true';
	$postreadmore 			= ( $post_read_more == 'false' ) 		? 'false'						: 'true';
	
	// Shortcode file
	$post_template_file_path 	= WPBD_DIR . '/view/wpbd-carousel/' . $template . '.php';
	$template_file 			= (file_exists($post_template_file_path)) ? $post_template_file_path : '';
	
	// Slider configuration
	$slider_conf = compact('slide_post', 'slide_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'loop', 'template');
	
	// Enqueue required script
	wp_enqueue_script( 'wpoh-slick-js' );
	wp_enqueue_script( 'wpbd-custom-script' );

	// Taking some globals variable
	global $post;

	// Taking some variables with value
	$fix			= wpbd_get_fix();
	$count 			= 0;		
	$grid_count 	= 1;
	// WP post Query Parameters
	$args = array ( 
				'post_type'     	 	=> WPBD_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'orderby'        		=> $orderby, 
				'order'          		=> $order,
				'posts_per_page' 		=> $posts_per_page,				
				'ignore_sticky_posts'	=> true,
			);
	
	// Post Category Parameter
	if($cat != "") {
		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> WPBD_CAT,
									'field' 	=> 'term_id',
									'terms' 	=> $cat
								));
	} 
	// WP Post Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;
	ob_start();
	// If post is added
	if ( $query->have_posts() ) { ?>		

	<div class="wpbd-post-carousel-outter wpbd-clear-all">
		<div class="wpbd-post-carousel <?php echo 'wpbd-'.$template; ?>"  id="wpbd-carousel-<?php echo $fix; ?>">
			<?php while ( $query->have_posts() ) : $query->the_post();				
				$count++;
				$terms 		= get_the_terms( $post->ID, WPBD_CAT );
				$cat_links = array();				
				if($terms) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name 		= join( " ", $cat_links );				
				$post_featured_image 	= wpbd_get_post_featured_image( $post->ID, $post_image_size );
				$post_link 		= wpbd_get_post_link( $post->ID );				
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1)  ? __('Reply', 'wp-post-and-blog-designer') : __('Replies', 'wp-post-and-blog-designer');				
				// Include shortcode html file
				if( $template_file ) {
					include( $template_file );
				}			
				$grid_count++;
			endwhile;
		?>
		</div>
		<div class="wpbd-slider-conf"><?php echo htmlspecialchars(json_encode( $slider_conf )); ?></div>
	</div>
	<?php
	} // End of have_post()	
	wp_reset_postdata(); // Reset WP Query	
	$content .= ob_get_clean();
	return $content;
}

/**
 * Function to handle the `wpbd_cell_box` shortcode
 * 
 * @package WP Post and Blog Designer
 * @since 1.0.0
 */
function wpbd_fetch_posts_cellbox( $atts, $content = null ) {
    
    // Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',				
		'template' 				=> 'template-1',
		'post_author' 			=> 'true',
		'pagination' 			=> 'true',		
		'post_date' 			=> 'true',		
		'post_category' 		=> 'true',		
		'post_content' 			=> 'true',
		'post_words_limit' 	    => '10',
		'post_read_more' 		=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',		
		'post_tags'				=> 'true',
		'post_comments'			=> 'true',
		), $atts, 'wpbd_post_cell_box'));
	
	$shortcode_templates 	= wpbd_post_template();
	$posts_per_page 	= !empty($limit) 					? $limit 						: '20';
	$cat 				= (!empty($category))				? explode(',',$category) 		: '';	
	$template 			= ($template && (array_key_exists(trim($template), $shortcode_templates))) ? trim($template) 	: 'template-1';
	$postAuthor 		= ($post_author == 'false')			? 'false'						: 'true';
	$pagination 		= ($pagination == 'false')			? 'false'						: 'true';
	$postDate 			= ( $post_date == 'false' ) 		? 'false'						: 'true';
	$postCategory 		= ( $post_category == 'false' )		? 'false' 						: 'true';
	$postContent 		= ( $post_content == 'false' ) 		? 'false' 						: 'true';
	$words_limit 		= !empty( $post_words_limit ) 	    ? $post_words_limit 			: 20;	
	$postreadmore 		= ( $post_read_more == 'false' )	? 'false' 						: 'true';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 			= !empty($orderby)					? $orderby 						: 'date';	
	$post_tags 			= ( $post_tags == 'false' ) 		? 'false'						: 'true';
	$post_comments 		= ( $post_comments == 'false' ) 	? 'false'						: 'true';
	
	// Shortcode file
	$post_template_file_path 	= WPBD_DIR . '/view/wpbd-cell-box/' . $template . '.php';
	$template_file 			= (file_exists($post_template_file_path)) ? $post_template_file_path : '';
	
	// Taking some globals
	global $post, $paged;

	// Taking some variables
	$count 			= 0; 
	$grid_count 	= 0;

	// Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}
	
	// WP Query Parameters
	$args = array ( 
		'post_type'      		=> WPBD_POST_TYPE,
		'post_status' 			=> array('publish'),
		'order'          		=> $order,
		'orderby'        		=> $orderby, 
		'posts_per_page' 		=> $posts_per_page, 
		'paged'          		=> $paged,		
		'ignore_sticky_posts'	=> true,
	);

    // Category Parameter
	if($cat != "") {
		
		$args['tax_query'] = array(
								array( 
									'taxonomy' 			=> WPBD_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
									'include_children'	=> $include_cat_child,
								));

	} 
	
	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;
	ob_start();	
	// If post is there
	if ( $query->have_posts() ) { 
		?>
		<div class="wpbd-post-cell-outter <?php echo 'wpbd-'.$template; ?> wpbd-clear-all">			
			<?php
			while ( $query->have_posts() ) : $query->the_post();
				
				$count++;
				$cat_links 		= array();
				$css_class 		= '';
				$post_image 	= wpbd_get_post_featured_image( $post->ID, $post_image_size );
				$post_link 		= wpbd_get_post_link( $post->ID );
				$terms 			= get_the_terms( $post->ID, WPBD_CAT );
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1)  ? 'Reply' : 'Replies';
				
				if($terms) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( " ", $cat_links );				
	            
	            // Include shortcode html file
				if( $template_file ) {
					include( $template_file );
				}					
				$grid_count++;
			endwhile; ?>
		</div>
		<?php if($pagination == "true") { ?>
		<div class="wpbd-pagination wpbd-clear-all">
			<?php 				
				echo wpbd_post_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages ) );
			 ?>			
		</div>
		<?php }
	} // end of have_post()

	wp_reset_postdata(); // Reset WP Query
    $content .= ob_get_clean();
    return $content;
}
/**
 * Function for the `wpbd_row` shortcode
 * 
 * @package WP Post and Blog Designer
 * @since 1.0.0
 */
function wpbd_fetch_posts_row( $atts, $content = null ) {
    
    // Shortcode all Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',				
		'template' 				=> 'template-1',
		'show_author' 			=> 'true',
		'pagination' 			=> 'true',		
		'post_image_size' 		=> 'large',		
		'post_date' 			=> 'true',		
		'post_category' 		=> 'true',		
		'post_content' 			=> 'true',
		'post_tags'				=> 'true',
		'post_comments'			=> 'true',
		'post_words_limit' 	=> '20',
		'post_read_more' 		=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',		
		), $atts, 'wpbd_list'));
	
	$shortcode_templates 	= wpbd_post_template();	
	$posts_per_page 	= !empty($limit) 					? $limit 						: '20';
	$cat 				= (!empty($category))				? explode(',',$category) 		: '';	
	$template 			= ($template && (array_key_exists(trim($template), $shortcode_templates))) ? trim($template) 	: 'template-1';
	$PostAuthor 		= ($post_author == 'false')			? 'false'						: 'true';
	$pagination 		= ($pagination == 'false')			? 'false'						: 'true';	
	$post_image_size 		= (!empty($post_image_size))				? $post_image_size 	: 'large'; //thumbnail, medium, large, full	
	$PostDate 			= ( $post_date == 'false' ) 		? 'false'						: 'true';
	$PostCategory 		= ( $post_category == 'false' )		? 'false' 						: 'true';
	$PostContent 		= ( $post_content == 'false' ) 		? 'false' 						: 'true';
	$words_limit 		= !empty( $post_words_limit ) 	? $post_words_limit 			: 20;	
	$postreadmore 		= ( $post_read_more == 'false' )	? 'false' 						: 'true';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 			= !empty($orderby)					? $orderby 						: 'date';	
	$show_tags 			= ( $show_tags == 'false' ) 		? 'false'						: 'true';
	$Post_Comments 		= ( $show_comments == 'false' ) 	? 'false'						: 'true';
	
	// Design Template file
	$post_template_file_path 	= WPBD_DIR . '/view/wpbd-row/' . $template . '.php';
	$template_file 			= (file_exists($post_template_file_path)) ? $post_template_file_path : '';
	
	// Taking globals variable
	global $post, $paged;

	// Taking constant variables
	$count 			= 0; 
	$wpbdcount 		= 0;	
	

	// Post Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}
	
	// WP Post Query Parameters
	$args = array ( 
		'post_type'      		=> WPBD_POST_TYPE,
		'post_status' 			=> array('publish'),
		'order'          		=> $order,
		'orderby'        		=> $orderby, 
		'posts_per_page' 		=> $posts_per_page, 
		'paged'          		=> $paged,		
		'ignore_sticky_posts'	=> true,
	);
    // Category Parameter
	if($cat != "") {		
		$args['tax_query'] = array(
								array( 
									'taxonomy' 			=> WPBD_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,									
								));

	} 
	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;
	ob_start();	
	// If post is there
	if ( $query->have_posts() ) {  ?>		
		<div class="wpbd-row-main <?php echo 'wpbd-'.$template; ?> wpbd-clear-all">			
			<?php
			while ( $query->have_posts() ) : $query->the_post();				
				$count++;
				$cat_links 		= array();
				$css_class 		= '';
				$post_image 	= wpbd_get_post_featured_image( $post->ID, $post_image_size );
				$post_link 		= wpbd_get_post_link( $post->ID );
				$terms 			= get_the_terms( $post->ID, WPBD_CAT );
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1)  ? 'Reply' : 'Replies';				
				if($terms) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( " ", $cat_links );					            
	            // Include shortcode html file
				if( $template_file ) {
					include( $template_file );
				}
				$wpbdcount++;	
			endwhile; ?>
		</div>
		<?php if($pagination == "true") { ?>
		<div class="wpbd-post-pagination wpbd-clear-all">
			<?php 				
				echo wpbd_post_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages ) );
			?>				
		</div>
		<?php }
	} // end of have_post()
	wp_reset_postdata(); // Reset WP Query
    $content .= ob_get_clean();
    return $content;
}
/**
 * Function for the `wpbd_ticker` shortcode
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_fetch_post_ticker( $atts, $content = null ) {
	// ticker Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'ticker_title'			=> __('Latest Post', 'wp-post-and-blog-designer'),
		'template_color'		=> '#acacac',
		'title_color'	        => '#fff',
		'font_color'			=> '#000',
		'font_style'			=> 'normal',
		'ticker_direction'		=> 'slide-v',
		'autoplay'				=> 'true',
		'speed'					=> 3000,		
	), $atts, 'wpbd_ticker'));

	$limit				= (!empty($limit)) 		? $limit 					      : '20';
	$cat 				= (!empty($category))	? explode(',',$category) 	      : '';
    $order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 		      : 'DESC';
	$orderby 			= (!empty($orderby))				? $orderby		      : 'date';
	$ticker_title		= !empty($ticker_title)	? $ticker_title				      : '';
	$template_color		= !empty($template_color)		    ? $template_color	  : '#acacac';
	$title_color	= !empty($title_color)		        ? $title_color		  : '#fff';
	$font_color			= !empty($font_color)				? $font_color		  : '#acacac';
	$font_style			= !empty($font_style)				? $font_style		  : 'normal';	
	$ticker_effect		= !empty($ticker_direction)		    ? $ticker_direction	  : 'fade';
	$autoplay 			= ($autoplay == 'false')			? 'false'			  : 'true';
	$speed 				= !empty($speed)					? $speed			  : 3000;



	// Enqueue required script
	wp_enqueue_script( 'wpbd-ticker-js' );
	wp_enqueue_script( 'wpbd-custom-script' );
	// Taking some globals
	global $post;
	// Taking some default
	$fix	= wpbd_get_fix();
	// Ticker configuration
	$ticker_conf = compact('ticker_effect', 'autoplay', 'speed', 'font_style');
	// Post Query Parameter
	$args = array (
		'post_type'     	 	=> WPBD_POST_TYPE,
		'post_status'			=> array( 'publish' ),
		'order'          		=> $order,
		'orderby'        		=> $orderby,
		'posts_per_page' 		=> $limit,		
		'ignore_sticky_posts'	=> true,		
	);	
	// Post Category Parameter
	if( !empty($cat) ) {
		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> WPBD_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,									
							));
	} 
	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;
	ob_start();
	// If post is there
	if ( $query->have_posts() ) { ?>	
	<style type="text/css">
	#wpbd-ticker-<?php echo $fix; ?>{border-color:<?php echo $template_color ?>;}
	#wpbd-ticker-<?php echo $fix; ?> >.wpbd-ticker-title{background:<?php echo $template_color ?>;}
	#wpbd-ticker-<?php echo $fix; ?> >.wpbd-ticker-title>span{border-left-color:<?php echo $template_color ?>;}
	#wpbd-ticker-<?php echo $fix; ?> >ul>li>a:hover, #wpbd-ticker-<?php echo $fix; ?>>ul>li>a{color:<?php echo $font_color; ?>;}
	#wpbd-ticker-<?php echo $fix; ?> > .wpbd-ticker-title > .wpbd-ticker-title-cnt{color: <?php echo $title_color; ?>}
	</style>
	<div class="wpbd-ticker-wrp wpbd-clear-all" id="wpbd-ticker-<?php echo $fix; ?>">
		<div class="wpbd-ticker-title wpbd-ticker-title">
			<?php if($ticker_title) { ?>
			<div class="wpbd-ticker-title-cnt"><?php echo $ticker_title; ?></div>
			<?php } ?>
			<span></span>
		</div>
		<ul class="wpbd-ticker-cnt">
			<?php while ( $query->have_posts() ) : $query->the_post();
				$post_link = wpbd_get_post_link($post->ID);
			?>
			<li class="wpbd-ticker-ele"><a href="<?php echo esc_url( $post_link ); ?>" ><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
		<div class="wpbd-ticker-arrow <?php if($autoplay=="false"){echo "show-arrow";}?>">
			<span></span>
			<span></span>
		</div>
		<div class="wpbd-ticker-conf"><?php echo htmlspecialchars(json_encode($ticker_conf)); ?></div>
	</div>

<?php
	} // End of post have_post()

	wp_reset_postdata(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}
/**
 * Function for the `wpbd_masonry` shortcode
 * 
 * @package Wp post and Blog Designer
 * @since 1.0.0
 */
function wpbd_fetch_post_masonry( $atts, $content = null ) {		
		// Shortcode Parameters
		extract(shortcode_atts(array(
			"limit" 				=> '2',
			"category" 				=> '',			
			"template"	 			=> 'template-1',
			"grid" 					=> '2',
			"pagination" 			=> 'false',
			"post_date" 			=> 'true',
			"post_category"			=> 'true',
			"post_content" 			=> 'true',
			"post_read_more" 		=> 'true',
			"content_words_limit" 	=> '20',			
			'order'					=> 'DESC',
			'orderby'				=> 'date',			
			'effect'				=> 'effect-2',
			'load_more_text'		=> '',
			'post_author' 			=> 'true',
			'post_image_size' 	    => 'large',			
			'post_tags'				=> 'true',
			'post_comments'			=> 'true',	
		), $atts, 'wpbd_masonry'));
		$shortcode_templates 	= wpbd_post_template();
		$msonry_effects 	= wpbd_post_masonry_effects();	   
	    $posts_per_page		= (!empty($limit)) 		? $limit 			: '4';
	    $cat 				= (!empty($category))	? explode(',',$category) : '';		
		$template 			= ($template && (array_key_exists(trim($template), $shortcode_templates))) ? trim($template) 	: 'template-1';
		$pagination 		= ($pagination == 'true')			? 'true'		: 'false';
		$gridcol 			= (!empty($grid))					? $grid 		: '2';
		$showDate 			= ( $post_date == 'true' ) 			? 'true' 		: 'false';
		$showCategory 		= ( $post_category == 'true')		? 'true' 		: 'false';
		$showContent 		= ( $post_content == 'true' ) 		? 'true' 		: 'false';
	    $words_limit 		= !empty($content_words_limit) 		? $content_words_limit : '20';
		$showreadmore 		= ( $post_read_more == 'true' ) 	? 'true' 		: 'false';
		$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 		: 'DESC';
		$orderby 			= (!empty($orderby))				? $orderby		: 'date';		
		$load_more_text 	= !empty($load_more_text) 			? $load_more_text : 'Load More Posts'; 
		$effect 			= (!empty($effect) && array_key_exists(trim($effect), $msonry_effects))	? trim($effect) : 'effect-1';		
		$showAuthor 		= ($post_author == 'false')			? 'false'			: 'true';
		$post_image_size 		= (!empty($post_image_size))				? $post_image_size 	: 'large'; //thumbnail, medium, large, full		
		$show_tags 			= ( $post_tags == 'false' ) 			? 'false'						: 'true';
		$show_comments 		= ( $post_comments == 'false' ) 		? 'false'						: 'true';	
		$fix 			= wpbd_get_fix();
		// Shortcode file
		$template_file_path 	= WPBD_DIR . '/view/wpbd-masonry/' . $template . '.php';
		$template_file 		= (file_exists($template_file_path)) ? $template_file_path : '';
		// Shortcode Parameters
		$shortcode_atts = compact('posts_per_page', 'cat', 'template', 'pagination', 'gridcol', 'showDate', 'showCategory', 'showContent', 'words_limit', 'showreadmore', 'order', 'orderby', 'showAuthor','load_more_text', 'post_image_size', 'show_tags','show_comments');
		global $paged, $post, $wpbawm_in_shrtcode;
		if(is_home() || is_front_page()) {
			  $paged = get_query_var('page');
		} else {
			 $paged = get_query_var('paged');
		}
		// WP Query Parameters
	$args = array ( 
		'post_type'      		=> WPBD_POST_TYPE,
		'post_status' 			=> array('publish'),
		'order'          		=> $order,
		'orderby'        		=> $orderby, 
		'posts_per_page' 		=> $posts_per_page, 
		'paged'          		=> $paged,		
		'ignore_sticky_posts'	=> true,
	);
    // Post Category Parameter
	if($cat != "") {
		$args['tax_query'] = array(
								array( 
									'taxonomy' 			=> WPBD_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,									
								));
	} 
	// WP post Query
		$query 			= new WP_Query($args);
		$post_count 	= $query->post_count;
		$total_post 	= $query->found_posts;
		$count 			= 0;
		$grid_count		= 1;
		ob_start();	
		$grid = $gridcol;

if($grid == '2') {
	$grids = "6";
} else if($grid == '3') {
	$grids = "4";
}  else if($grid == '4') {
	$grids = "3";
}  else if($grid == '5') {
	$grids = "b5";	
} else if ($grid == '1') {
	$grids = "12";
} else {
	$grids = "12";
}
    // If Blog post is there
		if ( $query->have_posts() ) :
			// Enqueue required script
			wp_enqueue_script( 'wpbd-custom-script' );
			wp_enqueue_script('masonry', 'jquery');
			wp_enqueue_script('wpbd-custom-masonry-script');
		 ?>			
		<div class="wpbd-post-masonry-wrp wpbd-clear-all" id="wpbd-post-masonry-wrp-<?php echo $fix; ?>">
			<div class="wpbd-post-masonry wpbd-<?php echo $effect; ?> <?php echo 'wpbd-'.$template; ?> "
			 id="wpbd-post-masonry-<?php echo $fix; ?>">
	            <?php while ( $query->have_posts() ) : $query->the_post();	            		
	            	$count++;
	            	$cat_links 			= array();
	               	$terms 					= get_the_terms( $post->ID, WPBD_CAT );
					$post_link 				= wpbd_get_post_link( $post->ID );					
					$post_featured_image 	= wpbd_get_post_featured_image( $post->ID, $post_image_size );	                
					$tags 			        = get_the_tag_list(' ',', ');
					$comments 		        = get_comments_number( $post->ID );
					$reply			        = ($comments <= 1)  ? 'Reply' : 'Replies';
					if($terms) {
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
	                }
	                $cate_name = join( " ", $cat_links );
	              	
	              	if( $template_file ) {
	              		include( $template_file );
	              	}					
					$grid_count++;
	            	endwhile;				
	           	?>
			</div><!-- end .wpbd-blog-masonry -->			
			<?php if( ($posts_per_page != -1) && ($posts_per_page < $total_post) && ($pagination != 'true') ) { ?>
			<div class="wpbd-ajax-btn-wrap">
				<button class="wpbd-load-more-btn more" data-ajax="1" data-paged="1" data-count="<?php echo $count; ?>">
					<i class="wpbd-ajax-loader"><img src="<?php echo WPBD_URL . 'assets/images/ajax-loader.gif'; ?>" alt="<?php _e('Loading', 'wp-post-and-blog-templateer'); ?>" /></i> 
					<?php echo $load_more_text;?>
				</button>
				<div class="wpbd-hide wpbd-shortcode-param"><?php echo wpbd_esc_attr( json_encode($shortcode_atts)); ?></div>
			</div><!-- end .wpbd-ajax-btn-wrap -->
			<?php } ?>

			<?php if($pagination == "true") { ?>
				<div class="wpbd-post-pagination wpbd-clear-all">
				<?php 				
					echo wpbd_post_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages ) );
				 ?>				
			</div>
			<?php } ?>
		</div><!-- end .wpbd-blog-masonry -->
	<?php			
		endif;
		wp_reset_postdata(); // Reset wp post query
		$content .= ob_get_clean();
		return $content;
	}
/**
 * Function to handle the 'wpbd_post_filter' shortcode
 * 
 * @package Recent Post Slider with Widget Pro
 * @since 1.0.0
 */
function get_wpbd_filter_shortcode( $atts, $content ) {
        // Shortcode Parameters
extract(shortcode_atts(array(                
        'cat_id'                            => array(), 
        'include_cat_child'                 => 'true',                
        'order'                             => 'DESC',
        'orderby'                           => 'date',
        'grid'                              => '3',             
        'post_image_size'                   => 'large', 
        'post_date'                         => 'true', 
        'post_category'                     => 'true',
        'post_author'                       => 'true',
        'image_height'                      => '', 
        'template'                          => 'template-1',              
        'post_words_limit'               => '20', 
        'post_read_more'                    => 'true', 
        'content_tail'                      => '...', 
        'cat_limit'                         => 0, 
        'cat_order'                         => 'asc', 
        'image_fit'                         => 'true',              
        'cat_orderby'                       => 'name', 
        'exclude_cat'                       => array(), 
        'post_comments'                     => 'true',
        'post_content'                      => 'true',
        'post_tags'                         => 'true',
        'all_filter_text'                   => '',// filter
        ), $atts, 'wpbd_post_filter'));
$shortcode_templates        = wpbd_post_template();
$unique                     = wpbd_get_fix();
$limit                      = !empty($limit) ? $limit  : '15';
$order                      = ( strtolower($order) == 'asc' )     ? 'ASC'   : 'DESC';
$orderby                    = !empty($orderby)                    ? $orderby     : 'date';
$gridcol                    = !empty($grid)                       ? $grid        : '3';
$template                   = array_key_exists( trim($template)  , $shortcode_templates ) ? $template : 'template-1';        
$cat_id                     = (!empty($cat_id))                   ? explode(',',$cat_id)                         : '';
$include_cat_child          = ( $include_cat_child == 'false' )   ? false  : true;        
$words_limit                = !empty( $post_words_limit )      ? $post_words_limit  : 20;
$content_tail               = html_entity_decode($content_tail);
$show_read_more             = ( $post_read_more == 'false' )      ? false    : true;        
$showAuthor                 = ($post_author == 'false')           ? 'false'   : 'true';
$post_image_size            = (!empty($post_image_size))          ? $post_image_size  : 'large'; //thumbnail, medium, large, full        
$showDate                   = ( $post_date == 'false' )           ? 'false'                                                : 'true';
$showCategory               = ( $post_category == 'false' )       ? 'false'                                                 : 'true';
$image_height               = (!empty($image_height))             ? $image_height                 : '';
$height_css                 = ($image_height)                     ? 'height:'.$image_height.'px;' : '';
$cat_limit                  = !empty($cat_limit)                  ? $cat_limit                                 : 0;
$cat_order                  = ( strtolower($cat_order) == 'asc' ) ? 'ASC'  : 'DESC';
$cat_orderby                = !empty($cat_orderby)                ? $cat_orderby  : 'name';
$exclude_cat                = !empty($exclude_cat)                ? explode(',', $exclude_cat)         : array();
$image_fit                  = ($image_fit == 'false')             ? 0 : 1;
$show_comments              = ( $post_comments == 'false' )       ? 'false'  : 'true';
$showContent                = ( $post_content == 'false' )        ? 'false'  : 'true';
$showContent                = ( $post_content == 'false' )        ? 'false'  : 'true';
$Post_tags                  = ( $post_tags == 'false')            ? 'false'  : 'true';
$all_filter_text            = !empty($all_filter_text) ? $all_filter_text : __('All', 'recent-post-slider-widget');
// Shortcode file        
$template_file_path         = WPBD_DIR . '/view/wpbd-filter/' . $template . '.php';
$template_file                 = (file_exists($template_file_path)) ? $template_file_path : '';
wp_enqueue_script( 'wpoh-filter-js');
wp_enqueue_script( 'wpbd-custom-script');
// Taking some globals
global $post;
$image_fit_class        = ($image_fit)         ? 'wpbd-image-fit' : ''; 
// Getting Terms
$wpbdterms = get_terms( array(
                'taxonomy'           => WPBD_CAT,
                'hide_empty'         => true,
                'fields'             => 'id=>name',
                'number'             => $cat_limit,
                'order'              => $cat_order,
                'orderby'            => $cat_orderby,
                'include'            => $cat_id,
                'exclude'            => $exclude_cat,
));
ob_start();
// If category is there
if( !is_wp_error($wpbdterms) && !empty($wpbdterms) ) {
// Getting ids 
$logo_cats = array_keys( $wpbdterms);
// WP Query Parameters
$query_args = array(
'post_type'                         => WPBD_POST_TYPE,
'post_status'                         => array( 'publish' ),
'posts_per_page'                => -1,
'order'                          => $order,
'orderby'                        => $orderby,
'ignore_sticky_posts'        => true,
);
// Category Parameter
if( !empty($logo_cats) ) {
$query_args['tax_query'] = array( array( 'taxonomy' => WPBD_CAT,
                         'field'    => 'term_id',
                         'terms'    => $logo_cats,
                         'include_children' => $include_cat_child,
                        ));
}
// WP Query
$post_query = new WP_Query($query_args);
$post_count = $post_query->post_count;
$count      = 0;
$grid_count                = 1;                
if( $post_query->have_posts() ) { ?>
<div class="rpsw-filter-otter-wrp">
<ul class="wpbd-filter-list">
<li class="wpbd-filtr-cat-list wpbd-active-filtr-cat" data-filter="all"><a href="javascript:void(0);"><?php echo $all_filter_text; ?></a></li>
<?php foreach ($wpbdterms as $term_id => $term_name) { ?>
<li class="wpbd-filtr-cat-list" data-filter="<?php echo $term_id; ?>"><a href="javascript:void(0);"><?php echo $term_name; ?></a></li>
<?php } ?>
</ul>
<div class="wpbd-filtr-outter" id="rpsw-post-filtr-<?php echo $unique; ?>">
<div class="rpsw-post-grid-main rpsw-post-filter <?php echo 'rpsw-'.$template.' '.$image_fit_class; ?> has-no-animation rpsw-clearfix">
<?php while ($post_query->have_posts()) : $post_query->the_post();
$count++;        
$feat_image                 = wpbd_get_post_featured_image( $post->ID, $post_image_size, true );
$post_link                  = wpbd_get_post_link( $post->ID );        
$postcats                   = get_the_terms($post->ID, WPBD_CAT);
$css_class                  = '';
$usedcat                    = array();
$cat_links                  = array();
$comments                   = get_comments_number( $post->ID );
$reply                      = ($comments <= 1)  ? 'Reply' : 'Replies';
if($postcats) {
foreach ( $postcats as $term ) {
        $term_link = get_term_link( $term );
        $cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
}
}
$cate_name = join( " ", $cat_links );
if( !is_wp_error($postcats) && !empty($postcats) ) {
        foreach ($postcats as $postcat) {
                $usedcat[] = $postcat->term_id;
        }
}
$data_category = !empty($usedcat) ? implode(', ',$usedcat) : '1';
if ( is_numeric( $grid ) ) {                                        
                        if($grid == 1){
                                $cell = 12;
                        }
                        else if($grid == 2){
                                $cell = 6;
                        }
                        else if($grid == 3){
                                $cell = 4;        
                        }
                        else if($grid == 4){
                                $cell = 3;
                        }
                        else if($grid == 5){
                                $cell = 'b5';
                        }
                         else{
        $cell = $grid;
    }
    $class = 'wpbd-medium-'.$cell.' wpbd-cell';
    }
                if( $grid_count == 1 ){
                        $css_class = 'wpbd-first';
                } elseif ( $grid_count == $grid ) {
                        $grid_count = 0;
                        $css_class = 'wpbd-last';
                }         
?>
<div class="<?php echo $class; ?> <?php echo $css_class; ?> filtr-item" data-category="<?php echo $data_category; ?>">
<?php     // Include shortcode html file
                if( $template_file ) {
                   include( $template_file );
                }
                $grid_count++;        
?>
</div>
<?php endwhile; ?>
</div>
</div>
</div>
<?php
} // End of have post
wp_reset_postdata(); // reset wp query
$content .= ob_get_clean();
return $content;
} // End of category check
}
}//add shortcode class
$wtpsw_shortcode = new Wpbd_Shortcode();