<?php
/**
 * Electoreftech functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Electoreftech
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'electoreftech' ),
			)
		);

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
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'electoreftech_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
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
	$GLOBALS['content_width'] = apply_filters( 'electoreftech_content_width', 640 );
}
add_action( 'after_setup_theme', 'electoreftech_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function electoreftech_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'electoreftech' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'electoreftech' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="right-side-title"><span class="title-wrapper">
				<span class="blog-title-inner">',
			'after_title'   => '</span></span></div>',
		)
	);
}
add_action( 'widgets_init', 'electoreftech_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function electoreftech_scripts() {
	wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css', _S_VERSION );
	wp_enqueue_style( 'nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.0.0/nouislider.css' );
	wp_enqueue_style( 'theme', get_template_directory_uri() . '/css/theme.css' );
	wp_enqueue_style( 'chosen', get_template_directory_uri() . '/css/chosen.css', array(), _S_VERSION  );

	wp_enqueue_style( 'electoreftech-main', get_template_directory_uri() . '/css/main.css', _S_VERSION );
	
	wp_enqueue_style( 'electoreftech-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'electoreftech-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jquery-3.5.1.min', get_template_directory_uri() . '/js/jquery-3.5.1.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'owl.carousel', get_template_directory_uri() . '/js/owl.carousel.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'electoreftech-custom', get_template_directory_uri() . '/js/custom.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'megamenu', get_template_directory_uri() . '/js/megamenu.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'nouislider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.0.0/nouislider.js', array(), '20190207', true );
	wp_enqueue_script( 'chosen.jquery', get_template_directory_uri() . '/js/chosen.jquery.js', array(), '20190207', true );

	wp_enqueue_script( 'electoreftech-param', get_template_directory_uri() . '/js/electroref.js', array(), '20190207', true );
	
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

	wp_localize_script( 'electoreftech-param', 'electroref_params', $electroref_params);
	wp_enqueue_script( 'electoreftech-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

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