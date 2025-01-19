<?php
// Charger les styles du thème parent et du thème enfant
function portfolio_enqueue_styles() {
    // Charger le style du parent
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // Charger le style de l'enfant
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}
add_action( 'wp_enqueue_scripts', 'portfolio_enqueue_styles' );


////////// ENREGISTRER UN MENU POUR LE HEADER ET FOOTER /////////////

register_nav_menus(array(
    'Header Menu' => 'Menu Principal',
    'Footer Menu' => 'Menu Foot',
));

  ////////////// ACTIVER LE SUPPORT DU LOGO PERSONNALISÉ /////////////
  add_theme_support('custom-logo', array(
    'height'      => 60,
    'width'       => 60,
    'flex-height' => true,
    'flex-width'  => true,
));

/////// HERO AVEC LE SCRIPT DE CHARGEMENT D’UNE IMAGE ALÉATOIRE ///////////

function get_random_hero_image() {
    $upload_dir = wp_get_upload_dir(); // Récupère le répertoire des uploads
    $base_url = $upload_dir['baseurl']; // URL de base du dossier uploads

    // URL DES IMAGES
    $images = array(
        $base_url . '/2025/01/responsive.jpg',
        $base_url . '/2025/01/git.jpg',
        $base_url . '/2025/01/css.jpg',
        $base_url . '/2025/01/html.jpg',
        $base_url . '/2025/01/laptop.jpg',
        $base_url . '/2025/01/certifie.jpg',
        $base_url . '/2025/01/nodejs.jpg',
        $base_url . '/2025/01/chatgpt.jpg',
        $base_url . '/2025/01/code.jpg',
        $base_url . '/2025/01/php.jpg',
    );

    // Retourne une image aléatoire
    return $images[array_rand($images)];
}