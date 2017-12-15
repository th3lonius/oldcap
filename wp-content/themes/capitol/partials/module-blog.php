<section class="module--blogroll col-6-12">

  <?php if ( have_posts() ) : ?>
  
  <h3>Blogroll</h3>

    <?php while ( have_posts() ) : the_post(); ?>

  <article>

    <header>
      <h1 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
      <date><?php the_date(); ?> @ <?php the_time('F j, Y'); ?></date>
      <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>
    </header>

    <section>
      <?php the_excerpt(); ?>
    </section>

  </article>

    <?php endwhile; ?>
  
  <?php endif; ?>

</section>