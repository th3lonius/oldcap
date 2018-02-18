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
      
    <?php include(locate_template('module-photo--header.php')); ?>

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

<?php get_template_part( 'module', 'more--recipes' ); ?>

</main><!-- .recipe-page -->

<?php get_footer(); ?>