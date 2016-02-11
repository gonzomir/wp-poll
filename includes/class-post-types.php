<?php

/*
* @Author 		Jaed Mosharraf
* Copyright: 	2015 Jaed Mosharraf
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

class class_wp_poll_post_types{
	
	public function __construct(){
		add_action( 'init', array( $this, 'wp_poll_post_type_wp_poll' ), 0 );
		add_action( 'init', array( $this, 'wp_poll_post_type_wp_poll_by_post' ), 0 );
	}
	
	public function wp_poll_post_type_wp_poll()
	{
		if ( post_type_exists( "wp_poll" ) )
		return;

		$singular  = __( 'Poll', 'wp_poll' );
		$plural    = __( 'Polls', 'wp_poll' );
	 
	 
		register_post_type( "wp_poll",
			apply_filters( "register_post_type_job", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => __( $singular, 'wp_poll' ),
					'all_items'             => sprintf( __( 'All %s', 'wp_poll' ), $plural ),
					'add_new' 				=> __( 'Add '.$singular, 'wp_poll' ),
					'add_new_item' 			=> sprintf( __( 'Add %s', 'wp_poll' ), $singular ),
					'edit' 					=> __( 'Edit', 'wp_poll' ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'wp_poll' ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', 'wp_poll' ), $singular ),
					'view' 					=> sprintf( __( 'View %s', 'wp_poll' ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', 'wp_poll' ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', 'wp_poll' ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', 'wp_poll' ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'wp_poll' ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', 'wp_poll' ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', 'wp_poll' ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> true,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'taxonomies' 			=> array('category'), 
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array('title','category'),
				'show_in_nav_menus' 	=> false,
				'menu_icon' => 'dashicons-admin-users',
			) )
		); 
	}
	
	public function wp_poll_post_type_wp_poll_by_post()
	{
		if ( post_type_exists( "wp_polled_by" ) )
		return;

		$singular  = __( 'Poller', 'wp_polled_by' );
		$plural    = __( 'Pollers', 'wp_polled_by' );
	 
	 
		register_post_type( "wp_polled_by",
			apply_filters( "register_post_type_job", array(
				'labels' => array(
					'name' 					=> $plural,
					'singular_name' 		=> $singular,
					'menu_name'             => __( $singular, 'wp_poll' ),
					'all_items'             => sprintf( __( 'All %s', 'wp_poll' ), $plural ),
					'add_new' 				=> __( 'Add '.$singular, 'wp_poll' ),
					'add_new_item' 			=> sprintf( __( 'Add %s', 'wp_poll' ), $singular ),
					'edit' 					=> __( 'Edit', 'wp_poll' ),
					'edit_item' 			=> sprintf( __( 'Edit %s', 'wp_poll' ), $singular ),
					'new_item' 				=> sprintf( __( 'New %s', 'wp_poll' ), $singular ),
					'view' 					=> sprintf( __( 'View %s', 'wp_poll' ), $singular ),
					'view_item' 			=> sprintf( __( 'View %s', 'wp_poll' ), $singular ),
					'search_items' 			=> sprintf( __( 'Search %s', 'wp_poll' ), $plural ),
					'not_found' 			=> sprintf( __( 'No %s found', 'wp_poll' ), $plural ),
					'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'wp_poll' ), $plural ),
					'parent' 				=> sprintf( __( 'Parent %s', 'wp_poll' ), $singular )
				),
				'description' => sprintf( __( 'This is where you can create and manage %s.', 'wp_poll' ), $plural ),
				'public' 				=> true,
				'show_ui' 				=> false,
				'capability_type' 		=> 'post',
				'map_meta_cap'          => true,
				'publicly_queryable' 	=> true,
				'exclude_from_search' 	=> false,
				'hierarchical' 			=> false,
				'rewrite' 				=> true,
				'query_var' 			=> true,
				'supports' 				=> array('title','custom-fields'),
				'show_in_nav_menus' 	=> false,
				'menu_icon' => 'dashicons-admin-users',
			) )
		); 
	}

} new class_wp_poll_post_types();