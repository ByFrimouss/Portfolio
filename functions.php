<?php

// Fonction pour l'enregistrement des styles et scripts
function theme_enqueue_styles() {
    // Enqueue du style du thème parent
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // Enqueue du style du thème enfant, avec comme dépendance le style du thème parent
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));

    // Si vous avez un script JavaScript spécifique dans le thème enfant
    if ( file_exists( get_stylesheet_directory() . '/script.js' ) ) {
        wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/script.js', array(), false, true);
    }
}

// Attacher la fonction à l'action 'wp_enqueue_scripts'
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


