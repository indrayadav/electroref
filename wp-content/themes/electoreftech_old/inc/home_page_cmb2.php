<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Electoreftech
 */
add_action( 'cmb2_admin_init', 'electroreftech_page_metabox' );
/**
 * Hook in and add a metabox that only appears on the 'About' page
 */
function electroreftech_page_metabox() {

	/**
	 * What We Do
	 */
	$wwd_group = new_cmb2_box( array(
		'id'           => 'what-we-do',
		'title'        => esc_html__( 'What We Do', 'cmb2' ),
		'object_types' => array( 'page' ),
	) );

	// $wwd_group_id is the field id string, so in this case: 'yourprefix_group_demo'
	$wwd_group_id = $wwd_group->add_field( array(
		'id'          => 'what-we-do',
		'type'        => 'group',
		'description' => esc_html__( 'Generate What We Do fields', 'cmb2' ),
		'options'     => array(
			'group_title'    => esc_html__( 'What We Do {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Add Another What We Do', 'cmb2' ),
			'remove_button'  => esc_html__( 'Remove What We Do', 'cmb2' ),
			'sortable'       => true,
			 'closed'      => true, // true to have the groups closed by default
			'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );

	$wwd_group->add_group_field( $wwd_group_id, array(
		'name'       => esc_html__( 'Entry Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',		
	) );

	$wwd_group->add_group_field( $wwd_group_id, array(
		'name'       => esc_html__( 'Entry Icon', 'cmb2' ),
		'id'         => 'icon',
		'type'       => 'text',		
	) );

	$wwd_group->add_group_field( $wwd_group_id, array(
		'name'        => esc_html__( 'Description', 'cmb2' ),
		'description' => esc_html__( 'Write a short description for this entry', 'cmb2' ),
		'id'          => 'description',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
		),
	) );

	$wwd_group->add_group_field( $wwd_group_id, array(
		'name' => esc_html__( 'Entry Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );



	$wcs_group = new_cmb2_box( array(
		'id'           => 'what-we-do',
		'title'        => esc_html__( 'What Client Says', 'cmb2' ),
		'object_types' => array( 'page' ),
	) );

	// $wwd_group_id is the field id string, so in this case: 'yourprefix_group_demo'
	$wcs_group_id = $wcs_group->add_field( array(
		'id'          => 'what-client-says',
		'type'        => 'group',
		'description' => esc_html__( 'Generate What Clients Says', 'cmb2' ),
		'options'     => array(
			'group_title'    => esc_html__( 'What Clients Says {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'     => esc_html__( 'Add Another What Clients Says', 'cmb2' ),
			'remove_button'  => esc_html__( 'Remove What Clients Says', 'cmb2' ),
			'sortable'       => true,
			 'closed'      => true, // true to have the groups closed by default
			 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );

	$wcs_group->add_group_field( $wcs_group_id, array(
		'name'       => esc_html__( 'Client name', 'cmb2' ),
		'id'         => 'name',
		'type'       => 'text',		
	) );

	

	$wcs_group->add_group_field( $wcs_group_id, array(
		'name'        => esc_html__( 'Thoughts', 'cmb2' ),
		'description' => esc_html__( 'Write a short thoughts for this entry', 'cmb2' ),
		'id'          => 'thoughts',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
		),
	) );

	$wcs_group->add_group_field( $wcs_group_id, array(
		'name' => esc_html__( 'Client Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );


	

}
