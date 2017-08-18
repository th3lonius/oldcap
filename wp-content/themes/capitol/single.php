<?php get_header(); ?>

<main class="interior">

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
        $size = 'full';
        $thumb = $image['sizes'][ $size ];
        $width = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ];

        ?>
           
    <article class="intro-image" style="background-image: url(<?php echo $url; ?>);">

      <div class="caption">
        <h1 class="caption-text"><?php the_title(); ?></h1>
      </div>

    <?php endif; ?>
            
  </article>
           
  <article>
    
   <header>
        <?php previous_post_link( '%link', 'Older' ); ?>
        <?php next_post_link( '%link', 'Newer' );	?>
   </header>

    <section class="col-6-12 no-float">

      <?php the_content(); ?>

    </section>
      
  </article>
            
    <?php endwhile; ?>


    <?php else : ?>


  <?php endif; ?>

</main><!-- .interior -->

<?php get_footer(); ?>