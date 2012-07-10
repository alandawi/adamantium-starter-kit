<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */

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
    $cols['adamantium_post_thumb'] = __('Imagen Destacada');
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
?>