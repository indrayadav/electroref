<?php
$issue_count = empty( $issue_count ) ? 0 : $issue_count;
$button_text = $issue_count > 1
	? __( 'Ignore All', 'wds' )
	: __( 'Ignore', 'wds' );
?>
<tr class="wds-controls-row">
	<td>
		<button class="wds-ignore-all wds-disabled-during-request sui-button sui-button-ghost">
			<span class="sui-loading-text">
				<span class="sui-icon-eye-hide"
				   aria-hidden="true"></span> <?php echo esc_html( $button_text ); ?>
			</span>

			<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
		</button>
	</td>
	<td>
		<button class="wds-add-all-to-sitemap wds-disabled-during-request sui-button sui-button-blue">
			<span class="sui-loading-text">
				<span class="sui-icon-plus"
				   aria-hidden="true"></span> <?php esc_html_e( 'Add All to Sitemap', 'wds' ); ?>
			</span>

			<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
		</button>
	</td>
</tr>
