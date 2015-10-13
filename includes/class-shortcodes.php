<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_wp_poll_shortcodes{
	
    public function __construct()
	{
		add_shortcode( wp_poll_short_code, array( $this, 'wp_poll_display_for_today' ) );		
		add_shortcode( 'wp_poll_list', array( $this, 'wp_poll_list_display' ) );	
		
		add_filter( 'widget_text', 'do_shortcode', 11);
	}

	
	public function wp_poll_display_for_today($atts, $content = null ) 
	{
			$atts = shortcode_atts(
				array(
					'themes' => 'flat',
					), $atts);
	
			$html = '';
			$themes = $atts['themes'];
					
			$class_wp_poll_functions = new class_wp_poll_functions();
			$wp_poll_themes_dir = $class_wp_poll_functions->wp_poll_themes_dir();
			$wp_poll_themes_url = $class_wp_poll_functions->wp_poll_themes_url();

			echo '<link  type="text/css" media="all" rel="stylesheet"  href="'.$wp_poll_themes_url[$themes].'/style.css" >';				

			require_once( plugin_dir_path( __FILE__ ) . 'wp-poll-variables.php');			
			
			include $wp_poll_themes_dir[$themes].'/index.php';				
			return $html;
	}
	
	public function wp_poll_list_display($atts, $content = null ) 
	{
			$atts = shortcode_atts(
				array(
					'themes' => 'flat',
					), $atts);
	
			$html = '';
			$themes = $atts['themes'];
					
			$class_wp_poll_functions = new class_wp_poll_functions();
			$wp_poll_list_themes_dir = $class_wp_poll_functions->wp_poll_list_themes_dir();
			$wp_poll_list_themes_url = $class_wp_poll_functions->wp_poll_list_themes_url();

			echo '<link  type="text/css" media="all" rel="stylesheet"  href="'.$wp_poll_list_themes_url[$themes].'/style.css" >';				

			include $wp_poll_list_themes_dir[$themes].'/index.php';				
			return $html;
	}
	
} new class_wp_poll_shortcodes();