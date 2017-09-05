<?php

/* Template Name: Recipes Page */

get_header();

?>

<main class="interior">

<?php while ( have_posts() ) : the_post(); ?>
  
  <?php get_template_part( 'module', 'recipe--intro' ); ?>   

    <article class="recipe">

      <?php get_template_part( 'module', 'recipe--abstract' ); ?>   
      
      <?php get_template_part( 'module', 'recipe--ingredients' ); ?>
      
      <?php get_template_part( 'module', 'recipe--procedure' ); ?>
      
    </article>

<?php endwhile; ?>

  <?php get_template_part( 'module', 'more--recipes' ); ?>

</main><!-- .interior -->

<?php get_footer(); ?>