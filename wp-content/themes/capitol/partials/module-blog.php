<section class="module--blogroll container__col-sm-12 container__col-md-6">
  
<?php

    $args = array(
      'category_name' => 'blogpost',
      'showposts'=> 6,
      'post__not_in' => array($post->ID)
    );

    $query = new WP_Query( $args );

?>

  <?php if ( $query->have_posts() ) : ?>
  
  <article class="container__row">
    
    <section class="container__col-sm-12">
  
      <h2>Blogroll</h2>

      <?php while ( $query->have_posts() ) : $query->the_post(); ?>

      <article>

        <header>
          <h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
          <date><?php the_date(); ?> @ <?php the_time('F j, Y'); ?></date>
          <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>
        </header>

        <section>
          <?php the_excerpt(); ?>
        </section>

      </article>

    <?php endwhile; ?>
      
    </section><!-- .container__col-sm-12 -->
    
  </article><!-- .container__row -->
  
  <?php endif; ?>

</section><!-- .module--blogroll -->