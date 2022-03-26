<?php

add_action('rest_api_init', 'universityLikeRoutes');

function universityLikeRoutes()
{
    register_rest_route('university/v1', 'manageLike', array(
        'methods' => 'POST',
        'callback' => 'createLike'
    ));

    register_rest_route('university/v1', 'manageLike', array(
        'methods' => 'DELETE',
        'callback' => 'deleteLike'
    ));
}

function createLike($data)
{
    if (is_user_logged_in()) {
        $professorId = $data['professorId'];

        $existQuery = new WP_Query(array(
            'author' => get_current_user_id(),
            'post_type' => 'like',
            'meta_query' => array(
                array(
                    'key' => 'liked_professor_id',
                    'compare' => '=',
                    'value' => $professorId
                )
            )
        ));
        if (!$existQuery->found_posts AND get_post_type($professorId) == 'professor'){
            return wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => '',
                'meta_input' => array(
                    'liked_professor_id' => $professorId
                )
            ));
        } else {
            die('Invalid professor id.');
        }
       
    } else {
        die('Only logged in users can create a like.');
    }
}

function deleteLike()
{
    return 'Thanks for trying to delete a like';
}
