<?php get_header(); ?>

<main class="blogroll container--fluid">
  
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
    
  } ?>

  <?php if ( have_posts() ) : ?>
  
  <section class="container__row offset-top-margin--small">
    
   <nav>
      <?php previous_post_link( '%link', 'Older' ); ?>
      <?php next_post_link( '%link', 'Newer' );	?>
   </nav>

    <?php while ( have_posts() ) : the_post(); ?>
                              
    <article class="container__col-sm-12 container__col-md-8">
      
      <header>
        <h1 class="article-title"><?php the_title(); ?></h1>
        <date><?php the_date('F j, Y'); ?></date>
        <?php if ( function_exists( 'sharing_display' ) ) {
          sharing_display( '', true );
      }

      if ( class_exists( 'Jetpack_Likes' ) ) {
          $custom_likes = new Jetpack_Likes;
          echo $custom_likes->post_likes( '' );
      } ?>
        <ul class="post-categories">
          <?php
          $categories = get_the_category();
          $separator = ' ';
          $output = '';
          if($categories){
              foreach($categories as $category) {
          if($category->name !== 'Blogpost'){
                  $output .= '<li><a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></li>'.$separator;}
              }
          echo trim($output, $separator);
          }
          ?>
        </ul>
      </header>
      
      <img src="<?php echo $customphoto; ?>" />

      <section class="content-full">

        <?php the_content(); ?>

      </section>
      
      <cite>Written by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>

    </article>
            
    <?php endwhile; ?>
  
  </section>
  
  <?php endif; ?>

</main><!-- .blog -->

<?php get_footer(); ?>