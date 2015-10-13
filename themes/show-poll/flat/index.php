<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

	$wp_query = new WP_Query(
		array (
			'post_type' => 'wp_poll',
			'meta_query' => array(
				array(
					'key' => 'wp_poll_for_date',
					'value' => wp_poll_get_date(),
					
					),					
				),
		) );
	
	$html .= '<div class="wp_poll_container">';		
				
	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();	
			
			$wp_poll_header_content = get_post_meta(get_the_ID(),'wp_poll_main_question',true);
			$wp_poll_post_id = get_the_ID();

			$html .= '
			<div class="poll_header_title">
				<a href="" >'.__(get_the_title(),'wp_poll').'</a>
			</div>
			
			<div class="poll_header_content">
				<p>'.__($wp_poll_header_content,'wp_poll').'</p>
			</div>
			
			
			<div class="wp_poll_select_option">';
			
			for ( $i = 1; $i <= 5; $i ++ )
			{
				$opt = get_post_meta($wp_poll_post_id,'wp_poll_option_'.$i,true);
				$percent = $class_wp_poll_functions->wp_poll_get_submit_percent( $wp_poll_post_id, $opt );
				
				$html .= '
				<input type="radio" name="wp_poll_option" value="'.$opt.'" />
				<span class="wp_poll_option_'.$i.'">'.__($opt,'wp_poll').'</span>
				<span class="wp_poll_option_result no_display"> - ('.__($percent.'%','wp_poll').')</span><br>
				';
			}
			
			$html .= '</div>';
			
			$html .= '
			<div class="wp_poll_total_submit no_display">
				'.__('Total Submit: '. $class_wp_poll_functions->wp_poll_get_total_submit($wp_poll_post_id),'wp_poll').'
			</div>
			';
			

			$html .= '
			<div class="wp_poll_buttons">
				<div wp_poll_post_id="'.$wp_poll_post_id.'" class="wp_poll_button_submit div_center wp_poll_button_medium '.$wp_poll_submit_button.'">
					'.__($wp_poll_submit_btn_text,'wp_poll').'
				</div>
				
				<ul class="wp_poll_secondary_buttons">
					<li>
						<div class="wp_poll_button_results wp_poll_button_small '.$wp_poll_result_button.'">
							'.__($wp_poll_result_btn_text,'wp_poll').'
						</div>
					</li>
					<li>
						<div class="wp_poll_button_small '.$wp_poll_archive_button.'">
							'.__($wp_poll_archive_btn_text,'wp_poll').'
						</div>
					</li>
					
				</ul>
				
			</div>
			';

		endwhile;
	wp_reset_query();
	else:
		$html .= __('No Poll found','wp_poll');	
	endif;		
				
	$html .= '</div>';  // end wp_poll_container 

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

	
	</style>
	';
	
	
	
	