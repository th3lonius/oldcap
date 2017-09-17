<?php get_header(); ?>

<main class="blog">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
                              
  <article class="col-8-12 no-float">
    
    <header>
      <author>by <?php the_author(); ?> </author>
      <date> on <?php the_date(); ?> @ <?php the_time(); ?></date>
      <h1><?php the_title(); ?></h1>
    </header>

    <section>

      <?php the_content(); ?>

    </section>
      
  </article>
            
    <?php endwhile; ?>


    <?php else : ?>


  <?php endif; ?>

</main><!-- .blog -->

<?php get_footer(); ?>