<?php

/* Template Name: Recipes Page */

get_header();

?>

<main class="recipe-page">

<?php while ( have_posts() ) : the_post(); ?>
  
  <?php get_template_part( 'module', 'recipe--intro' ); ?>   

    <article class="container--fluid recipe">

      <?php get_template_part( 'module', 'recipe--abstract' ); ?>
      
      <section class="container__row">
      
        <?php get_template_part( 'module', 'recipe--ingredients' ); ?>

        <?php get_template_part( 'module', 'recipe--procedure' ); ?>
        
      </section>

<?php endwhile; ?>

  <?php get_template_part( 'module', 'more--recipes' ); ?>
      
    </article>

</main><!-- .interior -->

<?php get_footer(); ?>