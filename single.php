<?php 
    get_header();

    global $post;

    echo '<main class="additional-info ' . esc_attr($post->post_name) . '">';
    echo '<h1>' . esc_html(get_the_title()) . '</h1>';
    the_content();
    echo '</main>';
    get_footer();

?>
