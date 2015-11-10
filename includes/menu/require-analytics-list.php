<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

	$chart_data = array();
	
	extract($_GET);
	if (!isset($wp_poll)) $wp_poll = '';
	

	$html .= '
	<div class="wp_poll_admin_settings_header" style="margin-left:10px;margin-top:20px;">
		<img src="'.wp_poll_plugin_url.'admin/images/select-option.png" />
		<span>You are Using FREE verion of WP Poll <a href="http://pluginbazar.ml/downloads/wp-poll-pro/" target="_blank"> Click Here to Get PRO Version </a> </span>
	</div>';

	// satrt new tab section
	
	$html .= '
	<div class="back-settings post-grid-settings">
		<ul class="tab-nav"> 
            <li nav="1" class="nav1 active">List Analytics</li>    
            <li nav="2" class="nav2">Pie Analytics</li>    
            <li nav="3" class="nav3">Geo Analytics</li>    
            
        </ul>
		
		<ul class="box">
			<li style="display: block;" class="box1 tab-box active">
				<div class="option-box">
					<img src="'.wp_poll_plugin_url.'admin/images/list-analytics.png" />
                </div>                
            </li>
			
			<li style="display: none;" class="box2 tab-box">
				<div class="option-box">
                   <img src="'.wp_poll_plugin_url.'admin/images/pie-analytics.png" />
                </div>                
            </li>
			<li style="display: none;" class="box3 tab-box">
				<div class="option-box">
                   <img src="'.wp_poll_plugin_url.'admin/images/geo-analytics.png" />
                </div>                
            </li>
			
		</ul>
	</div>
	';

	
	$html .= '</div>';