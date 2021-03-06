<?php
/**
 * Sanctuarysite functions and definitions
 *
 * @package Sanctuarysite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1024; /* pixels: max-width of page content. */
}

if ( ! function_exists( 'sanctuarysite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sanctuarysite_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Sanctuarysite, use a find and replace
	 * to change 'sanctuarysite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sanctuarysite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sanctuarysite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
//	add_theme_support( 'custom-background', apply_filters( 'sanctuarysite_custom_background_args', array(
//		'default-color' => 'ffffff',
//		'default-image' => '',
//	) ) );

}
endif; // sanctuarysite_setup
add_action( 'after_setup_theme', 'sanctuarysite_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sanctuarysite_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sanctuarysite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}

add_action( 'init', 'create_my_post_types' );

function create_my_post_types() {
 register_post_type( 'painters-cabin', 
 array(
      'labels' => array(
      	'name' => __( 'Painters Cabin' ),
      	'singular_name' => __( 'Painters Cabin' ),
      	'add_new' => __( 'Add New' ),
      	'add_new_item' => __( 'Add New Painters Cabin' ),
      	'edit' => __( 'Edit' ),
      	'edit_item' => __( 'Edit Painters Cabin' ),
      	'new_item' => __( 'New Painters Cabin' ),
      	'view' => __( 'View Painters Cabin' ),
      	'view_item' => __( 'View Painters Cabin' ),
      	'search_items' => __( 'Search Painters Cabin' ),
      	'not_found' => __( 'No Painters Cabin found' ),
      	'not_found_in_trash' => __( 'No Painters Cabin found in Trash' ),
      	'parent' => __( 'Parent Painters Cabin' ),
      ),
      
      'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes' ),
      		
 'public' => true,
      'menu_position' => 4,
      'rewrite' => array('slug' => 'painters-cabin'),
      'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
      'taxonomies' => array('category', 'post_tag'),
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
     )
  );
}





add_action( 'widgets_init', 'sanctuarysite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sanctuarysite_scripts() {
	
	wp_enqueue_style( 'sanctuarysite-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'sanctuarysite-style-google-fonts', 'http://fonts.googleapis.com/css?family=Arvo:400,700|Open+Sans:400,700|Open+Sans+Condensed:300,700' );
	
	wp_enqueue_script( 'sanctuarysite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'sanctuarysite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true ); 
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sanctuarysite_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
