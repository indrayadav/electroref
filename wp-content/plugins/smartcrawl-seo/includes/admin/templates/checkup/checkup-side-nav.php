<?php
$active_tab = empty( $active_tab ) ? '' : $active_tab;
$issue_count = empty( $issue_count ) ? 0 : $issue_count;
$is_member = empty( $is_member ) ? false : true;
$options = Smartcrawl_Settings::get_component_options( Smartcrawl_Settings::COMP_CHECKUP );
$checkup_cron_enabled = ! empty( $options['checkup-cron-enable'] ) && $is_member;

$this->_render( 'vertical-tabs-side-nav', array(
	'active_tab' => $active_tab,
	'tabs'       => array(
		array(
			'id'        => 'tab_checkup',
			'name'      => esc_html__( 'Checkup', 'wds' ),
			'tag_value' => $issue_count > 0 ? $issue_count : false,
			'tag_class' => 'sui-tag-warning',
		),
		array(
			'id'   => 'tab_settings',
			'name' => esc_html__( 'Reporting', 'wds' ),
			'tick' => $checkup_cron_enabled,
		),
	),
) );
