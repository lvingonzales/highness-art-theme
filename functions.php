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

        wp_enqueue_style(
            'highnessart_content_product_style',
            get_stylesheet_directory_uri() . '/public/css/content-product.css'
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

if (! function_exists( 'highness_front_page_enqueues')) {
    function highness_front_page_enqueues () {
        if (is_front_page(  )) {

            wp_enqueue_style(
                'highness_featured_hero_style',
                get_stylesheet_directory_uri(  ) . '/public/css/featured-hero.css'
            );

            wp_enqueue_style(
                'highness_intro_text_style',
                get_stylesheet_directory_uri(  ) . '/public/css/intro-text.css'
            );

            wp_enqueue_style(
                'highness_lit_agency_section_style',
                get_stylesheet_directory_uri(  ) . '/public/css/literary-agency-section.css'
            );

            wp_enqueue_style(
                'highness_testimonials_style',
                get_stylesheet_directory_uri(  ) . '/public/css/testimonial.css'
            );
        }
    }
}

add_action ('wp_enqueue_scripts', 'highness_front_page_enqueues');

if (! function_exists('highness_cart_page_enqueues')) {
    function highness_cart_page_enqueues () {
        if (is_cart()) {
            wp_enqueue_style(
                'highness_cart_style',
                get_stylesheet_directory_uri(  ) . '/public/css/cart.css'
            );
        }
    }
}

add_action( 'wp_enqueue_scripts', 'highness_cart_page_enqueues');

add_action ('after_setup_theme', 'setup_woocommerce_support');
function setup_woocommerce_support () {
    add_theme_support( 'woocommerce' );
}

function highness_svg( $icon, $class = '', $title = '', $return = false) {
    $file = get_template_directory(  ) . '/public/icons/' . $icon. '.svg';

    if (file_exists($file)) {
        $svg = file_get_contents($file);

        if ( $class ) {
            $svg = preg_replace( '/<svg\b(.*?)>/', '<svg$1 class="' . esc_attr( $class ) . '">', $svg, 1 );
        }

        // Add a <title> for accessibility if provided.
        if ( $title ) {
            $svg = preg_replace( '/(<svg\b[^>]*>)/', '$1<title>' . esc_html( $title ) . '</title>', $svg, 1 );
        }

        if($return) {
            return $svg;
        }

        echo $svg;
    }
}

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'product_title_and_author', 10);

function product_title_and_author () {
    global $product;

    $author_name = $product->get_attribute( 'pa_book-author' );

    echo '<h2 class="woocommerce-loop-product__title">';
    echo esc_html($product->get_name());
    echo '</h2>';

    if ($author_name) {
        echo '<span class="product-author"> ' . esc_html( $author_name ) . '</span>';
    }
}

add_action ('woocommerce_before_shop_loop', function() {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}, 1);
