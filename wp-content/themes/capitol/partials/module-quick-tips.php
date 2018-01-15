<?php

    $args = array(
      'category_name' => 'quick-tips',
      'showposts'=> 6,
      'post__not_in' => array($post->ID)
    );

    $query = new WP_Query( $args );

?>

<?php if ( $query->have_posts() ) : ?>

<section class="quick-tips container__col-sm-12 container__col-md-4">

      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    
    
      <h3 class="article-title"><a href="<?php the_permalink(); ?>" class="block"><?php the_title(); ?></a></h3>
      <date><?php the_date(); ?> @ <?php the_time(); ?></date>
      <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>

      <?php endwhile; ?>

<?php endif; ?>