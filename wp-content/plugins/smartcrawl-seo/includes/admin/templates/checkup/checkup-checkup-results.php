<?php
$issue_count = empty( $issue_count ) ? 0 : $issue_count;
$has_errors = ! empty( $error );
$has_items = ! empty( $items );
?>

<?php if ( $has_items && ! $has_errors ): ?>
	<p><?php esc_html_e( 'Here are your outstanding SEO issues. We recommend actioning as many as possible to ensure your site is as search engine and social media friendly as possible.', 'wds' ); ?></p>

	<?php
	if ( $issue_count > 0 ) {
		$this->_render( 'notice', array(
			'message' => sprintf(
				_n( 'You have %d SEO recommendation.', 'You have %d SEO recommendations.', $issue_count, 'wds' ),
				$issue_count
			),
		) );
	} else {
		$this->_render( 'notice', array(
			'message' => esc_html__( "You don't have any SEO checkup recommendations – Google is loving it.", 'wds' ),
			'class'   => 'sui-notice-success',
		) );
	}
	?>
<?php endif; ?>

<?php $this->_render( 'checkup/checkup-results-inner' ); ?>

<?php if ( $has_items && ! $has_errors ): ?>
	<p class="wds-centre">
		<small><?php esc_html_e( 'Remember, these are recommendations only to help Google index your content effectively. SEO requires constant tweaking and improvement alongside good quality content on your website.', 'wds' ); ?></small>
	</p>
<?php endif; ?>
