<?php

add_action('wp_ajax_ova_elems_get_posts_for_slider', 'ova_elems_get_posts_for_slider');

function ova_elems_get_posts_for_slider() {
    // Verify nonce
    // if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ova_elems_ajax_nonce')) {
    //     wp_send_json_error('Invalid nonce');
    //     wp_die();
    // }

    // Check user capabilities
    if (!current_user_can('edit_posts')) {
        wp_send_json_error('Insufficient permissions');
        wp_die();
    }

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );
    $posts = get_posts($args);

    $options = '';
    foreach ($posts as $post) {
        $options .= sprintf(
            '<option value="%d">%s</option>',
            esc_attr($post->ID),
            esc_html($post->post_title)
        );
    }

    // new add
    echo wp_kses($options, array(
        'option' => array(
            'value' => array()
        )
    ));
    
    wp_die(); 
}


function ova_elems_get_categories() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ova_elems_ajax_nonce')) {
        wp_send_json_error('Invalid nonce');
        wp_die();
    }

    // Check user capabilities
    if (!current_user_can('edit_posts')) {
        wp_send_json_error('Insufficient permissions');
        wp_die();
    }

    $url = OVA_ELEMS_LICENSE_ENDPOINT . 'getCollections';
    $data = [];
    $args = [
        'method'    => 'POST',
        'body'      => json_encode($data),
        'headers'   => [
            'Content-Type' => 'application/json',
        ]
    ];
    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        wp_send_json_error(array(
            'status'    => false,
            'code'      => 100,
            'data'      => array(),
            'msg'       => $response->get_error_message()
        ));
        wp_die();
    } else {
        $response_body = wp_remote_retrieve_body($response);
        $data = json_decode($response_body, true);

        wp_send_json_success(array(
            'status'    => true,
            'code'      => 200,
            'data'      => isset($data['data']) ? $data['data'] : array(),
            'msg'       => 'Collections data retrieved'
        ));
        wp_die();
    }
}
add_action('wp_ajax_ova_elems_get_categories', 'ova_elems_get_categories');

function ova_elems_get_templates() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ova_elems_ajax_nonce')) {
        wp_send_json_error('Invalid nonce');
        wp_die();
    }

    // Check user capabilities
    if (!current_user_can('edit_posts')) {
        wp_send_json_error('Insufficient permissions');
        wp_die();
    }

    $url = OVA_ELEMS_LICENSE_ENDPOINT . 'getFilteredProducts';

    $handle = isset($_POST['handle']) ? sanitize_text_field($_POST['handle']) : '';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $cursor = isset($_POST['cursor']) ? sanitize_text_field($_POST['cursor']) : null;

    $data = [
        "collectionHandle" => $handle,
        "productHandle" => $search,
        "paginationParams" => [
            "first" => 9,
            "afterCursor" => $cursor,
            "beforeCursor" => null,
            "reverse" => true
        ]
    ];

    $args = [
        'method'    => 'POST',
        'body'      => json_encode($data),
        'headers'   => [
            'Content-Type' => 'application/json',
        ]
    ];

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        wp_send_json_error(array(
            'status'    => false,
            'code'      => 100,
            'data'      => array(),
            'msg'       => $response->get_error_message()
        ));
        wp_die();
    } else {
        $response_body = wp_remote_retrieve_body($response);
        $data = json_decode($response_body, true);

        wp_send_json_success(array(
            'status'    => true,
            'code'      => 200,
            'data'      => isset($data['data']) ? $data['data'] : array(),
            'msg'       => 'Templates data retrieved'
        ));
        wp_die();
    }
}
add_action('wp_ajax_ova_elems_get_templates', 'ova_elems_get_templates');