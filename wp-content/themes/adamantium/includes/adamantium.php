<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */

	// Post Thumbnail Support
	add_theme_support( 'post-thumbnails' );
	/* 
		To add support for other post types you must use an array:
		add_theme_support('post-thumbnails', array('post', 'page', 'CUSTOM_POST_TYPE'));

		To make a custom thumbnail:
		add_image_size('special-thumbnail', 200, 160, true);

		Example:
		<?php the_post_thumbnail( 'special-thumbnail' ); ?>
	*/


	/******************************
	| GENERAL
	******************************/

	// Remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
	function adamantium_filter_ptags_on_images($content){
	   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
	add_filter('the_content', 'adamantium_filter_ptags_on_images');



	// This removes the annoying […] to a Read More link
	function adamantium_excerpt_more($more) {
		global $post;
		return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
	}
	add_filter('excerpt_more', 'adamantium_excerpt_more');	
	


	// Custom Login Logo
	function adamantium_custom_login_logo() {
	    echo '<style type="text/css">
	        h1 a { background-image:url('.get_bloginfo('template_directory').'/img/custom-login-logo.png) !important; }
	    </style>';
	}
	add_action('login_head', 'adamantium_custom_login_logo');



	// Remove margin-top automatically generated
	function adamantium_admin_bar(){ return false; }
	add_filter( 'show_admin_bar' , 'adamantium_admin_bar');



	// Exclude pages from search results
	function adamantium_SearchFilter($query) {
		if ($query->is_search) {
				$query->set('post_type', 'post');
			}
		return $query;
	}
	add_filter('pre_get_posts','adamantium_SearchFilter');




	/******************************
	| SECURITY
	******************************/

	// removes the WordPress version from your header for security
    function adamantium_remove_version() {
        return '<!--built on the Adamantium Starter Kit -->';
    }
    add_filter('the_generator', 'adamantium_remove_version');



    // Remove admin name in comments class
	function adamantium_remove_comment_author_class( $classes ) {
	    foreach( $classes as $key => $class ) {
	        if(strstr($class, "comment-author-")) {
	            unset( $classes[$key] );
	        }
	    }
	    return $classes;
	}
	add_filter( 'comment_class' , 'adamantium_remove_comment_author_class' );



	// Hide login errors
	add_filter('login_errors', create_function('$a', "return null;"));



	// Removes the WordPress version from your header for security
	remove_action('wp_head', 'wp_generator');



	// Removes the WordPress version from your RSS for security
	function adamantium_remove_feed_generator() {
		return '';
	}
	add_filter('the_generator', 'adamantium_remove_feed_generator');



	// Do not allow users access to the administrator for subscribers
	function adamantium_restrict_access_admin_panel(){
	  global $current_user;
	  get_currentuserinfo();
	  if ($current_user->user_level <  4) {
	    wp_redirect( get_bloginfo('url') );
	    exit;
	  }
	}
	add_action('admin_init', 'adamantium_restrict_access_admin_panel', 1);



	// Remove injected CSS from recent comments widget
	function adamantium_remove_recent_comments_style() {
	  global $wp_widget_factory;
	  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
	    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	  }
	}
	add_action('wp_head', 'adamantium_remove_recent_comments_style', 1);



	// Remove injected CSS from gallery
	function adamantium_gallery_style($css) {
	  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
	}
	add_filter('gallery_style', 'adamantium_gallery_style');



	/******************************
	| CUSTOM FUNCTIONS
	******************************/

	// Add to know the ID column of entries
	function adamantium_posts_columns_id($defaults){
	    $defaults['wps_post_id'] = __('ID');
	    return $defaults;
	}
	function adamantium_posts_custom_id_columns($column_name, $id){
	  if($column_name === 'wps_post_id'){
	          echo $id;
	    }
	}
	add_filter('manage_posts_columns', 'adamantium_posts_columns_id', 5);
	add_action('manage_posts_custom_column', 'adamantium_posts_custom_id_columns', 5, 2);
	add_filter('manage_pages_columns', 'adamantium_posts_columns_id', 5);
	add_action('manage_pages_custom_column', 'adamantium_posts_custom_id_columns', 5, 2);



	// Add a column to display the Featured Post Thumbnail
	add_image_size( 'admin-list-thumb', 150, 150, false );
	add_filter('manage_posts_columns', 'adamantium_add_post_thumbnail_column', 5);
	add_filter('manage_pages_columns', 'adamantium_add_post_thumbnail_column', 5);

	function adamantium_add_post_thumbnail_column($cols){
	  $cols['adamantium_post_thumb'] = __('Featured Image');
	  return $cols;
	}
	add_action('manage_posts_custom_column', 'adamantium_display_post_thumbnail_column', 5, 2);
	add_action('manage_pages_custom_column', 'adamantium_display_post_thumbnail_column', 5, 2);

	function adamantium_display_post_thumbnail_column($col, $id){
	  switch($col){
	    case 'adamantium_post_thumb':
	      if( function_exists('the_post_thumbnail') )
	        echo the_post_thumbnail( 'admin-list-thumb' );
	      else
	        echo 'Not supported in theme';
	      break;
	  }
	}



	// Adamantium Page Navigation
	function adamantium_page_navi($before = '', $after = '') {
		global $wpdb, $wp_query;
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
		if ( $numposts <= $posts_per_page ) { return; }
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = 7;
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		echo $before.'<div class="page-navigation"><ol class="adamantium_page_navi clearfix">'."";
		if ($start_page >= 2 && $pages_to_show < $max_page) {
			$first_page_text = "First";
			echo '<li class="apn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
		}
		echo '<li class="apn-prev-link">';
		previous_posts_link('<<');
		echo '</li>';
		for($i = $start_page; $i  <= $end_page; $i++) {
			if($i == $paged) {
				echo '<li class="apn-current">'.$i.'</li>';
			} else {
				echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
			}
		}
		echo '<li class="apn-next-link">';
		next_posts_link('>>');
		echo '</li>';
		if ($end_page < $max_page) {
			$last_page_text = "Last";
			echo '<li class="apn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
		}
		echo '</ol></div>'.$after."";
	}
?>