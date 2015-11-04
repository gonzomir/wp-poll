<?php	


/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class class_wp_poll_analytics_page  {
	
	
    public function __construct(){

		add_action( 'admin_menu', array( $this, 'admin_menu' ), 12 );
    }
		
	public function wp_poll_analytics_options_form(){
		$html = fn_show_analytics_list();
		return $html;
	}
} new class_wp_poll_analytics_page();
	
	function fn_show_analytics_list()
	{
		$html = '';

		require_once('require-analytics-list.php');
		return $html;
		
	}


	//========================== Showing this Class Data ==========================//
	$class_wp_poll_analytics_page = new class_wp_poll_analytics_page();
	echo $class_wp_poll_analytics_page->wp_poll_analytics_options_form(); 

?>