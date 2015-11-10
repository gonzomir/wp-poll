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
	<div style="margin-left:10px;margin-top:20px;">
		<select id="wp_poll_select_poll">
		<option value="0">Select a Poll Item</option>';	
	
	$wp_query = new WP_Query( array (
		'post_type' => array('wp_poll'),
		'post_status' => 'publish',
	) );
	while ( $wp_query->have_posts() ) : $wp_query->the_post();	
		if ( $wp_poll == get_the_ID() ) $selected = 'selected';
		else $selected = '';
		
		$html .= '<option value="'.get_the_ID().'" '.$selected.'>'.get_the_title().'</option>';
	endwhile;
	wp_reset_query();
	
	$html .='</select>';
	if (!empty($wp_poll))
		$html .= '<span>This analytics is only for poll: '.get_the_title($wp_poll).'</span>';
	$html.= '</div>
		';
	
	if( $wp_poll != 0 ):
		$wp_query = new WP_Query( array (
			'post_type' => array('wp_polled_by'),
			'post_status' => 'publish',
			'meta_query' => array(
					array(
						'key' => 'wp_polled_post_id',
						'value' => $wp_poll,
						
						),					
					),
		) );
	else:
		$wp_query = new WP_Query( array (
			'post_type' => array('wp_polled_by'),
			'post_status' => 'publish',
		) );
	endif;
		
	while ( $wp_query->have_posts() ) : $wp_query->the_post();	
				
		$wp_polled_by = get_post_meta(get_the_ID(),'wp_polled_by',true);
		$wp_poller_location = get_post_meta(get_the_ID(),'wp_poller_location',true);
		$wp_poller_country = get_post_meta(get_the_ID(),'wp_poller_country',true);
				
		$poll_details = get_the_ID();
		
		array_push($chart_data, array($wp_poller_location, $wp_poller_country, $poll_details));

	endwhile;
	wp_reset_query();

	// satrt new tab section
	$arr_analytics = fn_get_analytics( $chart_data );
	
	$html .= '
		<script>
			if( navigator.onLine ){
				'.fn_get_pie_chart( $arr_analytics, 'pie_chart' ).'
				'.fn_get_geo_chart( $arr_analytics, 'geo_chart' ).'
			}
			else{
				window.onload = function() {
					document.getElementById("pie_chart").innerHTML="Sorry: You have NO active internet Connection";
					document.getElementById("geo_chart").innerHTML="Sorry: You have NO active internet Connection";
				}
			}
		</script>
	';

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
					'.fn_get_list($chart_data).'
                </div>                
            </li>
			
			<li style="display: none;" class="box2 tab-box">
				<div class="option-box">
                    <div id="pie_chart"></div>
                </div>                
            </li>
			<li style="display: none;" class="box3 tab-box">
				<div class="option-box">
                    <div id="geo_chart"></div>
                </div>                
            </li>
			
		</ul>
	</div>
	';

	
	$html .= '</div>';
	
	function fn_get_list($chart_data)
	{
		
		$html = '';
		$html .= '
		<div class="wp_poll_admin_list"> 
			<ol>';
			
			foreach( $chart_data as $k => $v) 
			{
				$parts = explode(',', $v[2]);
				$poller_id = isset($parts[0]) ? $parts[0] : null;
				
				$poll_id = get_post_meta($poller_id, 'wp_polled_post_id', true);
				
				if ( $poller_id != null )
				{
					$html .= '
					<li>
						
						Poll Name: <a href="post.php?post='.$poll_id.'&action=edit"> '.get_the_title($poll_id).' </a> #
						Polled From: '.$v[0].' #
						Open Poller: <a href="admin.php?page=manage_wp_ld&post_id='.$poller_id.'"> Open Poller </a>
					</li>';
				}
			}
				
		return $html;
	}
	
	function fn_get_pie_chart( $arr_analytics, $chart_where_to_show )
	{
		?>
        <script type="text/javascript">
			google.load('visualization', '1', {packages: ['corechart']});
            google.setOnLoadCallback(drawChart);
			function drawChart() 
			{
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Topping');
				data.addColumn('number', 'Slices');
				data.addRows([
				<?php
					foreach( $arr_analytics as $k => $v) 
					{
						echo "['{$k}', {$v}],";
					}
                ?>
				]);
				
				var set_width = 800, set_height = 400;
				if ( window.innerWidth <= 300 ){
					set_width = 300;
					set_height = 300;
				} 
				
				var options = {
					pieHole: 0.4,
					width:set_width,
					height:set_height,
					pieSliceText:'none',
				};

				var chart = new google.visualization.PieChart(document.getElementById('<?php echo $chart_where_to_show; ?>'));
				chart.draw(data, options);
			}
		</script>
		<?php
	}
	
	function fn_get_geo_chart( $arr_analytics, $chart_where_to_show )
	{	
		?>
       	<script type="text/javascript">
			google.load("visualization", "1", {packages:["geochart"]});
			google.setOnLoadCallback(drawRegionsMap);

			function drawRegionsMap() {
				var data = google.visualization.arrayToDataTable([
					['Country', 'Popularity'],
					<?php
					foreach( $arr_analytics as $k => $v) 
					{
						echo "['{$k}', {$v}],";
					}
					?>
					]);
				var set_width = 800, set_height = 400;
				if ( window.innerWidth <= 300 ){
					set_width = 300;
					set_height = 300;
				} 
				var options = {
					width:set_width,
					height:set_height,
				};
				var chart = new google.visualization.GeoChart(document.getElementById('<?php echo $chart_where_to_show; ?>'));
				chart.draw(data, options);
			}
		</script>
		<?php
	}
	
	function fn_get_analytics( $chart_data )
	{
		$arr_analytics = array();
		foreach( $chart_data as $k => $v) 
		{
			array_push($arr_analytics, $v[1]);
		}
		$arr_analytics = array_count_values($arr_analytics);
		
		return $arr_analytics;
	}