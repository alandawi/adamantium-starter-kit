<?php
/**
 * @package WordPress
 * @subpackage Adamantium - Starter Kit
 * @author Alan Gabriel Dawidowicz - www.alandawi.com.ar
 */
 
/*
	Any option you want to add the extra panel will go here
*/

	// Maintenance Mode
	if ( of_get_option("maintenance_mode") == true) {
		function adamantium_maintenance_mode() {
			$site_title = get_bloginfo('name');
			$message_maintenance_mode = "We are performing maintenance"; // Enter the desired message!

		    if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
		        wp_die('<center><h1>'.$site_title.'</h1><p>'.$message_maintenance_mode.'</p></center>');
		    }
		}
		add_action('get_header', 'adamantium_maintenance_mode');
	}
?>