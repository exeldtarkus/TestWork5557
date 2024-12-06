<?php
class City_Temperature_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'city_temperature',
            __( 'City Temperature', 'storefront-child' ),
            array( 'description' => __( 'Displays a selected city and its current temperature using the OpenWeatherMap API.', 'storefront-child' ) )
        );
    }

    /** Widget Output on the Frontend */
    public function widget( $args, $instance ) {
        // Retrieve selected city
        $city_id = isset( $instance['city_id'] ) ? $instance['city_id'] : '';
        $api_key = 'b67b5c838c045937643deb920117148d'; // Replace with your API key

        echo $args['before_widget'];

        if ( ! empty( $city_id ) ) {
            // Get latitude and longitude from city post meta
            $latitude = get_post_meta( $city_id, '_latitude', true );
            $longitude = get_post_meta( $city_id, '_longitude', true );

            if ( $latitude && $longitude ) {
                // Fetch weather data
                $weather_data = $this->get_weather_data( $latitude, $longitude, $api_key );

                if ( is_array( $weather_data ) ) {
                    // Display weather information
                    echo '<h3>' . get_the_title( $city_id ) . '</h3>';
                    echo '<p><strong>' . __( 'Temperature:', 'storefront-child' ) . '</strong> ' . esc_html( $weather_data['main']['temp'] ) . '°C</p>';
                    echo '<p><strong>' . __( 'Weather:', 'storefront-child' ) . '</strong> ' . esc_html( $weather_data['weather'][0]['description'] ) . '</p>';
                    echo '<p><strong>' . __( 'Humidity:', 'storefront-child' ) . '</strong> ' . esc_html( $weather_data['main']['humidity'] ) . '%</p>';
                    echo '<p><strong>' . __( 'Wind Speed:', 'storefront-child' ) . '</strong> ' . esc_html( $weather_data['wind']['speed'] ) . ' m/s</p>';
                } else {
                    // If API response is not valid
                    echo '<p>' . esc_html( $weather_data ) . '</p>';
                }
            } else {
                echo '<p>' . __( 'Latitude and longitude data are not available for this city.', 'storefront-child' ) . '</p>';
            }
        } else {
            echo '<p>' . __( 'No city selected.', 'storefront-child' ) . '</p>';
        }

        echo $args['after_widget'];
    }

    /** Form in Admin Dashboard for Widget Settings */
    public function form( $instance ) {
        // Retrieve saved city_id or set default
        $city_id = isset( $instance['city_id'] ) ? $instance['city_id'] : '';

        // Query all cities
        $cities = get_posts( array(
            'post_type'   => 'cities',
            'numberposts' => -1,
        ) );

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'city_id' ) ); ?>"><?php _e( 'Select City:', 'storefront-child' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'city_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'city_id' ) ); ?>">
                <option value=""><?php _e( 'Select a city', 'storefront-child' ); ?></option>
                <?php foreach ( $cities as $city ) : ?>
                    <option value="<?php echo esc_attr( $city->ID ); ?>" <?php selected( $city_id, $city->ID ); ?>>
                        <?php echo esc_html( $city->post_title ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    /** Save Widget Settings */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['city_id'] = ! empty( $new_instance['city_id'] ) ? sanitize_text_field( $new_instance['city_id'] ) : '';
        return $instance;
    }

    /** Fetch Weather Data Using 2.5 API with Caching */
    private function get_weather_data( $latitude, $longitude, $api_key ) {
        $transient_key = "weather_data_{$latitude}_{$longitude}";
        $cached_data = get_transient( $transient_key );
    
        if ( $cached_data ) {
            return $cached_data; // Return cached data
        }

        // Use the 2.5 API for Current Weather
        $api_url = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&units=metric&appid={$api_key}";
        $response = wp_remote_get( $api_url );
    
        // Debugging: Log API response for troubleshooting
        if ( is_wp_error( $response ) ) {
            error_log( 'API Request Error: ' . $response->get_error_message() );
            return __( 'Unable to fetch weather data.', 'storefront-child' );
        }
    
        $weather_data = json_decode( wp_remote_retrieve_body( $response ), true );
    
        // Log raw API response for debugging
        error_log( print_r( $weather_data, true ) );
    
        if ( isset( $weather_data['main'] ) ) {
            set_transient( $transient_key, $weather_data, HOUR_IN_SECONDS ); // Cache for 1 hour
            return $weather_data;
        }
    
        return __( 'Weather data not available.', 'storefront-child' );
    }
}

// Register the widget
function register_city_temperature_widget() {
    register_widget( 'City_Temperature_Widget' );
}
add_action( 'widgets_init', 'register_city_temperature_widget' );