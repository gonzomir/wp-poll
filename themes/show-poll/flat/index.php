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
	
	$wp_poll_page =  get_option( 'wp_poll_page' );
	$page = get_page_by_title( $wp_poll_page );
	
	if ( empty($wp_poll_page) || $wp_poll_page == 'none' ) $page_link = ''; 
	else $page_link = get_permalink($page->ID);
	
	
	$wp_poll_show_featured =  get_option( 'wp_poll_show_featured' );
	if ( $wp_poll_show_featured == 'yes' )
	{
		$html.= '<div class="pb-settings">';
		$html.= '
		<ul class="tab-nav">
			<li nav="1" class="nav1 active">'.__('Today Poll','wp_poll').'</li>
			<li nav="2" class="nav2"  style="float:right;">'.__('Featured','wp_poll').'</li>
		</ul>
		
		<ul class="box">';
		
		$html .='<li style="display: block;" class="box1 tab-box active">';
		$html .= wp_poll_show_poll($class_wp_poll_functions,"","wp_poll_all_time");
		$html.= '</li>';

		$html .='<li style="display: none;" class="box2 tab-box active">';
		$html .= wp_poll_show_poll($class_wp_poll_functions,"","wp_poll_featured");
		$html.= '</li>';
		$html.= '</ul></div>';	
	}
	else
	{
		$html .= wp_poll_show_poll($class_wp_poll_functions,"","wp_poll_all_time");
	}

	$lighter_color = fn_get_color($wp_poll_header_bg_color,2,80);
	$html .= '
	<style>
		.wp_poll_container .poll_header_title {
			background-color:'.$wp_poll_header_bg_color.' !important;
		}
		.wp_poll_container .poll_header_title a{
			font-size:'.$wp_poll_header_font_size.' !important;
			color:'.$wp_poll_header_font_color.' !important;
			font-weight:'.$wp_poll_header_font_weight.' !important;
			font-style:'.$wp_poll_header_font_style.' !important;
		}
		
		.wp_poll_container .poll_header_content{
			color:'.$wp_poll_content_font_color.' !important;
		}

		.wp_poll_container .poll_header_content p{
			font-size:'.$wp_poll_content_font_size.' !important;
			font-weight:'.$wp_poll_content_font_weight.' !important;
			font-style:'.$wp_poll_content_font_style.' !important;
		}
		
		.wp_poll_container .wp_poll_select_option{
			color:'.$wp_poll_option_font_color.' !important;
			font-size:'.$wp_poll_option_font_size.' !important;
			font-weight:'.$wp_poll_option_font_weight.' !important;
			font-style:'.$wp_poll_option_font_style.' !important;
		}

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
	</style>';
	
	
	
	function wp_poll_show_poll($class_wp_poll_functions,$wp_poll_to_be_shown,$meta_key)
	{
		$html_out = "";
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
		
		
		if ( empty($wp_poll_to_be_shown) )
		{
			$wp_query = new WP_Query(
				array (
					'post_type' => 'wp_poll',
					'order' => 'ASC',
					'meta_query' => array(
						'relation' => 'OR',
						array(
							'key' => $meta_key,
							'value' => 'yes',
							'compare' => '=',
							),
						array(
							'key' => 'wp_poll_for_date',
							'value' => wp_poll_get_date(),
							'compare' => '=',
							)
						)
					)
				);
			$wp_query->the_post();
			$wp_poll_to_be_shown = get_the_ID();
			wp_reset_query();
		}

		$html_out .= '<div class="wp_poll_container">';
		
		if ( !empty($wp_poll_to_be_shown) )
		{
			$wp_poll_header_content = get_post_meta($wp_poll_to_be_shown,'wp_poll_main_question',true);
		
			$html_out .= '
			<div class="poll_header_title">
				<a href="" >'.__(get_the_title($wp_poll_to_be_shown),'wp_poll').'</a>
			</div>
				
			<div class="poll_header_content">
				<p>'.__($wp_poll_header_content,'wp_poll').'</p>
			</div>
				
				
			<div class="wp_poll_select_option">';
				
			for ( $i = 1; $i <= 5; $i ++ )
			{
				$opt = get_post_meta($wp_poll_to_be_shown,'wp_poll_option_'.$i,true);
				if ( empty( $opt ) ) continue;
				
				$percent = $class_wp_poll_functions->wp_poll_get_submit_percent( $wp_poll_to_be_shown, $opt );
					
				$html_out .= '
				<input type="radio" name="wp_poll_option" value="'.$opt.'" />
				<span class="wp_poll_option_'.$i.'">'.__($opt,'wp_poll').'</span>
				<span class="wp_poll_option_result no_display"> - ('.__($percent.'%','wp_poll').')</span><br>';
			}
				
			$html_out .= '</div>';
			
			$html_out .= '
			<div class="wp_poll_total_submit no_display">
				'.__('Total Submit: '. $class_wp_poll_functions->wp_poll_get_total_submit($wp_poll_to_be_shown),'wp_poll').'
			</div>';
				
			$html_out .= '
			<div class="wp_poll_archive_message no_display">
				<p>Archive is not Set Yet !</p>
			</div>';

			$html_out .= '
			<div class="wp_poll_buttons">
				<div wp_poll_to_be_shown="'.$wp_poll_to_be_shown.'" class="wp_poll_button_submit div_center wp_poll_button_medium '.$wp_poll_submit_button.'">
					'.__($wp_poll_submit_btn_text,'wp_poll').'
				</div>
					
				<ul class="wp_poll_secondary_buttons">
					<li>
						<div class="wp_poll_button_results wp_poll_button_small '.$wp_poll_result_button.'">
							'.__($wp_poll_result_btn_text,'wp_poll').'
						</div>
					</li>
					<li>
						<div wp_poll_page="'.$page_link.'" class="wp_poll_archive_button wp_poll_button_small '.$wp_poll_archive_button.'">
							'.__($wp_poll_archive_btn_text,'wp_poll').'
						</div>
					</li>
				</ul>
			</div>';
		}
		else $html_out .= __('No Poll found','wp_poll');	
		
		
		$html_out .= '</div>';  // end wp_poll_container 

		return $html_out;
	}
	
	
?>