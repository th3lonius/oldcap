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

      <section>
       <?php the_content(); ?>
      </section>

      <section class="locations">

        <?php if( have_rows('location') ): ?>

          <?php while ( have_rows('location') ) : the_row(); ?>

          <div class="location col-4-12">
            <figure class="location-img" style="background-image: url(<?php the_sub_field('logo'); ?>)"></figure>
            <a href="<?php the_sub_field('hyperlink'); ?>" target="_blank"><h3 class="location-name"><?php the_sub_field('name'); ?></h3></a>
          </div>

          <?php endwhile; ?>

        <?php endif; ?>

      </section>

    </article>

    <?php endwhile; ?>

  <?php endif; ?>

</div><!-- .interior -->

<?php get_footer(); ?>
