<?php
$option_name = empty( $_view['option_name'] ) ? '' : $_view['option_name'];
$crawl_dow = isset( $_view['options']['crawler-dow'] ) ? $_view['options']['crawler-dow'] : false;
$is_member = empty( $_view['is_member'] ) ? false : true;
$disabled = $is_member ? '' : 'disabled';
$monday = strtotime( 'this Monday' );
$monthly = empty( $monthly ) ? false : true;
$days = array(
	esc_html__( 'Sunday', 'wds' ),
	esc_html__( 'Monday', 'wds' ),
	esc_html__( 'Tuesday', 'wds' ),
	esc_html__( 'Wednesday', 'wds' ),
	esc_html__( 'Thursday', 'wds' ),
	esc_html__( 'Friday', 'wds' ),
	esc_html__( 'Saturday', 'wds' ),
);
$dow_range = $monthly ? range( 1, 28 ) : range( 0, 6 );
?>
<label for="wds-crawler-dow"
       class="sui-label">
	<?php
	$monthly
		? esc_html_e( 'Day of the month', 'wds' )
		: esc_html_e( 'Day of the week', 'wds' );
	?>
</label>

<select class="sui-select" <?php echo esc_attr( $disabled ); ?>
        id="wds-crawler-dow"
        data-minimum-results-for-search="-1"
        name="<?php echo esc_attr( $option_name ); ?>[crawler-dow]">

	<?php foreach ( $dow_range as $dow ) : ?>
		<option value="<?php echo esc_attr( $dow ); ?>"
			<?php selected( $dow, $crawl_dow ); ?>>
			<?php
			if ( $monthly ) {
				echo esc_html( $dow );
			} else {
				$day_number = date( 'w', $monday + ( $dow * DAY_IN_SECONDS ) );
				echo esc_html( $days[ $day_number ] );
			}
			?>
		</option>
	<?php endforeach; ?>
</select>
