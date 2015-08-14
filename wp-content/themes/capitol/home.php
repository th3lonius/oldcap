<?php get_header(); ?>

<main class="interior">

  <article class="intro-image" data-type="background" data-speed="6" style="background-image: url(<?php echo $url; ?>);">

    <?php if ( have_posts() ) : ?>

        <?php /* Start the Loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; ?>


    <?php else : ?>

        <?php get_template_part( 'content', 'none' ); ?>

    <?php endif; ?>

  </article><!-- #content -->

</main><!-- .interior -->

<?php get_footer(); ?>