<?php
$cron = Smartcrawl_Controller_Cron::get();
// This does the actual rescheduling
$cron->set_up_schedule();
$crawler_freq = empty( $_view['options']['crawler-frequency'] ) ? false : $_view['options']['crawler-frequency'];
$option_name = empty( $_view['option_name'] ) ? '' : $_view['option_name'];
?>

<div id="wds-crawler-frequency-tabs" class="sui-side-tabs sui-tabs">
	<div class="sui-tabs-menu">
		<?php foreach ( $cron->get_frequencies() as $key => $label ) : ?>
			<label class="sui-tab-item <?php echo $key === $crawler_freq ? 'active' : ''; ?>">
				<?php echo esc_html( $label ); ?>

				<input name="<?php echo esc_attr( $option_name ); ?>[crawler-frequency]"
				       value="<?php echo esc_attr( $key ); ?>"
				       type="radio" <?php checked( $key, $crawler_freq ); ?>
				       class="hidden wds-crawler-frequency-radio"
				/>
			</label>
		<?php endforeach; ?>
	</div>
</div>

<div id="wds-crawler-frequency-pane" class="sui-border-frame">
	<div class="sui-row">
		<div class="sui-col wds-dow weekly">
			<div class="sui-form-field">
				<?php $this->_render( 'sitemap/sitemap-reporting-dow-select' ); ?>
			</div>
		</div>

		<div class="sui-col wds-dow monthly">
			<div class="sui-form-field">
				<?php $this->_render( 'sitemap/sitemap-reporting-dow-select', array(
					'monthly' => true,
				) ); ?>
			</div>
		</div>

		<div class="sui-col">
			<div class="sui-form-field">
				<?php $this->_render( 'sitemap/sitemap-reporting-tod-select' ); ?>
			</div>
		</div>
	</div>
</div>
