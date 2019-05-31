<?php

add_action('rest_api_init', 'uniRegisterSearch');

function uniRegisterSearch(){
    
    register_rest_route('university/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'uniSearchResults'
    ));
}

function uniSearchResults(){
    $professors = new WP_Query(array(
        'post_type' => 'professor'
        
    ));
    
    $professorResults = array();
    
    while($professors->have_posts()){
        $professors->the_post();
        array_push($professorResults, array(
            'title' => get_the_title(),
            'url' => get_the_permalink()
        ));
    }
    
    
    return $professorResults;
}