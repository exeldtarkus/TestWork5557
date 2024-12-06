<?php
/**
 * Storefront Child Theme Functions
 *
 * This file contains the core functions for the child theme.
 * Includes custom post types, meta boxes, taxonomies, widgets, and helper functions.
 */

/** Enqueue Parent and Child Theme Styles */
if ( ! function_exists( 'storefront_child_enqueue_styles' ) ) {
    function storefront_child_enqueue_styles() {
        wp_enqueue_style( 'storefront-parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'storefront-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'storefront-parent-style' ) );
    }
}
add_action( 'wp_enqueue_scripts', 'storefront_child_enqueue_styles' );

/** Include Additional PHP Files */
require get_stylesheet_directory() . '/inc/post-types.php'; // Custom Post Type for Cities
require get_stylesheet_directory() . '/inc/meta-boxes.php'; // Meta Boxes for Latitude and Longitude
require get_stylesheet_directory() . '/inc/taxonomies.php'; // Custom Taxonomy Countries
require get_stylesheet_directory() . '/inc/widgets.php'; // City Temperature Widget
require get_stylesheet_directory() . '/inc/helpers.php'; // Helper Functions

/** Enqueue Custom JavaScript for AJAX */
function enqueue_city_scripts() {
    wp_enqueue_script( 'city-search', get_stylesheet_directory_uri() . '/js/city-search.js', array( 'jquery' ), '1.0', true );

    // Pass AJAX URL to JavaScript
    wp_localize_script( 'city-search', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_city_scripts' );

/** AJAX Handler for City Search */
function city_search_ajax_handler() {
    global $wpdb;

    $search = isset( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';
    $results = $wpdb->get_results( $wpdb->prepare(
        "SELECT post_title FROM {$wpdb->posts} WHERE post_title LIKE %s AND post_type = 'cities' AND post_status = 'publish'",
        '%' . $wpdb->esc_like( $search ) . '%'
    ) );

    if ( $results ) {
        wp_send_json_success( $results );
    } else {
        wp_send_json_error( 'No results found' );
    }
}
add_action( 'wp_ajax_city_search', 'city_search_ajax_handler' );
add_action( 'wp_ajax_nopriv_city_search', 'city_search_ajax_handler' );

/** Add Hooks for Custom Actions */
function before_city_table_action() {
    do_action( 'before_city_table' ); // Custom action hook for content before city table
}
function after_city_table_action() {
    do_action( 'after_city_table' ); // Custom action hook for content after city table
}