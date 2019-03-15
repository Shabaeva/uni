<?php

function uni_post_types(){

	//Event Post type
register_post_type('event', array(   
'rewrite' => array(
'slug' => 'events'
),
    'supports' => array('title', 'editor', 'excerpt'),
    'has_archive' => true,
    'public'=> true,
    'labels'=> array(
        'name'=>'Events',
        'add_new_item'=>'Add New Event',
        'edit_item'=>'Edit Event',
        'all_items'=>'All Events',
        'singular_name'=>'Event'
    ),
    'menu_icon'=>'dashicons-calendar'
    
    


));
	//Program Post type
	register_post_type('program', array(   
		'rewrite' => array( 'slug' => 'programs'),
    'supports' => array('title', 'editor'),
    'has_archive' => true,
    'public'=> true,
    'labels'=> array(
        'name'=>'Programs',
        'add_new_item'=>'Add New Program',
        'edit_item'=>'Edit Program',
        'all_items'=>'All Programs',
        'singular_name'=>'Program'
    ),
    'menu_icon'=>'dashicons-awards'
    
));
	
		//Professor Post type
	register_post_type('professor', array(   		
    'supports' => array('title', 'editor', 'thumbnail'),
    'public'=> true,
    'labels'=> array(
        'name'=>'Professor',
        'add_new_item'=>'Add New Professor',
        'edit_item'=>'Edit Professor',
        'all_items'=>'All Professors',
        'singular_name'=>'Professor'
    ),
    'menu_icon'=>'dashicons-welcome-learn-more'
    
));
	
}

add_action('init', 'uni_post_types');
