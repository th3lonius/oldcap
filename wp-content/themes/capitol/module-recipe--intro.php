<?php include(locate_template('module-photo--header.php')); ?>
  
  <header class="intro-details">

    <span class="serving">Serving <?php the_field('servings'); ?></span>

    <h1 class="intro-title recipe-title"><?php the_title(); ?></h1>

    <?php $authors = get_field('author');

      if( $authors ): ?>

      <?php foreach( $authors as $author ): // variable must NOT be called $post (IMPORTANT) ?>

      <author>by 
        <?php if ($author->post_content == '') {
          echo get_the_title( $author->ID ); 
          } else { ?>
          <a href="<?php echo get_permalink( $author->ID ); ?>"><?php echo get_the_title( $author->ID ); ?></a></author>
        <?php } ?>

      <?php endforeach; ?>

      <?php endif; ?>

  </header>

<?php if ( function_exists( 'sharing_display' ) ) {
    sharing_display( '', true );
}
 
if ( class_exists( 'Jetpack_Likes' ) ) {
    $custom_likes = new Jetpack_Likes;
    echo $custom_likes->post_likes( '' );
} ?>

</section><!-- .intro-image -->