<?php

/* Template Name: Recipes Archive */

get_header();

?>

<?php

    $args = array(
      'post_type' => 'recipes',
      'posts_per_page' => 1
    );

    $query = new WP_Query( $args );

?>

<main class="recipe-page container--fluid">

<?php if ( $query->have_posts() ) : ?>

  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
  
    <?php get_template_part( 'module', 'recipe--intro' ); ?>   

  <?php endwhile; ?>

<?php endif; ?>

<?php get_template_part( 'module', 'more--recipes' ); ?>

</main><!-- .recipe-page -->

<?php get_footer(); ?>