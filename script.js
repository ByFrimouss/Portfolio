/////////////// AJAX POUR CHARGER PLUS //////////////////////

jQuery(document).ready(function ($) {
  $("#load-more-photos").on("click", function () {
    var button = $(this);
    var page = button.data("page"); // Récupère la page suivante
    var data = {
      action: "load_more_photos", // L'action AJAX
      page: page,
      posts_per_page: 4, // Nombre de photos supplémentaires à charger
    };

    $.ajax({
      url: ajax_object.ajaxurl, // URL pour l'appel AJAX (définie automatiquement par WordPress)
      type: "POST",
      data: data,
      beforeSend: function () {
        button.text("Chargement..."); // Change le texte du bouton pendant le chargement
      },
      success: function (response) {
        if (response) {
          // Ajoute les nouvelles photos à la galerie
          $(".photo-gallery").append(response);
          button.text("Charger plus"); // Remet le texte du bouton
          button.data("page", page + 1); // Met à jour la page pour la prochaine requête
        }
      },
    });
  });
});

/////////////// ANIMATION SUR LES TITRES DES SECTIONS //////////////////////

document.addEventListener("DOMContentLoaded", function () {
  const target = document.querySelector("#anchor-projet h2");

  // Crée un observateur
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          target.classList.add("visible"); // Ajoute la classe quand visible
          observer.unobserve(target); // Stoppe l'observation une fois visible
        }
      });
    },
    {
      threshold: 0.1, // L'élément doit être visible à 50%
    }
  );

  observer.observe(target); // Observe l'élément
});

////////////// PARALLAX ///////////////
document.addEventListener("DOMContentLoaded", () => {
  // Sélectionner les titres
  const titre = document.querySelector(".title");
  const sousTitre = document.querySelector(".subtitle");
  const placeSection = document.querySelector(".header-photo");

  // Fonction qui ajuste la position des titres en fonction du scroll dans la section "a propos"
  function moveTitle() {
    // Obtenir la position de la section "a propos" par rapport au haut de la page
    const sectionTop = placeSection.offsetTop;
    const sectionHeight = placeSection.offsetHeight;
    const scrollPosition = window.scrollY;

    // Vérifier si le scroll est dans la section "a propos"
    if (
      scrollPosition >= sectionTop &&
      scrollPosition <= sectionTop + sectionHeight
    ) {
      // Calculer le pourcentage de scroll dans la section "a propos"
      const scrollInSection = scrollPosition - sectionTop;
      const sectionScrollRatio = scrollInSection / sectionHeight;

      // Ajuster les déplacements pour que les titres descendent vers le bas
      const maxMove = sectionHeight - 120; // Limite à la hauteur de la section avec une marge de 20px
      const moveTitre = Math.min(sectionScrollRatio * maxMove, maxMove);
      const moveSousTitre = Math.min(sectionScrollRatio * maxMove, maxMove);

      // Appliquer la transformation pour déplacer les titres
      titre.style.transform = `translateY(${moveTitre}px)`;
      sousTitre.style.transform = `translateY(${moveSousTitre}px)`;
    }
  }

  // Attacher la fonction au scroll de la fenêtre
  window.addEventListener("scroll", moveTitle);
});
