<?php
/* Template Name: Home 
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
$home_id = get_the_ID();
?>
<!-- slider-area-start -->
<section id="main-slider">
    <div id="home-slider" class="owl-carousel owl-theme">
   <?php $query= new WP_Query(array('post_type'=>'slider'));

        if($query->have_posts()): 

        while($query->have_posts()): $query->the_post(); 

        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); 

        ?>
    
    <div class="item"><img src="<?php echo $featured_img_url; ?>" alt="The Last of us"></div>
    <?php  

endwhile; 

endif;

wp_reset_query();

?>

    
    </div>
</section>
		<!-- slider-area-end -->
		<!-- what-we-do-start -->
		<div class="what-we-do ptb-120 gray-bg">
			<div class="container">
			<div class="section-title mb-60 text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>Our Company</h4>
					<h2>What We Do</h2>
				</div>
				<div class="row">
					<div class="col-md-4 p-r">
						<div>
							<!-- Nav tabs -->
							<ul class="offer-tab" role="tablist">
								<?php $what_we_do = get_post_meta( get_the_ID(), 'what-we-do', true ); 
							
									foreach( $what_we_do as $key => $we_do ) {
										?>
										
										<li role="presentation" class="<?php echo $key==0?'active':''; ?>">
									<a href="#<?php echo $key ?>" aria-controls="<?php echo $key ?>" role="tab" data-toggle="tab">
										<div class="offer-list">
										    <?php /* ?>
											<div class="offer-icon">
												<i class="<?php echo $we_do['icon']; ?>"></i>
											</div> <?php */ ?>
											<div class="offer-text">
												<span><?php echo $we_do['title']; ?></span>
											</div>
										</div>
									</a>
								</li>

									<?php }

								?>							
							</ul>
						</div>					
					</div> 
					<div class="col-md-8 p-t">
						  <!-- Tab panes -->
						<div class="tab-content">
							<?php 
							foreach( $what_we_do as $key => $we_do ) {
								?>
							<div role="tabpanel" class="tab-pane <?php echo $key==0?'active':''; ?>" id="<?php echo $key; ?>">
								<div class="offer-wrapper" style="background-image:url(<?php echo $we_do['image'] ?>)">
									<div class="offer-content">
										<?php echo wpautop($we_do['description']); ?>
										<a href="https://electroreftech.com/contact/">CONTACT NOW</a>
									</div>
								</div>
							</div>
							<?php } ?>						
						</div>					
					</div>
				</div>
			</div>
        </div>
        
        <!-- products-area-start -->
  <div class="blog-area pt-120 pb-90" id="latest-news-sec">
			<div class="container">
				<div class="section-title mb-60 text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4><a href="https://electroreftech.com/products/">View All Products</a></h4>
					<h2>Featured Products</h2>
				</div>
				<div class="row">
				    <div id="home_products" class="owl-carousel owl-theme">
                <?php 
				
			
				$args = array(
						'posts_per_page' => 8,
						'post_type' => 'product',	
						'orderby' => array( 'rand', 'name' ),
						'order'   => 'DESC',
				);
				
				$wp_query = new WP_Query( $args );			 
				 
						while ( $wp_query->have_posts() ) : $wp_query->the_post();

						 $post_id = get_the_ID(); 
						 $price = get_post_meta($post_id, 'product_price', true);
						?>
						<div class="col-md-12">
							<div class="blog-wrapper mb-30">
								<div class="product-img">
									<a href="<?php echo get_permalink($post_id); ?>">
									<?php 
									// Must be inside a loop.
									 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('home-product',array('class' => 'img-responsive'));
									}
									else {
										echo '<img src="' . get_template_directory_uri() . '/img/no_image.png" />';
									}
								
									?></a>
								</div>
								<div class="blog-text">
									<div class="blog-info">
										<h3><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h3>
									</div>
									<div class="blog-date">
										
										<?php  echo electoreftech_product_price( $post_id);  ?>
										<div class="read-more"><a href="<?php echo get_permalink($post_id); ?>">VIEW MORE</a></div>
									</div>
								</div>
							</div>
						</div>
                        
					
						<?php 
						
							endwhile;			
						
						?>
						</div>
				</div>
			</div>
        </div>
		<!-- products-area-start -->
				
		
		
		<!-- our-service-area-start -->
		<div class="our-service-area pt-120 pb-90 gray-bg">
			<div class="container">
				<div class="section-title mb-60 text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>We Provide</h4>
					<h2>Our Services</h2>
				</div>
				<div class="row">
				<?php 
				 $args = [	
					'post_type' => 'service',						
					'posts_per_page' => 3,
				 ];

				$the_query = new WP_Query( $args ); ?>
				
				<?php if ( $the_query->have_posts() ) :
					 while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-md-4 col-sm-6">
						<div class="service-wrapper mb-30">
							<div class="service-img">
								<?php 
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('homepage-thumb');
								}
								else {
									echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
										. '/assets/img/blog/1.jpg" />';
								}
								?>	
							</div>
							<div class="service-text text-center">
								<div class="service-icon-img">
									<i class="flaticon-house-icon"></i>
								</div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php echo wpautop(wp_trim_words( get_the_content(), 22, null )); ?>
								<a href="<?php the_permalink(); ?>">read more</a>
							</div>
						</div>
					</div>
					<?php endwhile;
					 wp_reset_postdata(); 
					 endif; ?>
					
				</div>
			</div>
		</div>
		<!-- our-service-area-end -->
		<!-- blog-area-start -->
		<div class="blog-area pt-120 pb-90" id="latest-news-sec">
			<div class="container">
				<div class="section-title mb-60 text-center" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/logo/section.png)">
					<h4>blog</h4>
					<h2>Latest News</h2>
				</div>
				<div class="row">
				<?php 
				 $args = [							
					'posts_per_page' => 3,
				 ];

				$the_query = new WP_Query( $args ); ?>
				
				<?php if ( $the_query->have_posts() ) :
					 while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-md-4 col-sm-6">
						<div class="blog-wrapper mb-30">
							<div class="blog-img">
								<a href="<?php the_permalink(); ?>">
								<?php 
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('homepage-thumb');
								}
								else {
									echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
										. '/assets/img/blog/1.jpg" />';
								}
								?>								
								</a>
							</div>
							<div class="blog-text">
								<div class="blog-info">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<?php echo wpautop(wp_trim_words(get_the_content(),'20','')); ?>
								</div>
								<div class="blog-date">
									<span><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>
									<!-- <span><i class="fa fa-heart"></i>20 like</span> -->
									<span><i class="fa fa-comment"></i><?php echo get_comments_number(); ?> comments</span>
								</div>
							</div>
						</div>
					</div>
					<?php endwhile;
					 wp_reset_postdata(); 
					 endif; ?>
					
					<!-- <div class="col-md-4 col-sm-6">
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
					</div> -->
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
		<div class="testimonial-area pb-80">
			<div class="container">
				<div class="row">
					<div class="testimonial-active owl-carousel">
						<?php $testimonials = get_post_meta( $home_id, 'what-client-says', 'true');
						 foreach ($testimonials as $key => $testimonial) {
							?>

						<div class="col-md-12">
							<div class="testimonial-wrapper mb-30">
								<div class="testimonial-img text-center">
									<img src="<?php echo $testimonial['image']; ?>" alt="" />
								</div>
								<div class="testimonial-text text-center">
								<?php echo wpautop( $testimonial['thoughts']); ?>
									<span><?php echo $testimonial['name']; ?></span>
								</div>
							</div>
						</div>
							
							<?php
						 }	
						?>
										
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- testimonial-area-end -->
	
	
<?php
get_footer();
