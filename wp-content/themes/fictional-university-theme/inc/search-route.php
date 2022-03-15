<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch()
{
    register_rest_route('university/v1', 'search', array(
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults($data)
{
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
    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();
        if (get_post_type() == 'post' or get_post_type() == 'page') {
            array_push($searchResults['generalInfo'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }
        if (get_post_type() == 'professor') {
            array_push($searchResults['professor'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape'),
            ));
        }
        if (get_post_type() == 'event') {
            $eventDate = new DateTime(get_field('event_date'));
            $description = null;
            if (has_excerpt()) {
                $description = get_the_excerpt();
            } else {
                $description = wp_trim_words(get_the_content(), 18);
            }
            array_push($searchResults['event'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'month' => $eventDate->format('M'),
                'day' => $eventDate->format('d'),
                'description' => $description
            ));
        }
        if (get_post_type() == 'program') {
            $relatedCampuses = get_field('related_campus');
            if ($relatedCampuses){
                foreach ($relatedCampuses as $item){
                    array_push($searchResults['campus'], array(
                        'title' => get_the_title($item),
                        'url' => get_the_permalink($item)
                    ));
                }
            }
            array_push($searchResults['program'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
                'id' => get_the_ID()
            ));
        }
        if (get_post_type() == 'campus') {
            array_push($searchResults['campus'], array(
                'title' => get_the_title(),
                'url' => get_the_permalink(),
            ));
        }
    }

    if ($searchResults['program']){
        $programsMetaQuery = array(
            'relation' => 'OR',
        );
        foreach ($searchResults['program'] as $item){
            array_push($programsMetaQuery, array(
                array(
                    'key' => 'related_program',
                    'compare' => 'LIKE',
                    'value' => '"' . $item['id'] . '"'
                )
            ));
        }
        $programRelationshipQuery = new WP_Query(array(
            'post_type' => array('professor', 'event'),
            'meta_query' => $programsMetaQuery
        ));
    
        while ($programRelationshipQuery->have_posts()) {
            $programRelationshipQuery->the_post();

            if (get_post_type('professor')){
                array_push($searchResults['professor'], array(
                    'title' => get_the_title(),
                    'url' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0, 'professorLandscape'),
                ));
            }
            if (get_post_type() == 'event') {
                $eventDate = new DateTime(get_field('event_date'));
                $description = null;
                if (has_excerpt()) {
                    $description = get_the_excerpt();
                } else {
                    $description = wp_trim_words(get_the_content(), 18);
                }
                array_push($searchResults['event'], array(
                    'title' => get_the_title(),
                    'url' => get_the_permalink(),
                    'month' => $eventDate->format('M'),
                    'day' => $eventDate->format('d'),
                    'description' => $description
                ));
            }
        }
        $searchResults['professor'] = array_unique($searchResults['professor'], SORT_REGULAR);
        $searchResults['event'] = array_unique($searchResults['event'], SORT_REGULAR);
    }
    return $searchResults;
}
