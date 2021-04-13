<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Electoreftech
 */

     // Product Categories			
		$terms = get_terms( array(
		'taxonomy' => 'product_cat',
		'hide_empty' => true
	) );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
?>
	<div class="widget mb-60">
		<h6 class="widget-title">Product Categories</h6>
		<ul class="blog-categories">
			<?php 
			foreach ( $terms as $term ) {
				echo '<li><a href="' . esc_url( get_term_link( $term->term_id ) ) . '">'. $term->name .'</a> <span class="count">('. $term->count .')</span></li>';
			}
			?>
		</ul>
	</div>
	<?php } ?>

	<?php 
	     // Product Categories			
		 $terms = get_terms( array(
			'taxonomy' => 'brand',
			'hide_empty' => true
		) );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
			?>
				<div class="widget mb-60">
					<h6 class="widget-title">Product Brands</h6>
					<ul class="blog-categories">
						<?php 
						foreach ( $terms as $term ) {
							echo '<li><a href="' . esc_url( get_term_link( $term->term_id ) ) . '">'. $term->name .'</a> <span class="count">('. $term->count .')</span></li>';
						}
						?>
					</ul>
				</div>
						
			<?php 
		}
	?>
	