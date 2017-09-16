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

    <section class="col-3-12 no-padding">

      <a href="<?php the_permalink(); ?>" class="block">
        
        <?php $image = get_field('photo');

          if( !empty($image) ){

            // vars
            $url = $image['url'];
            $title = $image['title'];
            $alt = $image['alt'];
            $caption = $image['caption'];

            // thumbnail
            $size = 'large';
            $customphoto = $image['sizes'][ $size ];
            $width = $image['sizes'][ $size . '-width' ];
            $height = $image['sizes'][ $size . '-height' ];

            ?>

              <figure style="background-image: url(<?php echo $customphoto; ?>);"></figure>

          <?php } else {

            $args = array(
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'tag' => 'fields',
                'posts_per_page' => 1,
                'fields' => 'ids',
                'orderby' => 'rand'
            );

            $randimage = new WP_Query( $args );

            if( $randimage->have_posts() ){
                $image_attributes = wp_get_attachment_image_src( $randimage->posts[0], 'medium' );
            ?>
            <figure style="background-image: url(<?php echo $image_attributes[0]; ?>);"></figure>

        <?php }

          } ?>  

        <header class="intro-details">
          <span class="serving">Serving <?php the_field('servings'); ?></span>
          <h3 class="recipe-title"><?php the_title(); ?></h3>
          
        <?php $authors = get_field('author');

          if( $authors ): ?>
        
          <?php foreach( $authors as $author ): // variable must NOT be called $post (IMPORTANT) ?>
                          
          <author>by <?php echo get_the_title( $author->ID ); ?></author>
        
          <?php endforeach; ?>
        
          <?php endif; ?>

        </header>

      </a>

    </section>

  <?php endwhile; ?>

  </article>

<?php endif; ?>