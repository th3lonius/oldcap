<?php

/**
 * filmscene functions and definitions
 *
 * @package filmscene
 */

if ( ! function_exists( 'filmscene_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

add_action('get_data','retrieve_agile_data');

function retrieve_agile_data(){
    $response = wp_remote_get( 'http://prod3.agileticketing.net/WebSales/feed.ashx?guid=22de01b4-eae0-4755-a8d4-6c879ee0cec5&showslist=true&withmedia=true' );
    $content = trim( wp_remote_retrieve_body( $response ) );
    $content = simplexml_load_string( $content, null, LIBXML_NOCDATA );
    $films = $content->ArrayOfShows->Show;
    foreach($films as $film){
        // sets up a query to check whether the films
        // we're trying to add have already been created
        $args = array(
        'post_type' => 'film',
        'meta_query' => array(
           array(
               'key' => 'agileid',
               'value' => intval($film->ID)
           )
        ),
        'fields' => 'ids'
        );

        $query = new WP_Query( $args );
        $duplicates = $query->posts;

        // if we've already created a film post for this film, update showings
        if ( ! empty( $duplicates ) ) {
            $showings = $film->CurrentShowings->Showing;
            foreach($showings as $showing){
                // sets up a query to check whether the showings
                // we're trying to add have already been created
                $showargs = array(
                    'post_type' => 'showing',
                    'meta_query' => array(
                       array(
                           'key' => 'showingid',
                           'value' => intval($showing->ID)
                       )
                    ),
                    'fields' => 'ids'
                );

                $showquery = new WP_Query( $showargs );
                $showduplicates = $showquery->posts;

                // if we've already created a showing post for this film, update showings
                if ( ! empty( $showduplicates ) ) {

                } else {
                    $new_show = array(
                        'post_title'    => (string)$film->Name,
                        'post_type'     => 'showing',
                        'post_status'   => 'publish'
                    );
                    $show_id = wp_insert_post($new_show, True);

                    if ( is_wp_error($show_id) ){

                    }
                    else {
                        update_post_meta($show_id, 'filmid', intval($film->ID), True);
                        update_post_meta($show_id, 'showingid', intval($showing->ID), True);
                        update_post_meta($show_id, 'startdate', strtotime((string)$showing->StartDate));
                        update_post_meta($show_id, 'enddate', strtotime((string)$showing->EndDate));
                        update_post_meta($show_id, 'buylink', (string)$showing->LegacyPurchaseLink);
                    }
                }
            }
        } else {
            $agileID = $film->ID;
            $name = $film->Name;
            $desc = $film->ShortDescription;

            $fixedname = ucwords(strtolower(preg_replace("/-\s[\p{L}\s]+/u", "", $name)));

            $new_film = array(
                'post_title'    => $fixedname,
                'post_content'  => $desc,
                'post_type'     => 'film',
                'post_status'   => 'publish'
            );
            $post_id = wp_insert_post($new_film, True);

            if ( is_wp_error($post_id) ){

            }
            else {
                $custom_props = $film->CustomProperties->CustomProperty;
                $directors = array();
                $prod_countries = array();
                $series = '';
                foreach($custom_props as $cp){
                    if($cp->Name == 'Director'){
                        $directors[] = (string)$cp->Value;
                    }
                    if($cp->Name == 'Year Released'){
                        $year_rel = intval($cp->Value);
                    }
                    if($cp->Name == 'Production Country'){
                        $prod_countries[] = (string)$cp->Value;
                    }
                    if($cp->Name == 'Series'){
                        $series = (string)$cp->Value;
                    }
                }

                $medias = $film->AdditionalMedia->Media;
                foreach($medias as $media){
                    if($media->Type == 'YouTube'){
                        $trailer = (string)$media->Value;
                    }
                }

                // If this film has a series, and that series is not an existing category
                if( $series != '' ) {
                    $cat = term_exists($series, 'category');
                    if ( $cat ) {
                        wp_set_object_terms($post_id, array(intval($cat['term_id'])), 'category');
                    } else {
                        // Create that new series category
                        $new_cat = wp_insert_term(
                            $series,
                            'category',
                            array(
                                'parent' => 4
                            )
                        );
                        // Set the film's category to the newly created series
                        wp_set_object_terms($post_id, array($new_cat['term_id']), 'category');
                    }
                }

                update_post_meta($post_id, 'agileid', intval($film->ID), True);
                update_post_meta($post_id, 'thumb_image', (string)$film->ThumbImage);
                update_post_meta($post_id, 'event_image', (string)$film->EventImage);
                update_post_meta($post_id, 'infolink', (string)$film->InfoLink);
                update_post_meta($post_id, 'director', implode(",", $directors));
                update_post_meta($post_id, 'year_released', $year_rel);
                update_post_meta($post_id, 'production_country', implode(",", $prod_countries));
                update_post_meta($post_id, 'trailer', $trailer);

                $showings = $film->CurrentShowings->Showing;
                foreach($showings as $showing){
                    // sets up a query to check whether the showings
                    // we're trying to add have already been created
                    $showargs = array(
                        'post_type' => 'showing',
                        'meta_query' => array(
                           array(
                               'key' => 'showingid',
                               'value' => intval($showing->ID)
                           )
                        ),
                        'fields' => 'ids'
                    );

                    $showquery = new WP_Query( $showargs );
                    $showduplicates = $showquery->posts;

                    // if we've already created a unique showing post for this film, don't update showings
                    if ( ! empty( $showduplicates ) ) {

                    } else {
                        $new_show = array(
                            'post_title'    => (string)$film->Name,
                            'post_type'     => 'showing',
                            'post_status'   => 'publish'
                        );
                        $show_id = wp_insert_post($new_show, True);

                        if ( is_wp_error($show_id) ){

                        }
                        else {
                            update_post_meta($show_id, 'filmid', intval($film->ID), True);
                            update_post_meta($show_id, 'showingid', intval($showing->ID), True);
                            update_post_meta($show_id, 'startdate', strtotime((string)$showing->StartDate));
                            update_post_meta($show_id, 'enddate', strtotime((string)$showing->EndDate));
                            update_post_meta($show_id, 'buylink', (string)$showing->LegacyPurchaseLink);

                            if( $series != '' ) {
                                $cat = term_exists($series, 'category');
                                if ( $cat ) {
                                    wp_set_object_terms($show_id, array(intval($cat['term_id'])), 'category');
                                }
                            }

                        }
                    }
                }
            }
        }

    }
}

add_action('init','film_post_type');

function film_post_type(){

    register_post_type('film', array(
        'labels' => array(
            'name' => __('Films'),
            'singular_name' => __('Film')
            ),
        'taxonomies' => array('category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'has_archive' => true
    ));

}

add_action('init','showing_post_type');

function showing_post_type(){

    register_post_type('showing',array(
        'labels' => array(
            'name' => __('Showings'),
            'singular_name' => __('Showing')
            ),
        'taxonomies' => array('category'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'has_archive' => true
        ));

}

add_action('init','announcement_post_type');

function announcement_post_type(){

    register_post_type('announcement',array(
        'labels' => array(
            'name' => __('Announcements'),
            'singular_name' => __('Announcement')
            ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'has_archive' => true
        ));

}

function sitewide_js() {
  wp_deregister_script('jquery');
  wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"), false, '1.9.1', true);
  wp_register_script( 'main', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0', false );
  wp_register_script( 'slider', get_template_directory_uri() . '/js/superslides.js', array( 'jquery' ), '1.0.0', false );
  wp_register_script( 'object-fit', get_template_directory_uri() . '/js/polyfill.object-fit.min.js', array( 'jquery' ), '1.0.0', false );
  wp_register_script( 'remodal', get_template_directory_uri() . '/js/remodal.min.js', array( 'jquery' ), '1.0.0', false );
  wp_register_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '1.0.0', false );
  wp_enqueue_script( 'main' );
  wp_enqueue_script( 'slider' );
  wp_enqueue_script( 'object-fit' );
  wp_enqueue_script( 'remodal' );
  wp_enqueue_script( 'slick' );
}
add_action( 'wp_enqueue_scripts', 'sitewide_js');

function filmscene_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on filmscene, use a find and replace
	 * to change 'filmscene' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'filmscene', get_template_directory() . '/languages' );

    // Add the ability to add a Featured Image to a Special Event.
    add_theme_support( 'post-thumbnails' );

    add_theme_support( 'menus' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // filmscene_setup
add_action( 'after_setup_theme', 'filmscene_setup' );


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/** Admin Menu **/
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog';
    $submenu['edit.php'][5][0] = 'News & Updates';
    $submenu['edit.php'][10][0] = 'Post an Update';
    echo '';
}

function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'News & Updates';
        $labels->singular_name = 'news';
        $labels->add_new = 'Post an Update';
        $labels->add_new_item = 'Post an Update';
        $labels->edit_item = 'Edit Updates';
        $labels->new_item = 'News & Updates';
        $labels->view_item = 'View Updates';
        $labels->search_items = 'Search Updates';
        $labels->not_found = 'No Contacts found';
        $labels->not_found_in_trash = 'No Contacts found in Trash';
    }
    add_action( 'init', 'change_post_object_label' );
    add_action( 'admin_menu', 'change_post_menu_label' );

// CUSTOMIZE ADMIN MENU ORDER
   function custom_menu_order($menu_ord) {
       if (!$menu_ord) return true;
       return array(
        'index.php', // dashboard link
        'edit.php', //the posts tab
        'edit.php?post_type=capabilities', // Custom post type
        'edit.php?post_type=page', //the pages tab
        'separator1', // first separator
        'upload.php', // Media
        'link-manager.php', // Links
        'edit-comments.php', // Comments
        'separator2', // second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );
   }
    add_filter('custom_menu_order', 'custom_menu_order');
    add_filter('menu_order', 'custom_menu_order');
    add_filter('acf/settings/show_admin', '__return_false');

?>