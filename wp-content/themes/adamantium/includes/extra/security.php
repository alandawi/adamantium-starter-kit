<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */

	/*
		Any option you want to add for security will stay in this place
	*/

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
?>