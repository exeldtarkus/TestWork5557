<?php
// Validate latitude and longitude
function validate_latitude( $latitude ) {
    return is_numeric( $latitude ) && $latitude >= -90 && $latitude <= 90;
}

function validate_longitude( $longitude ) {
    return is_numeric( $longitude ) && $longitude >= -180 && $longitude <= 180;
}

// Format latitude and longitude for display
function format_coordinates( $latitude, $longitude ) {
    if ( $latitude && $longitude ) {
        return "Lat: $latitude, Long: $longitude";
    }
    return 'Coordinates not available';
}