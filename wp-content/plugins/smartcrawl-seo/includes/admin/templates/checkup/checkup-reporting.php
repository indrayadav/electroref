<?php
$option_name = empty( $_view['option_name'] ) ? '' : $_view['option_name'];
$toggle_field_name = $option_name . '[checkup-cron-enable]';
$is_member = empty( $_view['is_member'] ) ? false : true;
$checkup_cron_enabled = empty( $checkup_cron_enabled ) ? false : true;
$checkup_freq = isset( $_view['options']['checkup-frequency'] ) ? $_view['options']['checkup-frequency'] : false;
$email_recipients = empty( $email_recipients ) ? array() : $email_recipients;
$cron = Smartcrawl_Controller_Cron::get();
$frequencies = $cron->get_frequencies();
?>

<div class="wds-upsell-tab-description">
	<div>
		<p><?php esc_html_e( 'Set up SmartCrawl to automatically run a comprehensive SEO Checkup daily, weekly or monthly and receive an email report to as many recipients as you like.', 'wds' ); ?></p>
	</div>

	<?php if ( $checkup_cron_enabled && ! empty( $email_recipients ) ): ?>
		<?php $this->_render( 'notice', array(
			'message' => sprintf(
				_n(
					'Automatic checkups are enabled and sending %1$s to %2$d recipient.',
					'Automatic checkups are enabled and sending %1$s to %2$d recipients.',
					count( $email_recipients ),
					'wds'
				),
				smartcrawl_get_array_value( $frequencies, $checkup_freq ),
				count( $email_recipients )
			),
			'class'   => 'sui-notice-info',
		) ); ?>
	<?php endif; ?>
</div>
<div class="sui-box-settings-row <?php echo $is_member ? '' : 'sui-disabled'; ?>">
	<div class="sui-box-settings-col-1">
		<label class="sui-settings-label">

			<?php esc_html_e( 'Schedule automatic checkups', 'wds' ); ?>
		</label>
		<span class="sui-description">
			<?php esc_html_e( 'Enable automated SEO reports for this website.', 'wds' ); ?>
		</span>
	</div>
	<div class="sui-box-settings-col-2">
		<?php
		$this->_render( 'toggle-item', array(
			'field_name'                 => $toggle_field_name,
			'field_id'                   => $toggle_field_name,
			'checked'                    => $checkup_cron_enabled,
			'item_label'                 => esc_html__( 'Enable regular checkups', 'wds' ),
			'sub_settings_template'      => 'checkup/checkup-recipients',
			'sub_settings_template_args' => array(
				'option_name'      => $option_name,
				'checkup_freq'     => $checkup_freq,
				'email_recipients' => $email_recipients,
			),
		) );
		?>
	</div>
</div>

<?php if ( ! $is_member ): ?>
	<?php $this->_render( 'mascot-message', array(
		'key'         => 'seo-checkup-upsell',
		'dismissible' => false,
		'message'     => sprintf(
			'%s <strong>%s</strong> <a target="_blank" class="sui-button sui-button-purple" href="https://wpmudev.com/project/smartcrawl-wordpress-seo/?utm_source=smartcrawl&utm_medium=plugin&utm_campaign=smartcrawl_seocheckup_reporting_upsell_notice">%s</a>',
			esc_html__( 'Upgrade to Pro to unlock unlimited SEO Checkups with automated scheduled reports to always stay on top of any issues.', 'wds' ),
			esc_html__( 'Try it all FREE today!', 'wds' ),
			esc_html__( 'Try it FREE today', 'wds' )
		),
	) ); ?>
<?php endif; ?>
