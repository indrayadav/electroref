<?php
$is_sitewide = is_network_admin()
               && smartcrawl_is_switch_active( 'SMARTCRAWL_SITEWIDE' );
?>

<?php if ( $is_sitewide ):
	$this->_render( 'notice', array(
		'class'   => 'sui-notice-warning',
		'message' => esc_html__( "The schema types added here will be used on the main site only.", 'wds' ),
	) );
endif; ?>

<div id="wds-schema-type-components"></div>
