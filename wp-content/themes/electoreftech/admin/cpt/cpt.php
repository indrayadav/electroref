<?php
// Post Type Key: product
function create_posts_products() {
  $labels = array(
    'name' => __( 'Products', 'Post Type General Name', 'electoreftech' ),
    'singular_name' => __( 'Products', 'Post Type Singular Name', 'electoreftech' ),
    'menu_name' => __( 'Products', 'electoreftech' ),
    'name_admin_bar' => __( 'Products', 'electoreftech' ),
    'archives' => __( 'Products Archives', 'electoreftech' ),
    'attributes' => __( 'Products Attributes', 'electoreftech' ),
    'parent_item_colon' => __( 'Parent Products:', 'electoreftech' ),
    'all_items' => __( 'All Products', 'electoreftech' ),
    'add_new_item' => __( 'Add New Products', 'electoreftech' ),
    'add_new' => __( 'Add New', 'electoreftech' ),
    'new_item' => __( 'New Products', 'electoreftech' ),
    'edit_item' => __( 'Edit Products', 'electoreftech' ),
    'update_item' => __( 'Update Products', 'electoreftech' ),
    'view_item' => __( 'View Products', 'electoreftech' ),
    'view_items' => __( 'View Products', 'electoreftech' ),
    'search_items' => __( 'Search Products', 'electoreftech' ),
    'not_found' => __( 'Not found', 'electoreftech' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'electoreftech' ),
    'featured_image' => __( 'Featured Image', 'electoreftech' ),
    'set_featured_image' => __( 'Set featured image', 'electoreftech' ),
    'remove_featured_image' => __( 'Remove featured image', 'electoreftech' ),
    'use_featured_image' => __( 'Use as featured image', 'electoreftech' ),
    'insert_into_item' => __( 'Insert into Products', 'electoreftech' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Products', 'electoreftech' ),
    'items_list' => __( 'Products list', 'electoreftech' ),
    'items_list_navigation' => __( 'Products list navigation', 'electoreftech' ),
    'filter_items_list' => __( 'Filter Products list', 'electoreftech' ),
  );
  $args = array(
    'label'               => __( 'Products', 'electoreftech' ),
    'description'         => __( 'All Products', 'electoreftech' ),
    'labels'              => $labels,
    'menu_icon'           => 'dashicons-products',
    'supports'            => array('title', 'editor', 'thumbnail', ),
    'public'              => true,
    'hierarchical'        => false,
    'show_ui'             => true,
    'has_archive'         => false,
    'rewrite'             => true,
    'rewrite'      => array( 'slug' => 'product', 'with_front' => false ),
    'publicly_queryable' => true,
    'query_var' => true,
  );
  register_post_type( 'product', $args );
  flush_rewrite_rules( false );

}
add_action( 'init', 'create_posts_products', 0 );


// Post Type Key: Services
function create_posts_services() {
    $labels = array(
      'name' => __( 'Services', 'Post Type General Name', 'electoreftech' ),
      'singular_name' => __( 'Services', 'Post Type Singular Name', 'electoreftech' ),
      'menu_name' => __( 'Services', 'electoreftech' ),
      'name_admin_bar' => __( 'Services', 'electoreftech' ),
      'archives' => __( 'Services Archives', 'electoreftech' ),
      'attributes' => __( 'Services Attributes', 'electoreftech' ),
      'parent_item_colon' => __( 'Parent Services:', 'electoreftech' ),
      'all_items' => __( 'All Services', 'electoreftech' ),
      'add_new_item' => __( 'Add New Services', 'electoreftech' ),
      'add_new' => __( 'Add New', 'electoreftech' ),
      'new_item' => __( 'New Services', 'electoreftech' ),
      'edit_item' => __( 'Edit Services', 'electoreftech' ),
      'update_item' => __( 'Update Services', 'electoreftech' ),
      'view_item' => __( 'View Services', 'electoreftech' ),
      'view_items' => __( 'View Services', 'electoreftech' ),
      'search_items' => __( 'Search Services', 'electoreftech' ),
      'not_found' => __( 'Not found', 'electoreftech' ),
      'not_found_in_trash' => __( 'Not found in Trash', 'electoreftech' ),
      'featured_image' => __( 'Featured Image', 'electoreftech' ),
      'set_featured_image' => __( 'Set featured image', 'electoreftech' ),
      'remove_featured_image' => __( 'Remove featured image', 'electoreftech' ),
      'use_featured_image' => __( 'Use as featured image', 'electoreftech' ),
      'insert_into_item' => __( 'Insert into Services', 'electoreftech' ),
      'uploaded_to_this_item' => __( 'Uploaded to this Services', 'electoreftech' ),
      'items_list' => __( 'Services list', 'electoreftech' ),
      'items_list_navigation' => __( 'Services list navigation', 'electoreftech' ),
      'filter_items_list' => __( 'Filter Services list', 'electoreftech' ),
    );
    $args = array(
      'label'               => __( 'Services', 'electoreftech' ),
      'description'         => __( 'All Services', 'electoreftech' ),
      'labels'              => $labels,
      'menu_icon'           => 'dashicons-buddicons-groups',
      'supports'            => array('title', 'editor', 'thumbnail', ),
      'public'              => true,
      'hierarchical'        => false,
      'show_ui'             => true,
      'has_archive'         => false,
      'rewrite'             => true,
      'rewrite'      => array( 'slug' => 'service', 'with_front' => false ),
      'publicly_queryable' => true,
      'query_var' => true,
    );
    register_post_type( 'service', $args );
    flush_rewrite_rules( false );
  
  }
  add_action( 'init', 'create_posts_services', 0 );


?>