<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="site">
        <header>
            <div class="container header">
                <a href="#">
                    <div class="logo-container">
                        <?php
                            echo wp_get_attachment_image(
                                170,
                                "full",
                                "false",
                                array(
                                    "class" => "logo header",
                                    "alt"=>"highness logo",
                                )
                            );
                        ?>
                        <p>
                            Highness Publishing House
                        </p>
                    </div>
                </a>
                <nav class="nav-bar">
                    <div class="nav-container">
                        <ul class="nav-menu">
                            <li class="nav-item">Home</li>
                            <li class="nav-item">Catalogue</li>
                            <li class="nav-item">About Us</li>
                            <li class="nav-item">Contact Us</li>
                            <li class="nav-item cart">Cart</li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
