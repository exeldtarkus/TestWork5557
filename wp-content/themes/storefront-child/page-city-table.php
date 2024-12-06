<?php
/**
 * Template Name: City Table
 */

get_header();

global $wpdb;
$cities = $wpdb->get_results( "SELECT p.ID, p.post_title, pm_lat.meta_value AS latitude, pm_lon.meta_value AS longitude
    FROM $wpdb->posts p
    INNER JOIN $wpdb->postmeta pm_lat ON p.ID = pm_lat.post_id AND pm_lat.meta_key = '_latitude'
    INNER JOIN $wpdb->postmeta pm_lon ON p.ID = pm_lon.post_id AND pm_lon.meta_key = '_longitude'
    WHERE p.post_type = 'cities' AND p.post_status = 'publish'" );

?>
<div id="city-table">
    <h1>City Table</h1>
    <table>
        <thead>
            <tr>
                <th>City</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $cities as $city ) : ?>
                <tr>
                    <td><?php echo esc_html( $city->post_title ); ?></td>
                    <td><?php echo esc_html( $city->latitude ); ?></td>
                    <td><?php echo esc_html( $city->longitude ); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php

get_footer();