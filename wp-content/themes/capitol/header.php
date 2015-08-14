<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package filmscene
 */

error_reporting(E_ERROR | E_PARSE);
session_start();

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, user-scalable=no">
    <title><?php wp_title( '|', true, 'right' ); ?>Film Scene</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/remodal.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/remodal-default-theme.css">
    <?php wp_head(); ?>
    <script src="//use.typekit.net/dzw2wjm.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="http://prod3.agileticketing.net/websales/agile_widget.ashx?orgid=2553&epgid=292&" type="text/javascript"></script>
    <script type="text/javascript">
      /*----- AGILE SIGN OUT MESSAGE REPLACEMENT -----*/
      $(window).load(function(){
        var $loginEl = $('.nav-signin').children()
        var $signout = $loginEl.text();
        var $firstname = $signout.split(' ');
        if ( $signout.indexOf('Sign-Out') !== -1 ) {
          $loginEl.text('Hello, ' + $firstname[1]);
          $loginEl.hover(function(){
            $loginEl.text('Sign-Out');
          }, function() {
              $loginEl.text('Hello, ' + $firstname[1]);
          });
        }

        $('.nav-signin').animate({width:'toggle'},150);


      });
    </script>
  </head>

  <body>
    <div class="remodal-bg"></div>
    <div class="remodal" data-remodal-id="modal">
      <button data-remodal-action="close" class="remodal-close"></button>
      <div class="video-container">
        <iframe id="youtube" src=""></iframe>
      </div>
    </div>

    <header class="global-header push-menu-right">

      <h1 class="logotype">Filmscene</h1>

      <nav class="nav-main">
        <?php
          $defaults = array(
            'theme_location'  => '',
            'menu'            => 'community-menu',
            'container'       => false,
            'container_class' => '',
            'menu_class'      => 'nav-secondary',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
          );

          wp_nav_menu( $defaults );

          $film_menu = array(
            'theme_location'  => '',
            'menu'            => 'film-menu',
            'container'       => false,
            'container_class' => '',
            'menu_class'      => 'nav-primary',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
          );

          wp_nav_menu( $film_menu );
        ?>

      </nav>
      <?php

        $annargs = array(
          'post_type' =>      'announcement',
          'numberposts'=>     1,
          'posts_per_page'=>  1,
          'post_status'=>     'publish'
        );
        $announcement = new WP_Query( $annargs );
        // remove_filter('the_content', 'wpautop');
        if ( $announcement->have_posts() && $_SESSION['annID'] != $announcement->get_posts()[0]->ID ) while ( $announcement->have_posts() ) : $announcement->the_post();
      ?>
        <div rel="<?php echo($post->ID); ?>" class="announcement">
          <p><?php the_title(); ?></p>
          <section><?php the_content(); ?></section>
          <button id="ann-exit" type="button" role="button" class="lines-button toggle-push-right"><span class="lines"></span></button>
        </div>
      <?php
        endwhile;
        wp_reset_postdata();
      ?>
    </header>

    <button type="button" role="button" class="lines-button toggle-push-right"><span class="lines"></span></button>

   <main>