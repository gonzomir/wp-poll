<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/


if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	if( empty( $poll_id ) ) $poll_id = get_the_ID();
	
	$wpp_status = isset( $GLOBALS['wpp_status'] ) ? $GLOBALS['wpp_status'] : '';
	if( $wpp_status == 'closed' ) $disabled = 'disabled';
	else $disabled = '';
	
	
	echo "<div class='button wpp_submit' wpp_status='$disabled' poll_id=".$poll_id.">".__('Submit', WPP_TEXT_DOMAIN)."</div>";
	echo "<div class='button wpp_result' poll_id=".$poll_id.">".__('Results', WPP_TEXT_DOMAIN)."</div>";
	