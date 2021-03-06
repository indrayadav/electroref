<?php
/**
 * @var Smartcrawl_SeoReport $crawl_report
 */
$crawl_report = empty( $_view['crawl_report'] ) ? null : $_view['crawl_report'];
$active_issues = empty( $crawl_report ) ? 0 : (int) $crawl_report->get_issues_count();
?>

<div style="<?php echo $active_issues ? '' : 'display:none;'; ?>">
	<button class="wds-ignore-all wds-disabled-during-request sui-button sui-button-ghost">
		<span class="sui-loading-text">
			<span class="sui-icon-eye-hide" aria-hidden="true"></span> <?php esc_html_e( 'Ignore All', 'wds' ); ?>
		</span>

		<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
	</button>
</div>
