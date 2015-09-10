<?php
/**
 * e4 functions and definitions
 *
 * @package e4
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'e4_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function e4_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on e4, use a find and replace
	 * to change 'e4' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'e4', get_template_directory() . '/languages' );

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
	add_theme_support( 'post-thumbnails' );
	
	add_image_size( 'e4-thumbs', '600', '800', false );
	
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'e4' ),
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
		'aside', 'image', 'video', 'quote',
	) );
}
endif; // e4_setup
add_action( 'after_setup_theme', 'e4_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function e4_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Side Widgets', 'e4' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Header Widgets', 'e4' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'e4_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function e4_scripts() {
	wp_enqueue_style( 'e4-style', get_stylesheet_uri() );
	wp_enqueue_style( 'e4-fa', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css');
	wp_enqueue_script( 'e4-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	
	// JQUERY
	if (!is_admin()) add_action("wp_enqueue_scripts", "e4_jquery_enqueue", 11);
	function e4_jquery_enqueue() {
		wp_deregister_script('jquery');
		wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js", false, null);
		wp_enqueue_script('jquery');
	}
	
	// E4 JS
	wp_enqueue_script( 'e4-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20120206', true );
	wp_enqueue_script( 'e4-main', get_template_directory_uri() . '/js/main.js', array(), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'e4_scripts' );

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

/**
 * E4 Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';


function current_page_url() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

/**
 * REPLACING ATTACHMENT LINKS TO FILE	
 **/
add_shortcode( 'gallery', 'file_gallery_shortcode' ); 

 function file_gallery_shortcode( $atts ) {
      $atts['link'] = 'file';
      return gallery_shortcode( $atts );
 }
 
/**
 * DASHBOARD WIDGET
 */ 
 function e3_add_dashboard_widgets() {
 	wp_add_dashboard_widget( 'e3_dashboard_widget', 'Welcome to E3', 'e3_dashboard_widget_function' );
 	global $wp_meta_boxes;
 	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
 	$example_widget_backup = array( 'e3_dashboard_widget' => $normal_dashboard['e3_dashboard_widget'] );
 	unset( $normal_dashboard['e3_dashboard_widget'] );
 	$sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );
 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
} 
add_action( 'wp_dashboard_setup', 'e3_add_dashboard_widgets' );
function e3_dashboard_widget_function() {
	echo 'Hey, thanks for using E4, here are some recommended plugins:<br /><br/>
	<strong><a href="https://wordpress.org/plugins/simple-custom-post-order/">Simple Custom Post Order</a></strong>: Re-order posts with a simple drag and drop interface.<br/>
	<strong><a href="http://csshero.org/themes/e4">CSS Hero</a></strong>: Easily customize the look of your E4 theme without writing any code.
	';
}

function e4_add_div_to_image( $content ) {

   // A regular expression of what to look for.
   $pattern = '/(<img([^>]*)>)/i';
   // What to replace it with. $1 refers to the content in the first 'capture group', in parentheses above
   $replacement = '<div class="clear"></div><div class="e4-post-image-wrap">$1</div>';

   // run preg_replace() on the $content
   $content = preg_replace( $pattern, $replacement, $content );

   // return the processed content
   return $content;
}

add_filter( 'the_content', 'e4_add_div_to_image' );