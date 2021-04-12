<?php
$source = empty( $source ) ? '' : $source;
$destination = empty( $destination ) ? '' : $destination;
$temporary_selected = empty( $temporary_selected ) ? '' : $temporary_selected;
$permanent_selected = empty( $permanent_selected ) ? '' : $permanent_selected;
$index = empty( $index ) ? 0 : $index;
?>

<div class="wds-add-edit-fields">

	<div class="sui-form-field">
		<label class="sui-label"><?php esc_attr_e( 'Old URL', 'wds' ); ?></label>
		<input class="sui-form-control wds-source-url"
		       value="<?php echo esc_attr( $source ); ?>"
		       placeholder="<?php esc_attr_e( 'E.g. /cats', 'wds' ); ?>" type="text"/>
	</div>

	<div class="sui-form-field">
		<label class="sui-label"><?php esc_attr_e( 'New URL', 'wds' ); ?></label>
		<input class="sui-form-control wds-destination-url"
		       value="<?php echo esc_attr( $destination ); ?>"
		       placeholder="<?php esc_attr_e( 'E.g. /cats-new', 'wds' ); ?>" type="text"/>
	</div>

	<div class="sui-form-field">
		<label class="sui-label"><?php esc_html_e( 'Redirect Type', 'wds' ); ?></label>
		<select class=" wds-redirect-type sui-select"
		        data-minimum-results-for-search="-1">
			<option <?php echo $temporary_selected; ?> value="302"><?php esc_html_e( 'Temporary', 'wds' ); ?></option>
			<option <?php echo $permanent_selected; ?> value="301"><?php esc_html_e( 'Permanent', 'wds' ); ?></option>
		</select>
		<span class="sui-description">
			<?php esc_html_e( 'This tells search engines whether to keep indexing the old page, or replace it with the new page.', 'wds' ); ?>
		</span>
	</div>

	<input type="hidden"
	       class="wds-redirect-index"
	       value="<?php echo esc_attr( $index ); ?>"/>

	<button type="button" data-modal-close
	        class="sui-button sui-button-ghost">
		<?php esc_html_e( 'Cancel', 'wds' ); ?>
	</button>

	<button type="button"
	        class="sui-button wds-action-button">
		<span class="sui-icon-check" aria-hidden="true"></span>

		<?php esc_html_e( 'Apply Redirect', 'wds' ); ?>
	</button>
</div>
