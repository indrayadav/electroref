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

<!-- Brand logo -->
<?php     			
			$terms = get_terms( array(
			'taxonomy' => 'brand',
			'hide_empty' => true,
		) );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
?>
<section id="our-clients">
    <div class="container">
        <div class="mainfoodtitle">
            <h2>Our Brands</h2>
        </div>
        <div class="owl-theme bestselllerowl">
        <?php foreach ( $terms as $term ) { 
			$brand_url = home_url( '/products-air-conditioner-price-nepal/' ) . '?prod_brand='.  $term->slug;
			$file = get_term_meta( $term->term_id, '_product_brand_brand', true );
			if(!empty($file)){
            ?>
            <div class="item">
                <div class="client-img">
                    <a href="<?php echo $brand_url; ?>" target="_blank"><img src="<?php  echo $file;?>" class="img-fluid" alt="<?php echo $term->name; ?>"></a>
                </div>
            </div>

        <?php }  } ?>
        </div>
    </div>
</section>
<?php } ?>

  <!-- Footer Section Start -->
  <footer id="footer" class="footer">
            <div class="top-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="fbox fblistbox">
                                <h4>About Us<span></span></h4>
                                <p>Electro-Ref Tech Pvt. Ltd. is an Air Conditioner & Home Appliances Sales, Service & Maintenance Center in Nepal. You can find multiple brands of air conditioner in our AC Showroom which is located in Kupondol, Lalitpur, Nepal </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="fbox fbcontactinfo">
                                <h4>Showroom<span></span></h4>
                                <ul>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <p>Opposite to Hanumanthan Temple, Kupondole, Lalitpur,Nepal</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <p>electroref.tech@gmail.com</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                                        <p>01-5260961, 981-8776832</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-clock-o"></i>
                                        <p>Sun - Sat: 8:00 am- 8:00pm</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="fbox fbcontactinfo">
                                <h4>Service Center<span></span></h4>
                                <ul>
                                    <li>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <p>Near Sarwanga Hospital Kupondole, Lalitpur,Nepal</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <p>electroref.tech@gmail.com</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                                        <p>01-5180257, 981-8776832</p>
                                    </li>
                                    <li>
                                        <i class="fa fa-clock-o"></i>
                                        <p>Sun - Sat: 8:00 am- 8:00pm</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="fbox">
                                <h4>Newsletter<span></span></h4>
                                <div class="newsletter-box">
                                    <div class="searchbox">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Enter your email..." required="">
                                            <div class="input-group-append">
                                                <button class="btn" type="button">Go</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="socialconnectus">
                                        <h4>Follow us<span></span></h4>
                                        <ul>
                                            <li><a href="https://www.facebook.com/electroref.tech/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li><a href="https://twitter.com/nepal_achouse/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="https://wa.me/97798841031632" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                                            <li><a href="https://www.instagram.com/electroreftech/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            <li><a href="https://www.youtube.com/channel/UCIXsEn0OD1Pe7l1NX4qpV9A" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-lg-4">
                            <div class="fbottom">
                                <div class="copyright">
                                    <p>© Copyright 2021 Electro-Ref Tech</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="fbottom">
                                <div class="poweredby">
                                    <p>Developed by: <a href="#" target="_blank">Saffron Digital Agency</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="fbottom">
                                <div class="paymentimg">
                                    <ul>
                                        <li>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/payment/esewa.png" class="img-fluid" alt="esewa">
                                        </li>
                                        <li>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/payment/khalti.png" class="img-fluid" alt="esewa">
                                        </li>
                                        <li>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/payment/himalayan.png" class="img-fluid" alt="esewa">
                                        </li>
                                        <li>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/payment/nabil.jpg" class="img-fluid" alt="esewa">
                                        </li>
                                        <li>
                                            <img src="<?php echo get_template_directory_uri(); ?>/img/payment/nic.jpg" class="img-fluid" alt="esewa">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

<?php wp_footer(); ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#searchiconbec').click(function() {
            $('.showsearchbox').slideToggle("fast");
        });
    });
    </script>
    <script>
    function openNav() { document.getElementById("mySidenav").style.width = "300px"; }

    function closeNav() { document.getElementById("mySidenav").style.width = "0"; }
    </script>
    <script type="text/javascript">
    jQuery(document).scroll(function(e) {
        var scrollTop = jQuery(document).scrollTop();
        if (scrollTop > 75) {
            //console.log(scrollTop);
            jQuery('.header_area').addClass('sticky');
        } else {
            jQuery('.header_area').removeClass('sticky');
        }
    });
    </script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#site-spop").focus(function() {
            $('.site-search-form').addClass("search-normal-screen");
        });
        $("#search-close").click(function() {
            $('.site-search-form').removeClass("search-normal-screen");
        });
    });
    </script>

</body>
</html>
