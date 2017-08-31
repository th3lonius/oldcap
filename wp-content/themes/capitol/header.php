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
    <title><?php wp_title( '|', true, 'right' ); ?>Old Capitol</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
    <?php wp_head(); ?>
    <script src="https://use.typekit.net/fae8swm.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="http://prod3.agileticketing.net/websales/agile_widget.ashx?orgid=2553&epgid=292&" type="text/javascript"></script>
  </head>

<?php if ( is_page( 'about' )) { ?>

  <body class="bg-grey">

<?php } else { ?>

  <body>
   
   <?php } ?>

    <header class="global-header push-menu-right">
      
      <section class="top-bar">
        <h2 class="top-bar--title">Old Capitol Food Co.  <span class="slogan">| Iowa City's tofu maker</span></h2>
        <button type="button" role="button" class="lines-button toggle-push-right"><span class="lines"></span></button>
      </section>

      <a href="<?php echo get_settings('home'); ?>" class="logo"><img src="<?php bloginfo('template_url'); ?>/img/rebrand.svg"/></a>

      <div class="nav-container">

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
              <li><a href="https://twitter.com/oldcapfoodco" class="twitter">Twitter</a></li>
              <li><a href="https://www.facebook.com/oldcapfoodco/" class="facebook">Facebook</a></li>
            </ul>

      </div>

    </header>