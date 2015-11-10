<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access

	$wp_poll_list_per_page = get_option( 'wp_poll_list_per_page' );
	$wp_poll_show_poll_icon = get_option( 'wp_poll_show_poll_icon' );
	$wp_poll_no_poll_found_text = get_option( 'wp_poll_no_poll_found_text' );
	$wp_poll_list_title_font_color = get_option( 'wp_poll_list_title_font_color' );
	
	
	if ( empty($wp_poll_list_per_page) ) $wp_poll_list_per_page = 10;
	if ( empty($wp_poll_show_poll_icon) ) $wp_poll_show_poll_icon = 'yes';
	if ( empty($wp_poll_no_poll_found_text) ) $wp_poll_no_poll_found_text = 'No Poll Found';

	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	elseif ( get_query_var('page') ) $paged = get_query_var('page');
	else $paged = 1;

	$sort_by = isset($_GET['sort_by'])   ? $_GET['sort_by'] : '';
	$data = isset($_GET['data'])   ? $_GET['data'] : '';
	
	$wp_query = new WP_Query(
		array (
			'post_type' => 'wp_poll',
			'orderby' => 'Date',
			'order' => 'DESC',
			'posts_per_page' => $wp_poll_list_per_page,
			'paged' => $paged,	
			
		) );
	
	$html .= '<div class="poll-list">';		
				
	if ( $wp_query->have_posts() ) :
		while ( $wp_query->have_posts() ) : $wp_query->the_post();	
			
			$wp_poll_name 		= get_the_title();
			$wp_poll_content	= get_post_meta(get_the_ID(),'wp_poll_main_question',true);
			$wp_poll_for_date	= get_post_meta(get_the_ID(),'wp_poll_for_date',true);
			$wp_poll_category_name	= get_the_category();
	
			$polled_posts = wp_count_posts( 'wp_polled_by' ); 
			$wp_polled_all_posts = $polled_posts->publish;
			if ( empty( $wp_polled_all_posts ) ) $poll_impact = 0;
			else $poll_impact = round(( $class_wp_poll_functions->wp_poll_get_total_submit(get_the_ID()) * 100 ) / $wp_polled_all_posts);
			
			
			if ( $sort_by == 'impact' && $data != $poll_impact )  continue;
			if ( $sort_by == 'category' && $data != $wp_poll_category_name[0]->cat_name )  continue;
			if ( $sort_by == 'date' && $data != $wp_poll_for_date )  continue;
			
			$html .=
			'<div class="single">';
			
			if ( $wp_poll_show_poll_icon == 'yes' )
				$html .= '<div class="poll-thumb"><img src="'.wp_poll_plugin_url .'themes/poll-list/flat/images/poll.png" /> </div>';
			
			$html .= '
				<div class="title"><a href="" style="color:'.$wp_poll_list_title_font_color.';">'.$wp_poll_name.'</a></div>
				
				<div class="poll-content">'
				.__( $wp_poll_content ,'wp_poll').'</div>
						
				<div class="wp_poll_button_small wp_poll_button_green book_list_meta a">
					<a href="?sort_by=available&data=available">'.__('Available','wp_poll').'</a></div>
				<div class="wp_poll_button_small wp_poll_button_navy_blue book_list_meta a">
					<a href="?sort_by=impact&data='.$poll_impact.'">'.__('Impact: '.$poll_impact.'%','wp_poll').'</a></div>
				<div class="wp_poll_button_small wp_poll_button_light_violate book_list_meta a">
					<a href="?sort_by=category&data='.$wp_poll_category_name[0]->cat_name.'">'.__($wp_poll_category_name[0]->cat_name,'wp_poll').'</a></div>
				<div class="wp_poll_button_small wp_poll_button_sky_blue book_list_meta a">
					<a href="?sort_by=date&data='.$wp_poll_for_date.'">'.__($wp_poll_for_date,'wp_poll').'</a></div>
					
			</div>';
		endwhile;
	
		$html .= '<div class="paginate">';
		$big = 999999999;
		$html .= paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $paged ),
			'total' => $wp_query->max_num_pages
			) );
		$html .= '</div >';	
	
	wp_reset_query();
	else:
		$html .= __( $wp_poll_no_poll_found_text ,'wp_poll');	
	endif;		
				
	$html .= '</div>'; // .poll-list	


