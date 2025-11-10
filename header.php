<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/3a35ceb387.js" crossorigin="anonymous"></script>
    <title>Highness Publishing House | <?php echo get_the_title() ?></title>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="site">
        <header class="main">
            <div class="container header">
                <a href="<?php echo esc_attr(get_permalink(16)); ?>" id="logo-header">
                    <div class="logo-container">
                        <?php
                        echo wp_get_attachment_image(
                            170,
                            "full",
                            "false",
                            array(
                                "class" => "logo header",
                                "alt" => "highness logo",
                            )
                        );
                        ?>
                    </div>
                </a>
                <a href="<?php echo esc_attr(get_permalink(16)); ?>" id="title-header">
                    <h3>
                        HIGHNESS GLOBAL PUBLISHING HOUSE
                    </h3>
                </a>
                <nav class="nav-bar">
                    <button class="nav-button menu"></button>
                    <div class="nav-container desktop">
                        <div class="nav-overlay"></div>
                        <div class="nav-content">
                            <button class="nav-button close"></button>
                            <?php
                            wp_nav_menu(array(
                                'menu' => 'header-menu',
                                'menu_class' => 'nav-menu',
                                'container' => false,
                            ))
                                ?>
                            <div class="logo-container">
                                <?php
                                echo wp_get_attachment_image(
                                    170,
                                    "full",
                                    "false",
                                    array(
                                        "class" => "logo nav",
                                        "alt" => "highness logo",
                                    )
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div class="main-content container">
