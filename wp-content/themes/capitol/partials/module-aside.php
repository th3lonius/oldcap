<aside class="container__col-sm-12 container__col-md-4">

<?php

    $args = array(
      'category_name' => 'quick-tips',
      'showposts'=> 6,
      'post__not_in' => array($post->ID)
    );

    $query = new WP_Query( $args );

?>

<?php if ( $query->have_posts() ) : ?>
  
  <article class="quick-tips container__row">
    
    <section class="container__col-sm-12">
      
      <h2 class="section-title">Quick Tips</h2>

      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    
    
      <h3 class="article-title"><a href="<?php the_permalink(); ?>" class="block"><?php the_title(); ?></a></h3>
      <date><?php the_date(); ?> @ <?php the_time(); ?></date>
      <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>

      <?php endwhile; ?>
      
    </section>
    
  </article>

<?php endif; ?>

<?php

    $args = array(
      'post_type' => 'recipes',
      'showposts'=> 6,
      'post__not_in' => array($post->ID)
    );

    $query = new WP_Query( $args );

?>

<?php if ( $query->have_posts() ) : ?>

    <article class="more-recipes container__row">
      
      <section class="container__col-sm-12">
      
        <h2 class="section-title">Latest Recipes</h2>

      <?php while ( $query->have_posts() ) : $query->the_post(); ?>

        <section class="container__col-sm-12">

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
        
      </section>
      
    </article>

  </aside>

<?php endif; ?>