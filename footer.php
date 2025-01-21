<footer>
    <?php wp_nav_menu( array(
        'theme_location' => 'menu-footer',
        'menu_class' => 'link-footer',
        'container' => 'null',
    ) );
    ?>

    <!-- Lightbox HTML -->
<div id="lightbox-overlay">
  <div class="lightbox-content">
   
    <button class="lightbox-prev">
      <span class="arrow"></span>
      <span class="text"></span>
    </button>
    
    <img class="lightbox-image" src="" alt="">
    
    <div class="lightbox-info">
      <h3 class="lightbox-title"></h3>
      <span class="lightbox-category"></span>
    </div>
    
    <button class="lightbox-next">
    <span class="text"></span>
      <span class="arrow"></span>
    </button>
  </div>
  <span class="lightbox-close">&times;</span>
</div>


    <?php wp_footer(); ?>
</footer>

</body>
</html>