<?php 

global $product;

?>

<?php 

$terms = get_the_terms( $product -> get_id(), 'authors' );

    if ($terms && ! is_wp_error( $terms )) {
        foreach ($terms as $key => $term) {
            ?>
            <div class="author_container" id="author-container-<?php echo esc_html($term -> slug); ?>">
                <h3><?php echo esc_html($term -> name); ?></h3>
                <p><?php echo esc_html($term -> description) ?></p>
            </div>
            <?php
        }
    }

