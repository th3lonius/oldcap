<?php include(locate_template('module-photo--header.php')); ?>
  
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

</section><!-- .intro-image -->