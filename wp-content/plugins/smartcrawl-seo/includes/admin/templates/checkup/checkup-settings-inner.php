<?php
$active_tab = empty( $active_tab ) ? '' : $active_tab;
$is_member = empty( $is_member ) ? false : true;
$email_recipients = empty( $email_recipients ) ? array() : $email_recipients;
$options = Smartcrawl_Settings::get_component_options( Smartcrawl_Settings::COMP_CHECKUP );
$checkup_cron_enabled = ! empty( $options['checkup-cron-enable'] ) && $is_member;
?>

<div class="wds-seo-checkup-stats-container">
	<?php $this->_render( 'checkup/checkup-top' ); ?>
</div>

<form action='<?php echo esc_attr( $_view['action_url'] ); ?>' method='post' class="wds-form">
	<?php $this->settings_fields( $_view['option_name'] ); ?>

	<input type="hidden"
	       name='<?php echo esc_attr( $_view['option_name'] ); ?>[<?php echo esc_attr( $_view['slug'] ); ?>-setup]'
	       value="1">

	<div class="wds-vertical-tabs-container sui-row-with-sidenav">

		<?php $this->_render( 'checkup/checkup-side-nav', array(
			'active_tab' => $active_tab,
		) ); ?>

		<?php
		$this->_render( 'vertical-tab', array(
			'tab_id'       => 'tab_checkup',
			'tab_name'     => esc_html__( 'Checkup', 'wds' ),
			'button_text'  => false,
			'is_active'    => 'tab_checkup' === $active_tab,
			'tab_sections' => array(
				array(
					'section_template' => 'checkup/checkup-checkup',
				),
			),
		) );
		?>
		<?php
		$this->_render(
			'vertical-tab-upsell',
			array(
				'tab_id'             => 'tab_settings',
				'tab_name'           => esc_html__( 'Reporting', 'wds' ),
				'is_active'          => 'tab_settings' === $active_tab,
				'button_text'        => $is_member ? esc_html__( 'Save Settings', 'wds' ) : '',
				'title_actions_left' => 'checkup/checkup-reporting-title-pro-tag',
				'tab_sections'       => array(
					array(
						'section_template' => 'checkup/checkup-reporting',
						'section_args'     => array(
							'checkup_cron_enabled' => $checkup_cron_enabled,
							'email_recipients'     => $email_recipients,
						),
					),
				),
			)
		);
		?>

	</div>
</form>
