<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_wp_poll_post_meta{
	
	public function __construct(){
		add_action('add_meta_boxes', array($this, 'meta_boxes_wp_poll'));
		add_action('save_post', array($this, 'meta_boxes_wp_poll_save'));
	}

	public function wp_poll_meta_options($options = array()){
		
		global $post;
		
		$options['Naming'] = array(
				
			'wp_poll_self_shortcode'=>array(
				'css_class'=>'wp_poll_self_shortcode',					
				'title'=>'Self Shortcode',
				'option_details'=>'Use this shortcode to show this poll seperately.',						
				'input_type'=>'text',
				'input_values'=> '[wp_poll_display_today id='.get_the_ID().']',
				'autoselect'=> true,
			),
						
		);
		
		$options['Poll Info'] = array(
									
			'wp_poll_main_question'=>array(
				'css_class'=>'wp_poll_main_question',					
				'title'=>'Poll Main Content',
				'option_details'=>'',						
				'input_type'=>'textarea', // text, radio, checkbox, select, 
				'input_values'=> '', // could be array
				),
				
			'wp_poll_for_date'=>array(
				'css_class'=>'wp_poll_for_date',					
				'title'=>'Poll Publish Date',
				'option_details'=>'',						
				'input_type'=>'text', // text, radio, checkbox, select, 
				'input_values'=> wp_poll_get_date(), // could be array
				),
						
		);
		
		$options['Poll Option'] = array(
									
			'wp_poll_option_1'=>array(
				'css_class'=>'wp_poll_option_1',					
				'title'=>'Poll Option 1',
				'option_details'=>'',						
				'input_type'=>'text', // text, radio, checkbox, select, 
				'input_values'=> '', // could be array
				),
								
			'wp_poll_option_2'=>array(
				'css_class'=>'wp_poll_option_2',					
				'title'=>'Poll Option 2',
				'option_details'=>'',						
				'input_type'=>'text', // text, radio, checkbox, select, 
				'input_values'=> '', // could be array
				),

			'wp_poll_option_3'=>array(
				'css_class'=>'wp_poll_option_3',					
				'title'=>'Poll Option 3',
				'option_details'=>'',						
				'input_type'=>'text', // text, radio, checkbox, select, 
				'input_values'=> '', // could be array
				),
				
			'wp_poll_option_4'=>array(
				'css_class'=>'wp_poll_option_4',					
				'title'=>'Poll Option 4',
				'option_details'=>'',						
				'input_type'=>'text', // text, radio, checkbox, select, 
				'input_values'=> '', // could be array
				),
			'wp_poll_option_5'=>array(
				'css_class'=>'wp_poll_option_5',					
				'title'=>'Poll Option 5',
				'option_details'=>'',						
				'input_type'=>'text', // text, radio, checkbox, select, 
				'input_values'=> '', // could be array
				),
						
		);
		
		$options['Poll Settings'] = array(
									
			'wp_poll_all_time'=>array(
				'css_class'=>'wp_poll_all_time',					
				'title'=>'Set This for Alltime',
				'option_details'=>'If you set this Poll Yes then it will show alltime.',						
				'input_type'=>'radio', 
				'input_values'=> 'no',
				'input_args'=> array('yes'=>'Yes', 'no'=>'No'),
				
				),
		);
		
		$options['Featured Poll'] = array(
									
			'wp_poll_featured'=>array(
				'css_class'=>'wp_poll_featured',					
				'title'=>'Set This as Featured',
				'option_details'=>'If you set this Poll Yes then it will show in the Featured Tab (in case of Show Featured Tab).',						
				'input_type'=>'radio', 
				'input_values'=> 'no',
				'input_args'=> array('yes'=>'Yes', 'no'=>'No'),
				
				),
						
		);
		
		$options = apply_filters( 'wp_poll_filters_meta_options', $options );
		return $options;
	}
	
	
	public function wp_poll_meta_options_form(){
		global $post;
			
		$wp_poll_meta_options = $this->wp_poll_meta_options();
		$html = '';
			
		$html.= '<div class="back-settings job-bm-cp-settings">';			

		$html_nav = '';
		$html_box = '';
				
		$i=1;
		foreach($wp_poll_meta_options as $key=>$options)
		{
			if ( $i == 1 ) $html_nav.= '<li nav="'.$i.'" class="nav'.$i.' active">'.$key.'</li>';				
			else $html_nav.= '<li nav="'.$i.'" class="nav'.$i.'">'.$key.'</li>';
				
			if( $i == 1 ) $html_box.= '<li style="display: block;" class="box'.$i.' tab-box active">';				
			else $html_box.= '<li style="display: none;" class="box'.$i.' tab-box">';
				
			foreach($options as $option_key=>$option_info)
			{
				$option_value =  get_post_meta( $post->ID, $option_key, true );

				if(empty($option_value)) $option_value = $option_info['input_values'];
				
				$html_box.= '<div class="option-box '.$option_info['css_class'].'">';
				$html_box.= '<p class="option-title">'.$option_info['title'].'</p>';
				$html_box.= '<p class="option-info">'.$option_info['option_details'].'</p>';
				
				if($option_info['input_type'] == 'text') {
					if( $option_info['autoselect'] ) $autoselect = 'readonly="true" onclick="this.select()"';
					else $autoselect = '';
						
					$html_box.= '<input '.$autoselect.' id="'.$option_key.'" type="text" placeholder="" name="'.$option_key.'" value="'.$option_value.'" /> ';					
				
				}
				elseif($option_info['input_type'] == 'textarea')
					$html_box.= '<textarea placeholder="" name="'.$option_key.'" >'.$option_value.'</textarea> ';
				elseif($option_info['input_type'] == 'date')
					 $html_box.= '<input type="text" id="jquery-datepicker" name="entry_post_date" value="' . $option_value . '">';
				elseif($option_info['input_type'] == 'radio')
				{
					$input_args = $option_info['input_args'];
					foreach($input_args as $input_args_key=>$input_args_values)
					{
						if($input_args_key == $option_value) $checked = 'checked';
						else $checked = '';
						$html_box.= '<label><input class="'.$option_key.'" type="radio" '.$checked.' value="'.$input_args_key.'" name="'.$option_key.'"   >'.$input_args_values.'</label><br/>';
					}
				}
				elseif($option_info['input_type'] == 'select')
				{
					$input_args = $option_info['input_args'];
					$html_box.= '<select name="'.$option_key.'" >';
					foreach($input_args as $input_args_key=>$input_args_values)
					{
						if($input_args_key == $option_value) $selected = 'selected';
						else $selected = '';
						$html_box.= '<option '.$selected.' value="'.$input_args_key.'">'.$input_args_values.'</option>';
					}
					$html_box.= '</select>';
				}					
				elseif($option_info['input_type'] == 'checkbox')
				{
					$input_args = $option_info['input_args'];
					foreach($input_args as $input_args_key=>$input_args_values)
					{
						if(empty($option_value[$input_args_key])) $checked = '';
						else $checked = 'checked';
						$html_box.= '<label><input '.$checked.' value="'.$input_args_values.'" name="'.$option_key.'['.$input_args_key.']"  type="checkbox" >'.$input_args_values.'</label><br/>';
					}
				}	
				elseif($option_info['input_type'] == 'file')
				{	
					$html_box.= '<input type="text" id="file_'.$option_key.'" name="'.$option_key.'" value="'.$option_value.'" /><br />';
					$html_box.= '<input id="upload_button_'.$option_key.'" class="upload_button_'.$option_key.' button" type="button" value="Upload File" />';					
					$html_box.= '<br /><br /><div style="overflow:hidden;max-height:150px;max-width:150px;" class="logo-preview"><img width="100%" src="'.$option_value.'" /></div>';
					$html_box.= '
							<script>
								jQuery(document).ready(function($){
									var custom_uploader; 
									jQuery("#upload_button_'.$option_key.'").click(function(e) {
										e.preventDefault();
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: "Choose File",
											button: {
												text: "Choose File"
											},
											multiple: false
										});
										custom_uploader.on("select", function() {
											attachment = custom_uploader.state().get("selection").first().toJSON();
											jQuery("#file_'.$option_key.'").val(attachment.url);
											jQuery(".logo-preview img").attr("src",attachment.url);											
										});
										custom_uploader.open();
									});
								})
							</script>';					
				}					
				$html_box.= '</div>';
			}
			$html_box.= '</li>';
			$i++;
		}
		$html.= '<ul class="tab-nav">';
		$html.= $html_nav;			
		$html.= '</ul>';
		$html.= '<ul class="box">';
		$html.= $html_box;
		$html.= '</ul>';		
		$html.= '</div>';			
		return $html;
	}

	public function meta_boxes_wp_poll($post_type) {
			$post_types = array('wp_poll');
			if (in_array($post_type, $post_types)) 
			{
				add_meta_box('wp_poll_metabox',
					__('Poll Data','wp_poll'),
					array($this, 'wp_poll_meta_box_function'),
					$post_type,
					'normal',
					'high');
			}
		}
	public function wp_poll_meta_box_function($post) {
        wp_nonce_field('wp_poll_nonce_check', 'wp_poll_nonce_check_value');
		$wp_poll_meta_options = $this->wp_poll_meta_options();
		foreach($wp_poll_meta_options as $options_tab=>$options)
		{
			foreach($options as $option_key=>$option_data)
				${$option_key} = get_post_meta($post -> ID, $option_key, true);
		}
		?> <div class="job-bm-cp-meta"> <?php
		echo $this->wp_poll_meta_options_form(); 
		?></div><?php
   	}
	
	public function meta_boxes_wp_poll_save($post_id){
		if (!isset($_POST['wp_poll_nonce_check_value'])) return $post_id;

		$nonce = $_POST['wp_poll_nonce_check_value'];
		
	 	if (!wp_verify_nonce($nonce, 'wp_poll_nonce_check')) return $post_id;
	 	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	 	if ('page' == $_POST['post_type']) 
		{
	 		if (!current_user_can('edit_page', $post_id)) return $post_id;
	 	} 
		else 
		{
	 		if (!current_user_can('edit_post', $post_id)) return $post_id;
		}
	 
		$wp_poll_meta_options = $this->wp_poll_meta_options();
		
		foreach($wp_poll_meta_options as $options_tab=>$options)
		{
			foreach($options as $option_key=>$option_data)
			{
				${$option_key} = stripslashes_deep($_POST[$option_key]);
				update_post_meta($post_id, $option_key, ${$option_key});			
			}
		}		
	}
	
} new class_wp_poll_post_meta();