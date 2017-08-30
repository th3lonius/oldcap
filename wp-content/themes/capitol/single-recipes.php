<?php

/* Template Name: Recipes Page */

get_header();

?>

<main class="interior">

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
        
        <span class="serving">Serving <?php the_field('servings'); ?></span>

        <h1 class="intro-title recipe-title"><?php the_title(); ?></h1>

        <?php $authors = get_field('author');

          if( $authors ): ?>
        
          <?php foreach( $authors as $author ): // variable must NOT be called $post (IMPORTANT) ?>
                          
          <author>by <a href="<?php echo get_permalink( $author->ID ); ?>"><?php echo get_the_title( $author->ID ); ?></a></author>
        
          <?php endforeach; ?>
        
          <?php endif; ?>
    
      </header>

    </section>

    <article>
      
      <?php if ( $post->post_content!=="" ) { ?>
      
        <section class="col-12-12 abstract">

          <?php the_content(); ?>

        </section>
        
      <?php } ?>

      <section class="col-4-12 ingredients">

        <?php if( have_rows('ingredients') ): ?>

          <h3 class="recipe-section-title">Ingredients</h3>

          <ul>

          <?php while ( have_rows('ingredients') ) : the_row(); ?>

          <li>
            <span class="quantity">
              <?php
              
              $output = get_sub_field('quantity');
              $fraction = decimalToFraction($output);
              
              if (is_float($output)) {
                
              echo $fraction[0];?>/<?php echo $fraction[1];
                
              } else {
                echo the_sub_field('quantity');
              }
              ?>
            </span>
            
            <span class="measurement"><?php the_sub_field('measurement'); ?></span>
            
            <span class="ingredient"><?php the_sub_field('ingredient'); ?></span>
            
          </li>

          <?php endwhile; ?>

          </ul>
        
        <p>*<?php the_field('ingredient_notes'); ?></p>

        <?php endif; ?>

      </section>

      <section class="col-8-12 procedure">
        
        <section>
          
          <h3 class="recipe-section-title">Directions</h3>

          <?php the_field('directions'); ?>
          
        </section>
        
        <?php if( get_field('cooking_tips') ): ?>
        
          <section>

            <h3 class="recipe-section-title">Cooking Tips</h3>

            <?php the_field('cooking_tips'); ?>

          </section>
        
        <?php endif; ?>
        
        <?php if( get_field('serving_tips') ): ?>
        
          <section>

            <h3 class="recipe-section-title">Serving Tips</h3>

            <?php the_field('serving_tips'); ?>

          </section>
        
        <?php endif; ?>
        
        <?php if( get_field('variations') ): ?>
        
          <section>

            <h3 class="recipe-section-title">Variations</h3>

            <?php the_field('variations'); ?>

          </section>
        
        <?php endif; ?>
        
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

    <section class="col-3-12 no-padding">

    <?php endif; ?>

      <a href="<?php the_permalink(); ?>" class="block">

      <figure style="background-image: url(<?php echo $url; ?>);"></figure>

        <header class="intro-details">
          <span class="serving">Serving <?php the_field('servings'); ?></span>
          <h3 class="recipe-title"><?php the_title(); ?></h3>
          <author>by <?php the_author(); ?></author>
        </header>

      </a>

    </section>

  <?php endwhile; ?>

  </article>


<?php endif; ?>

</main><!-- .interior -->

<?php get_footer(); ?>