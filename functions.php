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

        wp_enqueue_style(
            'highnessart_footer_style',
            get_stylesheet_directory_uri() . '/public/css/footer.css'
        );
        
        
        wp_enqueue_script( 
            "highnessart_header_script", 
            get_stylesheet_directory_uri() . '/assets/js/header.js', 
            array(), 
            '1.0.0', 
            true
        );

        wp_enqueue_script( 
            "highnessart_footer_script", 
            get_stylesheet_directory_uri() . '/assets/js/footer.js', 
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

if (! function_exists( 'highness_front_page_enqueues')) {
    function highness_front_page_enqueues () {
        if (is_front_page(  )) {

            wp_enqueue_style(
                'highness_featured_hero_style',
                get_stylesheet_directory_uri(  ) . '/public/css/featured-hero.css'
            );
        }
    }
}

add_action ('wp_enqueue_scripts', 'highness_front_page_enqueues');

function highness_custom_image_sizes() {
    add_image_size( 'hero-small', 600, 0, false );
    add_image_size( 'hero-medium', 1200, 0, false );
}

add_action('after_theme_setup', 'highness_custom_image_sizes');
