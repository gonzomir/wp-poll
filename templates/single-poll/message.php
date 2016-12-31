<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/


if ( ! defined('ABSPATH')) exit;  // if direct access 

	if( empty( $poll_id ) ) $poll_id = get_the_ID();
	$poll_deadline = get_post_meta( $poll_id, 'poll_deadline', true );
	
	if( empty( $poll_deadline ) ) return;
	
	
	// echo '<pre>'; print_r( $GLOBALS['wpp_status'] ); echo '</pre>';
	
	
	$current_time 	= current_time('timestamp');
	$poll_time 		= strtotime( $poll_deadline . " +1 day" );
	
	
	
	if( $current_time > $poll_time ):
		
		$time_ago = human_time_diff( $poll_time, $current_time ); 
		
		echo
		sprintf(
			'<p class="wpp_message wpp_poll_closed">%s</p>',
			apply_filters(
				'wpp_filter_message_poll_closed_html', 
				"<i class='fa fa-envelope'></i> Sorry, This poll is completed on <b><i>$poll_deadline</i></b> - 
				about <b><i>$time_ago</i></b> ago" 
			)
		);
		
		$GLOBALS['wpp_status'] = 'closed';
	else:
		
		$time_remaining = human_time_diff( $poll_time, $current_time ); 
		
		echo
		sprintf(
			'<p class="wpp_message">%s</p>',
			apply_filters(
				'wpp_filter_message_poll_open_html', 
				"<i class='fa fa-envelope'></i> This poll is open till <b><i>$poll_deadline</i></b> - 
				only <b><i>$time_remaining</i></b> remaining" 
			)
		);
		$GLOBALS['wpp_status'] = 'open';
	endif;

	
	