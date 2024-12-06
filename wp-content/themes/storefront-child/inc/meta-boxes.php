<?php
// Add Meta Box for Latitude and Longitude
function add_city_meta_boxes() {
    add_meta_box(
        'city_meta_box',
        'City Location',
        'city_meta_box_callback',
        'cities',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'add_city_meta_boxes' );

// Meta Box Callback
function city_meta_box_callback( $post ) {
    $latitude = get_post_meta( $post->ID, '_latitude', true );
    $longitude = get_post_meta( $post->ID, '_longitude', true );

    wp_nonce_field( 'city_meta_box_nonce', 'city_meta_nonce' );

    echo '<p><label for="latitude">Latitude:</label></p>';
    echo '<input type="text" id="latitude" name="latitude" value="' . esc_attr( $latitude ) . '" size="25" />';
    echo '<p><label for="longitude">Longitude:</label></p>';
    echo '<input type="text" id="longitude" name="longitude" value="' . esc_attr( $longitude ) . '" size="25" />';
}

// Save Meta Box Data
function save_city_meta_box_data( $post_id ) {
    if ( ! isset( $_POST['city_meta_nonce'] ) || ! wp_verify_nonce( $_POST['city_meta_nonce'], 'city_meta_box_nonce' ) ) {
        return;
    }

    if ( isset( $_POST['latitude'] ) ) {
        update_post_meta( $post_id, '_latitude', sanitize_text_field( $_POST['latitude'] ) );
    }
    if ( isset( $_POST['longitude'] ) ) {
        update_post_meta( $post_id, '_longitude', sanitize_text_field( $_POST['longitude'] ) );
    }
}
add_action( 'save_post', 'save_city_meta_box_data' );