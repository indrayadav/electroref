<?php $this->_render( 'modal', array(
	'id'            => 'wds-data-reset-modal',
	'title'         => esc_html__( 'Reset Settings & Data', 'wds' ),
	'body_template' => 'settings/data-reset-modal-body',
	'small'         => true,
) );

wp_enqueue_script( Smartcrawl_Controller_Assets::DATA_RESET_JS );
