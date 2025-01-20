<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <!-- Lien pour les polices google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body>
<header>
    <nav>

    <!-- Logo -->
        <div class="logo">
            <?php the_custom_logo(); ?>
        </div>

        <!-- menu natif de wordpress -->
        <?php wp_nav_menu( array(
        'theme_location' => 'header-menu',
        'menu_class' => 'link-primary',
        'container_class' => 'menu',
        ) );
    ?>
    </nav>
</header>