<?php $this->_render( 'modal', array(
	'id'            => 'wds-multisite-data-reset-modal',
	'title'         => esc_html__( 'Reset Subsites', 'wds' ),
	'body_template' => 'settings/multisite-data-reset-modal-body',
	'small'         => true,
) );

wp_enqueue_script( Smartcrawl_Controller_Assets::DATA_RESET_JS );
