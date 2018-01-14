<?php
  get_header();
?>

<main class="container--fluid">

  <?php get_template_part( 'partials/module', 'video' ); ?>
  
  <article class="clients-container container__row">
    
    <?php get_template_part( 'partials/module', 'clients' ); ?>
    
  </article>
  
  <article class="container__row">
    
    <?php get_template_part( 'partials/module', 'link--stores' ); ?>
  
  </article>
  
  <article class="container__row">

    <?php get_template_part( 'partials/module', 'blog' ); ?>
    
  </article>
  
  <article class="container__row">
    
    <h3 class="section-title st-quicktips">Quick Tips</h3>
    
    <?php get_template_part( 'partials/module', 'quick-tips' ); ?>
    
  </article>
  
  <article class="container__row">
    
    <?php get_template_part( 'partials/module', 'new-recipes' ); ?>
    
  </article>
  
  <article class="stores-container container__row">
  
    <?php get_template_part( 'partials/module', 'stores' ); ?>
    
  </article>
  
</main>

<?php get_footer(); ?>