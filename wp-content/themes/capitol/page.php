<?php get_header(); ?>

<main class="container">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php

        $image = get_field('photo');

        if( !empty($image) ):

          $size = 'large';
          $url = $image['sizes'][$size];

        ?>

    <section class="bg-image-intro" style="background-image: url(<?php echo $url; ?>);">

      <header class="intro-details">

        <h1 class="intro-title"><?php the_title(); ?></h1>

      </header>

        <?php endif; ?>

    </section>
  
    <section class="container__row">

      <article class="container__col-sm-12">

        <?php the_content(); ?>

      </article>

    </section>

    <?php endwhile; ?>

  <?php endif; ?>

</main><!-- .interior -->

<?php get_footer(); ?>