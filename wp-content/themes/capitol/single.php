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
  
  <section class="container__row">

    <?php while ( have_posts() ) : the_post(); ?>
                              
    <article class="container__col-sm-12 container__col-md-8">
      
      <header>
        <h1 class="article-title"><?php the_title(); ?></h1>
        <date><?php the_date('F j, Y'); ?> @ <?php the_time('g:ia'); ?></date>
        <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>
      </header>
      
      <img src="<?php echo $customphoto; ?>" />

      <section>

        <?php the_content(); ?>

      </section>

    </article>
            
    <?php endwhile; ?>
  
  </section>
  
  <?php endif; ?>

</main><!-- .blog -->

<?php get_footer(); ?>