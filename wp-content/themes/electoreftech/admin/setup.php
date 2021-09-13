<?php 
/* BRICX USERS
---------------------------- */
function electroreftech_product_reviews() {
  $dashboard = 'dashicons-star-half';

  add_menu_page( __('Product Reviews', 'electoreftech'), __('Product Reviews', 'electoreftech'), 'manage_options', 'electro-product-reviews', 'electro_product_reviews', $dashboard , 22);
  add_submenu_page('electro-product-reviews', __('Requested Quotes', 'electoreftech'), __('Requested Quotes', 'electoreftech'), 'manage_options', 'requested-quote', 'electro_requested_quote' );
  
}

function electro_product_reviews(){
  include( get_template_directory() . '/admin/options/product_reviews.php' );
}

function electro_requested_quote(){
  include( get_template_directory() . '/admin/options/product_quote.php' );
}

add_action( 'admin_menu', 'electroreftech_product_reviews', 5 );

/* PRODUCT MAIN CATEGORIES */
function electroreftech_product_cat() {
  $dashboard = 'dashicons-portfolio';

  add_menu_page( __('Main Categories', 'electoreftech'), __('Main Categories', 'electoreftech'), 'manage_options', 'product-main-cat', 'electro_main_cat', $dashboard , 22);
  add_submenu_page('product-main-cat', __('Add New', 'electoreftech'), __('Add New', 'electoreftech'), 'manage_options', 'product-main-cat&mode=add', 'electro_main_cat' );
}

function electro_main_cat(){
  include( get_template_directory() . '/admin/options/product_main_cat.php' );
}

add_action( 'admin_menu', 'electroreftech_product_cat', 6 );

?>