<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Electoreftech
 */

?>
		<?php     
			// Product Categories			
			$terms = get_terms( array(
			'taxonomy' => 'brand',
			'hide_empty' => true,
		) );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	?>
<section class="pb-50">
	<div class="container">
		<div id="footer_brands" class="owl-carousel owl-theme">
		<?php foreach ( $terms as $term ) { 
			$brand_url = home_url( '/products-air-conditioner-price-nepal/' ) . '?prod_brand='.  $term->slug;
			$file = get_term_meta( $term->term_id, '_product_brand_brand', true );
			if(!empty($file)){
			?>

				<div class="brand">
					<a href="<?php echo $brand_url; ?>">
					<img src="<?php  echo $file;?>" alt="<?php echo $term->name; ?>"></a>
				</div>

		<?php }  } ?>
		</div>
	</div>
</section>
		<?php } ?>

<footer>
	<!-- footer-top-area-start -->
	<div class="footer-top-area gray-bg pt-100 pb-70">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-4 pr-0">
					<div class="footer-wrapper mb-30">
						<h2 class="footer-section">About Us</h2>
						<div class="footer-text">
							<p>Electro-Ref Tech Pvt. Ltd. is an Air Conditioner & Home Appliances Sales, Service & Maintenance Center
in Nepal. You can find multiple brands of air conditioner in our AC Showroom which is located in
Kupondol, Lalitpur, Nepal </p>
						</div>
					</div>
				</div>
				<div class="col-md-offset-1 col-md-2 col-sm-4">
					<div class="footer-wrapper mb-30">
						<?php     
						 // Product Categories			
							$terms = get_terms( array(
							'taxonomy' => 'brand',
							'hide_empty' => true,
							'number' => 5
						) );
						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					?> <h2 class="footer-section">Our Brands</h2>
					<ul class="footer-menu">
						<?php 
						foreach ( $terms as $term ) {
							echo '<li><a href="' . esc_url( get_term_link( $term->term_id ) ) . '">'. $term->name .'</a> </li>';
						}
						?>

					</ul>

					<?php } ?>
					</div>
				</div>
				<div class=" col-md-3 hidden-sm">
					<div class="footer-wrapper mb-30">
						<h2 class="footer-section">Showroom</h2>
						<ul class="footer-link">
							<li><i class="zmdi zmdi-pin"></i><span>Opposite to Hanumanthan Temple, Kupondole, Lalitpur,Nepal</span></li>
							<li><i class="fa fa-phone"></i><span>01-5260961, 981-8776832</span></li>
							<li><i class="fa fa-envelope-open"></i><span>electroref.tech@gmail.com</span></li>
							<li><i class="fa fa-clock-o"></i><span>Sun - Sat: 8:00 am- 8:00pm</span></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<div class="footer-wrapper mb-30">
						<h2 class="footer-section">Service Center</h2>
						<ul class="footer-link">
							<li><i class="zmdi zmdi-pin"></i><span>Near Sarwanga Hospital	Kupondole, Lalitpur,Nepal</span></li>
							<li><i class="fa fa-phone"></i><span>01-5180257, 981-8776832</span></li>
							<li><i class="fa fa-envelope-open"></i><span>electroref.tech@gmail.com</span></li>
							<li><i class="fa fa-clock-o"></i><span>Sun - Sat: 8:00 am- 8:00pm</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- footer-top-area-end -->
	<!-- footer-bottom-area-start -->
	<div class="footer-bottom-area gray-bg-1 ptb-20">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="copyright">
						<p>Copyright © 2020 <a href="#">Saffron Digital Agency</a> All Right Reserved.</p>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="footer-icon">
						<a href="https://www.facebook.com/electroref.tech" target="_blank"><i class="fa fa-facebook"></i></a>
						<a href="https://www.instagram.com/electroreftech/" target="_blank"><i class="fa fa-instagram"></i></a>
						<a href="#"><i class="fa fa-pinterest-p"></i></a>
						<a href="https://twitter.com/nepal_achouse/" target="_blank"><i class="fa fa-twitter"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- footer-bottom-area-end -->
</footer>

<?php wp_footer(); ?>

</body>
</html>
