<?php
/**
 * Electoreftech functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Electoreftech
 */

if ( ! function_exists( 'electoreftech_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function electoreftech_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Electoreftech, use a find and replace
		 * to change 'electoreftech' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'electoreftech', get_template_directory() . '/languages' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'homepage-thumb', 370, 245, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'electoreftech' ),
		) );

		/*
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'electoreftech_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'electoreftech_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function electoreftech_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'electoreftech_content_width', 640 );
}
add_action( 'after_setup_theme', 'electoreftech_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function electoreftech_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'electoreftech' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'electoreftech' ),
		'before_widget' => '<div id="%1$s" class="widget mb-60 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
}
add_action( 'widgets_init', 'electoreftech_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function electoreftech_scripts() {
	wp_enqueue_style( 'electoreftech-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', '20151215' );
	wp_enqueue_style( 'electoreftech-magnific', get_template_directory_uri() . '/assets/css/magnific-popup.css', '20151215' );
	wp_enqueue_style( 'electoreftech-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', '20151215' );
	wp_enqueue_style( 'electoreftech-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', '20151215' );
	wp_enqueue_style( 'electoreftech-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', '20151215' );
	wp_enqueue_style( 'electoreftech-ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css', '20151215' );
	wp_enqueue_style( 'electoreftech-headline', get_template_directory_uri() . '/assets/css/headline.css', '20151215' );
	wp_enqueue_style( 'electoreftech-navigation', get_template_directory_uri() . '/assets/css/animate.min.css', '20151215' );
	wp_enqueue_style( 'electoreftech-material', get_template_directory_uri() . '/assets/css/material-design-iconic-font.min.css', '20151215' );
	wp_enqueue_style( 'electoreftech-meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.css', '20151215' );
	wp_enqueue_style( 'electoreftech-stroke', get_template_directory_uri() . '/assets/css/Pe-icon-7-stroke.css', '20151215' );
	wp_enqueue_style( 'electoreftech-bundle', get_template_directory_uri() . '/assets/css/bundle.css', '20151215' );
	wp_enqueue_style( 'nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.0.0/nouislider.css' );
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/assets/css/theme.css' );
	wp_enqueue_style( 'chosen', get_template_directory_uri() . '/assets/css/chosen.css', array(), '1.222'  );
	wp_enqueue_style( 'electoreftech-style', get_stylesheet_uri(), array(), '1.45'  );
	wp_enqueue_style( 'electoreftech-responsive', get_template_directory_uri() . '/assets/css/responsive.css', '20151215' );



	//wp_enqueue_script( 'electoreftech-jquery', get_template_directory_uri() . '/assets/js/vendorjquery-1.12.0.minn.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-headline', get_template_directory_uri() . '/assets/js/headline.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-magnific', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-scrollUp', get_template_directory_uri() . '/assets/js/jquery.scrollUp.min.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-parallax', get_template_directory_uri() . '/assets/js/jquery.parallax-1.1.3.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-meanmenu', get_template_directory_uri() . '/assets/js/jquery.meanmenu.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-zoom', get_template_directory_uri() . '/assets/js/zoom.js', array(), '20151215', true );
	wp_enqueue_script( 'electoreftech-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array(), '20151215', true );
	wp_enqueue_script( 'nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.0.0/nouislider.js', array(), '20190207', true );
	wp_enqueue_script( 'chosen.jquery', get_template_directory_uri() . '/assets/js/chosen.jquery.js', array(), '20190207', true );
	
	wp_enqueue_script( 'electroref-pinit-js', '//assets.pinterest.com/js/pinit.js', array(), NULL, true );
	wp_enqueue_script( 'electroref-facebook-js', '//connect.facebook.net/en_US/all.js', array(), NULL, true );
	

	wp_register_script( 'electoreftech-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.21', true );
	wp_enqueue_script('electoreftech-main');

	$electroref_params = array(
		'admin_ajax_url' => admin_url( 'admin-ajax.php' ),
		'site_name' => get_bloginfo('name'),
		'search_url' =>  esc_url( home_url( '/products-air-conditioner-price-nepal/' ) ),
		'loading_text' => __('Loading...', 'electoreftech'),
		'no_more_content_text' => __('No more product found.', 'electoreftech'),
		'load_more_text' => __('Load more', 'electoreftech'),
		'processing' => __('Processing..', 'electoreftech'),
		'slider_min_price' => '0',
		'slider_max_price' => '300000',
		'min_price' => '0',
		'max_price' => '300000',
	);

	if(isset($_REQUEST['min_price']) && !empty($_REQUEST['min_price'])){
		$electroref_params['min_price'] = $_REQUEST['min_price'];
	}

	if(isset($_REQUEST['max_price']) && !empty($_REQUEST['max_price'])){
		$electroref_params['max_price'] = $_REQUEST['max_price'];
	}

	wp_localize_script( 'electoreftech-main', 'electroref_params', $electroref_params);

	wp_enqueue_script( 'electoreftech-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'electoreftech-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'electoreftech_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/vendor/autoload.php';
require get_template_directory() . '/inc/electroref_functions.php';
require get_template_directory() . '/admin/config_admin.php';
require get_template_directory() . '/inc/home_page_cmb2.php';



/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Custom Post Type
function electoreftech_custom_init() {

  
    $args = array(
      'public' => true,
      'label'  => 'Slider',
      'supports'=>array('title','editor','thumbnail'),
      'menu_icon'           => 'dashicons-images-alt2',

    );
    register_post_type( 'slider', $args );

}
add_action( 'init', 'electoreftech_custom_init' );
if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'feature-thumb', 262, 175,true );
  add_image_size( 'special-thumb', 370, 247,true );
  add_image_size( 'cat-thumb', 200, 130,true );
  add_image_size( 'testimonial-thumb', 100, 100,true ); 
  add_image_size( 'home-product', 400, 400, true );
}

/* Entrada Javascript constant 
................................................ */
if ( ! function_exists( 'entrada_js_constant' ) ) {
	function entrada_js_constant(){
		$html = '';

		/* Facebook Open Graph */
		
		if (is_single()) {
			global $post;
			if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
				$thumbnail_id = get_post_thumbnail_id($post->ID);
				$thumbnail_object = get_post($thumbnail_id);
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');					
				$image = $thumb[0];
			} else {	
				$image = ''; 
			}
			$post_12 = get_post($post->ID); 
			$description = $post_12->post_content;
			wp_trim_words( strip_tags($description), 30, '...' );
			$description = str_replace("\"", "'", $description);

			$facebook_app_id = 220198652759638;
			$post_title = get_the_title();
			$post_permalink = get_permalink();
			$blog_name = get_bloginfo('name');
			
			echo "\n<meta property=\"fb:appid\" content=\"$facebook_app_id\" />";
			echo "\n<meta property=\"og:type\" content=\"website\" />";
			echo "\n<meta property=\"og:title\" content=\"$post_title\" />";
			echo "\n<meta property=\"og:url\" content=\"$post_permalink\" />";
			echo "\n<meta property=\"og:description\" content=\"$description\" />";		
			echo "\n<meta property=\"og:image\" content=\"$image\" />";
	        echo "\n<meta property=\"og:image:width\" content=\"384\" />";
	        echo "\n<meta property=\"og:image:height\" content=\"250\" />";
			echo "\n<meta property=\"og:site_name\" content=\"$blog_name\" />";
			echo "\n<meta property=\"og:locale\" content=\"en_US\" />";
		}
	}
}
add_action('wp_head', 'entrada_js_constant');