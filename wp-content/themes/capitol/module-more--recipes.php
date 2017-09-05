<?php

    $args = array(
      'post_type' => 'recipes',
      'showposts'=> 6,
      'post__not_in' => array($post->ID)
    );

    $query = new WP_Query( $args );

?>

<?php if ( $query->have_posts() ) : ?>

  <article class="col-12-12 more-recipes">

  <?php while ( $query->have_posts() ) : $query->the_post(); ?>

    <section class="col-3-12 no-padding">

      <a href="<?php the_permalink(); ?>" class="block">
        
      <?php include(locate_template('module-photo--medium.php')); ?>

      <figure style="background-image: url(<?php echo $customphoto; ?>);"></figure>

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