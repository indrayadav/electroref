<?php 
/* Template Name: Contact ss
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Electoreftech
 */

get_header();

while ( have_posts() ) :
	the_post();

	$banner_img = get_template_directory_uri(). '/img/page_banner.jpg';
	$electroref_page_banner = get_post_meta(get_the_ID(), 'electroref_page_banner', true);

	if(isset($electroref_page_banner) && !empty($electroref_page_banner)){
		$banner_img = $electroref_page_banner;
	}
 ?>

<section id="breadcrumb-nf">
	<div class="container">
	<h1><?php echo get_the_title(); ?></h1>
		<?php
			if ( function_exists( 'electoreftech_breadcrumbs' ) ) {
				electoreftech_breadcrumbs();
			}
			?>
	</div>
</section>
        
<!-- Contact Us Section Start -->
<section class="contact-3-area contact-2 contact-3 pt-120 pb-50">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="contact-wrapper-3 mb-30">
					<div class="contact-3-text">
						<h3>Leave Us a Message</h3>
						<p>If you have any queries, please contact us on detail below :</p>
					</div>
					<div class="contactform-electro">
					<?php echo do_shortcode('[contact-form-7 id="150" title="Contact form 1"]');?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="contact-3-right-wrapper mb-30">
					<div class="contact-3-right-info">
						<h3>Show Room </h3>
					</div>
					<div class="contact-3-address">
						<div class="contact-3-icon"> <i class="fa fa-map-marker" aria-hidden="true"></i> </div>
						<div class="address-text"> <span class="location">Address :</span> <span class="USA"> Opposite to Hanumansthan Temple, Kupondole, Lalitpur,Nepal</span> </div>
					</div>
					<div class="contact-3-address">
						<div class="contact-3-icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
						<div class="address-text"> <span class="location">phone :</span> <span class="USA">01-5260961, 981-8776832</span> </div>
					</div>
					<div class="contact-3-address">
						<div class="contact-3-icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
						<div class="address-text"> <span class="location">mail :</span> <span class="USA">electroref.tech@gmail.com</span> </div>
					</div>
				</div>
				<div class="contact-3-right-wrapper mt-3 mb-30">
					<div class="contact-3-right-info">
						<h3>Service Center</h3>
					</div>
					<div class="contact-3-address">
						<div class="contact-3-icon"> <i class="fa fa-map-marker" aria-hidden="true"></i> </div>
						<div class="address-text"> <span class="location">Address :</span> <span class="USA">Near Sarwanga Hospital
								Kupondole, Lalitpur,Nepal</span> </div>
					</div>
					<div class="contact-3-address">
						<div class="contact-3-icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
						<div class="address-text"> <span class="location">phone :</span> <span class="USA">01-5180257, 981-8776832</span> </div>
					</div>
					<div class="contact-3-address">
						<div class="contact-3-icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
						<div class="address-text"> <span class="location">mail :</span> <span class="USA">electroref.tech@gmail.com</span> </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- map-area -->
	<div class="map-area pb-120">
		<div class="container">
		<div class="row">
			<div class="col-md-6">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2970.8234057176846!2d85.31561075148892!3d27.6887334951867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19b4ed4a662b%3A0xfc8632adca3bba31!2zRWxlY3Ryby1SZWYgVGVjaCBQdnQuIEx0ZC4gKOCkh-CksuClh-CkleCljeCkn-CljeCksOCliy3gpLDgpYfgpKsg4KSf4KWH4KSVKSBbQUMgSG91c2Vd!5e0!3m2!1sen!2snp!4v1619084185584!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				<h5> Store location</h5>
				<p>Opposite to Hanumansthan Temple, Kupondole, Lalitpur,Nepal</p>
			</div>
			<div class="col-md-6">

			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2498.222082104564!2d85.31570924321085!3d27.685790626179593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3b649a58a40c42b0!2sElectro%20Ref%20Tech%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1619084531118!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				<h5> Service Center location</h5>
				<p>Near Sarwanga Hospital Kupondole, Lalitpur,Nepal</p>
			</div>
		</div>
	</div>
	<!-- map-end -->
</section>


<?php 
endwhile; // End of the loop.
get_footer();
