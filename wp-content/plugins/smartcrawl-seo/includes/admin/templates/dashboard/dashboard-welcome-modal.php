<?php $id = 'wds-welcome-modal'; ?>

<div class="sui-modal sui-modal-md">
	<div role="dialog"
	     id="<?php echo esc_attr( $id ); ?>"
	     class="sui-modal-content <?php echo esc_attr( $id ); ?>-dialog"
	     aria-modal="true"
	     aria-labelledby="<?php echo esc_attr( $id ); ?>-dialog-title"
	     aria-describedby="<?php echo esc_attr( $id ); ?>-dialog-description">

		<div class="sui-box" role="document">
			<div class="sui-box-header sui-flatten sui-content-center sui-spacing-top--40">
				<div class="sui-box-banner" role="banner" aria-hidden="true">
					<img src="<?php echo esc_attr( SMARTCRAWL_PLUGIN_URL ); ?>assets/images/graphic-upgrade-header.svg"/>
				</div>

				<button class="sui-button-icon sui-button-float--right" data-modal-close
				        id="<?php echo esc_attr( $id ); ?>-close-button"
				        type="button">
					<span class="sui-icon-close sui-md" aria-hidden="true"></span>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wds' ); ?></span>
				</button>

				<h3 class="sui-box-title sui-lg"
				    id="<?php echo esc_attr( $id ); ?>-dialog-title">

					<?php esc_html_e( 'NEW: Local Business schema type!', 'wds' ); ?>
				</h3>

				<div class="sui-box-body sui-content-center">
					<p class="sui-description"
					   id="<?php echo esc_attr( $id ); ?>-dialog-description">
						<span>
							<?php esc_html_e( "Another highly-requested feature to help search engines better understand your site’s content and increase your visibility in search results.", 'wds' ); ?>
						</span>

						<span>
							<?php echo __( "You can now add and customize the <strong>Local Business type</strong>. This new type offers all the specific subtypes and the ability to add multiple locations and opening hours. It also includes the properties that are required by Google, which are incorporated by default. However, the Schema builder also allows you to fine-tune the type to suit your Business's requirements, if needed.", 'wds' ); ?>
						</span>
					</p>

					<h4><?php esc_html_e( 'Other Features added:', 'wds' ); ?></h4>
					<ul>
						<li>
							<small>
								<?php echo __( 'The new schema <strong>wizard</strong> to help you easily set up your Schema types.', 'wds' ); ?>
							</small>
						</li>
						<li>
							<small>
								<?php echo __( 'The option to <strong>duplicate</strong> the schema types for a quicker configuration of multiple types.', 'wds' ); ?>
							</small>
						</li>
						<li>
							<small>
								<?php echo __( 'The choice to <strong>enable</strong> or <strong>disable</strong> schema types.', 'wds' ); ?>
							</small>
						</li>
					</ul>

					<button id="<?php echo esc_attr( $id ); ?>-get-started" type="button" class="sui-button">
						<span class="sui-loading-text">
							<?php esc_html_e( 'Got it', 'wds' ); ?>
						</span>
						<span class="sui-icon-loader sui-loading" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</div>

		<a style="display: none;" id="<?php echo esc_attr( $id ); ?>-skip"
		   href="#">

			<?php esc_html_e( 'Skip This', 'wds' ); ?>
		</a>
	</div>
</div>
