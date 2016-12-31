<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/


if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	if( empty( $poll_id ) ) $poll_id = get_the_ID();
	
	$poll_meta_options 	= get_post_meta( $poll_id, 'poll_meta_options', true );
	$poll_meta_multiple	= get_post_meta( $poll_id, 'poll_meta_multiple', true );
		
	if( $poll_meta_multiple == 'yes' ) $input_type_style = 'checkbox';
	else $input_type_style = 'radio';
	
	$wpp_status = isset( $GLOBALS['wpp_status'] ) ? $GLOBALS['wpp_status'] : '';
	if( $wpp_status == 'closed' ) $disabled = 'disabled';
	else $disabled = '';
	
	
	echo "<ul class='wpp_option_list'>";
	foreach( $poll_meta_options as $option_id => $option_value ) {
		
		if( empty( $option_value ) ) continue;
		
		echo "
		<li class='wpp_option_single' option_id='$option_id'>
			<input type='$input_type_style' $disabled value='$option_id' name='submit_poll_option' class='submit_poll_option' id='$option_id' />
			<label for='$option_id' class='option_title'>$option_value</span>
		</li>";
	}
	echo "</ul>";
	