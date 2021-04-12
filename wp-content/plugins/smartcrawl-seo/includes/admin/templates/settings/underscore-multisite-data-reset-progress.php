<p class="sui-description"><?php esc_html_e( 'Resetting your subsite settings, please keep this window open …', 'wds' ); ?></p>

<?php $this->_render( 'progress-bar', array(
	'progress'       => 0,
	'progress_state' => '{{= progress_message }}',
) ); ?>
