<?php 
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */

	/*
		Any Shortcode will stay in this place
	*/


	// Enable Shortcodes in excerpts and widgets
	add_filter('widget_text', 'do_shortcode');
	add_filter('the_excerpt', 'do_shortcode');
	add_filter('get_the_excerpt', 'do_shortcode');



	// Highlight
	// How to: [highlight color="red"]Lorem Ipsum is simply dummy text.[/highlight]
	function adamantium_highlight_shortcode( $atts, $content = null ) {
		extract( shortcode_atts(
		array(
	      'color' => 'yellow',
	      'color' => 'red',
	      'color' => 'green',
	      'color' => 'blue',
	      ),
		  $atts ) );
	      return '<span class="text-highlight highlight-' . $color . '">' . $content . '</span>';
	}
	add_shortcode('highlight', 'adamantium_highlight_shortcode');



	// Box
	// How to: [box color="red"]Lorem Ipsum is simply dummy text of the printing and typesetting industry.[/box]
	function adamantium_box_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
	      'color' => 'orange',
	      'size' => 'normal',
	      'type' => '',
		  'align' => 'default',
	      ), $atts ) );
	      return '<div class="box-shortcode box-' . $color . '">' . $content . '</div>';
	}
	add_shortcode('box', 'adamantium_box_shortcode');



	// YouTube
	// How to: [youtube video="HiB7Be0wNsg" width="300" height="150" /]
	function adamantium_youtube_shortcode($atts, $content = null) {
	   extract(shortcode_atts(array(
				'video'  => '',
				'width'  => '540',
				'height' => '400'
				), $atts));

			return '<div class="youtube_video"><object type="application/x-shockwave-flash" style="width:'.$width.'px; height:'.$height.'px;" data="http://www.youtube.com/v/'.$video.'&amp;hl=en_US&amp;fs=1&amp;"><param name="movie" value="http://www.youtube.com/v/'.$video.'&amp;hl=en_US&amp;fs=1&amp;" /></object></div>';
	}
	add_shortcode('youtube', 'adamantium_youtube_shortcode');
?>