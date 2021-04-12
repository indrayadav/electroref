<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Electoreftech
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "ElectroRefTechnology",
    "url": "https://www.electroreftech.com/",
    "address": "Kupandole, Lalitpur, Nepal",
    "sameAs": [
      "https://www.facebook.com/electroreftech.com",
      "https://twitter.com/home",
      "https://www.linkedin.com/company/t/",
      "https://www.instagram.com/electroreftech/?hl=en"
    ],
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Kupandole, Lalitpur, Nepal",
    "addressRegion": "Bagmati",
    "postalCode": "00977",
    "addressCountry": "NP"
  }
  }
</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
     <meta name="google-site-verification" content="-lp6YNHU26wrKMoU7QXLDKzYXQj1tFe9erCgaXkyORc" />
	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-31914987-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-31914987-3');
</script>

</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0&appId=220198652759638&autoLogAppEvents=1"></script>

<header class="">
			<!-- header-top-area-start -->
			<div class="header-top-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-3 site-branding col-xs-12">
							<div class="header-logo">
								<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/electro_logo.png" alt="" /></a>
							</div>
						</div>
						<div class="col-lg-5 col-md-5 col-sm-9 hidden-xs">
						<div class="site-search">
						 <form class="navbar-form" action="<?php echo esc_url( home_url( '/products-air-conditioner-price-nepal/' ) ); ?>" method="get" role="search">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Find product..." name="query" title="" id="srch-term">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit"> <i class="fa fa-search"></i></button>
            </div>
        </div>
        </form>
						</div>
						</div>
						<div class="col-lg-3 col-md-3 hidden-sm col-xs-12">
							<div class="header-left-icon">
								<a href="https://www.facebook.com/electroref.tech/" class="icon-facebook" target="_blank"><i class="fa fa-facebook"></i></a>
								<a href="https://www.instagram.com/electroreftech/" class="icon-instagram"  target="_blank"><i class="fa fa-instagram"></i></a>
								<a href="https://twitter.com/nepal_achouse/" class="icon-twitter"  target="_blank"><i class="fa fa-twitter"></i></a>
								<a href="https://www.pinterest.com/electroreftech/" class="icon-pinit"  target="_blank"><i class="fa fa-pinterest"></i></a>
					
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- main-menu-area-start -->
			<div id="header-sticky" class="main-menu-area">
				<div class="container">
					<div class="row">
						<div class=" col-lg-10 col-md-8  col-xs-7">
							<div class="main-menu">
								<nav>
										
									<?php wp_nav_menu(); ?>

									<!-- <ul>
										<li class="active"><a href="index.html">home</a>
										</li>
										<li><a href="about-us.html">About Us</a></li>
										<li><a href="service.html">service</a>
											<ul class="sub-menu">
												<li><a href="service-details.html">service-details</a></li>
											</ul>
										</li>
										<li><a href="project.html">projects</a>
											<ul class="sub-menu">
												<li><a href="project-details.html">project-details</a></li>
											</ul>
										</li>
										<li><a href="blog.html">blog</a>
											<ul class="sub-menu">
												<li><a href="blog-details.html">blog-details</a></li>
											</ul>
										</li>
										<li><a href="contact.html">contact</a></li>
									</ul> -->
								</nav>
							</div>						
						</div>				
						<div class=" col-lg-2 col-md-4 col-xs-12">
							<div class="make-appointment">
								<a href="tel:+977015260961" target="_blank"><i class="fa fa-phone"></i> 01-5260961</a>
							</div>
						</div>
						<div class="col-xs-12"><div class="mobile-menu"></div></div>
					</div>
				</div>
			</div>
			<!-- main-menu-area-end -->
		</header>

									<!-- Book Now -->
										<div id="booknowbutton">
<div class="modal fade" id="bookappointment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Make Appointment</h4>
      </div>
      <div class="modal-body">
        <div class="booknow-model">
        	<form action="/" method="Post">
        		<div class="form-group">
        			<label>Full Name</label>
        			<input type="text" name="f_name" class="form-control" placeholder="Enter Full Name..." required="">
        		</div>
        		<div class="form-group">
        			<label>Email</label>
        			<input type="text" name="e_name" class="form-control" placeholder="Enter Full Email..." required="">
        		</div>
        		<div class="form-group">
        			<label>Address</label>
        			<input type="text" name="a_name" class="form-control" placeholder="Enter Full Address..." required="">
        		</div>
        			<div class="form-group">
        			<label>Phone</label>
        			<input type="text" name="f_name" class="form-control" placeholder="Enter Full Phone..." required="">
        		</div>
        		<div class="form-group">
        			<label>Message</label>
        			<textarea class="form-control" placeholder="Enter Message" required="" rows="7"></textarea>
        		</div>
        		<div class="submitbtn">
        			<input type="submit" name="submitbtn" value="Send">
        		</div>
        	</form>
        </div>
      </div>
  </div>
</div>
									</div>
								</div>
