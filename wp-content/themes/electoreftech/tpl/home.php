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

<!-- Banner -->
<?php $query= new WP_Query(array('post_type'=>'slider'));
if($query->have_posts()):
$cnt = 0;    ?> 
<section id="banner">
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php 
			        while($query->have_posts()): $query->the_post(); 
					$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); 
					$cnt++;
			?>
			<div class="carousel-item <?php if($cnt == 1) { echo ' active'; } ?>"> <img class="d-block w-100" src="<?php echo $featured_img_url; ?>" alt="First slide">
			</div>
			<?php endwhile;  ?>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <i class="fa fa-angle-right" aria-hidden="true"></i> <span class="sr-only">Next</span> </a>
	</div>
</section>
<?php endif;
wp_reset_query(); ?>


<!-- Top Featured categories Section Start -->
<?php 	$terms = get_terms( array(
			'taxonomy' => 'product_cat',
			'hide_empty' => true
		) );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){		
		?>
<section id="top-featured-categories">
	<div class="container">
		<div class="mainfoodtitle">
			<h2>Top categories</h2>
		</div>
		<div class="owl-theme bestselllerowl">
			<?php foreach ( $terms as $term ) {
				$cat_url = home_url( '/products-air-conditioner-price-nepal/' ) . '?prod_cat='.  $term->slug;
				$file = get_term_meta( $term->term_id, '_product_cat_img', true );
				if(!empty($file)){
				?>
			<div class="item">
				<div class="tcatbox">
					<div class="tcatimg"> <a href="<?php echo $cat_url; ?>"><img src="<?php  echo $file;?>" class="img-fluid" alt="<?php echo $term->name; ?>"></a> </div>
					<div class="tcatdesc">
						<h4><a href="<?php echo $cat_url; ?>"><?php echo $term->name; ?></a></h4>
					</div>
				</div>
			</div>
			<?php } 
			} ?>
		</div>
	</div>
</section>
<?php } ?>

<!-- what-we-do-start -->
<?php $what_we_do = get_post_meta( get_the_ID(), 'what-we-do', true );
 if($what_we_do){  ?>
<section id="whatwedosection">
	<div class="container">
		<div class="bgwhatwedo-overlay">
			<div class="mainfoodtitle">
				<h2 class="maintitle">What We Do</h2>
			</div>
			<div class="row">
				<?php foreach( $what_we_do as $key => $we_do ) { ?>
				<div class="col-md-6 col-lg-4">
					<div class="whatwedobox">
						<div class="whatwe-do-img">
							<a href="<?php echo $we_do['url']; ?>"><img src="<?php echo $we_do['image'] ?>" class="img-fluid" alt="<?php echo $we_do['title']; ?>"></a>
						</div>
						<div class="whatwe-do-desc">
							<h4><a href="<?php echo $we_do['url']; ?>"><?php echo $we_do['title']; ?></a></h4>
							<p><?php echo wpautop($we_do['description']); ?></p>
							<div class="electrobtn"><a href="<?php echo $we_do['url']; ?>">Read More</a></div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<!-- Top Products Section Start -->
<?php 				
	$args = array(
		'posts_per_page' => 14,
		'post_type' => 'product',	
		'orderby' => 'meta_value_num',
		'meta_key' => 'product_featured',
		'order'   => 'DESC',
);
$wp_query = new WP_Query( $args );	
if ( $wp_query->have_posts() ) {			
?>
<section id="top-products">
	<div class="container">
		<div class="mainfoodtitle">
			<h2>Featured Products</h2>
		</div>
		<div class="pharproductLists">
			<div class="owl-theme bestselllerowl">
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				$post_id = get_the_ID(); 
				get_template_part(
					'template-parts/product/product',
					'carosal',
					array(
						'post_id' => $post_id,
					)
				);
				endwhile;
				?>
			</div>
		</div>
	</div>
</section>
<?php }
wp_reset_query();
?>

<!-- Our Services Section Start -->

<?php 				
	$args = array(
		'posts_per_page' => 3,
		'post_type' => 'service',	
		'order'   => 'DESC',
);
$wp_query = new WP_Query( $args );	
if ( $wp_query->have_posts() ) {			
?>
<section id="ourserviesec">
	<div class="container">
		<div class="mainfoodtitle">
			<h2>Our Services</h2>
		</div>
		<div class="row">
		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				$post_id = get_the_ID(); 
				get_template_part(
					'template-parts/blog/blog',
					'grid',
					array(
						'post_id' => $post_id,
					)
				);
				endwhile;
	    ?>
		</div>
	</div>
</section>
<?php }
wp_reset_query();
?>   

<!-- Best Sellers Section Start -->
<?php 				
	$args = array(
		'posts_per_page' => 14,
		'post_type' => 'product',	
		'orderby' => 'meta_value_num',
		'meta_key' => 'post_views_count', 
		'order'   => 'DESC',
);
$wp_query = new WP_Query( $args );	
if ( $wp_query->have_posts() ) {			
?>
<section id="best-selllers">
	<div class="container">
		<div class="mainfoodtitle">
			<h2>Best Deals</h2>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="pharproductLists">
					<div class="owl-theme bestselllerowl">
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
						$post_id = get_the_ID(); 
						get_template_part(
							'template-parts/product/product',
							'carosal',
							array(
								'post_id' => $post_id,
							)
						);
						endwhile;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php }
wp_reset_query();
?>  

<!-- Blog Section Start -->
<?php 				
	$args = array(
		'posts_per_page' => 3,
		'post_type' => 'post',	
		'order'   => 'DESC',
);
$wp_query = new WP_Query( $args );	
if ( $wp_query->have_posts() ) {			
?>
<section id="blogsection">
	<div class="container">
		<div class="mainfoodtitle">
			<h2>Latest Blog</h2>
		</div>
		<div class="row">
		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				$post_id = get_the_ID(); 
				get_template_part(
					'template-parts/blog/blog',
					'modern',
					array(
						'post_id' => $post_id,
					)
				);
				endwhile;
	    ?>
		</div>
	</div>
</section>
<?php }
wp_reset_query();
?>  

<!-- What Our Students say about Us Section Start -->
<?php $testimonials = get_post_meta( $home_id, 'what-client-says', 'true'); 
if($testimonials){
?>
<section id="testimonials-section">
	<div class="container">
		<div class="mainfoodtitle">
			<h2>Customer Reviews</h2>
		</div>
		<div class="row">
			<?php foreach ($testimonials as $key => $testimonial) { ?>
			<div class="col-md-4 col-lg-4">
				<div class="testimolbox">
					<div class="testdescitpion">
						<p><?php echo wpautop( $testimonial['thoughts']); ?></p>
					</div>
					<div class="sturentnamepostion">
						<div class="media">
							<img class="align-self-start mr-3" src="<?php echo $testimonial['image']; ?>" alt="<?php echo $testimonial['name']; ?>">
							<div class="media-body">
								<h5 class="mt-0"><?php echo $testimonial['name']; ?></h5>
								<p><?php echo $testimonial['position']; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php } ?>
	
<?php
get_footer();