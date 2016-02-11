<?php
/*
	Plugin Name: WP Poll
	Plugin URI: http://pluginbazar.ml/
	Description: It allows user to poll in your website with many awesome feature.
	Version: 1.1.2
	Author: Jaed Mosharraf
	Author URI: http://pluginbazar.ml/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class WPPollManager {
	
	public function __construct(){
	
	define('wp_poll_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
	define('wp_poll_plugin_dir', plugin_dir_path( __FILE__ ) );
	define('wp_poll_wp_url', 'https://wordpress.org/plugins/wp-poll/' );
	define('wp_poll_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/wp-poll' );
	define('wp_poll_pro_url','http://pluginbazar.ml/' );
	define('wp_poll_demo_url', 'http://pluginbazar.ml/' );
	define('wp_poll_conatct_url', 'http://pluginbazar.ml/contact/' );
	define('wp_poll_qa_url', 'http://pluginbazar.ml/qa/' );
	define('wp_poll_plugin_name', 'WP Poll' );
	define('wp_poll_plugin_version', '1.0.0' );
	define('wp_poll_customer_type', 'free' );
	define('wp_poll_share_url', 'https://wordpress.org/plugins/wp-poll/' );
	
	define('wp_poll_short_code', 'wp_poll_display_today' );
	define('wp_poll_list_short_code', 'wp_poll_list' );
	
	// Class
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-types.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-meta.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-post-meta-poller.php');	

	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-shortcodes.php');	
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-functions.php');
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-settings.php');
	
	//require_once( plugin_dir_path( __FILE__ ) . 'includes/class-widget.php');
		

	// Function's
	require_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php');

	add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
	add_action( 'wp_enqueue_scripts', array( $this, 'wp_poll_front_scripts' ) );
	add_action( 'admin_enqueue_scripts', array( $this, 'wp_poll_admin_scripts' ) );
	
	}

	public function wp_poll_front_scripts()
	{
		wp_enqueue_script('jquery');

		wp_enqueue_script('wp_poll_js', plugins_url( '/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'wp_poll_js', 'wp_poll_ajax', array( 'wp_poll_ajaxurl' => admin_url( 'admin-ajax.php')));

		wp_enqueue_style('wp_poll_style', wp_poll_plugin_url.'css/style.css');

		wp_enqueue_style('font-awesome', wp_poll_plugin_url.'css/font-awesome.css');
		wp_enqueue_style('font-awesome', wp_poll_plugin_url.'css/font-awesome.min.css');
		
		//BackAdmin
		wp_enqueue_style('BackAdmin', wp_poll_plugin_url.'BackAdmin/css/BackAdmin.css');
		wp_enqueue_script('BackAdmin', plugins_url( 'BackAdmin/js/BackAdmin.js' , __FILE__ ) , array( 'jquery' ));		
	}

	public function wp_poll_admin_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-autocomplete');		

		wp_enqueue_style( 'jquery-ui-datepicker-style' , '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css');
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp_poll_color_picker', plugins_url('/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
		wp_enqueue_script('wp_poll_admin_js', plugins_url( '/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('wp_poll_admin_js', 'wp_poll_ajax', array( 'wp_poll_ajaxurl' => admin_url( 'admin-ajax.php')));
		wp_enqueue_style('wp_poll_admin_style', wp_poll_plugin_url.'admin/css/style.css');

		//BackAdmin
		wp_enqueue_style('BackAdmin', wp_poll_plugin_url.'BackAdmin/css/BackAdmin.css');		
		wp_enqueue_script('BackAdmin', plugins_url( 'BackAdmin/js/BackAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
		wp_enqueue_script('Google-Chart-API', 'http://www.google.com/jsapi');
	}
	
	
} new WPPollManager();