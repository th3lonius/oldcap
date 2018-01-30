<?php get_header(); ?>

<main class="container">
  
  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php

        $image = get_field('photo');

        if( !empty($image) ):

          $size = 'medium';
          $url = $image['sizes'][$size];

        ?>

    <section class="bg-image-intro imgblur" style="background-image: url(<?php echo $url; ?>);">

      <header class="intro-details">

        <h1 class="intro-title"><?php the_title(); ?></h1>

      </header>

        <?php endif; ?>

    </section>

    <article class="locations container__row">

        <?php if( have_rows('location') ): ?>

      <section class="retail container__col-sm-12 container__col-md-6">

        <h3 class="article-title">Retail Locations</h3>

        <?php while ( have_rows('retail') ) : the_row(); ?>

        <ol class="location">

          <li><a href="<?php the_sub_field('hyperlink'); ?>" target="_blank" class="contextual-link"><?php the_sub_field('name'); ?></a></li>

          <?php while ( has_sub_field('addresses') ) : ?>
          <li><address><?php the_sub_field('address'); ?></address></li>
          <?php endwhile; ?>

        </ol>  

        <?php endwhile; ?>

      </section>

      <section class="wholesale container__col-sm-12 container__col-md-6">

        <h3 class="article-title">Restaurants & Prepared Foods</h3>

        <?php while ( have_rows('wholesale') ) : the_row(); ?>

        <ol class="location">

          <li><a href="<?php the_sub_field('hyperlink'); ?>" target="_blank" class="contextual-link"><?php the_sub_field('name'); ?></a></li>

          <?php while ( has_sub_field('addresses') ) : ?>
          <li><address><?php the_sub_field('address'); ?></address></li>
          <?php endwhile; ?>

        </ol>

        <?php endwhile; ?>

      </section>

        <?php endif; ?>

    </article><!-- .locations -->

    <?php endwhile; ?>

  <?php endif; ?>
  
</main>

  <article class="bg-color-green-lt container__row">
  
    <?php get_template_part( 'partials/module', 'stores' ); ?>
    
  </article>

<?php get_footer(); ?>