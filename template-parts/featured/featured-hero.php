<?php
/**
 * Front page Featured Hero Section
 */
?>
<?php
$args = array(
    'limit' => 6,
    'tag' => array('featured'),
);

$products = wc_get_products($args);
?>

<?php if (!empty($products)): ?>
    <section class="featured-hero">
        <div class="section-wrap">
            <ul class="featured-list">
                <?php foreach ($products as $product): ?>
                    <li class="featured-item">
                        <?php $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'full'); ?>
                        <div class="image-wrap" style="background: no-repeat url('<?php echo $image_url[0]; ?>'); background-size: cover; background-position: center;">
                        </div>
                        <div class="card">
                            <div class="text-wrap">
                                <div class="excerpt">
                                    <h3><?php echo esc_html($product->get_short_description()) ?></h3>
                                </div>
                                <div class="title">
                                    <a href="">
                                        <h2><?php echo esc_html($product->get_name()) ?></h2>
                                    </a>
                                    <p>
                                        <?php 
                                            $terms = get_the_terms( $product -> get_id(), 'authors' );
                                            echo esc_html($terms[0] -> name);
                                        ?>
                                    </p>
                                    <p class="desc">
                                        <?php echo esc_html(get_post_meta( $product->get_id(), '_product_subtitle', true )) ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="btn-wrap">
                                <a href="<?php echo get_permalink( $product->get_id()); ?>" class="button">See More</a>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </section>
<?php endif ?>

