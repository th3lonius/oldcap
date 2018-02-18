<?php include(locate_template('module-photo--header.php')); ?>
  
  <header class="intro-details">

    <span class="serving">Serving <?php the_field('servings'); ?></span>
    
    <?php $authors = get_field('author');
  
      if( $authors ): ?>
    
        <?php if ( is_archive() ) { ?>

          <a href="<?php the_permalink(); ?>" class="block">
            <h1 class="intro-title recipe-title"><?php the_title(); ?><cite>&#169;</cite></h1>
          </a>

        <?php } else { ?>

          <h1 class="intro-title recipe-title"><?php the_title(); ?><cite>&#169;</cite></h1>

        <?php } ?>
    
    <?php foreach( $authors as $author ): // variable must NOT be called $post (IMPORTANT) ?>

      <author>by <?php if ($author->post_content == '') { echo get_the_title( $author->ID ); } else { echo get_the_title( $author->ID ); } ?></author>

      <?php endforeach; ?>

      <?php endif; ?>
      
      <?php
      if ( is_archive() ) {
        the_excerpt();
      }
      ?>

  </header>

<?php if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
}
 
if ( class_exists( 'Jetpack_Likes' ) ) {
    $custom_likes = new Jetpack_Likes;
    echo $custom_likes->post_likes( '' );
} ?>

</section><!-- .intro-image -->