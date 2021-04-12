<?php

// Products => Product Category
function electoreftech_product_category() {

  $labels = array(
		'name'                       => _x( 'Product Categories', 'Product Categories General Name', 'electoreftech' ),
		'singular_name'              => _x( 'Product Category', 'Product Category Singular Name', 'electoreftech' ),
		'menu_name'                  => __( 'Product Categories', 'electoreftech' ),
		'all_items'                  => __( 'All Items', 'electoreftech' ),
		'parent_item'                => __( 'Parent Product Category', 'electoreftech' ),
		'parent_item_colon'          => __( 'Parent Product Category:', 'electoreftech' ),
		'new_item_name'              => __( 'New Product Category Name', 'electoreftech' ),
		'add_new_item'               => __( 'Add New Product Category', 'electoreftech' ),
		'edit_item'                  => __( 'Edit Product Category', 'electoreftech' ),
		'update_item'                => __( 'Update Product Category', 'electoreftech' ),
		'view_item'                  => __( 'View Product Category', 'electoreftech' ),
		'separate_items_with_commas' => __( 'Separate Product Category with commas', 'electoreftech' ),
		'add_or_remove_items'        => __( 'Add or remove Product Category', 'electoreftech' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'electoreftech' ),
		'popular_items'              => __( 'Product Category', 'electoreftech' ),
		'search_items'               => __( 'Search Product Category', 'electoreftech' ),
		'not_found'                  => __( 'Not Found', 'electoreftech' ),
		'no_terms'                   => __( 'No items', 'electoreftech' ),
		'items_list'                 => __( 'Product Category list', 'electoreftech' ),
		'items_list_navigation'      => __( 'Product Category list navigation', 'electoreftech' ),
	);

  register_taxonomy('product_cat', 'product', array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'public' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product_cat' ),
  ));


}
add_action( 'init', 'electoreftech_product_category' );


// Products => Brand
function electoreftech_product_brand() {

	$labels = array(
		  'name'                       => _x( 'Product Brands', 'Product Brands General Name', 'electoreftech' ),
		  'singular_name'              => _x( 'Product Brand', 'Product Brand Singular Name', 'electoreftech' ),
		  'menu_name'                  => __( 'Product Brands', 'electoreftech' ),
		  'all_items'                  => __( 'All Items', 'electoreftech' ),
		  'parent_item'                => __( 'Parent Product Brand', 'electoreftech' ),
		  'parent_item_colon'          => __( 'Parent Product Brand:', 'electoreftech' ),
		  'new_item_name'              => __( 'New Product Brand Name', 'electoreftech' ),
		  'add_new_item'               => __( 'Add New Product Brand', 'electoreftech' ),
		  'edit_item'                  => __( 'Edit Product Brand', 'electoreftech' ),
		  'update_item'                => __( 'Update Product Brand', 'electoreftech' ),
		  'view_item'                  => __( 'View Product Brand', 'electoreftech' ),
		  'separate_items_with_commas' => __( 'Separate Product Brand with commas', 'electoreftech' ),
		  'add_or_remove_items'        => __( 'Add or remove Product Brand', 'electoreftech' ),
		  'choose_from_most_used'      => __( 'Choose from the most used', 'electoreftech' ),
		  'popular_items'              => __( 'Product Brand', 'electoreftech' ),
		  'search_items'               => __( 'Search Product Brand', 'electoreftech' ),
		  'not_found'                  => __( 'Not Found', 'electoreftech' ),
		  'no_terms'                   => __( 'No items', 'electoreftech' ),
		  'items_list'                 => __( 'Product Brand list', 'electoreftech' ),
		  'items_list_navigation'      => __( 'Product Brand list navigation', 'electoreftech' ),
	  );
  
	register_taxonomy('brand', 'product', array(
	  'hierarchical' => true,
	  'labels' => $labels,
	  'show_ui' => true,
	  'public' => true,
	  'show_admin_column' => true,
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'brand' ),
	));
  
  
  }
  add_action( 'init', 'electoreftech_product_brand' );


// Service => Category
function electoreftech_service_category() {

	$labels = array(
		  'name'                       => _x( 'Service Categories', 'Service Categories General Name', 'electoreftech' ),
		  'singular_name'              => _x( 'Service Category', 'Service Category Singular Name', 'electoreftech' ),
		  'menu_name'                  => __( 'Service Categories', 'electoreftech' ),
		  'all_items'                  => __( 'All Items', 'electoreftech' ),
		  'parent_item'                => __( 'Parent Service Category', 'electoreftech' ),
		  'parent_item_colon'          => __( 'Parent Service Category:', 'electoreftech' ),
		  'new_item_name'              => __( 'New Service Category Name', 'electoreftech' ),
		  'add_new_item'               => __( 'Add New Service Category', 'electoreftech' ),
		  'edit_item'                  => __( 'Edit Service Category', 'electoreftech' ),
		  'update_item'                => __( 'Update Service Category', 'electoreftech' ),
		  'view_item'                  => __( 'View Service Category', 'electoreftech' ),
		  'separate_items_with_commas' => __( 'Separate Service Category with commas', 'electoreftech' ),
		  'add_or_remove_items'        => __( 'Add or remove Service Category', 'electoreftech' ),
		  'choose_from_most_used'      => __( 'Choose from the most used', 'electoreftech' ),
		  'popular_items'              => __( 'Service Category', 'electoreftech' ),
		  'search_items'               => __( 'Search Service Category', 'electoreftech' ),
		  'not_found'                  => __( 'Not Found', 'electoreftech' ),
		  'no_terms'                   => __( 'No items', 'electoreftech' ),
		  'items_list'                 => __( 'Service Category list', 'electoreftech' ),
		  'items_list_navigation'      => __( 'Service Category list navigation', 'electoreftech' ),
	  );
  
	register_taxonomy('service_cat', 'service', array(
	  'hierarchical' => true,
	  'labels' => $labels,
	  'show_ui' => true,
	  'public' => true,
	  'show_admin_column' => true,
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'service_cat' ),
	));
  
  
  }
  add_action( 'init', 'electoreftech_service_category' );

  add_action( 'cmb2_init', 'cmb2_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function cmb2_register_taxonomy_metabox() {
	$prefix = '_product_brand_';

/**
 * Metabox to add fields to categories and tags
 */
$cmb_term = new_cmb2_box( array(
	'id'               => $prefix . 'edit',
	'title'            => esc_html__( 'Brand Logo', 'cmb2' ), // Doesn't output for term boxes
	'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
	'taxonomies'       => array( 'brand' ), // Tells CMB2 which taxonomies should have these fields
	'new_term_section' => true, // Will display in the "Add New Category" section
) );
		$cmb_term->add_field( array(
			'name' 			=> esc_html__( 'Upload brand logo', 'cmb2' ),
			'desc' 			=> esc_html__( 'Add an image to represent this brand.', 'cmb2' ),
			'id'   			=> $prefix . 'brand',
			'type' 			=> 'file',
			'column' 		=> array( 'position' => 8 ),
		) );
	// Add other metaboxes as needed
}

?>