<?php
get_header(); ?>

<div class="interior">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php

        $image = get_field('image');

        if( !empty($image) ):

            // vars
            $url = $image['url'];
            $title = $image['title'];
            $alt = $image['alt'];
            $caption = $image['caption'];

            // thumbnail
            $size = 'thumbnail';
            $thumb = $image['sizes'][ $size ];
            $width = $image['sizes'][ $size . '-width' ];
            $height = $image['sizes'][ $size . '-height' ];

        ?>

    <article class="intro-image" style="background-image: url(<?php echo $url; ?>);">

      <header class="intro-details">

        <h1 class="intro-title"><?php the_title(); ?></h1>

      </header>

        <?php endif; ?>

    </article>

    <article class="col-8-12 no-float">
      <?php the_content(); ?>
    </article>

    <?php endwhile; ?>

  <?php endif; ?>

</div><!-- .interior -->

<?php get_footer(); ?>
