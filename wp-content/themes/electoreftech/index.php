<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Electoreftech
 */

get_header();
?>
<!-- slider-area-start -->

<section id="main-slider">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

  	   <?php $i=-1;

                      $query= new WP_Query(array('post_type'=>'slider'));

                      if($query->have_posts()): 

                      while($query->have_posts()): $query->the_post(); 

                    $i++;

               ?>
    <div class="item <?php if($i==0){echo "active";} ?>">
       <?php if ( has_post_thumbnail()) : ?>
          <?php the_post_thumbnail(); ?>
          <?php endif; ?>
      <div class="carousel-caption">
        <h3><?php the_title(); ?></h3>
   <p><?php echo wp_trim_words(get_the_content(), 34, '...'); ?></p>
   <div class="read-more"><a href="<?php the_permalink(); ?>">Read More</a></div>
      </div>
    </div>
<?php  

                   endwhile; 

                   endif;

                  wp_reset_query();

                 ?>

 
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</section>
		<!-- slider-area-end -->
		<!-- what-we-do-start -->
		<div class="what-we-do ptb-120">
			<div class="container">
			<div class="section-title mb-60 text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>Our Company</h4>
					<h2>What We Do</h2>
				</div>
				<div class="row">
					<div class="col-md-6 p-r">
						<div>
							<!-- Nav tabs -->
							<ul class="offer-tab" role="tablist">
								<li role="presentation" class="active">
									<a href="#home" aria-controls="home" role="tab" data-toggle="tab">
										<div class="offer-list">
											<div class="offer-icon">
												<i class="flaticon-plus-icon"></i>
											</div>
											<div class="offer-text">
												<span>home Repair</span>
											</div>
										</div>
									</a>
								</li>
								<li role="presentation">
									<a href="#profile" aria-controls="home" role="tab" data-toggle="tab">
										<div class="offer-list">
											<div class="offer-icon">
												<i class="flaticon-gear-icon"></i>
											</div>
											<div class="offer-text">
												<span>improvement</span>
											</div>
										</div>
									</a>
								</li>
								<li role="presentation">
									<a href="#messages" aria-controls="home" role="tab" data-toggle="tab">
										<div class="offer-list">
											<div class="offer-icon">
												<i class="flaticon-paint-brush"></i>
											</div>
											<div class="offer-text">
												<span>maintains</span>
											</div>
										</div>
									</a>
								</li>
								<li role="presentation">
									<a href="#settings" aria-controls="home" role="tab" data-toggle="tab">
										<div class="offer-list">
											<div class="offer-icon">
												<i class="flaticon-strategy-icon"></i>
											</div>
											<div class="offer-text">
												<span>planning</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>					
					</div> 
					<div class="col-md-6 p-t">
						  <!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="home">
								<div class="offer-wrapper" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/tab/1.jpg)">
									<div class="offer-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiuml smod tempor incididunt ut labore et dolore magna aliqua.lol Ut enim ad minim veniam quis nostrud.</p>
										<ul class="tab-menu">
											<li> Window Replacement</li>
											<li> Wall Paintings</li>
											<li> Kitchen Counter</li>
											<li> Pipe Fitting</li>
											<li> Wire Change</li>
											<li> Furniture Moving</li>
										</ul>
										<a href="#">contact now</a>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="profile">
								<div class="offer-wrapper" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/tab/2.jpg)">
									<div class="offer-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiuml smod tempor incididunt ut labore et dolore magna aliqua.lol Ut enim ad minim veniam quis nostrud.</p>
										<ul class="tab-menu">
											<li> Window Replacement</li>
											<li> Wall Paintings</li>
											<li> Kitchen Counter</li>
											<li> Pipe Fitting</li>
											<li> Wire Change</li>
											<li> Furniture Moving</li>
										</ul>
										<a href="#">contact now</a>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="messages">
								<div class="offer-wrapper" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/tab/3.jpg)">
									<div class="offer-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiuml smod tempor incididunt ut labore et dolore magna aliqua.lol Ut enim ad minim veniam quis nostrud.</p>
										<ul class="tab-menu">
											<li> Window Replacement</li>
											<li> Wall Paintings</li>
											<li> Kitchen Counter</li>
											<li> Pipe Fitting</li>
											<li> Wire Change</li>
											<li> Furniture Moving</li>
										</ul>
										<a href="#">contact now</a>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="settings">
								<div class="offer-wrapper" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/tab/4.jpg)">
									<div class="offer-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiuml smod tempor incididunt ut labore et dolore magna aliqua.lol Ut enim ad minim veniam quis nostrud.</p>
										<ul class="tab-menu">
											<li> Window Replacement</li>
											<li> Wall Paintings</li>
											<li> Kitchen Counter</li>
											<li> Pipe Fitting</li>
											<li> Wire Change</li>
											<li> Furniture Moving</li>
										</ul>
										<a href="#">contact now</a>
									</div>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>
		<!-- what-we-do-end -->
		<!-- home-service-start -->
		<div class="home-service-area gray-bg">
			<div class="col-md-6 p-0 col-xs-12">
				<div class="home-service-wrapper ptb-120" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/service/1.jpg)">
					<div class="home-content">
						<h3>Helping centers 24/7 <br> hours open.</h3>
						<div class="content">
							<h4>Contact Us :</h4>
							<p>+123-3258-2548 <br> hmend@gmail.com</p>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-md-6 p-0 col-xs-12">
				<div class="home-area-right">
					<div class="home-section">
						<h3>We Are Professional & Carefully Home Services.</h3>
						<div class="homes-info">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="home-wrapper mb-20">
								<div class="home-text">
									<p>Lorem ipsum dolor sit amet consect adipisicing elit sed. </p>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="home-wrapper mb-20">
								<div class="home-text">
									<p>Lorem ipsum dolor sit amet consect adipisicing elit sed. </p>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 mb-20">
							<div class="home-wrapper">
								<div class="home-text">
									<p>Lorem ipsum dolor sit amet consect adipisicing elit sed. </p>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 mb-20">
							<div class="home-wrapper">
								<div class="home-text">
									<p>Lorem ipsum dolor sit amet consect adipisicing elit sed. </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- home-service-end -->
		<!-- our-service-area-start -->
		<div class="our-service-area pt-120 pb-90">
			<div class="container">
				<div class="section-title mb-60 text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>We Provide</h4>
					<h2>Our Services</h2>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="service-wrapper mb-30">
							<div class="service-img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/2.jpg" alt="" />
							</div>
							<div class="service-text text-center">
								<div class="service-icon-img">
									<i class="flaticon-house-icon"></i>
								</div>
								<h2><a href="service-details.html">Wall Paintings</a></h2>
								<p>Lorem ipsum dolor sit amet, consj ectetulor adipisicing elit, sed do eiusmod tempor </p>
								<a href="service-details.html">read more</a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="service-wrapper mb-30">
							<div class="service-img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/3.jpg" alt="" />
							</div>
							<div class="service-text text-center">
								<div class="service-icon-img">
									<i class="flaticon-house-icon"></i>
								</div>
								<h2><a href="service-details.html">Furniture Moving</a></h2>
								<p>Lorem ipsum dolor sit amet, consj ectetulor adipisicing elit, sed do eiusmod tempor </p>
								<a href="service-details.html">read more</a>
							</div>
						</div>
					</div>
					<div class="col-md-4 hidden-sm">
						<div class="service-wrapper mb-30">
							<div class="service-img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/4.jpg" alt="" />
							</div>
							<div class="service-text text-center">
								<div class="service-icon-img">
									<i class="flaticon-house-icon"></i>
								</div>
								<h2><a href="service-details.html">Kitchen Counter</a></h2>
								<p>Lorem ipsum dolor sit amet, consj ectetulor adipisicing elit, sed do eiusmod tempor </p>
								<a href="service-details.html">read more</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- our-service-area-end -->
		<!-- testimonial-1-area-start -->
		<div class="testimonial-1-area pt-120 pb-200 gray-bg">
			<div class="container">
				<div class="section-title text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>Testimonial</h4>
					<h2>What Clients Say</h2>
				</div>
			</div>
		</div>
		<!-- testimonial-1-area-end -->
		<!-- testimonial-area-start -->
		<div class="testimonial-area">
			<div class="container">
				<div class="row">
					<div class="testimonial-active owl-carousel">
						<div class="col-md-12">
							<div class="testimonial-wrapper mb-30">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/1.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Handy Man</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper mb-30">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/2.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Maksud Reza</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper mb-30">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/3.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Miller Ko</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/4.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Maksud Reza</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/1.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Jon Frank</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/2.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Maksud Reza</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/3.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Jon Doe</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- testimonial-area-end -->
		<!-- counter-area-start -->
		<div class="counter-area pt-120 pb-85">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="counter-wrapper mb-30">
							<div class="counter-img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/1.png" alt="" />
							</div>
							<div class="counter-text">
								<h2 class="counter">340</h2>
							</div>
							<span class="customers">Happy Customers</span>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="counter-wrapper mb-30">
							<div class="counter-img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/2.png" alt="" />
							</div>
							<div class="counter-text">
								<h2 class="counter">440</h2>
							</div>
							<span class="customers">COMPLET PROJECTS</span>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="counter-wrapper mb-30">
							<div class="counter-img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/3.png" alt="" />
							</div>
							<div class="counter-text">
								<h2 class="counter">100</h2>
							</div>
							<span class="customers">AWARDS WINNING</span>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="counter-wrapper mb-30">
							<div class="counter-img">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/4.png" alt="" />
							</div>
							<div class="counter-text">
								<h2 class="counter">720</h2>
							</div>
							<span class="customers">WORKERS EMPLOYED</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- counter-area-end -->
		<!-- recent-work-area-start -->
		<div class="recent-work-area ptb-120 gray-bg ">
			<div class="container">
				<div class="section-title mb-60 text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>Our Projects</h4>
					<h2>Recent Work</h2>
				</div>
				<div class="row">
					<div class="works-active owl-carousel">
						<div class="col-md-12">
							<div class="work-wrapper">
								<div class="work-img">
									<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/work/1.jpg" alt="" /></a>
									<div class="work-text">
										<h3><a href="#">Wall Paintings</a></h3>
										<span>www.devitems.com</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="work-wrapper">
								<div class="work-img">
									<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/work/2.jpg" alt="" /></a>
									<div class="work-text">
										<h3><a href="#">Wall Paintings</a></h3>
										<span>www.devitems.com</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="work-wrapper">
								<div class="work-img">
									<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/work/3.jpg" alt="" /></a>
									<div class="work-text">
										<h3><a href="#">Wall Paintings</a></h3>
										<span>www.devitems.com</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="work-wrapper">
								<div class="work-img">
									<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/work/2.jpg" alt="" /></a>
									<div class="work-text">
										<h3><a href="#">Wall Paintings</a></h3>
										<span>www.devitems.com</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- recent-work-area-end -->
		<!-- blog-area-start -->
		<div class="blog-area pt-120 pb-90">
			<div class="container">
				<div class="section-title mb-60 text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>blog</h4>
					<h2>Latest News</h2>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="blog-wrapper mb-30">
							<div class="blog-img">
								<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/1.jpg" alt="" /></a>
							</div>
							<div class="blog-text">
								<div class="blog-info">
									<h3><a href="#">Lorem ipsum dolor sit amet conse.</a></h3>
									<p>Lorem ipsum dolor sit amet con adipisic elit sed do eiusmod tel incididunt ut lab et dolore mag aliqua.</p>
								</div>
								<div class="blog-date">
									<span><i class="fa fa-clock-o"></i>14 Sep, 2017</span>
									<span><i class="fa fa-heart"></i>20 like</span>
									<span><i class="fa fa-comment"></i>0 comments</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="blog-wrapper mb-30">
							<div class="blog-img">
								<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/2.jpg" alt="" /></a>
							</div>
							<div class="blog-text">
								<div class="blog-info">
									<h3><a href="#">Lorem ipsum dolor sit amet conse.</a></h3>
									<p>Lorem ipsum dolor sit amet con adipisic elit sed do eiusmod tel incididunt ut lab et dolore mag aliqua.</p>
								</div>
								<div class="blog-date">
									<span><i class="fa fa-clock-o"></i>14 Sep, 2017</span>
									<span><i class="fa fa-heart"></i>20 like</span>
									<span><i class="fa fa-comment"></i>0 comments</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 hidden-sm">
						<div class="blog-wrapper mb-30">
							<div class="blog-img">
								<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/blog/3.jpg" alt="" /></a>
							</div>
							<div class="blog-text">
								<div class="blog-info">
									<h3><a href="#">Lorem ipsum dolor sit amet conse.</a></h3>
									<p>Lorem ipsum dolor sit amet con adipisic elit sed do eiusmod tel incididunt ut lab et dolore mag aliqua.</p>
								</div>
								<div class="blog-date">
									<span><i class="fa fa-clock-o"></i>14 Sep, 2017</span>
									<span><i class="fa fa-heart"></i>20 like</span>
									<span><i class="fa fa-comment"></i>0 comments</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- blog-area-start -->
		<!-- testimonial-1-area-start -->
		<div class="testimonial-1-area pt-120 pb-200 gray-bg">
			<div class="container">
				<div class="section-title text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>Testimonial</h4>
					<h2>What Clients Say</h2>
				</div>
			</div>
		</div>
		<!-- testimonial-1-area-end -->
		<!-- testimonial-area-start -->
		<div class="testimonial-area">
			<div class="container">
				<div class="row">
					<div class="testimonial-active owl-carousel">
						<div class="col-md-12">
							<div class="testimonial-wrapper mb-30">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/1.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Handy Man</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper mb-30">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/2.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Maksud Reza</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper mb-30">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/3.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Miller Ko</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/4.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Maksud Reza</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/1.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Jon Frank</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/2.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Maksud Reza</span>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="testimonial-wrapper">
								<div class="testimonial-img text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/3.jpg" alt="" />
								</div>
								<div class="testimonial-text text-center">
									<p>Lorem ipsum dolor sit amet, conse cteturlol adipisicing elit, sed do eiusmod tem porlop incididunt ut labore et dolore. </p>
									<span>Jon Doe</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- testimonial-area-end -->

<?php
get_footer();
