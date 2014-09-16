<?php
/**
 * Hemingway Rewritten functions and definitions
 *
 * @package Hemingway Rewritten
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 676; /* pixels */
}

if ( ! function_exists( 'hemingway_rewritten_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hemingway_rewritten_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Hemingway Rewritten, use a find and replace
	 * to change 'hemingway-rewritten' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hemingway-rewritten', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'hemingway-rewritten-featured', '676', '999' );
	add_image_size( 'hemingway-rewritten-header', '1280', '416', true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hemingway-rewritten' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hemingway_rewritten_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // hemingway_rewritten_setup
add_action( 'after_setup_theme', 'hemingway_rewritten_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function hemingway_rewritten_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'hemingway-rewritten' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'hemingway-rewritten' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'hemingway-rewritten' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'hemingway-rewritten' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'hemingway_rewritten_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hemingway_rewritten_scripts() {
	wp_enqueue_style( 'hemingway-rewritten-raleway' );
	wp_enqueue_style( 'hemingway-rewritten-latos' );
	wp_enqueue_style( 'hemingway-rewritten-style', get_stylesheet_uri() );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css' );

	wp_enqueue_script( 'hemingway-rewritten-script', get_template_directory_uri() . '/js/hemingway-rewritten.js', array( 'jquery' ), '20140228', true );

	wp_enqueue_script( 'hemingway-rewritten-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'hemingway-rewritten-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hemingway_rewritten_scripts' );

/**
 * Register Google Fonts
 */
function hemingway_rewritten_google_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	/*	translators: If there are characters in your language that are not supported
		by Raleway, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'hemingway-rewritten' ) ) {

		wp_register_style( 'hemingway-rewritten-raleway', "$protocol://fonts.googleapis.com/css?family=Raleway:400,300,700" );

	}

	/*	translators: If there are characters in your language that are not supported
		by Latos, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Latos font: on or off', 'hemingway-rewritten' ) ) {

		wp_register_style( 'hemingway-rewritten-latos', "$protocol://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic&subset=latin,latin-ext" );

	}

}
add_action( 'init', 'hemingway_rewritten_google_fonts' );

/**
 * Enqueue Google Fonts for custom headers
 */
function hemingway_rewritten_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'hemingway-rewritten-raleway' );
	wp_enqueue_style( 'hemingway-rewritten-latos' );

}
add_action( 'admin_enqueue_scripts', 'hemingway_rewritten_admin_scripts' );

/**
 * If a page or post has a featured image set, use that instead of the custom header
 */
function hemingway_rewritten_featured_image_headers() {
	if ( '' == get_the_post_thumbnail() || is_archive() || is_search() || is_home() )
		return;

	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hemingway-rewritten-header' );
	?>
	<style type="text/css" id="featured-header-image">
		.site-header-image {
			background-image: url( <?php echo $image[0]; ?> );
		}
	</style>
	<?php
}
//Late priority to override custom headers if set
add_action( 'wp_head', 'hemingway_rewritten_featured_image_headers', 999 );

/**
 * Adjust content_width value for no sidebar page template, and one-column
 * layout (no widgets in main sidebar).
 */
function hemingway_rewritten_content_width() {
	if ( is_page_template( 'nosidebar-page.php' ) || ! is_active_sidebar( 'sidebar-1' ) ) {
		$GLOBALS['content_width'] = 780;
	}
}
add_action( 'template_redirect', 'hemingway_rewritten_content_width' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
