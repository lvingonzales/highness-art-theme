<?php 
/**
 * Front page Featured Hero Section
 */
?>

<?php 
    $home_text = get_field("home_intro")
?>

<section class="intro">
    <div class="container">
        <div class="image">
            <?php
                echo wp_get_attachment_image(
                    212,
                    "woocommerce-single",
                    "false",
                    array(
                        "class" => "",
                        "alt"=>"highness logo",
                    )
                );
            ?>
        </div>
        <div class="title">
            <h1> <?php echo esc_html($home_text["home_title"]); ?> </h1>
        </div>
        <div class="paragraph-wrap">
            <?php echo esc_html($home_text["home_desc"]); ?>
        </div>
    </div>
</section>
