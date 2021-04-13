<?php
$option_name = empty( $_view['option_name'] ) ? '' : $_view['option_name'];
$schema_yt_api_key = empty( $schema_yt_api_key ) ? '' : $schema_yt_api_key;
?>
<div class="sui-form-field">
	<p class="sui-description">
		<?php echo smartcrawl_format_link(
			esc_html__( 'SmartCrawl will use %s to fetch video data automatically.', 'wds' ),
			'https://developers.google.com/youtube/registering_an_application',
			'YouTubeAPI',
			'_blank'
		); ?>
	</p>
	<label for="schema_yt_api_key" class="sui-label"><?php esc_html_e( 'Access Code', 'wds' ); ?></label>
	<input type="text" id="schema_yt_api_key" class="sui-form-control"
	       name="<?php echo esc_attr( $option_name ); ?>[schema_yt_api_key]"
	       value="<?php echo esc_attr( $schema_yt_api_key ); ?>"
	       placeholder="<?php esc_attr_e( 'API Key', 'wds' ); ?>"/>
</div>

<button class="sui-button sui-button-blue" id="wds-authorize-api-key">
	<?php esc_html_e( 'Authorize', 'wds' ); ?>
</button>
