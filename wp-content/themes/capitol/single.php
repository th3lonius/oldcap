<?php get_header(); ?>

<main class="blog container--fluid">
  
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
  
  <section class="container__row">

    <?php while ( have_posts() ) : the_post(); ?>
                              
    <article class="container__col-sm-12 container__col-md-8">
      
      <img src="<?php echo $customphoto; ?>" />

      <header>
        <author>by <?php the_author(); ?> </author>
        <date> on <?php the_date(); ?> @ <?php the_time(); ?></date>
        <h1><?php the_title(); ?></h1>
      </header>

      <section>

        <?php the_content(); ?>

      </section>

    </article>
            
    <?php endwhile; ?>
  
  </section>
  
  <?php endif; ?>

</main><!-- .blog -->

<?php get_footer(); ?>