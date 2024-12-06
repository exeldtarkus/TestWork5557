<?php
// Register Custom Taxonomy Countries
function create_countries_taxonomy() {
    $args = array(
        'hierarchical'      => true, // Category-like behavior
        'label'             => 'Countries',
        'show_ui'           => true, // Enable UI in admin
        'show_admin_column' => true, // Show in admin columns
        'rewrite'           => array( 'slug' => 'country' ),
    );
    register_taxonomy( 'countries', 'cities', $args );
}
add_action( 'init', 'create_countries_taxonomy' );