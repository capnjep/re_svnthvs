<?php
/**
 * re_svnthvs functions and definitions
 *
 * @package re_svnthvs
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 're_svnthvs_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function re_svnthvs_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on re_svnthvs, use a find and replace
	 * to change 're_svnthvs' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 're_svnthvs', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 're_svnthvs' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 're_svnthvs_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // re_svnthvs_setup
add_action( 'after_setup_theme', 're_svnthvs_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function re_svnthvs_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 're_svnthvs' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 're_svnthvs_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function re_svnthvs_scripts() {
	wp_enqueue_style( 're_svnthvs-style', get_stylesheet_uri() );

	wp_enqueue_script( 're_svnthvs-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 're_svnthvs-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 're_svnthvs-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 're_svnthvs_scripts' );

/**
 * Enqueue bootstrap scripts and styles
 */
function re_svnthvs_bootstrap() {
	wp_enqueue_style( 'bootstrap-min', get_template_directory_uri() . '/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-theme-min', get_template_directory_uri() . '/dist/css/bootstrap-theme.min.css' );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/dist/js/bootstrap.min.js', array('jquery'), '3.0.0', true);
}
add_action( 'wp_enqueue_scripts', 're_svnthvs_bootstrap' ); 

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
