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
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/remodal.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/remodal-default-theme.css">
    <?php wp_head(); ?>
    <script src="//use.typekit.net/dzw2wjm.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="http://prod3.agileticketing.net/websales/agile_widget.ashx?orgid=2553&epgid=292&" type="text/javascript"></script>
  </head>

  <body>
    
    <header class="global-header push-menu-right">
      
      <div class="header-content">

        <a href="#" class="logo"></a>

        <nav class="nav-main">
          <ul>
            <li><a href="#">Nutrition</a></li>
            <li><a href="#">Recipes</a></li>
            <li><a href="#">Find us</a></li>
            <li><a href="#">Mission</a></li>
            <li><a href="#">Holler</a></li>
            <li><a href="#">Blog</a></li>
          </ul>
        </nav>
      
      </div>
      
    </header>

    <button type="button" role="button" class="lines-button toggle-push-right"><span class="lines"></span></button>

    <main>