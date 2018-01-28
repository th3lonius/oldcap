<?php

/* Template Name: Get in Touch Page */
/* Template Post Type: page */

get_header(); ?>

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
        $size = 'large';
        $thumb = $image['sizes'][ $size ];
        $width = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ];

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
        
        <?php echo do_shortcode('[wpgmza id="1"]'); ?>

      </article>
    
    </section>
            
    <?php endwhile; ?>

    <?php else : ?>

  <?php endif; ?>

</main><!-- .interior -->

<?php get_footer(); ?>