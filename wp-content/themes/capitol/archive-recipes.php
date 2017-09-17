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

<main class="recipe-page">

<?php if ( $query->have_posts() ) : ?>

  <?php while ( $query->have_posts() ) : $query->the_post(); ?>
      
    <?php include(locate_template('module-photo--header.php')); ?>

      <h3 class="latest-tag">Latest Recipe</h3>

      <header class="intro-details">
        
        <span class="serving">Serving <?php the_field('servings'); ?></span>

        <a href="<?php the_permalink(); ?>" class="block">
          <h1 class="intro-title recipe-title"><?php the_title(); ?></h1>
        </a>
        
        <?php $authors = get_field('author');

        if( $authors ): ?>

        <?php foreach( $authors as $author ): // variable must NOT be called $post (IMPORTANT) ?>

        <author>by <a href="<?php echo get_permalink( $author->ID ); ?>"><?php echo get_the_title( $author->ID ); ?></a></author>

        <?php endforeach; ?>

        <?php endif; ?>

        <?php the_excerpt(); ?>

      </header>

    </section>

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
        
        <?php include(locate_template('module-photo--thumbnail.php')); ?>

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