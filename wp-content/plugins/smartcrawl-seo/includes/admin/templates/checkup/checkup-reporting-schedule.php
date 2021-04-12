<?php
$checkup_freq = empty( $checkup_freq ) ? false : $checkup_freq;
$cron = Smartcrawl_Controller_Cron::get();

// This does the actual rescheduling
$cron->set_up_schedule();
$is_member = empty( $_view['is_member'] ) ? false : true;
$option_name = empty( $_view['option_name'] ) ? '' : $_view['option_name'];
$disabled = $is_member ? '' : 'disabled';
?>
<div id="wds-checkup-frequency-tabs" class="sui-side-tabs sui-tabs">
	<div class="sui-tabs-menu">
		<?php foreach ( $cron->get_frequencies() as $key => $label ) : ?>
			<label class="sui-tab-item <?php echo $key === $checkup_freq ? 'active' : ''; ?>">

				<?php echo esc_html( $label ); ?>
				<input name="<?php echo esc_attr( $option_name ); ?>[checkup-frequency]"
				       value="<?php echo esc_attr( $key ); ?>"
				       type="radio" <?php checked( $key, $checkup_freq ); ?>
				       class="wds-checkup-frequency-radio"
				/>
			</label>
		<?php endforeach; ?>
	</div>
</div>

<div id="wds-checkup-frequency-pane" class="sui-border-frame">
	<div class="sui-row">
		<div class="sui-col wds-dow weekly">
			<div class="sui-form-field">
				<?php $this->_render( 'checkup/checkup-reporting-dow-select' ); ?>
			</div>
		</div>

		<div class="sui-col wds-dow monthly">
			<div class="sui-form-field">
				<?php $this->_render( 'checkup/checkup-reporting-dow-select', array(
					'monthly' => true,
				) ); ?>
			</div>
		</div>

		<div class="sui-col">
			<div class="sui-form-field">
				<?php $this->_render( 'checkup/checkup-reporting-tod-select' ); ?>
			</div>
		</div>
	</div>
</div>
