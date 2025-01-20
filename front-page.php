<?php get_header(); ?>

<!---------------- HERO BANNER --------------->
<section class="hero-banner" style="background-image: url('<?php echo get_random_hero_image(); ?>');">
<div class="glassmorphism-container">
        <h1>Gr@ph'Web</h1>
    </div>
</section>

<section id="anchor-projet">
    <h2>Mes projets</h2>
</section>

<?php

/////////////// AFFICHER LES PROJETS ////////////////
$args = array(
    'post_type'      => 'mes_projets',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => 1,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div class="photo-gallery">';
    while ($query->have_posts()) : $query->the_post(); 
        $categories = get_the_terms(get_the_ID(), 'categorie'); // Récupère les catégories
        $contexte = get_field('contexte');   // Champ personnalisé (ACF)
        $voir_le_site = get_field('voir_le_site');              // Champ personnalisé (ACF)
        $description = get_field('description');              // Champ personnalisé (ACF)

        // Vérification de l'erreur pour les catégories
        if (!is_wp_error($categories) && !empty($categories)) {
            $category_name = esc_html($categories[0]->name);
        } else {
            $category_name = 'Non catégorisé';
        }
        ?>
        <article class="photo-item">
            <div class="photo-wrapper">
                <?php 
                // vérifie l'existence d'une image à la une
                if (has_post_thumbnail()) {
                    // Affiche l'image à la une et rajout de data-category directement à l'image
                    the_post_thumbnail('original', [
                        'class' => 'photo-thumbnail', 
                        'data-category' => !empty($categories) ? esc_attr($categories[0]->name) : 'Non catégorisé'
                    ]);
                } else {
                    echo '<img src="' . get_stylesheet_directory_uri() . '/Images/placeholder.jpg" alt="Image non disponible" class="photo-thumbnail" data-category="' . (!empty($categories) ? esc_attr($categories[0]->name) : 'Non catégorisé') . '">';
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
                        <!-- Icône pour aller à la page single-photo.php -->
                        <a href="<?php the_permalink(); ?>" class="icon icon-view" aria-label="Voir la page">
                            <i class="fas fa-eye"></i>
                        </a>
                        <!-- Icône pour ouvrir la lightbox -->
                        <a href="#" class="icon icon-lightbox" data-photo-id="<?php echo get_the_ID(); ?>" aria-label="Voir dans la lightbox">
                            <i class="fas fa-expand"></i>
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <?php endwhile;
    echo '</div>';
    echo '<button id="load-more-photos" data-page="2">Charger plus</button>'; // Le bouton "Charger plus" avec la page suivante
    wp_reset_postdata();
else :
    echo '<p>Aucune photo trouvée.</p>';
endif;


get_footer();?>