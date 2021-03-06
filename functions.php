<?php
/**
 * WPS Prime 2 functions and definitions.
 *
 * @see  https://developer.wordpress.org/themes/basics/theme-functions/
 */

/* Set up global theme setup */
global $wps_theme_setup;
/**
 * Start theme setup.
 */
class WPS_Theme_Setup {

	/**
	 * Template directory.
	 *
	 * @var string
	 */
	private $template_dir;

	/**
	 * Main Theme Class Constructor.
	 *
	 * Loads all necessary classes, functions, hooks, configuration files and actions for the theme.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		 $this->template_dir = get_template_directory();

		/* Define constants */
		add_action( 'after_setup_theme', array( $this, 'theme_constants' ), 1 );

		/* Theme Content width */
		add_action( 'after_setup_theme', array( $this, 'wps_prime_content_width' ), 0 );

		/* Load theme helpers */
		add_action( 'after_setup_theme', array( $this, 'theme_helpers' ), 1 );

		/* Load theme typography generator */
		add_action( 'after_setup_theme', array( $this, 'theme_typography' ), 2 );

		/* Construct Theme Base (Start theme construction) */
		$this->theme_constants();
		$this->theme_options();
		add_action( 'after_setup_theme', array( $this, 'wps_theme_base' ) );

		/*
		 * Load configuration
		 * Must load first so it can use hooks defined in the classes
		 */
		add_action( 'after_setup_theme', array( $this, 'wps_configs' ), 4 );

		/* Register theme deault setup */
		add_action( 'widgets_init', array( $this, 'wps_theme_setup_defaults' ), 1 );

		/* Enqueue scripts and styles. */
		add_action( 'wp_enqueue_scripts', array( $this, 'wps_theme_js' ) );

		/* Enqueue main style. */
		add_action( 'wp_enqueue_scripts', array( $this, 'wps_theme_css' ) );

		/* Load meta boxes */
		add_action( 'after_setup_theme', array( $this, 'theme_meta_boxes' ), 5 );

		/* Third party settings and integration */
		add_action( 'after_setup_theme', array( $this, 'third_party_integration' ) );

		/* Register sidebar widget areas */
		add_action( 'widgets_init', array( $this, 'wps_register_theme_sidebars' ) );

		/* Load Theme Custom Components (Index custom components/objects ) */
		add_action( 'after_setup_theme', array( $this, 'wps_theme_components' ) );

		/* Hook Theme Components (Add via hooks the theme custom components/objects) */
		add_action( 'after_setup_theme', array( $this, 'wps_hook_theme_components' ) );
	}

	/**
	 * Define constants.
	 *
	 * @since 1.0.0
	 */
	public function theme_constants() {
		 /* Paths to the parent theme directory */
		if ( ! defined( 'WPS_THEME_DIR' ) ) {
			define( 'WPS_THEME_DIR', $this->template_dir );
		}

		if ( ! defined( 'WPS_THEME_URI' ) ) {
			define( 'WPS_THEME_URI', get_template_directory_uri() );
		}

		/* Stylesheet uri  */
		if ( ! defined( 'WPS_THEME_STYLE_URI' ) ) {
			define( 'WPS_THEME_STYLE_URI', get_stylesheet_uri() );
		}

		/* Theme css path  */
		if ( ! defined( 'WPS_CSS_URI' ) ) {
			define( 'WPS_CSS_URI', WPS_THEME_URI . '/css' );
		}

		/* Theme js path  */
		if ( ! defined( 'WPS_JS_DIR_URI' ) ) {
			define( 'WPS_JS_DIR_URI', WPS_THEME_URI . '/js' );
		}

		/* Theme image path  */
		if ( ! defined( 'WPS_IMAGE_DIR_URI' ) ) {
			define( 'WPS_IMAGE_DIR_URI', WPS_THEME_URI . '/images' );
		}

		/* Theme "engine" directory. Houses core functions  */
		if ( ! defined( 'WPS_ENGINE_DIR' ) ) {
			define( 'WPS_ENGINE_DIR', WPS_THEME_DIR . '/inc' );
		}

		/* Theme components directory  */
		if ( ! defined( 'WPS_COMPONENTS_DIR' ) ) {
			define( 'WPS_COMPONENTS_DIR', WPS_THEME_DIR . '/template-components' );
		}
	}

	/**
	 * Theme helpers.
	 *
	 * @since 1.0.0
	 */
	public static function theme_helpers() {
		/* Admin Settings Page */
		include_once WPS_ENGINE_DIR . '/theme-helpers/theme-helpers.php';
		/* Icon render wrapper */
		include_once WPS_ENGINE_DIR . '/theme-helpers/theme-run-icon.php';
	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	public function wps_prime_content_width() {
		 $GLOBALS['content_width'] = apply_filters( 'wps_prime_content_width', 1152 );
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public static function wps_theme_setup_defaults() {
		 /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wps_prime, use a find and replace
		 * to change 'wps-prime' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'wps-prime', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/* Add default posts and comments RSS feed links to head. */
		add_theme_support( 'automatic-feed-links' );

		/* Enable support for Post Thumbnails */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/* 3rd Party plugins support */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'yoast-seo-breadcrumbs' );

		/* This theme uses wp_nav_menu() in one location. */
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'wps-prime' ),
			)
		);
	}

	/**
	 * Content meta boxes.
	 *
	 * @since 1.0.0
	 */
	public static function theme_meta_boxes() {
		 /* Content Page Options */
		include_once WPS_ENGINE_DIR . '/meta-fields/pre-content-area.php';

		/* Page vertical margins control */
		include_once WPS_ENGINE_DIR . '/meta-fields/page-margins-control.php';

		/* Page custom settings quick edit */
		include_once WPS_ENGINE_DIR . '/meta-fields/page-settings-quick-edit.php';
	}

	/**
	 * Theme Typography.
	 *
	 * @since 1.3.0
	 */
	public function theme_typography() {
		/* Theme font options generation class */
		include_once WPS_ENGINE_DIR . '/theme-helpers/theme-typography-generator.php';
	}

	/**
	 * Setup theme options.
	 *
	 * @since 1.3.0
	 */
	public function theme_options() {
		/* Theme Customizer */
		include WPS_ENGINE_DIR . '/customizer-helpers.php';
		include WPS_ENGINE_DIR . '/customizer.php';
	}

	/**
	 * 3rd integrations and config
	 * Theme config and settings.
	 *
	 * @since 1.3.0
	 */
	public function wps_configs() {
		 /**
		 * WP Fine Tune.
		 *
		 * - Remove all the version numers from the end of css/js enqueued files added to <head> (suggested by pingdom.com)
		 * - Remove Comment Form Allowed Tags
		 * - Customize Comment Form Place Holder Input Text Fields & Infotexts http://wpsites.net/web-design/customize-comment-form-place-holder-input-text-fields-labels/
		 * - Customize Comment Form Text Area & Infotext http://wpsites.net/web-design/customize-comment-field-text-area-label/
		 * - Custom functions that act independently of the theme templates.
		 */
		include WPS_ENGINE_DIR . '/settings/wps-admin-theme-fine-tune.php';

		/**
		 *    Add media id to media library admin column.
		 */
		include WPS_ENGINE_DIR . '/admin/wps-admin-column-show-media-id.php';

		/**
		 *    Add post id to post list admin column.
		 */
		include WPS_ENGINE_DIR . '/admin/wps-admin-column-show-post-id.php';

		/**
		 *    Add page id to page list admin column.
		 */
		include WPS_ENGINE_DIR . '/admin/wps-admin-column-show-page-id.php';

		/**
		 *    Add page settins columns
		 */
		include WPS_ENGINE_DIR . '/admin/wps-admin-column-page-settings.php';

		/**
		 *    Theme configurations.
		 */

		/* Custom image sizes.  */
		include WPS_ENGINE_DIR . '/settings/wps-admin-image-sizes.php';

		/* Typography Settings */
		include WPS_ENGINE_DIR . '/settings/wps-admin-typography.php';
	}

	public function third_party_integration() {
		 /**
		 *    3rd integrations.
		 */

		/* Load Jetpack compatibility file. */
		include WPS_ENGINE_DIR . '/integrations/jetpack.php';

		/* Deregister Cf7 styles (included in style.css) */
		include WPS_ENGINE_DIR . '/integrations/cf7-finetune.php';

		/* Visual Composer */
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			include WPS_ENGINE_DIR . '/integrations/visual-composer/wps-vc-integration.php';
		}

		/*
		*    If we initiate fallback while VC is active, the fallback shortcodes will overwrite the VC shortcodes
		*/
		if ( ! class_exists( 'WPBakeryShortCode' ) ) {
			include WPS_ENGINE_DIR . '/integrations/visual-composer/shortcodes/wps-vc-shortcode-fallbacks.php';
		}
	}

	/**
	 * Theme base.
	 *
	 * Theme hooks / filters / walkers / shortcodes
	 * Functions used to build theme front end
	 *
	 * @since 1.3.0
	 */
	public function wps_theme_base() {
		/**
		   * Theme front end construction helper functions /hooks / filters / menu walker.
		   */

		/* Theme hooks & hook display debug */
		include WPS_ENGINE_DIR . '/theme-hooks-filters/theme-hooks.php';
		include WPS_ENGINE_DIR . '/theme-hooks-filters/theme-debug-hooks.php';

		/* Theme filters */
		include WPS_ENGINE_DIR . '/theme-hooks-filters/theme-css-filters.php';

		/* Custom Menu Walker */
		include WPS_ENGINE_DIR . '/theme-functions/theme-menu-walker.php';

		/* Shortcodes, generate markup for content layout, media-objects, slider, buttons, etc */
		include WPS_ENGINE_DIR . '/shortcodes/wps-shortcode-helpers.php';
		include WPS_ENGINE_DIR . '/shortcodes/wps-shortcodes.php';
		include WPS_ENGINE_DIR . '/admin/wps-shortcodes-admin-buttons.php';

		// WP Editor wps extension
		include WPS_ENGINE_DIR . '/admin/wps-tinymce-extension.php';

		/* Run/Load theme fonts on front end */
		include WPS_ENGINE_DIR . '/theme-functions/theme-run-fonts.php';

		/* Run/Load custom scripts from theme options section */
		include WPS_ENGINE_DIR . '/theme-functions/theme-run-custom-scripts.php';

		/* Custom widget options */
		include WPS_ENGINE_DIR . '/theme-functions/theme-widget-options.php';

		/* Add theme fonts to editor */
		include WPS_ENGINE_DIR . '/theme-functions/theme-editor-styles.php';

		/* Allow file types */
		include WPS_ENGINE_DIR . '/theme-functions/theme-allow-fie-type.php';
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function wps_theme_js() {
		/*
		 * SWIPER
		 */
		wp_register_script( 'slider_core', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.1/js/swiper.min.js', array( 'jquery' ), '', true );

		/* Default main nav */
		wp_register_script( 'main_menu_core', WPS_JS_DIR_URI . '/min/navigation.min.js', array(), '', true );

		/* Tabby Tabs  enqueued from functions */
		wp_register_script( 'wps_tabby', WPS_JS_DIR_URI . '/min/tabby.js', array( 'jquery' ), '', true );  // Loaded on demand from shortcode

		/* Parrallax  enqueued from functions */
		wp_register_script( 'wps_parallax', WPS_JS_DIR_URI . '/min/parallax.min.js', array( 'jquery' ), '', true ); // Loaded on demand from shortcode

		/* Video backgrounds script */
		wp_register_script( 'wps_vc_video_bg', WPS_JS_DIR_URI . '/min/wps-video-bg.min.js', array( 'jquery' ), '', true ); // Handle video backgrounds

		/* Fancybox pack */
		wp_register_script( 'wps_fancybox_pack_js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js', array( 'jquery' ), '', true ); // Fancybox enable

		wp_enqueue_script( 'scroll_magic', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js', array( 'jquery' ), '', true );

		/* Site JS */
		wp_register_script( 'site_js', WPS_JS_DIR_URI . '/min/site.min.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'main_menu_core' );
		wp_enqueue_script( 'wps_fancybox_pack_js' );
		wp_enqueue_script( 'scroll_magic' );
		wp_enqueue_script( 'site_js' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Add frontend main stylesheet ( frontend styling is here ).
	 */
	public function wps_theme_css() {
		/* Enque main style */
		wp_register_style( 'wps_prime-style', WPS_THEME_STYLE_URI );
		wp_enqueue_style( 'wps_prime-style' );

		// Core animations Pack
		wp_register_style( 'wps_animations', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' );

		// If disable animation library don't eque CSS
		if ( ! get_option( 'wps_disable_animation_lib', false ) ) {
			wp_enqueue_style( 'wps_animations' );
		}

		wp_register_style( 'wps_fancybox_pack_css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css' );
		wp_enqueue_style( 'wps_fancybox_pack_css' );

		wp_register_style( 'slider_style_core', WPS_CSS_URI . '/wps-swiper.min.css' );
	}

	/**
	 * Register theme sidebars.
	 */
	public function wps_register_theme_sidebars() {
		 /*
		 * Register widget area.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
		 */

		register_sidebar(
			array(
				'name'          => __( 'Sidebar', 'wps-prime' ),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer widget area one', 'wps-prime' ),
				'id'            => 'sidebar-footer-1',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer widget area two', 'wps-prime' ),
				'id'            => 'sidebar-footer-2',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer widget area three', 'wps-prime' ),
				'id'            => 'sidebar-footer-3',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          => __( 'Footer widget area four', 'wps-prime' ),
				'id'            => 'sidebar-footer-4',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	/**
	 * Theme components
	 * Customized template components
	 * Always load theme objects first and then theme parts.
	 */
	public function wps_theme_components() {
		/**
		 * Theme default components
		 * Rarely need to change default components.
		 */

		/* Custom Comment list markup */
		include_once WPS_COMPONENTS_DIR . '/theme-front-comment-list.php';
		/* Custom template tags. */
		include_once WPS_COMPONENTS_DIR . '/theme-front-template-tags.php';

		/**
		 * Theme custom components
		 * Index componets to make them avaliable to hook them to place in the theme
		 * custom Components often change from project to project.
		 */

		/* The custom walker enabled main navigation */
		include_once WPS_COMPONENTS_DIR . '/components/theme-site-nav.php';
		/* render the main logo */
		include_once WPS_COMPONENTS_DIR . '/components/theme-site-logo.php';
		/* Before the main site content area component */
		include_once WPS_COMPONENTS_DIR . '/components/theme-page-pre-content.php';
		/* Global content component */
		include_once WPS_COMPONENTS_DIR . '/components/theme-global-content.php';
		/* Site info component for footer */
		include_once WPS_COMPONENTS_DIR . '/components/theme-footer-site-microcopy.php';
		/* Header Layout */
		include_once WPS_COMPONENTS_DIR . '/theme-header-layout.php';
	}

	/**
	 * Hook components to theme
	 * always load after theme parts and components.
	 */
	public function wps_hook_theme_components() {
		// Add classes and wrapper elements in order to cosntruct the html architecture
		include WPS_COMPONENTS_DIR . '/theme-front-setup/theme-front-layout-setup.php';

		// Hook functional components of the website ex. header layout / logo / navigation / pre content ...etc
		// Find elements in root/template-components
		include WPS_COMPONENTS_DIR . '/theme-front-setup/theme-hook-components.php';
	}
}
$wps_theme_setup = new WPS_Theme_Setup();
