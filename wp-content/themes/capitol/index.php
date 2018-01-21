<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * 
 */

get_header(); ?>

<main class="blogroll container">

  <section class="container__row">

    <?php if ( have_posts() ) : ?>

      <?php while ( have_posts() ) : the_post(); ?>
    
          <article class="container__col-sm-12 container__col-md-6 container__col-lg-4">

            <?php include(locate_template('module-photo--thumbnail.php')); ?>

            <h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
            <date><?php the_date('F j, Y'); ?> @ <?php the_time('g:ia'); ?></date>
            <cite>by <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></cite>

            <section class="content-block">
              <?php the_excerpt(); ?>
            </section>

          </article>

      <?php endwhile; ?>

    <?php else : ?>

      <?php get_template_part( 'content', 'none' ); ?>

    <?php endif; ?>

  </section>

</main>

<?php get_footer(); ?>