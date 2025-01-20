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
