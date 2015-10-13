<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/
	$class_wp_poll_functions = new class_wp_poll_functions();
	
	$wp_polled_post_id 	= (int)$_POST['wp_poll_post_id'];	
	$wp_polled_option 	= sanitize_text_field($_POST['wp_poll_option_selected']);	
	
	if ( is_user_logged_in() ) $wp_polled_by = get_current_user_id();
	else $wp_polled_by = $class_wp_poll_functions->getUserIP();
	
	
	if ( !empty($wp_polled_post_id) || !empty($wp_polled_option) || !empty($wp_polled_by) ) 
	{
		if ( $class_wp_poll_functions->fn_check_already_ld( $wp_polled_post_id, $wp_polled_by ) == 0 )
		{
			$wp_ld_action_post = array(
				'post_type'   => 'wp_polled_by',
				'post_title'    => '#Poll by - ' . $wp_polled_by,
				'post_status'   => 'publish',
			  
			);
			
			$wp_ld_action_post_ID = wp_insert_post($wp_ld_action_post, true);
			
			update_post_meta($wp_ld_action_post_ID,'wp_polled_post_id',$wp_polled_post_id);
			update_post_meta($wp_ld_action_post_ID,'wp_polled_option',$wp_polled_option);
			update_post_meta($wp_ld_action_post_ID,'wp_polled_by',$wp_polled_by);
			
			$html['success'] = 'Success <i class="fa fa-check"></i>';
		}
		else $html['error'] = '<div> Already Done <i class="fa fa-exclamation-triangle"></div>'; 
	}
	else $html['error'] = '<div> Error Data <i class="fa fa-exclamation-triangle"> Try Again </div>';
	
?>