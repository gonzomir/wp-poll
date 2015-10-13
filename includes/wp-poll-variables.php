<?php
/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$wp_poll_header_font_color = get_option( 'wp_poll_header_font_color' );
	$wp_poll_header_bg_color = get_option( 'wp_poll_header_bg_color' );
	$wp_poll_header_font_size = get_option( 'wp_poll_header_font_size' );
	$wp_poll_header_font_weight = get_option( 'wp_poll_header_font_weight' );
	$wp_poll_header_font_style = get_option( 'wp_poll_header_font_style' );

	$wp_poll_content_font_color = get_option( 'wp_poll_content_font_color' );
	$wp_poll_content_font_size = get_option( 'wp_poll_content_font_size			' );
	$wp_poll_content_font_weight = get_option( 'wp_poll_content_font_weight' );
	$wp_poll_content_font_style = get_option( 'wp_poll_content_font_style' );

	$wp_poll_option_font_color = get_option( 'wp_poll_option_font_color' );
	$wp_poll_option_font_size = get_option( 'wp_poll_option_font_size			' );
	$wp_poll_option_font_weight = get_option( 'wp_poll_option_font_weight' );
	$wp_poll_option_font_style = get_option( 'wp_poll_option_font_style' );

	$wp_poll_submit_button = get_option( 'wp_poll_submit_button' );
	$wp_poll_result_button = get_option( 'wp_poll_result_button' );
	$wp_poll_archive_button = get_option( 'wp_poll_archive_button' );
	
	if ( empty($wp_poll_submit_button) ) $wp_poll_submit_button = 'wp_poll_button_dark_blue';
	if ( empty($wp_poll_result_button) ) $wp_poll_result_button = 'wp_poll_button_dark_blue';
	if ( empty($wp_poll_archive_button) ) $wp_poll_archive_button = 'wp_poll_button_dark_blue';
	
	$wp_poll_submit_btn_text = get_option( 'wp_poll_submit_btn_text' );
	$wp_poll_result_btn_text = get_option( 'wp_poll_result_btn_text' );
	$wp_poll_archive_btn_text = get_option( 'wp_poll_archive_btn_text' );
	
	if ( empty ($wp_poll_submit_btn_text) ) $wp_poll_submit_btn_text = 'Submit';
	if ( empty ($wp_poll_result_btn_text) ) $wp_poll_result_btn_text = 'Result';
	if ( empty ($wp_poll_archive_btn_text) ) $wp_poll_archive_btn_text = 'Archive';
	
	