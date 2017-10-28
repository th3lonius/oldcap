<?php
  get_header();
?>

<main>

<?php get_template_part( 'partials/module', 'video' ); ?>
  
</main>

<!--
<button type="button" role="button" class="blog-toggle toggle-push-right">
  <span>News & Updates</span>
  <span>Close</span>
</button>

<aside id="blogroll">
  
  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
  
      <ol>

        <li><a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a></li>
        <li><?php the_date(); ?> @ <?php the_time(); ?></li>
        <li><?php the_excerpt(); ?></li>

      </ol>
  
    <?php endwhile; ?>
  
  <?php endif; ?>
  
</aside>

-->

<?php get_footer(); ?>