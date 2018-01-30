<?php get_header(); ?>

<main class="container">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php 

        $image = get_field('photo');

        if( !empty($image) ): 

        // vars
        $url = $image['url'];
        $title = $image['title'];
        $alt = $image['alt'];
        $caption = $image['caption'];

        // thumbnail
        $size = 'medium';
        $thumb = $image['sizes'][ $size ];
        $width = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ];

        ?>

    <section class="bg-image-intro imgblur" style="background-image: url(<?php echo $url; ?>);">

      <header class="intro-details">

        <h1 class="intro-title"><?php the_title(); ?></h1>

      </header>

        <?php endif; ?>

    </section>
  
    <section class="container__row">

      <article class="container__col-sm-12">

        <?php the_content(); ?>
        
        <?php if (is_page( 'Get In Touch' )) { ?>
        
          <?php echo do_shortcode('[wpgmza id="1"]'); ?>
        
        <?php } else {}; ?>

      </article>

    </section>

    <?php endwhile; ?>

  <?php endif; ?>

</main>

<?php get_footer(); ?>