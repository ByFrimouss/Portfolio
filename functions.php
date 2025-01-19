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
