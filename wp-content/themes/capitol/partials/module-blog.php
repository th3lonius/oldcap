  <article class="module--blog">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <article>
    
      <header>
        <h1 class="article-title"><?php the_title() ?></h1>
        <date><?php the_time('F j, Y'); ?></date>
        <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>
      </header>
      
      <section class="content">
        <?php the_content(); ?>
      </section>
      
    </article>
        
    <?php endwhile; endif; ?>

  </article>
