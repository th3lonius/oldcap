<?php

/**
 * oldcap functions and definitions
 *
 * @package oldcap
 */

if ( ! function_exists( 'oldcap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
//Lets add Open Graph Meta Info
function insert_og_twit_in_head() {
    global $post;
    if ( !is_singular()) { //if it is not a post or a page
        return;
        echo '<meta property="fb:admins" content="EAQdzCRhadf"/>';
        $thumbnail_src = get_field('image');
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src['url'] ) . '"/>';
    } else {
        $thumbnail_src = get_field('photo');
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src['url'] ) . '"/>';
    }
    echo "
";
}
add_action( 'wp_head', 'insert_og_twit_in_head', 5 );

// ADJUST JPEG COMPRESSION
add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

// CUSTOM EXCERPT LENGTH
function custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function posts_orderby_lastname ($orderby_statement) 
{
  $orderby_statement = "RIGHT(post_title, LOCATE(' ', REVERSE(post_title)) - 1) ASC";
    return $orderby_statement;
}

register_nav_menus(
    array(
    'primary-menu' => __( 'Primary Menu' ),
    'secondary-menu' => __( 'Secondary Menu' )
    )
);

//  enable svg images in media uploader
function cc_mime_types( $mimes ){
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

add_action( 'init', 'recipes_post_type' );
add_action( 'init', 'authors_post_type' );

function authors_post_type() {

	register_post_type( 'authors', array(
		'labels' => array(
			'name' => __('Authors'),
			'singular_name' => __('Author')
			),
		'public' => true,
        'capability_type' => 'page',
		'show_ui' => true,
        'menu_icon' => 'dashicons-admin-users',
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
		'rewrite' => array(
			'slug' => 'author',
			'with_front' => false
			),
		'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'comments', 'author')
	) );
}

function recipes_post_type() {

	register_post_type( 'recipes', array(
		'labels' => array(
			'name' => __('Recipes'),
			'singular_name' => __('Recipe')
			),
		'public' => true,
        'capability_type' => 'page',
		'show_ui' => true,
        'menu_icon' => 'dashicons-carrot',
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
		'rewrite' => array(
			'slug' => 'recipes',
			'with_front' => false
			),
		'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'comments', 'author')
	) );
}

// CUSTOM POST TYPE AUTHOR LISTING
add_action( 'pre_get_posts', function ( $q ) {

    if( !is_admin() && $q->is_main_query() && $q->is_author() ) {

        $q->set( 'posts_per_page', 100 );
        $q->set( 'post_type', 'recipes' );

    }

});

/* Plugin Name: jQuery to the footer! */
add_action( 'wp_enqueue_scripts', 'wcmScriptToFooter', 9999 );
function wcmScriptToFooter()
{
    global $wp_scripts;
    $wp_scripts->add_data( 'jquery', 'group', 1 );
}

function theme_js() {
    wp_register_script( 'main', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '', true );
    wp_register_script( 'flowtype', get_template_directory_uri() . '/js/flowtype.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array( 'jquery' ), '', true );
    wp_register_script( 'stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'main' );
    wp_enqueue_script( 'flowtype' );
    wp_enqueue_script( 'sticky' );
    wp_enqueue_script( 'stellar' );
}

add_action( 'wp_enqueue_scripts', 'theme_js');

function oldcap_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on oldcap, use a find and replace
	 * to change 'oldcap' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'oldcap', get_template_directory() . '/languages' );

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
endif; // oldcap_setup
add_action( 'after_setup_theme', 'oldcap_setup' );


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
    $menu[5][0] = 'News & Updates';
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
        'edit.php?post_type=authors', // Custom post type
        'edit.php?post_type=recipes', // Custom post type
        'edit.php?post_type=gallery', // Custom post type
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