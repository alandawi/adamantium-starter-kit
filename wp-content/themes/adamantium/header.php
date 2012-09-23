<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!-- META TAGS -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="your, keywords, here" />
<meta name="author" content="Alan Gabriel Dawidowicz">

<!-- TITLE -->   
<title><?php if ( is_category() ) {
		echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
	} elseif ( is_tag() ) {
		echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
	} elseif ( is_archive() ) {
		wp_title(''); echo ' Archive | '; bloginfo( 'name' );
	} elseif ( is_search() ) {
		echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
	} elseif ( is_home() ) {
		bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
	} elseif ( is_front_page() ) {
		bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
	}  elseif ( is_404() ) {
		echo 'Error 404 Not Found | '; bloginfo( 'name' );
	} elseif ( is_single() ) {
		wp_title('');
	} else {
		echo wp_title(''); echo ' | '; bloginfo( 'name' );
	} ?></title>

<!-- LINK TAGS -->  
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />  
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS2 Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_enqueue_script("jquery"); /* Loads jQuery if it hasn't been loaded already */ ?>

<?php wp_head(); /* this is used by many Wordpress features and plugins to work proporly */ ?>
</head>

<body <?php body_class(); ?>>
	
	<!-- Example of Primary Menu:
	<div id="primary-menu">
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'fallback_cb' => 'fallback_no_menu' ) ); ?>
	</div> -->