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
		$cnt = 0;
?>
	<div class="category-listing">
		<div class="main-heading">
			<div class="row">
				<div class="col-md-12">
					<div class="right-side-title">
						<span class="title-wrapper">
							<span class="blog-title-inner">Product Categories</span>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="cate_lists">
			<ul class="electroref_toggle_wrap">
				<?php 
				foreach ( $terms as $term ) {
					echo '<li><a href="' . esc_url( get_term_link( $term->term_id ) ) . '">'. $term->name .'</a> <span class="count">('. $term->count .')</span></li>';
				}
				?>
			</ul>
			<span class="btn_toggle"><a href="javascript:void(0);"> Show more<i class="fa fa-plus-square-o" aria-hidden="true"></i></a> </span>
		</div>
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
			<div class="category-listing">
				<div class="main-heading">
					<div class="row">
						<div class="col-md-12">
							<div class="right-side-title">
								<span class="title-wrapper">
									<span class="blog-title-inner">Product Brands</span>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="cate_lists">
					<ul class="electroref_toggle_wrap">
						<?php 
						foreach ( $terms as $term ) {
							echo '<li><a href="' . esc_url( get_term_link( $term->term_id ) ) . '">'. $term->name .'</a> <span class="count">('. $term->count .')</span></li>';
						}
						?>
					</ul>
					<span class="btn_toggle"><a href="javascript:void(0);"> Show more<i class="fa fa-plus-square-o" aria-hidden="true"></i> </a> </span>
				</div>
	</div>
						
			<?php 
		}
	?>
	