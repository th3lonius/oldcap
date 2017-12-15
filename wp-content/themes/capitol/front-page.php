<?php
  get_header();
?>

<main>

  <?php get_template_part( 'partials/module', 'video' ); ?>

  <?php get_template_part( 'partials/module', 'blog' ); ?>

  <?php get_template_part( 'partials/module', 'latest-recipes' ); ?>
  
</main>

<?php get_footer(); ?>