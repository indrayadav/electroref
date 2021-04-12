<?php 
/* Product => post meta
-------------------------------------------------*/

function product_post_meta() {
    $prefix = 'product_';

    $cmb_product = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => esc_html__( 'Product General Informations', 'cmb2' ),
        'object_types'  => array( 'product' ), // Post type
      ) );

      $cmb_product->add_field( array(
        'name'             => esc_html__( 'Product Type', 'cmb2' ),
        'desc'             => esc_html__( 'Add product type(New/ Used)', 'cmb2' ),
        'id'               => $prefix . 'type',
        'type'             => 'select',
        'show_option_none' => false,
        'options'          => array(
              'Brand New' => esc_html__( 'Brand New', 'cmb2' ),
              'used'   => esc_html__( 'Used', 'cmb2' ),
            ),
    ) );

    $cmb_product->add_field( array(
      'name'     => esc_html__( 'Test Taxonomy Radio', 'cmb2' ),
      'desc'     => esc_html__( 'field description (optional)', 'cmb2' ),
      'id'       => 'yourprefix_demo_text_taxonomy_radio',
      'type'     => 'taxonomy_radio', // Or `taxonomy_radio_inline`/`taxonomy_radio_hierarchical`
      'taxonomy' => 'brand', // Taxonomy Slug
      // 'inline'  => true, // Toggles display to inline
      // Optionally override the args sent to the WordPress get_terms function.
      'query_args' => array(
        // 'orderby' => 'slug',
        // 'hide_empty' => true,
      ),
    ) );

    $cmb_product->add_field( array(
      'name'             => esc_html__( 'Product Stock', 'cmb2' ),
      'desc'             => esc_html__( 'Select product stock', 'cmb2' ),
      'id'               => $prefix . 'stock',
      'type'             => 'select',
      'show_option_none' => false,
      'options'          => array(
            'stock_in' => esc_html__( 'In Stock', 'cmb2' ),
            'stock_out'   => esc_html__( 'Out of Stock', 'cmb2' ),
          ),
  ) );

    $cmb_product->add_field( array(
      'name' => esc_html__( 'SKU', 'cmb2' ),
      'desc' => esc_html__( 'Add product SKU', 'cmb2' ),
      'id'   => $prefix . 'sku',
      'type' => 'text',
    ) );

    $cmb_product->add_field( array(
      'name' => esc_html__( 'Model No', 'cmb2' ),
      'desc' => esc_html__( 'Add product model number', 'cmb2' ),
      'id'   => $prefix . 'model',
      'type' => 'text',
    ) );

    $cmb_product->add_field( array(
      'name' => esc_html__( 'Regular Price', 'cmb2' ),
      'desc' => esc_html__( 'Add regular product price (NPR)', 'cmb2' ),
      'id'   => $prefix . 'price',
      'type' => 'text',
    ) );
    
    $cmb_product->add_field( array(
      'name' => esc_html__( 'Offer Price', 'cmb2' ),
      'desc' => esc_html__( 'Add offer product price (NPR)', 'cmb2' ),
      'id'   => $prefix . 'sale_price',
      'type' => 'text',
    ) );
    
    $cmb_product->add_field( array(
		'name' => esc_html__( 'Offer Start Date', 'cmb2' ),
		'desc' => esc_html__( 'Choose offer start date (optional)', 'cmb2' ),
		'id'   => $prefix . 'offer_start_date',
		'type' => 'text_date',
		// 'date_format' => 'Y-m-d',
	) );
	
	$cmb_product->add_field( array(
		'name' => esc_html__( 'Offer End Date', 'cmb2' ),
		'desc' => esc_html__( 'Choose offer end date (optional)', 'cmb2' ),
		'id'   => $prefix . 'offer_end_date',
		'type' => 'text_date',
		// 'date_format' => 'Y-m-d',
	) );
	
	$cmb_product->add_field( array(
		'name' => esc_html__( 'Test Date Picker', 'cmb2' ),
		'desc' => esc_html__( 'Choose offer start date (optional)', 'cmb2' ),
		'id'   => $prefix . 'offer_start_date',
		'type' => 'text_date',
		// 'date_format' => 'Y-m-d',
  ) );
  
  $cmb_product->add_field( array(
		'name' => esc_html__( 'Warranty', 'cmb2' ),
		'desc' => esc_html__( 'Add warranty text  (optional)', 'cmb2' ),
		'id'   => $prefix . 'warranty',
		'type' => 'textarea_small',
  ) );
  
  $cmb_product->add_field( array(
		'name' => esc_html__( 'Installation Fee', 'cmb2' ),
		'desc' => esc_html__( 'Add installation Fee (optional)', 'cmb2' ),
		'id'   => $prefix . 'installation_fee',
		'type' => 'textarea_small',
  ) );
  
  $cmb_product->add_field( array(
		'name' => esc_html__( 'Delivery Charge', 'cmb2' ),
		'desc' => esc_html__( 'Add Delivery Charge (optional)', 'cmb2' ),
		'id'   => $prefix . 'delivery_fee',
		'type' => 'textarea_small',
	) );

    $cmb_product->add_field( array(
      'name'         => esc_html__( 'Upload product images', 'cmb2' ),
      'desc'         => esc_html__( 'Upload or add multiple images/attachments.', 'cmb2' ),
      'id'           => $prefix . 'gallery_list',
      'type'         => 'file_list',
      'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
    ) );
    
    
   
}


add_action( 'cmb2_admin_init', 'product_post_meta' );

/* Service => post meta
-------------------------------------------------*/
function service_post_meta() {
  $prefix = 'service_';

  $cmb_service = new_cmb2_box( array(
      'id'            => $prefix . 'service',
      'title'         => esc_html__( 'Service General Informations', 'cmb2' ),
      'object_types'  => array( 'service' ), // Post type
    ) );

    $cmb_service->add_field( array(
      'name' => esc_html__( 'Service Icon', 'cmb2' ),
      'desc' => esc_html__( 'Add icon from flaticon.', 'cmb2' ),
      'id'   => $prefix . 'icon',
      'type' => 'text',
    ) );

}

add_action( 'cmb2_admin_init', 'service_post_meta' );

function electroref_page_post_meta() {
  $prefix = 'electroref_';

  $cmb_page = new_cmb2_box( array(
      'id'            => $prefix . 'electroref_page',
      'title'         => esc_html__( 'Page Banner Details', 'cmb2' ),
      'object_types'  => array( 'page' ), // Post type
    ) );

    $cmb_page->add_field( array(
      'name' => esc_html__( 'Upload Banner Image', 'cmb2' ),
      'desc' => esc_html__( 'Upload an image or enter a URL. (1903 * 323)', 'cmb2' ),
      'id'   =>  $prefix . 'page_banner',
      'type' => 'file',
    ) );

    $cmb_page->add_field( array(
      'name' => esc_html__( 'Page sub-heading', 'cmb2' ),
      'desc' => esc_html__( 'Add page sub heading here.', 'cmb2' ),
      'id'   => $prefix . 'sub_heading',
      'type' => 'text',
    ) );

  }

add_action( 'cmb2_admin_init', 'electroref_page_post_meta' );


/* Post => post meta
-------------------------------------------------*/

function post_post_meta() {
  $prefix = 'post_';

  $cmb_product = new_cmb2_box( array(
      'id'            => $prefix . 'metabox',
      'title'         => esc_html__( 'Blog Banner Image', 'cmb2' ),
      'object_types'  => array( 'post' ), // Post type
    ) );

  $cmb_product->add_field( array(
    'name'         => esc_html__( 'Banner for Blog', 'cmb2' ),
    'desc'         => esc_html__( 'Upload or add banner image.', 'cmb2' ),
    'id'           => $prefix . 'blog_banner',
    'type'         => 'file',
    'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
  ) );
 
 
}


add_action( 'cmb2_admin_init', 'post_post_meta' );

?>