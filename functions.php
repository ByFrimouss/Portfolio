<?php
// Charger les styles du thème parent et du thème enfant
function portfolio_enqueue_styles() {
    // Charger le style du parent
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // Charger le style de l'enfant
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/script.js', array( 'parent-style' ) );
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

//////////////////////// ACF ///////////////////

// Enregistrer un template pour les CPT "Mes projets"
function portfolio_register_templates() {
    if (is_singular('mes_projets')) {
        include get_stylesheet_directory() . '/single.php';
        exit;
    }
}
add_action('template_redirect', 'portfolio_register_templates');

//////////////// AJAX POUR CHARGER PLUS //////////////////

function load_more_photos() {
    // Récupère les paramètres envoyés via AJAX

    $page = intval($_POST['page']);
    $posts_per_page = intval($_POST['posts_per_page']) ;

    // Arguments de requête WP_Query
    $args = array(
        'post_type'      => 'mes_projets', 
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

             // Récupérer les catégories associées
    $categories = get_the_terms(get_the_ID(), 'categorie'); // Changez 'categorie' si nécessaire
    if (!empty($categories) && !is_wp_error($categories)) {
        $category_name = esc_html($categories[0]->name);
    } else {
        $category_name = 'Non catégorisé';
    }

            ?>
            <article class="photo-item">
                <div class="photo-wrapper">
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('original', ['class' => 'photo-thumbnail']);
                    } else {
                        echo '<img src="' . get_stylesheet_directory_uri() . '/Images/placeholder.jpg" alt="Image non disponible" class="photo-thumbnail">';
                    }
                    ?>
                    <div class="photo-overlay">
                        <div class="photo-info">
                            <h3 class="photo-title"><?php the_title(); ?></h3>
                            <p class="photo-category">
                            <?php 
                            if ($categories) {
                                echo esc_html($categories[0]->name); // Affiche la première catégorie
                            } else {
                                echo 'Non catégorisé';
                            }
                            ?>
                            </p>
                        </div>
                        <div class="photo-icons">
                            <a href="<?php the_permalink(); ?>" class="icon icon-view" aria-label="Voir la page">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="icon icon-lightbox" data-photo-id="<?php echo get_the_ID(); ?>" aria-label="Voir dans la lightbox">
                                <i class="fas fa-expand"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            <?php
        }
    } else {
        echo ''; // Pas de contenu à charger
    }

    wp_reset_postdata();
    wp_die(); // Terminer l'exécution de la requête AJAX
}
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


/***************** CHARGEMENT DU SCRIPT POUR LOCALISER AJAX **************/

function enqueue_ajax_script() {
    // Charger votre script personnalisé
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1.0', true);

    // Localiser ajaxurl pour le script JS
    wp_localize_script('custom-script', 'ajax_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_script');

/***************** INCLURE JQUERY DEPUIS WORDPRESS **************/

function custom_enqueue_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

/******************* LIGHTBOX ************************/

function enqueue_lightbox_scripts() {
    wp_enqueue_style('lightbox-css', get_stylesheet_directory_uri() . '/lightbox.css', array(), '1.0', 'all');
    wp_enqueue_script('lightbox-js', get_stylesheet_directory_uri() . '/lightbox.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_scripts');