<?php
$progress = 0;
$is_member = empty( $is_member ) ? false : $is_member;
?>
<p><?php esc_html_e( 'SmartCrawl is performing a full SEO checkup which will take a few moments. You can close this page if you need to, we’ll let you know when it’s complete.', 'wds' ); ?></p>
<?php
$this->_render( 'progress-bar', array(
	'progress' => $progress,
) );
?>

<?php
if ( ! $is_member ) {
	$this->_render( 'mascot-message', array(
		'key'         => 'dash-seo-checkup-upsell',
		'dismissible' => false,
		'message'     => sprintf(
			'%s <a target="_blank" class="sui-button sui-button-purple" href="https://wpmudev.com/project/smartcrawl-wordpress-seo/?utm_source=smartcrawl&utm_medium=plugin&utm_campaign=smartcrawl_dash_seocheckup_upsell_notice">%s</a>',
			esc_html__( 'Upgrade to Pro to schedule automated checkups and send white label email reports directly to your clients. Never miss a beat with your search engine optimization.', 'wds' ),
				esc_html__( 'Try it for FREE today', 'wds' )
		),
	) );
}
?>
