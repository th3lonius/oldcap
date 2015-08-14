  <article class="module--blog">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <article>
    
      <header>
        <h1 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h1>
        <date><?php the_time( $d ); ?></date>
        <span>by <?php the_author(); ?></span>
      </header>
      
      <section class="content">
        <?php the_content(); ?>
      </section>
      
    </article>
        
    <?php endwhile; endif; ?>

  </article>