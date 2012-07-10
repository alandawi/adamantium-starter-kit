<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */

	/*
		If you do not know what you do, DO NOT EDIT THIS FILE
	*/


	// THEME OPTIONS
	/* How it works: http://wptheming.com/options-framework-plugin/ */
	/* If you are not using Theme Options can comment this lines */
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/' );
		require_once dirname( __FILE__ ) . '/admin/options-framework.php';
	}



	// ADAMANTIUM CORE
	require (TEMPLATEPATH . '/includes/adamantium.php');



	// EXTRA OPTIONS FROM THEME OPTIONS
	require (TEMPLATEPATH . '/includes/extra-options-theme.php');
	


	// CUSTOM POST TYPES
	/* If you are not using Custom Post Types can comment this line */
	require (TEMPLATEPATH . '/includes/custom-post-types.php'); 



	// SHORTCODES
	/* If you are not using Shortcodes can comment this line */
	require (TEMPLATEPATH . '/includes/shortcodes/shortcodes.php'); 



	// WIDGETS
	/* If you are not using Widgets can comment this line */
	require (TEMPLATEPATH . '/includes/widgets.php');



	// MENUS
	/* If you are not using Menus can comment this line */
	require (TEMPLATEPATH . '/includes/menus.php');



	// EXTRA
	/* All that considered as an extra or utility that is external to WordPress and not default, you should put in the "Extra" Folder */
	require (TEMPLATEPATH . '/includes/extra/content-limit.php');
	require (TEMPLATEPATH . '/includes/extra/custom-columns.php');
	require (TEMPLATEPATH . '/includes/extra/wordpress-thumbnail-upload-metabox.php');
	require (TEMPLATEPATH . '/includes/extra/snippets.php');
	require (TEMPLATEPATH . '/includes/extra/security.php');



	// METABOXES
	/* How it works: http://www.farinspace.com/wpalchemy-metabox/ */
	/* If you are not using Metaboxes can comment this lines */
	require (TEMPLATEPATH . '/includes/metaboxes/setup.php');
	require (TEMPLATEPATH . '/includes/metaboxes/simple-spec.php');
	require (TEMPLATEPATH . '/includes/metaboxes/full-spec.php');
	require (TEMPLATEPATH . '/includes/metaboxes/checkbox-spec.php');
	require (TEMPLATEPATH . '/includes/metaboxes/radio-spec.php');
	require (TEMPLATEPATH . '/includes/metaboxes/select-spec.php');


/***************************************************************************************/

/*
	If you want to add new things, do it from here to keep order
*/

	
?>