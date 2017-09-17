<?php
get_header(); ?>

<main>

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php

        $image = get_field('photo');

        if( !empty($image) ):

          $size = 'large';
          $url = $image['sizes'][$size];

        ?>

    <section style="background-image: url(<?php echo $url; ?>);">

      <header class="intro-details">

        <h1 class="intro-title"><?php the_title(); ?></h1>

      </header>

        <?php endif; ?>

    </section>

    <article class="col-10-12 no-float">
     
      <section>
       
        <?php the_content(); ?>
        
      </section>
      
    </article>

    <?php endwhile; ?>

  <?php endif; ?>

</main><!-- .interior -->

<?php get_footer(); ?>