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


//============= Others Functions =====================================//

	function set_wp_poll_page($content = NULL) 
	{
		$wp_poll_page =  get_option( 'wp_poll_page' );
		if ( get_the_title() == $wp_poll_page)
		{
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