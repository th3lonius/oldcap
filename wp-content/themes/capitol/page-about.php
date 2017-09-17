<?php get_header(); ?>

<main>

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

        <?php if( $caption ): ?>

          <div class="caption">

        <?php endif; ?>

            <?php if( $caption ): ?>

            <h1 class="caption-text"><?php echo $caption; ?></h1>

          </div>

            <?php endif; ?>

        <?php endif; ?>
            
    </section>
           
    <article class="col-6-12 no-float">
     
      <section>
      
        <?php the_content(); ?>
      
      </section>
      
    </article>
            
    <?php endwhile; ?>

    <?php else : ?>

  <?php endif; ?>

</main><!-- .interior -->

<?php get_footer(); ?>