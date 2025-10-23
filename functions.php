<?php

if (!function_exists('highness_theme_setup')):
    function highness_theme_setup()
    {
        wp_enqueue_style(
            'highnessart_style',
            get_stylesheet_uri()
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
add_action('wp_enqueue_scripts', 'highness_theme_setup');

add_action('wp_enqueue_scripts', 'plugin_style_overrides');
function plugin_style_overrides()
{
    if (is_shop()) {
        wp_enqueue_style(
        "highnessart_woof_style",
        get_stylesheet_directory_uri(  ) . "/public/css/woof/woof.css"
    );
    }
}

if (!function_exists('highness_front_page_enqueues')) {
    function highness_front_page_enqueues()
    {
        if (is_front_page()) {

            wp_enqueue_style(
                'highness_featured_hero_style',
                get_stylesheet_directory_uri() . '/public/css/featured-hero.css'
            );

            wp_enqueue_style(
                'highness_intro_text_style',
                get_stylesheet_directory_uri() . '/public/css/intro-text.css'
            );

            wp_enqueue_style(
                'highness_lit_agency_section_style',
                get_stylesheet_directory_uri() . '/public/css/literary-agency-section.css'
            );

            wp_enqueue_style(
                'highness_testimonials_style',
                get_stylesheet_directory_uri() . '/public/css/testimonial.css'
            );
        }
    }
}

add_action('wp_enqueue_scripts', 'highness_front_page_enqueues');

if (!function_exists('highness_cart_page_enqueues')) {
    function highness_cart_page_enqueues()
    {
        if (is_cart()) {
            wp_enqueue_style(
                'highness_cart_style',
                get_stylesheet_directory_uri() . '/public/css/woocommerce/cart.css'
            );
        }
    }
}

add_action('wp_enqueue_scripts', 'highness_cart_page_enqueues');

add_action('after_setup_theme', 'setup_woocommerce_support');
function setup_woocommerce_support()
{
    add_theme_support('woocommerce');
}

function highness_svg($icon, $class = '', $title = '', $return = false)
{
    $file = get_template_directory() . '/public/icons/' . $icon . '.svg';

    if (file_exists($file)) {
        $svg = file_get_contents($file);

        if ($class) {
            $svg = preg_replace('/<svg\b(.*?)>/', '<svg$1 class="' . esc_attr($class) . '">', $svg, 1);
        }

        // Add a <title> for accessibility if provided.
        if ($title) {
            $svg = preg_replace('/(<svg\b[^>]*>)/', '$1<title>' . esc_html($title) . '</title>', $svg, 1);
        }

        if ($return) {
            return $svg;
        }

        echo $svg;
    }
}

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'product_title_and_author', 10);

function product_title_and_author()
{
    global $product;

    $author_name = $product->get_attribute('pa_book-author');

    echo '<h2 class="woocommerce-loop-product__title">';
    echo esc_html($product->get_name());
    echo '</h2>';

    if ($author_name) {
        echo '<span class="product-author"> ' . esc_html($author_name) . '</span>';
    }
}

add_action('woocommerce_before_shop_loop', function () {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}, 1);

add_action('woocommerce_before_main_content', function () {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}, 1);

add_filter('woocommerce_enqueue_styles', '__return_empty_array');


// Single Product Page Hook Overrides
add_action('woocommerce_single_product_summary', function() {
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
}, 1);

add_action('woocommerce_after_single_product_summary', function() {
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

    add_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 20);
    add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 10);
}, 1);

// Remove sidebar on single product pages
add_action( 'wp', function() {
    if ( is_product() ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    }
});

// add_action('highness_before_product_summary', 'woocommerce_template_single_title', 5 );
// add_action('highness_before_product_summary', 'woocommerce_template_single_rating', 10 );
// add_action('highness_before_product_summary', 'woocommerce_template_single_price', 10 );
// add_action('highness_before_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_filter('woocommerce_paypal_payments_single_product_renderer_hook', function() {
    return 'woocommerce_after_add_to_cart_form';
});

function highness_product_info() {
    global $product;

    echo '<div id="title">';
    woocommerce_template_single_title();

    $author = $product->get_attribute('pa_book-author');
    if(!empty($author)) {
        echo '<p class="product-author">';
        echo 'by ';
        echo esc_html($author);
        echo '</p>';
    }
    echo '</div>';

    woocommerce_template_single_rating();
    woocommerce_template_single_price();
    woocommerce_template_single_add_to_cart();
}

add_action('highness_before_product_summary', 'highness_product_info');


// Add and rename tabs

if ( !function_exists( 'highness_tab_content')) {
    function highness_tab_content () {
        wc_get_template('single-product/tabs/tab-content.php');
    }
} 

if ( !function_exists( 'highness_author_tab')) {
    function highness_author_tab () {
        wc_get_template('single-product/tabs/author.php');
    }
} 


add_filter( 'woocommerce_product_tabs', 'woo_edit_tabs', 98);

function woo_edit_tabs( $tabs ) {

    $tabs['description']['title'] = __('About this book');
    $tabs['description']['callback'] = 'highness_tab_content';

    $tabs['author'] = array(
        'title'         => __('About this author', 'woocommerce'),
        'priority'      => 10,
        'callback'      => 'highness_author_tab',
    );

    return $tabs;
}


// Custom Woocommerce Author Taxonomy

add_action ('init', 'register_woocommerce_custom_taxonomy');

function register_woocommerce_custom_taxonomy() {
    $text_domain = 'woocommerce';

    register_taxonomy( 'authors', array('product'), array(
        'labels' => array(
            'name' => _x('Authors', 'taxonomy general name', $text_domain),
            'singular_name' => _x('Author', 'taxonomy singular name', $text_domain),
            'search_items' => __('Search Authors', $text_domain),
            'all_items' => __('All Authors', $text_domain),
            'parent_item' => __('Parent Author', $text_domain),
            'parent_item_colon' => __('Parent Author:', $text_domain),
            'edit_item' => __('Edit Author', $text_domain),
            'update_item' => __('Update Author', $text_domain),
            'add_new_item' => __('Add New Author', $text_domain),
            'new_item_name' => __('New Author Name', $text_domain),
            'menu_name' => __('Authors', $text_domain),
        ),
        'hierarchical'      => true, // Like categories
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'author'),
    ) );
}

// Image upload for Author taxonomy

add_action( 'authors_add_form_fields', 'add_taxonomy_image_field', 10, 2 );
function add_taxonomy_image_field( $taxonomy ) {
    ?>
    <div class="form-field term-group">
        <label for="taxonomy-image-id"><?php _e( 'Image', 'woocommerce' ); ?></label>
        <input type="hidden" id="taxonomy-image-id" name="taxonomy-image-id" value="">
        <div id="taxonomy-image-wrapper"></div>
        <p>
            <input type="button" class="button button-secondary taxonomy-media-upload" id="taxonomy-media-upload" value="<?php _e( 'Add Image', 'woocommerce' ); ?>" />
            <input type="button" class="button button-secondary taxonomy-media-remove" id="taxonomy-media-remove" value="<?php _e( 'Remove Image', 'woocommerce' ); ?>" />
        </p>
    </div>
    <?php
}

add_action( 'authors_edit_form_fields', 'edit_taxonomy_image_field', 10, 2 );
function edit_taxonomy_image_field( $term, $taxonomy ) {
    $image_id = get_term_meta( $term->term_id, 'taxonomy-image-id', true );
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="taxonomy-image-id"><?php _e( 'Image', 'woocommerce' ); ?></label></th>
        <td>
            <input type="hidden" id="taxonomy-image-id" name="taxonomy-image-id" value="<?php echo esc_attr( $image_id ); ?>">
            <div id="taxonomy-image-wrapper">
                <?php if ( $image_id ) : ?>
                    <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
                <?php endif; ?>
            </div>
            <p>
                <input type="button" class="button button-secondary taxonomy-media-upload" id="taxonomy-media-upload" value="<?php _e( 'Add Image', 'woocommerce' ); ?>" />
                <input type="button" class="button button-secondary taxonomy-media-remove" id="taxonomy-media-remove" value="<?php _e( 'Remove Image', 'woocommerce' ); ?>" />
            </p>
        </td>
    </tr>
    <?php
}

add_action( 'created_authors', 'save_taxonomy_image_meta', 10, 2 );
add_action( 'edited_authors', 'save_taxonomy_image_meta', 10, 2 );

function save_taxonomy_image_meta( $term_id, $tt_id ) {
    if ( isset( $_POST['taxonomy-image-id'] ) && '' !== $_POST['taxonomy-image-id'] ) {
        update_term_meta( $term_id, 'taxonomy-image-id', absint( $_POST['taxonomy-image-id'] ) );
    } else {
        update_term_meta( $term_id, 'taxonomy-image-id', '' );
    }
}

add_action( 'admin_footer', 'taxonomy_image_script' );
function taxonomy_image_script() {
    ?>
    <script>
    jQuery(document).ready(function($){
        var frame;
        $('.taxonomy-media-upload').on('click', function(e){
            e.preventDefault();
            var button = $(this);
            if (frame) frame.close();
            frame = wp.media({
                title: 'Select or Upload Image',
                button: { text: 'Use this image' },
                multiple: false
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                $('#taxonomy-image-id').val(attachment.id);
                $('#taxonomy-image-wrapper').html('<img src="'+attachment.sizes.thumbnail.url+'" style="max-width:100%;"/>');
            });
            frame.open();
        });

        $('.taxonomy-media-remove').on('click', function(){
            $('#taxonomy-image-id').val('');
            $('#taxonomy-image-wrapper').html('');
        });
    });
    </script>
    <?php
}
