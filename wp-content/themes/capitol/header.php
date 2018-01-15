<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package capitol
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, user-scalable=no">
    <title><?php wp_title( '-', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">
    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png?v=5Ae6nvablg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png?v=5Ae6nvablg">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/android-chrome-192x192.png?v=5Ae6nvablg">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon-16x16.png?v=5Ae6nvablg">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/manifest.json?v=5Ae6nvablg">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/safari-pinned-tab.svg?v=5Ae6nvablg" color="#5bbad5">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico?v=5Ae6nvablg">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/mstile-144x144.png?v=5Ae6nvablg">
    <meta name="theme-color" content="#ffffff">
    <!-- Scripts -->
    <script src="https://use.typekit.net/fae8swm.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <?php
      $image = get_field('photo');
      $size = 'medium';
      $customphoto = $image['sizes'][ $size ];
    ?>
    <meta name="twitter:image" content="<?php echo $customphoto; ?>"/>
    <?php wp_head(); ?>
  </head>

  <body>
   
    <header class="global-header">
      
      <button type="button" role="button" class="menu-toggle toggle-push-right">
        <span>Menu</span>
        <span>Close</span>
        <span class="lines"></span>
      </button>
        
      <a href="<?php echo get_settings('home'); ?>" class="logo"><img src="<?php bloginfo('template_url'); ?>/img/logo.svg"/></a>
      
      <section class="push-menu-right">

        <menu class="nav-container">

            <?php
              $defaults = array(
                'theme_location'  => '',
                'menu'            => 'main',
                'container'       => 'nav',
                'container_class' => 'nav-main',
                'menu_class'      => '',
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

              ?>

              <ul class="social">
                <li><a href="https://twitter.com/oldcapfoodco" class="twitter"><img src="<?php echo get_bloginfo('template_url') ?>/img/icon/twitter.svg"/></a></li>
                <li><a href="https://www.facebook.com/oldcapfoodco/" class="facebook"><img src="<?php echo get_bloginfo('template_url') ?>/img/icon/facebook.svg"/></a></li>
              </ul>

        </menu>
      
      </section>

    </header>