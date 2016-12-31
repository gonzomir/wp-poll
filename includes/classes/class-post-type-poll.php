<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class WPP_Post_type_Poll{
	
	public function __construct(){
		add_action( 'init', array( $this, 'wpp_post_type_poll' ), 0 );
		// add_action( 'init', array( $this, 'wpp_post_type_wpp_by_post' ), 0 );
	}
	
	public function wpp_post_type_poll() {
		if ( post_type_exists( "poll" ) )
		return;

		$singular  = __( 'Poll', WPP_TEXT_DOMAIN );
		$plural    = __( 'Polls', WPP_TEXT_DOMAIN );
	 
	 
		register_post_type( "poll",
			apply_filters( "register_post_type_poll", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => __( $singular, WPP_TEXT_DOMAIN ),
					'all_items'             => sprintf( __( 'All %s', WPP_TEXT_DOMAIN ), $plural ),
					'add_new' 				=> __( 'Add '.$singular, WPP_TEXT_DOMAIN ),
					'add_new_item' 			=> sprintf( __( 'Add %s', WPP_TEXT_DOMAIN ), $singular ),
					'edit' 					=> __( 'Edit', WPP_TEXT_DOMAIN ),
					'edit_item' 			=> sprintf( __( 'Edit %s', WPP_TEXT_DOMAIN ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', WPP_TEXT_DOMAIN ), $singular ),
					'view' 					=> sprintf( __( 'View %s', WPP_TEXT_DOMAIN ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', WPP_TEXT_DOMAIN ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', WPP_TEXT_DOMAIN ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', WPP_TEXT_DOMAIN ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', WPP_TEXT_DOMAIN ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', WPP_TEXT_DOMAIN ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', WPP_TEXT_DOMAIN ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array(''),
				'show_in_nav_menus' 	=> false,
				'menu_icon' => 'dashicons-chart-bar',
			) )
		); 
		
		$singular  = __( 'Poll Category', WPP_TEXT_DOMAIN );
		$plural    = __( 'Poll Categories', WPP_TEXT_DOMAIN );
	 
		register_taxonomy( "poll_cat",
			apply_filters( 'register_taxonomy_poll_cat_object_type', array( 'poll' ) ),
	       	apply_filters( 'register_taxonomy_poll_cat_args', array(
				'hierarchical' 			=> true,
		        'show_admin_column' 	=> true,					
		        'update_count_callback' => '_update_post_term_count',
		        'label' 				=> $plural,
		        'labels' => array(
					'name'              => $plural,
					'singular_name'     => $singular,
					'menu_name'         => ucwords( $plural ),
					'search_items'      => sprintf( __( 'Search %s', WPP_TEXT_DOMAIN ), $plural ),
					'all_items'         => sprintf( __( 'All %s', WPP_TEXT_DOMAIN ), $plural ),
					'parent_item'       => sprintf( __( 'Parent %s', WPP_TEXT_DOMAIN ), $singular ),
					'parent_item_colon' => sprintf( __( 'Parent %s:', WPP_TEXT_DOMAIN ), $singular ),
					'edit_item'         => sprintf( __( 'Edit %s', WPP_TEXT_DOMAIN ), $singular ),
					'update_item'       => sprintf( __( 'Update %s', WPP_TEXT_DOMAIN ), $singular ),
					'add_new_item'      => sprintf( __( 'Add New %s', WPP_TEXT_DOMAIN ), $singular ),
					'new_item_name'     => sprintf( __( 'New %s Name', WPP_TEXT_DOMAIN ),  $singular )
	            ),
		        'show_ui' 				=> true,
		        'public' 	     		=> true,
				'rewrite' => array(
					'slug' => 'poll_cat',
					'with_front' => false,
					'hierarchical' => true
				),
			) )
		);
			
			
			
	}
	
} new WPP_Post_type_Poll();