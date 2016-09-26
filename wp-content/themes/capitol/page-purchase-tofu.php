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

    <article class="locations">

        <?php if( have_rows('location') ): ?>

      <section class="retail">

        <h2 class="section-title">Retail Locations</h2>

          <?php while ( have_rows('retail') ) : the_row(); ?>

            <a href="<?php the_sub_field('hyperlink'); ?>" target="_blank" class="contextual-link">
              <span><?php the_sub_field('name'); ?></span>
              <div>
              <?php while ( has_sub_field('addresses') ) : ?>
                <address><?php the_sub_field('address'); ?></address>
              <?php endwhile; ?>
              </div>
            </a>

          <?php endwhile; ?>

      </section>

      <section class="wholesale">

         <h2 class="section-title">Restaurants & Prepared Foods</h2>

            <?php while ( have_rows('wholesale') ) : the_row(); ?>

              <a href="<?php the_sub_field('hyperlink'); ?>" target="_blank" class="contextual-link">
                <span><?php the_sub_field('name'); ?></span>
                <div>
                <?php while ( has_sub_field('addresses') ) : ?>
                  <address><?php the_sub_field('address'); ?></address>
                <?php endwhile; ?>
                </div>
              </a>

            <?php endwhile; ?>

        </section>

        <?php endif; ?>

    </article><!-- .locations -->

    <?php endwhile; ?>

  <?php endif; ?>

</div><!-- .interior -->

<?php get_footer(); ?>
