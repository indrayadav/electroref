<?php
$show_data_settings = empty( $show_data_settings ) ? false : $show_data_settings;
$active_tab = empty( $active_tab ) ? '' : $active_tab;

$tabs = array(
	array(
		'id'   => 'tab_general_settings',
		'name' => esc_html__( 'General Settings', 'wds' ),
	),
	array(
		'id'   => 'tab_user_roles',
		'name' => esc_html__( 'User Roles', 'wds' ),
	),
	array(
		'id'   => 'tab_import_export',
		'name' => esc_html__( 'Import / Export', 'wds' ),
	),
);

if ( $show_data_settings ) {
	$tabs[] = array(
		'id'   => 'tab_data',
		'name' => esc_html__( 'Data & Settings', 'wds' ),
	);
}
$tabs[] = array(
	'id'   => 'tab_accessibility',
	'name' => esc_html__( 'Accessibility', 'wds' ),
);

$this->_render( 'vertical-tabs-side-nav', array(
	'active_tab' => $active_tab,
	'tabs'       => $tabs,
) );
