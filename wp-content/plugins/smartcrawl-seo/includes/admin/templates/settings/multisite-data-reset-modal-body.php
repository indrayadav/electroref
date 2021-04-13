<?php
$id = empty( $id ) ? '' : $id;
?>

<div class="wds-multisite-data-reset-modal-body">
	<p class="sui-description"><?php esc_html_e( 'Are you sure you want to reset all the subsites?', 'wds' ); ?></p>

	<button type="button" data-modal-close
	        class="sui-button sui-button-ghost">

		<?php esc_html_e( 'Cancel', 'wds' ); ?>
	</button>

	<button type="button"
	        class="sui-button sui-button-ghost sui-button-red wds-multisite-data-reset-button">
		<span class="sui-loading-text">
			<span class="sui-icon-refresh" aria-hidden="true"></span> <?php esc_html_e( 'Reset', 'wds' ); ?>
		</span>

		<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
	</button>
</div>

<?php wp_nonce_field( 'wds-multisite-data-reset-nonce', '_multi_data_reset_nonce', false ); ?>
