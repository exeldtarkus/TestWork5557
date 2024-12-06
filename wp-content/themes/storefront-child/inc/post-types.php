<?php
// Register Custom Post Type Cities
function create_cities_post_type() {
    $args = array(
        'label'         => 'Cities',
        'public'        => true,
        'menu_icon'     => 'dashicons-location',
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'cities', 'with_front' => false ),
        'show_in_rest'  => true, // Gutenberg support
    );
    register_post_type( 'cities', $args );
}
add_action( 'init', 'create_cities_post_type' );