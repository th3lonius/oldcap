<?php
  get_header();
?>

<main class="container--fluid">

  <?php get_template_part( 'partials/module', 'video' ); ?>
  
  <article class="container__row">

    <?php get_template_part( 'partials/module', 'blog' ); ?>

    <?php get_template_part( 'partials/module', 'aside' ); ?>
    
  </article>
  
</main>

<?php get_footer(); ?>