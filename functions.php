<?php

if  (! function_exists('highness_theme_setup')) :
    function highness_theme_setup () {
        wp_enqueue_style(
            'highnessart_style', 
            get_stylesheet_uri()
        );

        wp_enqueue_style(
            'highnessart_primary_style',
            get_stylesheet_directory_uri() . '/public/css/primary.css'
        );

        wp_enqueue_style(
            'highnessart_header_style',
            get_stylesheet_directory_uri() . '/public/css/header.css'
        );
        
        wp_enqueue_script( 
            "highnessart_header_script", 
            get_template_directory_uri() . '/assets/js/header.js', 
            array(), 
            '1.0.0', 
            true
        );
    }

endif;

add_action ('wp_enqueue_scripts', 'highness_theme_setup');

add_action ('after_theme_setup', function() {
    add_image_size('logo-mobile', 80, 160, true);
});
?>
