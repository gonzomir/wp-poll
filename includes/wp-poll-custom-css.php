<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	$custom_css = '';
	
	$lighter_color = fn_get_color($wp_poll_header_bg_color,2,80);
	
	$custom_css .= '
	<style>
		.pb-settings ul.tab-nav li {
			background: -webkit-linear-gradient('.$lighter_color.', '.$wp_poll_header_bg_color.');
			background: -o-linear-gradient('.$lighter_color.', '.$wp_poll_header_bg_color.');
			background: -moz-linear-gradient('.$lighter_color.', '.$wp_poll_header_bg_color.');
			background: linear-gradient('.$lighter_color.', '.$wp_poll_header_bg_color.');
			color:'.$wp_poll_header_font_color.';
		}
		.pb-settings ul.tab-nav li.active{
			background: -webkit-linear-gradient('.$wp_poll_header_bg_color.', '.$lighter_color.');
			background: -o-linear-gradient('.$wp_poll_header_bg_color.', '.$lighter_color.');
			background: -moz-linear-gradient('.$wp_poll_header_bg_color.', '.$lighter_color.');
			background: linear-gradient('.$wp_poll_header_bg_color.', '.$lighter_color.');
		}
		
		.pb-settings ul.tab-nav li.active:after {
			border-top-color: '.$lighter_color.';
		}
	
	</style>
	';
	
	$html .= $custom_css;
			
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

	