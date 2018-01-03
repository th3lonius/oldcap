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
  
  <article class="primary-container container__row">

    <?php get_template_part( 'partials/module', 'blog' ); ?>

    <?php get_template_part( 'partials/module', 'aside' ); ?>
    
  </article>
  
  <article class="stores-container container__row">
  
    <?php get_template_part( 'partials/module', 'stores' ); ?>
    
  </article>
  
</main>

<?php get_footer(); ?>