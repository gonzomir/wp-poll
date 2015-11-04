<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

class class_wp_poll_settings{

	public function __construct(){
		
		add_action('admin_menu', array( $this, 'wp_poll_menu_init' ));
		
	}

	public function wp_poll_menu_settings(){
		include('menu/settings.php');	
	}
	
	public function wp_poll_menu_analytics(){	
		include('menu/analytics.php');	
	}

	public function wp_poll_menu_init() {
		add_submenu_page('edit.php?post_type=wp_poll', __('Analytics','wp_poll'), __('Analytics','wp_poll'), 'manage_options', 'wp_poll_analytics', array( $this, 'wp_poll_menu_analytics' ));	
		add_submenu_page('edit.php?post_type=wp_poll', __('Settings','wp_poll'), __('Settings','wp_poll'), 'manage_options', 'wp_poll_menu_settings', array( $this, 'wp_poll_menu_settings' ));	
	}
}
	
new class_wp_poll_settings();