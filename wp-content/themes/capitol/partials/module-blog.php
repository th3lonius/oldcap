<section class="blogroll container__col-sm-12 container__col-md-12">
  
<?php

    $args = array(
      'category_name' => 'blogpost',
      'showposts'=> 6
    );

    $query = new WP_Query( $args );

?>

  <?php if ( $query->have_posts() ) : ?>
  
  <h3 class="section-title st-blogroll">Blogroll</h3>
  
      <div class="horizontal-scroll-container">

        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

        <article>

          <header>
            <h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
            <date><?php the_date('F j, Y'); ?> @ <?php the_time('g:ia'); ?></date>
            <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>
          </header>

          <section class="content-block">
            <?php the_excerpt(); ?>
          </section>

        </article>

      <?php endwhile; ?>
        
      </div>
  
  <?php endif; ?>

</section><!-- .module--blogroll -->