<?php
get_header(); ?>

<main>
  
<?php

    $args = array(
        'orderby' => 'recipes'
    );

    $query = new WP_Query( $args );

?>

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php

        $image = get_field('photo');

        if( !empty($image) ):

          $size = 'medium';
          $url = $image['sizes'][$size];

        ?>

    <section style="background-image: url(<?php echo $url; ?>);">

      <header class="intro-details">

        <h1 class="intro-title"><?php the_title(); ?></h1>

      </header>

        <?php endif; ?>

    </section>

    <article class="locations">

        <?php if( have_rows('location') ): ?>

      <section class="retail col-6-12">

        <h3 class="section-title">Retail Locations</h3>

        <?php while ( have_rows('retail') ) : the_row(); ?>

        <ol class="location">

          <li><a href="<?php the_sub_field('hyperlink'); ?>" target="_blank" class="contextual-link"><?php the_sub_field('name'); ?></a></li>

          <?php while ( has_sub_field('addresses') ) : ?>
          <li><address><?php the_sub_field('address'); ?></address></li>
          <?php endwhile; ?>

        </ol>  

        <?php endwhile; ?>

      </section>

      <section class="wholesale col-6-12">

        <h3 class="section-title">Restaurants & Prepared Foods</h3>

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

</main><!-- .interior -->

<?php get_footer(); ?>