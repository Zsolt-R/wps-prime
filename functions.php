<?php
/**
 * Themefunctions and definitions
 * WordPress 3.7 and PHP 5.2.4 to work properly
 *
 * @package wps_prime
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1052; /* Pixels */
}

if ( ! function_exists( 'wps_prime_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wps_prime_setup() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wps_prime, use a find and replace
		 * to change 'wps-prime' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'wps-prime', get_template_directory() . '/languages' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		 add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'wps-prime' ),
		) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Enable support for Post Formats.
		 *
		 * @link http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		/**
		 *This theme uses a custom image size for featured images, displayed on "standard" posts.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
	 	* Custom image sizes.
	 	*/
		require get_template_directory() . '/inc/custom-image-sizes.php';

		/**
		 * Setup the WordPress core custom background feature.
		 */
		add_theme_support( 'custom-background', apply_filters( 'wps_prime_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/**
		 * Theme hook-functions
		 */
		require get_template_directory() . '/theme-hooks/theme-hook-functions.php';

		/**
		 * Themne filter-functions
		 */
		require get_template_directory() . '/theme-filters/theme-filter-functions.php';

		/**
		 * Shortcodes to generate markup for content layout, media-objects, slider, buttons
		 */
		require get_template_directory() . '/inc/shortcodes.php';

		/**
		 * WP Fine Tune
		 *
		 * - Remove all the version numers from the end of css/js enqueued files added to <head> (suggested by pingdom.com)
		 * - Remove Comment Form Allowed Tags
		 * - Customize Comment Form Place Holder Input Text Fields & Labels http://wpsites.net/web-design/customize-comment-form-place-holder-input-text-fields-labels/
		 * - Customize Comment Form Text Area & Label http://wpsites.net/web-design/customize-comment-field-text-area-label/
		 */
		require get_template_directory() . '/inc/wps-theme-fine-tune.php';

		/**
		 * Defer or async this WordPress javascript snippet to load lastly for faster page load times
		 *
		 * @see http://www.growingwiththeweb.com/2014/02/async-vs-defer-attributes.html
		 *
		 * @link http://stackoverflow.com/questions/18944027/how-do-i-defer-or-async-this-wordpress-javascript-snippet-to-load-lastly-for-fas
		 */

		/**
		 * Async
		 *
		 * @param string $url Link to script.
		 */
		function add_async_forscript( $url ) {

			if ( strpos( $url, '#asyncload' ) === false ) {
				return $url; } else if ( is_admin() ) {
				return str_replace( '#asyncload', '', $url ); } else {
					return str_replace( '#asyncload', '', $url )."' async='async"; }
		}
		add_filter( 'clean_url', 'add_async_forscript', 11, 1 );

		/**
		 * Defer
		 *
		 * @param string $url Link to script.
		 */
		function add_defer_forscript( $url ) {

			if ( strpos( $url, '#deferload' ) === false ) {
				return $url; } else if ( is_admin() ) {
				return str_replace( '#deferload', '', $url ); } else {
					return str_replace( '#deferload', '', $url )."' defer='defer"; }
		}
		add_filter( 'clean_url','add_defer_forscript', 11, 1 );

		/**
		 * Theme Main nav default class
		 *
		 * @param array $classes Holds the classes of the main navigation.
		 */
		function add_theme_main_nav_class( $classes ) {
			$classes[] = 'site-nav';
			return $classes;
		}
		add_filter( 'main_nav_class','add_theme_main_nav_class' );

	}
endif; // End wps_prime_setup.
add_action( 'after_setup_theme', 'wps_prime_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wps_prime_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wps-prime' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer widget area one', 'wps-prime' ),
		'id'            => 'sidebar-footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer widget area two', 'wps-prime' ),
		'id'            => 'sidebar-footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer widget area three', 'wps-prime' ),
		'id'            => 'sidebar-footer-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer widget area four', 'wps-prime' ),
		'id'            => 'sidebar-footer-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'wps_prime_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wps_prime_scripts() {

	/* Add stylesheet to register in wp themes dashboard ( no frontend styling here ) */
	wp_enqueue_style( 'wps_prime-style', get_stylesheet_uri() );

	/**
	 * SWIPER
	 * wp_enqueue_script( 'swiper_core', get_template_directory_uri() . '/js/min/idangerous.swiper.min.js', array('jquery'), '20141029', true );
	 * SWIPER 3.0.x
	 */
	wp_enqueue_script( 'swiper_core', get_template_directory_uri() . '/js/min/swiper.jquery.min.js', array( 'jquery' ), '3.1.12', true );

	/* Site JS */
	wp_enqueue_script( 'site_js', get_template_directory_uri() . '/js/min/site.min.js', array( 'swiper_core' ), '20141029', true );

	/* PICTUREFILL defer load */
	wp_enqueue_script( 'picturefill_core', get_template_directory_uri() . '/js/min/picturefill.min.js#deferload', array(), '3.0.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wps_prime_scripts' );

/**
 * Add frontend main stylesheet ( frontend styling is here )
 */
function add_main_css() {
	wp_enqueue_style( 'wps_prime-icon-fonts', get_template_directory_uri() .'/fonts/iconfont/font-awesome-4.4.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts','add_main_css' );


/**
 * Implement the Custom Header feature.
 *
 * To add custom header add this code to functions.php
 * require get_template_directory() . '/inc/custom-header.php';
 */


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
 *  Theme Settings
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 *  Typography Settings
 */
require get_template_directory() . '/inc/typography.php';

/**
 *  Custom Menu Walker
 */
require get_template_directory() . '/inc/custom-menu-walker.php';

/**
 *  Custom Comment list markup
 */
require get_template_directory() . '/inc/comment-list.php';

/**
 *  Favicon
 */
require get_template_directory() . '/inc/favicon.php';



/* Allow shortcode in text widget */
add_filter( 'widget_text', 'do_shortcode' );

/* Allow shortcode in widget title */
add_filter( 'widget_title', 'do_shortcode' );


/**
* THEME DEPENDENCIES
*
* Theme parts
* Theme frontend layout class functions
*/
require get_template_directory() . '/theme-parts/theme-parts-init.php';
require get_template_directory() . '/layouts/frontend-layout-class-functions.php';


/**
 * HOOK OBJECTS TO THEME
 * always load after theme parts and modules
 */
require get_template_directory() . '/theme-hook-build.php';

/**
 * Plugin activator
 * PIKLIST / Simple Image Sizes / Online Backup for WordPress / WordPress Backup to Dropbox / WP Migrate DB
*/
require_once get_template_directory() . '/inc/wps-theme-plugins.php';

/**
 * Deregister Cf7 styles (included in style.css)
 */
require get_template_directory() . '/inc/cf7-finetune.php';
