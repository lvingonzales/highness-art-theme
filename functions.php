<?php

if  (! function_exists('highness_theme_setup')) :
    function highness_theme_setup () {
        wp_enqueue_style(
            'highnessart_style', 
            get_stylesheet_uri()
        );

        wp_enqueue_style(
            'highnessart_primary_style',
            get_parent_theme_file_uri('public/css/primary.css')
        );

        wp_enqueue_style(
            'highnessart_header_style',
            get_parent_theme_file_uri('public/css/header.css')
        );
    }

endif;

add_action ('wp_enqueue_scripts', 'highness_theme_setup');
?>
