<?php
/**
* A Simple Category Template
*/
 
get_header(); ?>

<main class="blogroll container">
 
  <section class="container__row">

    <?php if ( have_posts() ) : ?>
    
      <header>

        <h1 class="archive-title">Recent Posts in: <?php single_cat_title( '', true ); ?></h1>
        
      </header>

      <?php while ( have_posts() ) : the_post(); ?>

        <article class="container__col-sm-12 container__col-md-6 container__col-lg-4">

          <?php include(locate_template('module-photo--thumbnail.php')); ?>

          <h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title() ?></a></h4>
          <date><?php the_date('F j, Y'); ?></date>
          <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>

          <section class="content-block">
            <?php the_excerpt(); ?>
          </section>

        </article>
    
      <?php endwhile; ?>

    <?php endif; ?>

  </section>
  
</main>

<?php get_footer(); ?>