<?php	


/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class class_wp_poll_settings_page  {
	
	
    public function __construct(){

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
    }
	
	
	public function wp_poll_settings_options($options = array()){
		
		$options['Poll Options'] = array(
			
			'wp_poll_short_code'=>array(
				'css_class'=>'wp_poll_short_code',					
				'title'=>'Poll display Shortcode',
				'option_details'=>'',						
				'input_type'=>'text', // text, radio, checkbox, select, 
				'input_values'=>'['.wp_poll_short_code.']', // could be array
				'status'=>'disabled', // could be array
			),
			
			'wp_poll_submit_btn_text'=>array(
				'css_class'=>'wp_poll_submit_btn_text',					
				'title'=>'Submit Button Text',
				'option_details'=>'',						
				'input_type'=>'text', 
				'placeholder'=>'Submit',
			),	
			
			'wp_poll_result_btn_text'=>array(
				'css_class'=>'wp_poll_result_btn_text',					
				'title'=>'Result Button Text',
				'option_details'=>'',						
				'input_type'=>'text', 
				'placeholder'=>'Result',
			),
			
			'wp_poll_archive_btn_text'=>array(
				'css_class'=>'wp_poll_archive_btn_text',					
				'title'=>'Archive Button Text',
				'option_details'=>'',						
				'input_type'=>'text', 
				'placeholder'=>'Archive',
			),

		);
		
		$options['Poll List Options'] = array(

			'wp_poll_page'=>array(
				'css_class'=>'wp_poll_page',					
				'title'=>'Select Poll Page',
				'option_details'=>'',						
				'input_type'=>'select', // text, radio, checkbox, select, 
				'input_values'=>'', // could be array
				'input_args'=> fn_get_array_pages(),
			),
			
			'wp_poll_show_page_content'=>array(
				'css_class'=>'wp_poll_show_page_content',					
				'title'=>'Do you want to show page Content?',
				'option_details'=>'',						
				'input_type'=>'radio',
				'input_values'=>'yes', 
				'input_args'=> array('yes'=>'Yes', 'no'=>'No'),
			),
			
			
			
			'wp_poll_list_per_page'=>array(
				'css_class'=>'wp_poll_list_per_page',					
				'title'=>'List Per Page',
				'input_type'=>'text',
				'input_values'=>'', 
				'placeholder'=>'10',
			),
			
			'wp_poll_show_poll_icon'=>array(
				'css_class'=>'wp_poll_show_poll_icon',					
				'title'=>'Show Poll Icon in the List',
				'input_type'=>'radio',
				'input_args'=> array('yes'=>'Yes', 'no'=>'No'),
			),
			
			'wp_poll_list_title_font_color'=>array(
				'css_class'=>'wp_poll_list_title_font_color',					
				'title'=>'Set Poll List Title Color',
				'input_type'=>'text',
				'input_values'=> '#08519B',
			),
			
			'wp_poll_no_poll_found_text'=>array(
				'css_class'=>'wp_poll_no_poll_found_text',					
				'title'=>'No Poll Found Text',
				'input_type'=>'text',
				'placeholder'=>'No Poll Found',
				
			),
			
			
			
		);

		$options['Style-Header'] = array(

			'wp_poll_header_font_color'=>array(
				'css_class'=>'wp_poll_header_font_color',					
				'title'=>'Wp Poll Header Font Color',
				'option_details'=>'',						
				'input_type'=>'text',
				'input_values'=> '#ffffff',
			),
			
			'wp_poll_header_bg_color'=>array(
				'css_class'=>'wp_poll_header_bg_color',					
				'title'=>'Wp Poll Header Background Color',
				'option_details'=>'',						
				'input_type'=>'text',
				'input_values'=> '#08519B',
			),
			
			'wp_poll_header_font_size'=>array(
				'css_class'=>'wp_poll_header_font_size',					
				'title'=>'Wp Poll Header Font Size',
				'option_details'=>'',						
				'input_type'=>'text',
				'input_values'=> '',
				'placeholder'=> '13px',
				'status'=>'',
			),

			'wp_poll_header_font_weight'=>array(
				'css_class'=>'wp_poll_header_font_weight',					
				'title'=>'Wp Poll Header Font Weight',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'normal',
				'input_args'=> 
					array(
						'100'=>'100', 
						'200'=>'200', 
						'300'=>'300', 
						'400'=>'400', 
						'500'=>'500', 
						'600'=>'600', 
						'700'=>'700', 
						'800'=>'800',
						'900'=>'900',
						'bold'=>'bold',
						'bolder'=>'bolder',
						'initial'=>'initial',
						'lighter'=>'lighter',
						'normal'=>'normal',
					),
			),
			
			'wp_poll_header_font_style'=>array(
				'css_class'=>'wp_poll_header_font_style',					
				'title'=>'Wp Poll Header Font Style',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'normal',
				'input_args'=> 
					array(
						'italic'=>'italic', 
						'initial'=>'initial',
						'lighter'=>'lighter',
						'oblique'=>'oblique',
						'normal'=>'normal',	
					),
			),
			
		);
		
		$options['Style-Content'] = array(

			'wp_poll_content_font_color'=>array(
				'css_class'=>'wp_poll_content_font_color',					
				'title'=>'Wp Poll Content Font Color',
				'option_details'=>'',						
				'input_type'=>'text',
				'input_values'=> '#08519B',
			),
			
			'wp_poll_content_font_size'=>array(
				'css_class'=>'wp_poll_content_font_size',					
				'title'=>'Wp Poll Content Font Size',
				'option_details'=>'',						
				'input_type'=>'text',
				'input_values'=> '',
				'placeholder'=> '13px',
			),

			'wp_poll_content_font_weight'=>array(
				'css_class'=>'wp_poll_content_font_weight',					
				'title'=>'Wp Poll Content Font Weight',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'normal',
				'input_args'=> 
					array(
						'100'=>'100', 
						'200'=>'200', 
						'300'=>'300', 
						'400'=>'400', 
						'500'=>'500', 
						'600'=>'600', 
						'700'=>'700', 
						'800'=>'800',
						'900'=>'900',
						'bold'=>'bold',
						'bolder'=>'bolder',
						'initial'=>'initial',
						'lighter'=>'lighter',
						'normal'=>'normal',
					),
			),
			
			'wp_poll_content_font_style'=>array(
				'css_class'=>'wp_poll_content_font_style',					
				'title'=>'Wp Poll Content Font Style',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'normal',
				'input_args'=> 
					array(
						'italic'=>'italic', 
						'initial'=>'initial',
						'lighter'=>'lighter',
						'oblique'=>'oblique',
						'normal'=>'normal',	
					),
			),
			
		);
		
		$options['Style-Option'] = array(

			'wp_poll_option_font_color'=>array(
				'css_class'=>'wp_poll_option_font_color',					
				'title'=>'Wp Poll Option Font Color',
				'option_details'=>'',						
				'input_type'=>'text',
				'input_values'=> '#08519B',
			),
			
			'wp_poll_option_font_size'=>array(
				'css_class'=>'wp_poll_option_font_size',					
				'title'=>'Wp Poll Option Font Size',
				'option_details'=>'',						
				'input_type'=>'text',
				'input_values'=> '',
				'placeholder'=> '13px',
			),

			'wp_poll_option_font_weight'=>array(
				'css_class'=>'wp_poll_option_font_weight',					
				'title'=>'Wp Poll Option Font Weight',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'normal',
				'input_args'=> 
					array(
						'100'=>'100', 
						'200'=>'200', 
						'300'=>'300', 
						'400'=>'400', 
						'500'=>'500', 
						'600'=>'600', 
						'700'=>'700', 
						'800'=>'800',
						'900'=>'900',
						'bold'=>'bold',
						'bolder'=>'bolder',
						'initial'=>'initial',
						'lighter'=>'lighter',
						'normal'=>'normal',
					),
			),
			
			'wp_poll_option_font_style'=>array(
				'css_class'=>'wp_poll_option_font_style',					
				'title'=>'Wp Poll Option Font Style',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'normal',
				'input_args'=> 
					array(
						'italic'=>'italic', 
						'initial'=>'initial',
						'lighter'=>'lighter',
						'oblique'=>'oblique',
						'normal'=>'normal',	
					),
			),
			
		);
		
		$options['Style-Buttons'] = array(

			'wp_poll_submit_button'=>array(
				'css_class'=>'wp_poll_submit_button',					
				'title'=>'Wp Poll Submit Button Selection',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'wp_poll_button_dark_blue',
				'input_args'=> 
					array(
						'wp_poll_button_green'=>'Green Button', 
						'wp_poll_button_light_violate'=>'Light Violate Button', 
						'wp_poll_button_sky_blue'=>'Sky Blue Button', 
						'wp_poll_button_navy_blue'=>'Navy Blue Button', 
						'wp_poll_button_dark_blue'=>'Dark Blue Button', 
						'wp_poll_button_red'=>'Red Button', 
						'wp_poll_button_facebook'=>'Facebook Button', 
						
					),
			),
			
			'wp_poll_result_button'=>array(
				'css_class'=>'wp_poll_result_button',					
				'title'=>'Wp Poll Result Button Selection',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'wp_poll_button_dark_blue',
				'input_args'=> 
					array(
						'wp_poll_button_green'=>'Green Button', 
						'wp_poll_button_light_violate'=>'Light Violate Button', 
						'wp_poll_button_sky_blue'=>'Sky Blue Button', 
						'wp_poll_button_navy_blue'=>'Navy Blue Button', 
						'wp_poll_button_dark_blue'=>'Dark Blue Button', 
						'wp_poll_button_red'=>'Red Button', 
						'wp_poll_button_facebook'=>'Facebook Button', 
						
					),
			),
			
			'wp_poll_archive_button'=>array(
				'css_class'=>'wp_poll_archive_button',					
				'title'=>'Wp Poll Archive Button Selection',
				'option_details'=>'',						
				'input_type'=>'select',
				'input_values'=> 'wp_poll_button_dark_blue',
				'input_args'=> 
					array(
						'wp_poll_button_green'=>'Green Button', 
						'wp_poll_button_light_violate'=>'Light Violate Button', 
						'wp_poll_button_sky_blue'=>'Sky Blue Button', 
						'wp_poll_button_navy_blue'=>'Navy Blue Button', 
						'wp_poll_button_dark_blue'=>'Dark Blue Button', 
						'wp_poll_button_red'=>'Red Button', 
						'wp_poll_button_facebook'=>'Facebook Button', 
						
					),
			),
			
		);
		
		$options = apply_filters( 'wp_poll_settings_options', $options );
		return $options;
	}
	
	
	public function wp_poll_settings_options_form(){
		global $post;
			
		$wp_poll_settings_options = $this->wp_poll_settings_options();
		$html = '';
		$html.= '<div class="back-settings post-grid-settings">';			
		$html_nav = '';
		$html_box = '';
		
		$i=1;
		foreach($wp_poll_settings_options as $key=>$options)
		{
			if( $i == 1 ) $html_nav.= '<li nav="'.$i.'" class="nav'.$i.' active">'.$key.'</li>';				
			else $html_nav.= '<li nav="'.$i.'" class="nav'.$i.'">'.$key.'</li>';
							
			if( $i == 1 ) $html_box.= '<li style="display: block;" class="box'.$i.' tab-box active">';				
			else $html_box.= '<li style="display: none;" class="box'.$i.' tab-box">';
				
			foreach($options as $option_key=>$option_info)
			{
				$option_value =  get_option( $option_key );				
				
				if(!isset($option_info['placeholder'])) $placeholder = '';
				else $placeholder = $option_info['placeholder'];
				
				if(!isset($option_info['input_values'])) $option_info['input_values'] = '';
				if(!isset($option_info['status'])) $option_info['status'] = '';
				if(!isset($option_info['option_details'])) $option_info['option_details'] = '';
				
				
				
				if(empty($option_value)) $option_value = $option_info['input_values'];
				
				$html_box.= '<div class="option-box '.$option_info['css_class'].'">';
				$html_box.= '<p class="option-title">'.$option_info['title'].'</p>';
				$html_box.= '<p class="option-info">'.$option_info['option_details'].'</p>';
				
				
				
				
				if($option_info['input_type'] == 'text') 
					$html_box.= '<input type="text" '.$option_info['status'].' placeholder="'.$placeholder.'" name="'.$option_key.'" id="'.$option_key.'" value="'.$option_value.'" /> ';					
				elseif($option_info['input_type'] == 'text-multi')
				{
					$input_args = $option_info['input_args'];
					foreach($input_args as $input_args_key=>$input_args_values)
					{
						if(empty($option_value[$input_args_key])) $option_value[$input_args_key] = $input_args[$input_args_key];
						$html_box.= '<label>'.$input_args_key.'<br/><input class="job-bm-color" type="text" placeholder="" name="'.$option_key.'['.$input_args_key.']" value="'.$option_value[$input_args_key].'" /></label><br/>';	
					}
				}					
				elseif($option_info['input_type'] == 'textarea') $html_box.= '<textarea placeholder="" name="'.$option_key.'" >'.$option_value.'</textarea> ';
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
						$html_box.= '<label><input '.$checked.' value="'.$input_args_key.'" name="'.$option_key.'['.$input_args_key.']"  type="checkbox" >'.$input_args_values.'</label><br/>';
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
} new class_wp_poll_settings_page();

	if(empty($_POST['wp_poll_hidden'])):
		$class_wp_poll_settings_page = new class_wp_poll_settings_page();
		$wp_poll_settings_options = $class_wp_poll_settings_page->wp_poll_settings_options();
		foreach($wp_poll_settings_options as $options_tab=>$options)
		{
			foreach($options as $option_key=>$option_data) 
				${$option_key} = get_option( $option_key );
		}
	else:
		if($_POST['wp_poll_hidden'] == 'Y'):
			$class_wp_poll_settings_page = new class_wp_poll_settings_page();
			$wp_poll_settings_options = $class_wp_poll_settings_page->wp_poll_settings_options();
			foreach($wp_poll_settings_options as $options_tab=>$options)
			{
				foreach($options as $option_key=>$option_data)
				{
					if(!isset($_POST[$option_key])) $_POST[$option_key] = '';
					
					${$option_key} = stripslashes_deep($_POST[$option_key]);
					update_option($option_key, ${$option_key});
				}
			}
			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.', 'wp_poll' ); ?></strong></p></div>
			<?php
		endif;
	endif;
?>





	<div class="wrap">
		<div id="icon-tools" class="icon32"><br></div>
		<?php echo "<h2>".__(wp_poll_plugin_name.' Settings', 'wp_poll')."</h2>";?>
		
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
			<input type="hidden" name="wp_poll_hidden" value="Y" />
			<?php 
				settings_fields( 'wp_poll_plugin_options' );
				do_settings_sections( 'wp_poll_plugin_options' );
					
				$class_wp_poll_settings_page = new class_wp_poll_settings_page();
				echo $class_wp_poll_settings_page->wp_poll_settings_options_form(); 
			?>
			
			<input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes','wp_poll' ); ?>" />
			<!--<div class="button button-primary" id="wp_poll_reset_settings" > <?php //_e('Reset Settings','wp_poll' ); ?> </div> -->
		</form>
		
	</div>

<?php
	function fn_get_array_pages()
	{
		$pages = get_pages( );
		$array_pages = array();
		$array_pages['none'] = 'None';
		
		foreach($pages as $page)
		{
			if ( $page->post_title )
				$array_pages[$page->post_title] = $page->post_title;
		}
		
		return $array_pages;
	}
	
	
	
?>
				
				
				