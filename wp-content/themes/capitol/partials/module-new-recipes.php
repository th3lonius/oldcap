<?php

    $args = array(
      'post_type' => 'recipes',
      'showposts'=> 4,
      'post__not_in' => array($post->ID)
    );

    $query = new WP_Query( $args );

?>

<?php if ( $query->have_posts() ) : ?>

<section class="more-recipes container__col-sm-12">

  <section class="container__row">
    
    <header class="section-header">
      <h2 class="section-title st-recipes">Tofu Academy</h2>
      <small class="section-title--sub">The latest &amp; greatest tofu recipes</small>
    </header>

    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

      <article class="container__col-sm-12 container__col-md-6 container__col-lg-3 animated">

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

      </article>

    <?php endwhile; ?>

  </section>
      
</section>

<?php endif; ?>