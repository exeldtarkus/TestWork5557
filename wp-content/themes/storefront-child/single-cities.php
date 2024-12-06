<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        ?>
        <h1><?php the_title(); ?></h1>
        <div><?php the_content(); ?></div>
        <?php

        $latitude = get_post_meta( get_the_ID(), '_latitude', true );
        $longitude = get_post_meta( get_the_ID(), '_longitude', true );

        if ( $latitude && $longitude ) {
            echo '<p><strong>Latitude:</strong> ' . esc_html( $latitude ) . '</p>';
            echo '<p><strong>Longitude:</strong> ' . esc_html( $longitude ) . '</p>';
        }
    endwhile;
else :
    echo '<p>No city found.</p>';
endif;

get_footer();