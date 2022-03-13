<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch(){
    register_rest_route('university/v1', 'search', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults($data){
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term']) 
    ));

    $searchResults = array(
        'generalInfo' => array(),
        'professor' => array(),
        'program' => array(),
        'event' => array(),
        'campus' => array()
    );
    while ($mainQuery->have_posts()){
        $mainQuery->the_post();
        if (get_post_type() == 'post' OR get_post_type() == 'page'){
            array_push($searchResults['generalInfo'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink()
            ));
        }
        else {
            array_push($searchResults[get_post_type()], array(
                'title' => get_the_title(),
                'url' => get_the_permalink()
            ));
        }
        // if (get_post_type() == 'professor'){
        //     array_push($searchResults['professor'], array(
        //         'title' => get_the_title(),
        //         'url' => get_the_permalink()
        //     ));
        // }
        // if (get_post_type() == 'program'){
        //     array_push($searchResults['program'], array(
        //         'title' => get_the_title(),
        //         'url' => get_the_permalink()
        //     ));
        // }
    
      
    }
    return $searchResults;
}
