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

<main class="interior">

<?php if ( $query->have_posts() ) : ?>

  <?php while ( $query->have_posts() ) : $query->the_post(); ?>

    <?php get_template_part( 'module', 'photo--page-header' ); ?>

      <h3 class="latest-tag">Latest Recipe</h3>

      <header class="intro-details">

        <a href="<?php the_permalink(); ?>" class="block">
          <h1 class="intro-title recipe-title"><?php the_title(); ?></h1>
        </a>
        
        <span class="serving">Serving <?php the_field('servings'); ?></span>

        <?php the_excerpt(); ?>

      </header>

    </article>

  <?php endwhile; ?>

<?php endif; ?>


<?php

    $args = array(
      'post_type' => 'recipes',
      'offset' => 1
    );

    $query = new WP_Query( $args );

?>

<?php if ( $query->have_posts() ) : ?>

  <article class="col-12-12 more-recipes">

  <?php while ( $query->have_posts() ) : $query->the_post(); ?>

    <section class="col-3-12 no-padding">

      <a href="<?php the_permalink(); ?>" class="block">
        
        <?php get_template_part( 'module', 'photo--thumbnail' ); ?>

        <header class="intro-details">
          <span class="serving">Serving <?php the_field('servings'); ?></span>
          <h3 class="recipe-title"><?php the_title(); ?></h3>
          
        <?php $authors = get_field('author');

          if( $authors ): ?>
        
          <?php foreach( $authors as $author ): // variable must NOT be called $post (IMPORTANT) ?>
                          
          <author>by <?php echo get_the_title( $author->ID ); ?></author>
        
          <?php endforeach; ?>
        
          <?php endif; ?>

        </header>
        
      </a>

    </section>

  <?php endwhile; ?>

  </article>

<?php endif; ?>

</main><!-- .interior -->

<?php get_footer(); ?>