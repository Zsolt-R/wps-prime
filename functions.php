<?php
/**
 * Themefunctions and definitions
 * WordPress 3.7 and PHP 5.2.4 to work properly
 *
 * @package wps_prime
 */

/* Set up global var of the class */
global $wps_theme_setup;

/**
 * Start up class
 */
class WPS_Theme_Setup {

	/**
	 * Setup variable global
	 *
	 * @var string
	 */
	private $template_dir;

	/**
	 * Main Theme Class Constructor
	 *
	 * Loads all necessary classes, functions, hooks, configuration files and actions for the theme.
	 *
	 * @since 2.0.0
	 */
	public function __construct() {

		$this->template_dir = get_template_directory();

		/* Define constants */
		add_action( 'after_setup_theme', array( $this, 'constants' ), 1 );

		/**
		 * Load all core theme function files
		 * Load Before classes and addons so we can make use of them
		 */
		add_action( 'after_setup_theme', array( $this, 'include_functions' ), 1 );

		/* Load classes  */
		add_action( 'after_setup_theme', array( $this, 'classes' ), 2 );

		/* Load all the theme addons */
		add_action( 'after_setup_theme', array( $this, 'addons' ), 3 );

		/**
		 * Load configuration classes (post types & 3rd party plugins)
		 * Must load first so it can use hooks defined in the classes
		 */
		add_action( 'after_setup_theme', array( $this, 'configs' ), 4 );

		/* Register theme deault setup */
		add_action( 'widgets_init',  array( $this, 'theme_setup_defaults' ), 1 );

		/* Enqueue scripts and styles. */
		add_action( 'wp_enqueue_scripts', array( $this, 'theme_js' ) );

		/* Enqueue main style. */
		add_action( 'wp_enqueue_scripts',array( $this, 'theme_css' ) );

		/* Register sidebar widget areas */
		add_action( 'widgets_init',  array( $this, 'register_theme_sidebars' ) );

		/* Construct Theme Base (Start theme construction) */
		add_action( 'after_setup_theme', array( $this, 'theme_base' ) );

		/* Load Theme Custom Components (Index custom components/objects ) */
		add_action( 'after_setup_theme', array( $this, 'theme_components' ) );

		/* Hook Theme Components (Add via hooks the theme custom components/objects) */
		add_action( 'after_setup_theme', array( $this, 'hook_theme_components' ) );

	} // End constructor.

	/**
	 * Define constants.
	 *
	 * @since 2.0.0
	 */
	public function constants() {

		/* Paths to the parent theme directory */
		define( 'WPS_THEME_DIR', $this->template_dir );
		define( 'WPS_THEME_URI', get_template_directory_uri() );

		/* Stylesheet uri  */
		define( 'WPS_THEME_STYLE_URI', get_stylesheet_uri() );

		/* Theme assets images/fonts/scss/js  */
		define( 'WPS_ASSETS_URI', WPS_THEME_URI .'/assets/' );

		/* Javascript Paths  */
		define( 'WPS_JS_DIR_URI', WPS_ASSETS_URI .'/js/' );

		/* Theme "engine" directory. Houses core functions  */
		define( 'WPS_ENGINE_DIR', WPS_THEME_DIR .'/inc/' );

		/* Theme components directory  */
		define( 'WPS_COMPONENTS_DIR', WPS_THEME_DIR .'/theme-components/' );

	}

	/**
	 * Theme functions
	 * Load before Classes & Addons
	 *
	 * @since 2.0.0
	 */
	public function include_functions() {

		/* Defer or Async this WordPress javascript snippet to load lastly for faster page load times */
		require( WPS_ENGINE_DIR .'functions/wps-admin-async-defer.php' );

		/* Favicon just drop favicon into theme root and it will be auto-detected (favicon.ico) */
		require( WPS_ENGINE_DIR .'functions/wps-admin-favicon.php' );

		/* Wordpress theme customizer additions. */
		require( WPS_ENGINE_DIR .'functions/wps-admin-wp-customizer.php' );
	}

	/**
	 * Theme Classes
	 *
	 * @since 2.0.0
	 */
	public function classes() {

		/* Theme font options generation class */
		require_once( WPS_ENGINE_DIR .'classes/class-wps-theme-typography.php' );
	}

	/**
	 * Theme addons
	 *
	 * @since 2.0.0
	 */
	public static function addons() {

		/**
		 * Plugin activator
		 * PIKLIST / Simple Image Sizes / Online Backup for WordPress / WordPress Backup to Dropbox / WP Migrate DB
		*/
		require_once( WPS_ENGINE_DIR .'addons/wps-admin-theme-plugins.php' );

		/* Add theme options panel added to WP Dashboard (requires PIKLIST plugin) */
		require_once( WPS_ENGINE_DIR .'addons/wps-admin-theme-options-page.php' );
	}


	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public static function theme_setup_defaults() {

		// Get globals.
		global $content_width;

		/**
		 * Set the content width based on the theme's design and stylesheet.
		*/
		if ( ! isset( $content_width ) ) {
			$content_width = 1052; /* Pixels */
		}

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

		/* Enable support for Post Formats.*/
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );

		/* Enable support for Post Thumbnails */
		add_theme_support( 'post-thumbnails' );

		/* Switch default core markup for search form, comment form, and comments to output valid HTML5. */
		add_theme_support( 'html5' );

		/* 3rd Party plugins support */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'yoast-seo-breadcrumbs' );

		/* Setup the WordPress core custom background feature. */
		add_theme_support( 'custom-background', apply_filters( 'wps_prime_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/* This theme uses wp_nav_menu() in one location. */
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'wps-prime' ),
		) );
	}


	/**
	 * 3rd integrations and config
	 * Theme config and settings
	 *
	 * @since 2.0.0
	 */
	public function configs() {

		/**
		 *	WordPress admin/front-end custom configurations
		 */

		/**
		 * WP Fine Tune
		 *
		 * - Remove all the version numers from the end of css/js enqueued files added to <head> (suggested by pingdom.com)
		 * - Remove Comment Form Allowed Tags
		 * - Customize Comment Form Place Holder Input Text Fields & Infotexts http://wpsites.net/web-design/customize-comment-form-place-holder-input-text-fields-labels/
		 * - Customize Comment Form Text Area & Infotext http://wpsites.net/web-design/customize-comment-field-text-area-label/
		 * - Custom functions that act independently of the theme templates.
		 */
		require( WPS_ENGINE_DIR .'settings/wps-admin-theme-fine-tune.php' );

		/**
		 *	3rd integrations
		 */

		/* Load Jetpack compatibility file. */
		require( WPS_ENGINE_DIR .'integrations/jetpack.php' );

		/* Deregister Cf7 styles (included in style.css) */
		require( WPS_ENGINE_DIR .'integrations/cf7-finetune.php' );

		/**
		 *	Theme configurations
		 */

		/* Custom image sizes. 	*/
		require( WPS_ENGINE_DIR .'settings/wps-admin-image-sizes.php' );

		/* Typography Settings */
		require( WPS_ENGINE_DIR .'settings/wps-admin-typography.php' );

		/* Front end layout css generator functions */
		require( WPS_ENGINE_DIR .'settings/wps-front-layout-setup.php' );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	function theme_js() {
		/**
		 * SWIPER
		 * wp_enqueue_script( 'swiper_core', get_template_directory_uri() . '/js/min/idangerous.swiper.min.js', array('jquery'), '20141029', true );
		 * SWIPER 3.0.x
		 */
		wp_enqueue_script( 'swiper_core', WPS_JS_DIR_URI .'min/swiper.jquery.min.js', array( 'jquery' ), '3.1.12', true );

		/* Site JS */
		wp_enqueue_script( 'site_js', WPS_JS_DIR_URI .'min/site.min.js', array( 'swiper_core' ), '20141029', true );

		/* PICTUREFILL defer load */
		wp_enqueue_script( 'picturefill_core', WPS_JS_DIR_URI .'min/picturefill.min.js#deferload', array(), '3.0.1', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}


	/**
	 * Add frontend main stylesheet ( frontend styling is here )
	 */
	function theme_css() {

		/* Enque main style */
		wp_enqueue_style( 'wps_prime-style', WPS_THEME_STYLE_URI );
		wp_enqueue_style( 'wps_prime-icon-fonts', WPS_ASSETS_URI .'fonts/iconfont/font-awesome-4.5.0/css/font-awesome.min.css' );
	}

	/**
	 * Register theme sidebars
	 */
	public function register_theme_sidebars() {

		/**
		 * Register widget area.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
		 */

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

	/**
	 * Theme base
	 *
	 * Theme hooks / filters / walkers / shortcodes
	 * Functions used to build theme front end
	 *
	 * @since 2.0.0
	 */
	public function theme_base() {

		/**
		 * Theme front end construction helper functions /hooks / filters / menu walker
		 */

		/* Theme hooks */
		require( WPS_ENGINE_DIR .'hooks-filters/theme-hook-functions.php' );

		/* Theme filters */
		require( WPS_ENGINE_DIR .'hooks-filters/theme-filter-functions.php' );

		/* Custom Menu Walker */
		require( WPS_ENGINE_DIR .'functions/wps-front-menu-walker.php' );

		/* Load theme fonts */
		require( WPS_ENGINE_DIR .'functions/wps-admin-theme-font.php' );

		/* Add theme fonts to editor */
		require( WPS_ENGINE_DIR .'functions/wps-editor-styles.php' );

		/* Shortcodes, generate markup for content layout, media-objects, slider, buttons, etc */
		require( WPS_ENGINE_DIR .'shortcodes/shortcodes.php' );
		require( WPS_ENGINE_DIR .'shortcodes/admin/wps-shortcodes-admin-buttons.php' );
	}

	/**
	 * Theme components
	 * Customized template components
	 * Always load theme objects first and then theme parts
	 */
	public function theme_components() {

		/**
		 * Theme default components
		 * Rarely need to change default components
		 */

		/* Custom Comment list markup */
		require_once( WPS_COMPONENTS_DIR .'default/wps-front-comment-list.php' );
		/* Custom template tags. */
		require_once( WPS_COMPONENTS_DIR .'default/wps-front-template-tags.php' );

		/**
		 * Theme custom components
		 * custom Components often change from project to project
		 */

		/* Custom Objects */
		require_once( WPS_COMPONENTS_DIR .'objects/theme-site-nav.php' );
		require_once( WPS_COMPONENTS_DIR .'objects/theme-site-logo.php' );

		/* Theme Parts */
		require_once( WPS_COMPONENTS_DIR .'layout-elements/theme-header-layout.php' );
		require_once( WPS_COMPONENTS_DIR .'layout-elements/theme-footer-parts.php' );

	}

	/**
	 *	Hook components to theme
	 * always load after theme parts and components
	 */
	public function hook_theme_components() {

		require( WPS_THEME_DIR .'/theme-hook-build.php' );
	}
}
$wps_theme_setup = new WPS_Theme_Setup;