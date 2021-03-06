<div data-issue-id="{{- issue_id }}">

	<p class="sui-description">
		<?php
		printf(
			esc_html__( 'Choose where to redirect %s', 'wds' ),
			'<br/><strong><a href="{{- issue_path }}">{{- issue_path }}</a></strong>'
		);
		?>
	</p>
	<div class="sui-form-field">
		<label for="wds-redirect-target"
		       class="sui-label"><?php esc_html_e( 'New URL', 'wds' ); ?></label>
		<input id="wds-redirect-target"
		       type="url"
		       name="redirect"
		       value="{{- issue_redirect_path }}"
		       class="sui-form-control"
		       placeholder="<?php esc_attr_e( 'Enter new URL', 'wds' ); ?>"/>
		<p class="sui-description">
			<small>
				<?php
				$advanced_url = Smartcrawl_Settings_Admin::admin_url( Smartcrawl_Settings::TAB_AUTOLINKS ) . '&tab=tab_url_redirection';
				printf(
					esc_html__( 'Formats include relative URLs like %1$s or absolute URLs like %2$s. This feature will automatically redirect traffic from the broken URL to this new URL, you can view all your redirections under %3$s.', 'wds' ),
					sprintf( '<strong>%s</strong>', esc_html__( '/cats', 'wds' ) ),
					sprintf( '<strong>%s</strong>', esc_html__( 'https://website.com/cats', 'wds' ) ),
					sprintf( '<strong><a href="%s">%s</a></strong>', esc_url( $advanced_url ), esc_html__( 'Advanced Tools', 'wds' ) )
				);
				?>
			</small>
		</p>
	</div>

	<input type="hidden" name="source" value="{{- issue_path }}"/>
	<?php wp_nonce_field( 'wds-redirect', 'wds-redirect' ); ?>

	<button data-modal-close=""
	        type="button"
	        aria-label="<?php esc_attr_e( 'Close this dialog window', 'wds' ); ?>"
	        class="sui-button sui-button-ghost"><?php esc_html_e( 'Cancel', 'wds' ); ?></button>

	<button type="button"
	        class="sui-button wds-submit-redirect wds-disabled-during-request">
		<span class="sui-loading-text"><span class="sui-icon-check" aria-hidden="true"></span>
			<?php esc_html_e( 'Apply', 'wds' ); ?>
		</span>
		<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
	</button>
</div>
