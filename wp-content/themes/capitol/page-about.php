<?php get_header(); ?>

<main class="container--fluid">

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
           
    <section data-type="background" data-speed="6" style="background-image: url(<?php echo $url; ?>);">

        <?php endif; ?>
            
    </section>
  
    <section class="container__row">
           
      <article class="contaniner__col-sm-12">

        <?php the_content(); ?>
        
        [wpgmza id="1"]

      </article>
    
    </section>
            
    <?php endwhile; ?>

    <?php else : ?>

  <?php endif; ?>

</main><!-- .interior -->

<?php get_footer(); ?>