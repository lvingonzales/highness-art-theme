<?php 
/**
 * Front page Featured Hero Section
 */
?>

<section class="featured-hero">
    <div class="content">
        <div class="container">
            <div class="image-container">
                <?php
                    echo wp_get_attachment_image(
                        321,
                        "medium_large",
                        "false",
                        array(
                            "class" => "featured image",
                            "alt"=>"Two books and a cloth pouch bearing both the Stoned and Highness brand",
                            'sizes' => '(max-width: 768px) 100vw, (max-width: 1200px) 80vw, 1200px',
                        )
                    );
                ?>
            </div>
            <div class="card-container">
                <div class="text-content">
                    <div class="tagline"><h2>Edible Recipes for a Sophisticated Happy Hour</h2></div>
                    <div class="title-container">
                        <p class="title">Stoned</p>
                        <p class="author">Ann Allchin</p>
                    </div>
                    <div class="description">
                        <p>Discover STONED, the ultimate luxury coffee table cookbook that elevates the art of cannabis-infused cuisine...</p>
                    </div>
                </div>
                <button class="button see-more">See More</button>
            </div>
        </div>
    </div>
</section>
