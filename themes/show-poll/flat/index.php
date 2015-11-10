<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

	$wp_poll_show_featured =  get_option( 'wp_poll_show_featured' );
	
	if ( $wp_poll_show_featured == 'yes' ):
	
		$html.= '<div class="pb-settings">';
		$html.= '
		<ul class="tab-nav">
			<li nav="1" class="nav1 active">'.__('Today Poll','wp_poll').'</li>
			<li nav="2" class="nav2"  style="float:right;">'.__('Featured','wp_poll').'</li>
		</ul>
		
		<ul class="box">';
		
		$html .='<li style="display: block;" class="box1 tab-box active">';
		require 'reqire_only_poll.php';
		$html.= '</li>';

		$html .='<li style="display: none;" class="box2 tab-box active">';
		require 'require_featured_poll.php';
		$html.= '</li>';
		$html.= '</ul></div>';	
	else:
		require 'reqire_only_poll.php';
	endif;
	
	
	
	function fn_get_link($name)
	{
		$pages = get_pages( );
		foreach($pages as $page)
		{
			if ( $page->post_title == $name)
				//$array_pages[$page->post_title] = $page->post_title;
				return $page->post_status;
		}
	}
