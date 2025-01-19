<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <!-- Lien pour les polices google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body>
<header>
    <nav>

        <!-- menu natif de wordpress -->
        <?php wp_nav_menu( array(
        'theme_location' => 'header-menu',
        'menu_class' => 'link-primary',
        'container_class' => 'menu',
        ) );
    ?>
    </nav>
</header>