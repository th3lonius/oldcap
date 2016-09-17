<?php

/* Template Name: Recipes Page */

get_header();

?>

<div class="interior">

<?php while ( have_posts() ) : the_post(); ?>

    <?php $image = get_field('photo'); ?>
    <?php if( !empty($image) ):

        // vars
        $url = $image['url'];
        $title = $image['title'];
        $alt = $image['alt'];
        $caption = $image['caption'];

        // thumbnail
        $size = 'medium';
        $thumb = $image['sizes'][ $size ];
        $width = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ]; ?>

    <section class="intro-image" style="background-image: url(<?php echo $url; ?>);">

     <?php endif; ?>

      <header class="intro-details">

        <h1 class="recipe-title"><?php the_title(); ?></h1>

        <?php the_content(); ?>

      </header>

    </section>

    <article class="col-10-12 no-float">

      <section class="col-4-12 ingredients">

        <?php if( have_rows('ingredients') ): ?>

          <h3 class="section-title">Ingredients</h3>

          <ul>

          <?php while ( have_rows('ingredients') ) : the_row(); ?>

          <li>
            <span><?php the_sub_field('quantity'); ?></span>
            <span><?php the_sub_field('measurement'); ?></span>
            <span><?php the_sub_field('ingredient'); ?></span>
          </li>

          <?php endwhile; ?>

          </ul>

        <?php endif; ?>

      </section>

      <section class="col-8-12 directions">
        <h3 class="section-title">Directions</h3>
        <?php the_field('directions'); ?>
      </section>

    </article>

<?php endwhile; ?>


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

    <?php $image = get_field('photo'); ?>
    <?php if( !empty($image) ):

        // vars
        $url = $image['url'];
        $title = $image['title'];
        $alt = $image['alt'];
        $caption = $image['caption'];

        // thumbnail
        $size = 'medium';
        $thumb = $image['sizes'][ $size ];
        $width = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ]; ?>

    <section class="col-3-12">

    <?php endif; ?>

      <a href="<?php the_permalink(); ?>" class="block">

      <figure style="background-image: url(<?php echo $url; ?>);"></figure>

        <header class="intro-details">
          <h1 class="recipe-title"><?php the_title(); ?></h1>
        </header>

      </a>

    </section>

  <?php endwhile; ?>

  </article>


<?php endif; ?>

</div><!-- .interior -->

<?php get_footer(); ?>
