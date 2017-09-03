<?php

/* Template Name: Authors Page */
/* Template Post Type: page */

get_header();

?>

<main class="interior author-page">
  
  <?php while ( have_posts() ) : the_post(); ?>
  
  <article class="author-page--bio col-10-12 no-float">
    
    <?php $image = get_field('avatar');
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
    
    <img class="avatar" src="<?php echo $url; ?>" />
    
    <?php endif; ?>

    <?php the_content(); ?>

  </article>
  
  <?php endwhile; ?>
  
  <article class="author-page--recipes col-10-12 no-float">  

  <?php while ( have_posts() ) : the_post(); ?>

  <?php 
    $recipes = get_posts(array(
      'post_type' => 'recipes',
      'meta_query' => array(
        array(
          'key' => 'author', // name of custom field
          'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
          'compare' => 'LIKE'
        )
      )
    ));
  ?>

  <?php if( $recipes ): ?>

    <?php foreach( $recipes as $recipe ): ?>
  
      <?php 

      $servings = get_field('servings', $recipe->ID);
      $image = get_field('photo', $recipe->ID);
      if( !empty($image) ):

          // vars
          $url = $image['url'];
          $title = $image['title'];
          $alt = $image['alt'];
          $caption = $image['caption'];

          // thumbnail
          $size = 'medium';
          $customphoto = $image['sizes'][ $size ];
          $width = $image['sizes'][ $size . '-width' ];
          $height = $image['sizes'][ $size . '-height' ];
      ?>

      <section class="col-4-12 no-padding">
        
        <a href="<?php echo get_permalink( $recipe->ID ); ?>" class="block">
        
          <figure style="background-image: url(<?php echo $customphoto; ?>);"></figure>

          <header class="intro-details">
            
            <span class="serving">Serving <?php echo $servings; ?></span>
            <h3 class="recipe-title"><?php echo get_the_title( $recipe->ID ); ?></h3>
            <author>by <?php the_title(); ?></author>

          </header>
          
        </a>

      </section>
    
      <?php endif; ?>

  <?php endforeach; ?>

  <?php endif; ?>

  <?php endwhile; ?>

<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
    
  </article>

</main><!-- .interior -->

<?php get_footer(); ?>