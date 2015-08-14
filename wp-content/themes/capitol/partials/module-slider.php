<?php
 
    $args = array(
      'pagename' => 'Homepage Featured'
    );

    $query = new WP_Query( $args );

?>

  <article class="home-page--slider">
    
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>

    <header>
      <h1 class="article-title"><?php the_field('heading') ?></h1>
    </header>
    
    <?php if( have_rows('slider') ): ?>

    <section class="slides-container">
     
     <?php while( have_rows('slider') ): the_row(); 

		// vars
		$image = get_sub_field('photo');

		?>
     
     <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
     
     <?php endwhile; ?>
     
    </section>
    
    <?php endif; ?>
    
    <?php endwhile; ?>

  </article>