<?php
  get_header();
?>

<main class="container--fluid">

  <?php get_template_part( 'partials/module', 'video' ); ?>
  
  <article class="clients-container container__row">
    
    <?php get_template_part( 'partials/module', 'clients' ); ?>
    
  </article>
  
  <article class="container__row arrow-down">
    
    <?php get_template_part( 'partials/module', 'link--stores' ); ?>
  
  </article>
  
  <article class="container__row">
    
    <?php get_template_part( 'partials/module', 'our-story' ); ?>
    
  </article>
  
  <article class="container__row">
    
    <?php get_template_part( 'partials/module', 'new-recipes' ); ?>
    
  </article>
  
  <article class="container__row">

    <?php get_template_part( 'partials/module', 'blog' ); ?>
    
  </article>
  
  <article class="bg-color-green-lt container__row">
  
    <?php get_template_part( 'partials/module', 'stores' ); ?>
    
  </article>
  
</main>

<?php get_footer(); ?>