<?php

/* Template Name: Author Bio */

get_header();

?>

<?php

   if(isset($_GET['author_name'])) :

        $curauth = get_userdatabylogin($author_name);

    else :

        $curauth = get_userdata(intval($author));

    endif;

?>

<div class="interior author-page">
  
  <article class="col-12-12 author-page--bio">

    <?php echo nl2br(get_the_author_meta( 'user_description' )); ?>

  </article>
  
  <article class="author-page--recipes">

  <?php

      $args = array(
        'post_type' => 'recipes',
        'author_name' => $curauth->nickname
      );

      $query = new WP_Query( $args );

  ?>

  <?php if ( $query->have_posts() ) : ?>

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

      <section class="intro-image" style="background-image: url(<?php echo $url; ?>);">

        <h3 class="latest-tag">Recipes by <?php echo $curauth->nickname; ?></h3>

        <header class="intro-details">

          <a href="<?php the_permalink(); ?>" class="block">
            <h1 class="intro-title recipe-title"><?php the_title(); ?></h1>
          </a>

          <span class="serving">Serving <?php the_field('servings'); ?></span>

          <?php the_excerpt(); ?>

        </header>

      </section>

      <?php endif; ?>

      <?php endwhile; else: ?>

      <p><?php _e('No posts by this author.'); ?></p>

  <?php endif; ?>
  
  </article>
  
</div><!-- .interior -->

<?php get_footer(); ?>