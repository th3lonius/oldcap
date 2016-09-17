<?php
get_header(); ?>

<div class="interior">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php

        $image = get_field('image');

        if( !empty($image) ):

          $size = 'medium';
          $url = $image['sizes'][$size];

        ?>

    <article class="intro-image" style="background-image: url(<?php echo $url; ?>);">

      <header class="intro-details">

        <h1 class="intro-title"><?php the_title(); ?></h1>

      </header>

        <?php endif; ?>

    </article>

    <article class="col-10-12 no-float">

      <section class="col-6-12">
       <?php the_content(); ?>
      </section>

      <section class="locations col-6-12">

        <?php if( have_rows('location') ): ?>

         <h4>Restaurants & Prepared Foods</h4>

          <ul>

            <?php while ( have_rows('location') ) : the_row(); ?>

            <li class="location">
              <a href="<?php the_sub_field('hyperlink'); ?>" target="_blank"><?php the_sub_field('name'); ?></a>
            </li>

            <?php endwhile; ?>

          </ul>

        <?php endif; ?>

      </section>

    </article>

    <?php endwhile; ?>

  <?php endif; ?>

</div><!-- .interior -->

<?php get_footer(); ?>
