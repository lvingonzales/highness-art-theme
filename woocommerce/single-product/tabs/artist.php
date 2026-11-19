<?php 

global $product;

?>

<?php 

$terms = get_the_terms( $product -> get_id(), 'artist' );

    if ($terms && ! is_wp_error( $terms )) {
        foreach ($terms as $key => $term) {
            ?>
            <div class="artist_container" id="artist-container-<?php echo esc_html($term -> slug); ?>">
                <h3 style="margin-bottom: 0.5rem;"><?php echo esc_html($term -> name); ?></h3>
                <div>
                    <?php echo wp_kses_post( $term -> description ) ?>
                </div>
            </div>
            <?php
        }
    }

