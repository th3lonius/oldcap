<?php
  get_header();
?>

<?php get_template_part( 'partials/now', 'playing' ); ?>

<?php get_template_part( 'partials/showtimes' ); ?>

<?php get_template_part( 'partials/new', 'releases' ); ?>

<?php get_template_part( 'partials/active', 'series' ); ?>

<?php get_footer(); ?>