<?php
/* Electoreftech Theme activation hook
................................................. */
if ( ! function_exists( 'electoreftech_create_dynamic_table' ) ) {
	function electoreftech_create_dynamic_table() {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // Estimated chart
    $sql_main_categories = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."main_categories` ( `id` bigint(20) not null auto_increment, 
    `title` varchar(240) not null,
    `term_ids` text,
    `item_order` int(11), PRIMARY KEY  (`id`));";

    dbDelta($sql_main_categories);

    }
}
add_action('after_switch_theme', 'electoreftech_create_dynamic_table');


function electoreftech_bricx_orders() {
    $dashboard = get_template_directory_uri() . '/library/admin/assets/images/order.png';

    add_menu_page( __('Main Cateories', 'electoreftech'), __('Main Cateories', 'electoreftech'), 'manage_options', 'order', 'property_orders_fallback', $dashboard , 22);
    
  }

add_action( 'admin_menu', 'electoreftech_bricx_orders', 3 );
?>