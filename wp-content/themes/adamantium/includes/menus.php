<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */
 
	/*
		Any menu will stay in this place
	*/

	add_theme_support( 'menus' );
		if ( function_exists( 'register_nav_menus' ) ) {
		  	register_nav_menus(
		  		array(
		  		  'header-menu' => 'Header Menu',
		  		  'sidebar-menu' => 'Sidebar Menu',
		  		  'footer-menu' => 'Footer Menu',
		  		  'special-menu' => 'Special Menu'
		  		)
		  	);
		}
?>