<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	
	function wp_poll_ajax_onclick_submit()
	{
		$html = array();
	
		require_once( plugin_dir_path( __FILE__ ) . '/require-wp-poll-onclick-submit.php');

		echo json_encode($html);
		die();
	}
	add_action('wp_ajax_wp_poll_ajax_onclick_submit', 'wp_poll_ajax_onclick_submit');
	add_action('wp_ajax_nopriv_wp_poll_ajax_onclick_submit', 'wp_poll_ajax_onclick_submit');
	
	function wp_poll_ajax_reset_settings()
	{
		//$is_success = 0;
		
		
		$is_success = delete_option( 'wp_poll_plugin_options' );
		
		echo $is_success;
		die();
	}
	add_action('wp_ajax_wp_poll_ajax_reset_settings', 'wp_poll_ajax_reset_settings');
	add_action('wp_ajax_nopriv_wp_poll_ajax_reset_settings', 'wp_poll_ajax_reset_settings');
	
	

//============= Others Functions =====================================//

	function set_wp_poll_page($content = NULL) 
	{
		$wp_poll_page =  get_option( 'wp_poll_page' );
		$wp_poll_show_page_content =  get_option( 'wp_poll_show_page_content' );
		
		if ( get_the_title() == $wp_poll_page)
		{
			if ( $wp_poll_show_page_content == 'no' ) 
				return '<style>.entry-title {display:none;}</style>'.'['.wp_poll_list_short_code.']';
			$content .= '<style>.entry-title {display:none;}</style>';
			return $content. '['.wp_poll_list_short_code.']';
		}	
		else return $content;
		
	}
	add_filter( 'the_content', 'set_wp_poll_page' );
	
	add_filter('pre_get_posts', 'filter_search');
	function filter_search($query) 
	{
		if ($query->is_search) 
			$query->set('post_type', array('post', 'wp_poll_book'));
		return $query;
	}
	
	
	function wp_poll_get_date()
		{
			$gmt_offset = get_option('gmt_offset');
			$wpls_datetime = date('Y-m-d', strtotime('+'.$gmt_offset.' hour'));
			
			return $wpls_datetime;
		}
		
	function fn_get_color($color, $action, $dif=20){ 
  
		$color = str_replace('#', '', $color); 
		if (strlen($color) != 6){ return '000000'; } 
		$rgb = ''; 
		
		if ( $action == 1 ):
			for ($x=0;$x<3;$x++){
				$c = hexdec(substr($color,(2*$x),2)) - $dif; 
				$c = ($c < 0) ? 0 : dechex($c); 
				$rgb .= (strlen($c) < 2) ? '0'.$c : $c; 
			} 
		elseif ($action == 2 ):
			for ($x=0;$x<3;$x++){
				$c = hexdec(substr($color,(2*$x),2)) + $dif; 
				$c = ($c > 255) ? 'ff' : dechex($c);  
				$rgb .= (strlen($c) < 2) ? '0'.$c : $c;  
			}
		endif;
		
		return '#'.$rgb; 
	}