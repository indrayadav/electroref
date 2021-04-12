<?php
$option_name = empty( $option_name ) ? '' : $option_name;
$slugs = empty( $slugs ) ? array() : $slugs;
$wds_sitewide_mode = empty( $wds_sitewide_mode ) ? false : $wds_sitewide_mode;
$blog_tabs = empty( $blog_tabs ) ? array() : $blog_tabs;
$dashboard_url = Smartcrawl_Settings_Admin::admin_url( Smartcrawl_Settings_Admin::TAB_DASHBOARD );
$per_site_notice = empty( $per_site_notice ) ? '' : $per_site_notice;

$this->_render( 'before-page-container' );
?>
<div id="container" class="<?php smartcrawl_wrap_class( 'wds-page-network-settings' ); ?>">

	<div class="sui-header">
		<h1 class="sui-header-title">
			<?php esc_html_e( 'Network Settings', 'wds' ); ?>
		</h1>
	</div>

	<?php $this->_render( 'floating-notices' ); ?>

	<form method="post">
		<div class="wds-vertical-tabs-container sui-row-with-sidenav">
			<div class="wds-vertical-tabs sui-sidenav">
				<ul class="sui-vertical-tabs">
					<li class="sui-vertical-tab tab_network_settings current">
						<a role="button" data-target="tab_network_settings" href="#">
							<?php esc_html_e( 'Permissions', 'wds' ); ?>
						</a>
					</li>
				</ul>
			</div>

			<div class="wds-vertical-tab-section sui-box tab_network_settings " id="tab_network_settings">
				<div class="sui-box-header">
					<h2 class="sui-box-title"><?php esc_html_e( 'Permissions', 'wds' ); ?></h2>
				</div>

				<div class="sui-box-body">
					<input type="hidden" name="<?php echo esc_attr( $option_name ); ?>[save_blog_tabs]" value="1"/>
					<span><?php esc_html_e( 'Configure how much control your sub-site admins have over their sites.', 'wds' ); ?></span>

					<div class="sui-box-settings-row wds-separator-top">
						<div class="sui-box-settings-col-1">
							<label class="sui-settings-label"><?php esc_html_e( 'Sub-site Admin Permissions', 'wds' ); ?></label>
							<p class="sui-description">
								<?php esc_html_e( 'Choose whether you want to control all your sub-site SEO settings, or allow sub-site admins to configure them.', 'wds' ); ?>
							</p>
						</div>

						<div class="sui-box-settings-col-2">

							<div class="sui-side-tabs sui-tabs">
								<?php if ( ! $wds_sitewide_mode ): ?>
									<?php echo wp_kses_post( $per_site_notice ); ?>
								<?php endif; ?>

								<div data-tabs>
									<label class="<?php echo $wds_sitewide_mode ? 'active' : ''; ?>">
										<?php esc_html_e( 'Sitewide', 'wds' ); ?>
										<input name="<?php printf( '%s[wds_sitewide_mode]', $option_name ) ?>" <?php checked( $wds_sitewide_mode ); ?>
										       value="1"
										       type="radio"
										       class="hidden"/>
									</label>

									<label class="<?php echo $wds_sitewide_mode ? '' : 'active'; ?>">
										<?php esc_html_e( 'Per Site', 'wds' ); ?>
										<input name="<?php printf( '%s[wds_sitewide_mode]', $option_name ) ?>" <?php checked( $wds_sitewide_mode, false ); ?>
										       value="0"
										       type="radio"
										       class="hidden"/>
									</label>
								</div>

								<div data-panes>
									<div class="sui-tab-boxed <?php echo $wds_sitewide_mode ? 'active' : ''; ?>">
										<p class="sui-description"><?php esc_html_e( 'All sub-sites will inherit your network settings, and won’t be able to override them on a per site basis.', '' ); ?></p>
									</div>

									<div class="sui-tab-boxed <?php echo $wds_sitewide_mode ? '' : 'active'; ?>">
										<p class="sui-description"><?php esc_html_e( 'Each sub-site will have its own SEO settings. Choose which modules you want sub-site admins to be able to use and configure.', '' ); ?></p>

										<?php
										foreach ( $slugs as $item => $label ) {
											$checkbox_name = sprintf( '%s[wds_blog_tabs][%s]', $option_name, $item );
											?>
											<label for="<?php echo esc_attr( $checkbox_name ); ?>"
											       class="sui-checkbox">
												<input type="checkbox" <?php checked( ! empty( $blog_tabs[ $item ] ) ); ?>
												       name="<?php echo esc_attr( $checkbox_name ); ?>"
												       value="yes"
												       id="<?php echo esc_attr( $checkbox_name ); ?>"
												       aria-labelledby="label-<?php echo esc_attr( $checkbox_name ); ?>"/>
												<span aria-hidden="true"></span>
												<span id="label-<?php echo esc_attr( $checkbox_name ); ?>">
													<?php echo esc_html( $label ); ?>
												</span>
											</label><br/>
											<?php
										}
										?>
									</div>
								</div>

								<?php $this->_render( 'notice', array(
									'class'   => 'wds-drastic-changes-notice',
									'message' => esc_html__( 'Changing between Sitewide and Per Site modes means you are switching between two different SEO configurations. Be mindful, frequent drastic changes to SEO configurations on sub-sites can cause fluctuations in page rank.', 'wds' ),
								) ); ?>
							</div>
						</div>
					</div>
				</div>

				<div class="sui-box-footer">
					<button name="submit"
					        type="submit"
					        class="sui-button sui-button-blue">
						<span class="sui-icon-save" aria-hidden="true"></span>

						<?php esc_html_e( 'Save Changes', 'wds' ); ?>
					</button>
				</div>
			</div>
		</div>
		<?php wp_nonce_field( 'wds-network-settings-nonce', '_wds_nonce' ); ?>
	</form>
</div>
