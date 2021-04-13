<?php
$checkup_available = is_main_site();
if ( ! $checkup_available ) {
	return;
}

$page_url = Smartcrawl_Settings_Admin::admin_url( Smartcrawl_Settings::TAB_CHECKUP );
$checkup_url = Smartcrawl_Settings_Dashboard::checkup_url();
$options = Smartcrawl_Settings::get_options();
$reporting_enabled = smartcrawl_get_array_value( $options, 'checkup-cron-enable' );
$last_checked = ! empty( $last_checked_timestamp );
$in_progress = empty( $in_progress ) ? false : true;
$option_name = Smartcrawl_Settings::TAB_SETTINGS . '_options';
$checkup_text = esc_html__( 'Get a comprehensive report on how optimized your website is for search engines and social media. We recommend running this checkup first to see what needs improving.', 'wds' );
$items = ! $in_progress && $last_checked && ! empty( $items ) ? $items : array();
$issue_count = empty( $issue_count ) ? 0 : $issue_count;
$checkup_issues_tooltip = _n(
	'You have %d outstanding SEO issue to fix up',
	'You have %d outstanding SEO issues to fix up',
	$issue_count,
	'wds'
);
$checkup_issues_tooltip = sprintf( $checkup_issues_tooltip, $issue_count );
?>
<section id="<?php echo esc_attr( Smartcrawl_Settings_Dashboard::BOX_SEO_CHECKUP ); ?>"
         data-dependent="<?php echo esc_attr( Smartcrawl_Settings_Dashboard::BOX_TOP_STATS ); ?>"
         class="sui-box wds-dashboard-widget">
	<div class="sui-box-header">
		<h2 class="sui-box-title">
			<span class="sui-icon-smart-crawl" aria-hidden="true"></span><?php esc_html_e( 'SEO Checkup', 'wds' ); ?>
		</h2>

		<?php if ( $issue_count > 0 ) : ?>
			<div class="sui-actions-left">
				<span class="sui-tag sui-tag-warning sui-tooltip"
				      data-tooltip="<?php echo esc_attr( $checkup_issues_tooltip ); ?>">
					<?php echo intval( $issue_count ); ?>
				</span>
			</div>
		<?php elseif ( $in_progress ): ?>
			<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
		<?php endif; ?>

		<?php if ( $items ): ?>
			<div class="sui-actions-right">
				<a href="<?php echo esc_attr( $checkup_url ); ?>"
				   aria-label="<?php esc_html_e( 'Run SEO checkup', 'wds' ); ?>"
				   class="sui-button sui-button-blue">
					<span class="sui-icon-plus" aria-hidden="true"></span>

					<?php esc_html_e( 'Run checkup', 'wds' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<div class="sui-box-body">
		<?php
		if ( ! $last_checked && ! $in_progress ) {
			printf( '<p>%s</p>', esc_html( $checkup_text ) );
		} elseif ( $in_progress ) {
			$this->_render( 'dashboard/dashboard-checkup-progress' );
		} else {
			$this->_render( 'dashboard/dashboard-mini-checkup-report', array(
				'reporting_enabled' => $reporting_enabled,
			) );
		}
		?>
	</div>
	<?php if ( ! $last_checked && ! $in_progress ): ?>
		<div class="sui-box-footer">
			<a href="<?php echo esc_attr( $checkup_url ); ?>"
			   class="sui-button sui-button-blue">
				<span class="sui-icon-plus" aria-hidden="true"></span>

				<?php esc_html_e( 'Run checkup', 'wds' ); ?>
			</a>

			<span>
				<small>
					<?php echo empty( $reporting_enabled )
						? esc_html__( 'Automatic checkups are disabled', 'wds' )
						: esc_html__( 'Automatic checkups are enabled', 'wds' ); ?>
				</small>
			</span>
		</div>
	<?php endif; ?>
</section>
