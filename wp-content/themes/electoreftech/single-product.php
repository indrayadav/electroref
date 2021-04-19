<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Electoreftech
 */

get_header();

$banner_img = get_template_directory_uri(). '/img/page_banner.jpg';
$electroref_page_banner = get_post_meta(get_the_ID(), 'electroref_page_banner', true);

if(isset($electroref_page_banner) && !empty($electroref_page_banner)){
	$banner_img = $electroref_page_banner;
}
?>

<?php
	while ( have_posts() ) :
		the_post();
		$current_post_id = get_the_ID();

		// set page view count
		electoreftech_set_post_view($current_post_id);
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

<!-- Detail Page Section Start -->
<section id="detail-page">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="left-product-detailss">
					<div class="xzoom-container">
					<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');  ?>
					  <img class="xzoom2" src="<?php echo $featured_img_url; ?>" xoriginal="<?php echo $featured_img_url; ?>" />
						
					  <div class="xzoom-thumbs">
						<a href="<?php echo $featured_img_url; ?>"><img class="xzoom-gallery2" width="80" src="<?php echo $featured_img_url; ?>"  xpreview="<?php echo $featured_img_url; ?>" title=""></a>
						<?php 
						
						$product_galleries = get_post_meta( get_the_ID(), 'product_gallery_list', true );									
						foreach ($product_galleries as $key => $image) {
							$img = wp_get_attachment_image_src($key, array('140','140'), true ); 
							echo '<a href="'. $img[0] .'"><img class="xzoom-gallery2" width="80" src="'. $img[0] .'" title="'. get_the_title().'"></a>';
						}
						?>
						</div>
					</div> 
				</div>
			</div>	
			<div class="col-md-7">
				<div class="detailrightcontent">
				<div id="xzoom2-id" style="float: right; width: 200px; height: 200px;"></div>
					<h2><?php the_title(); ?></h2>
					<p><?php echo get_the_excerpt(); ?></p>
					<div class="productinfo">
						<ul>
						<?php 
									$terms = get_the_terms( get_the_ID(), 'brand' );
									if ( $terms && ! is_wp_error( $terms ) ) : 
 
										$draught_links = array();
									 
										foreach ( $terms as $term ) {
											$draught_links[] = $term->name;
										}
															 
										$on_draught = join( ", ", $draught_links );
										echo '<li> Brand Name : '. $on_draught . '</li>';

								    endif;		

									$product_type = get_post_meta(get_the_ID(), 'product_type', true);
									if(isset($product_type) && !empty($product_type)){
										echo '<li> Product : '. $product_type . '</li>';
									}

									$product_sku = get_post_meta(get_the_ID(), 'product_sku', true);
									if(isset($product_sku) && !empty($product_sku)){
										echo '<li> SKU : '. $product_sku . '</li>';
									}

									$product_model = get_post_meta(get_the_ID(), 'product_model', true);
									if(isset($product_model) && !empty($product_model)){
										echo '<li> Model No. : '. $product_model . '</li>';
									}

									$product_warranty = get_post_meta(get_the_ID(), 'product_warranty', true);
									if(isset($product_warranty) && !empty($product_warranty)){
										echo '<li> Warranty : '. $product_warranty . '</li>';
									}

									$product_installation_fee = get_post_meta(get_the_ID(), 'product_installation_fee', true);
									if(isset($product_installation_fee) && !empty($product_installation_fee)){
										echo '<li>Installation Fee : '. $product_installation_fee . '</li>';
									}

									$product_delivery_fee = get_post_meta(get_the_ID(), 'product_delivery_fee', true);
									if(isset($product_delivery_fee) && !empty($product_delivery_fee)){
										echo '<li>Delivery Fee : '. $product_delivery_fee . '</li>';
									}

									?>
						</ul>
					</div>
					
					<div class="product-price">
						<h4><?php echo electoreftech_product_price(get_the_ID()); ?></h4>
					</div>
					<div class="share-product">
					    <input type="hidden" class="post_id" value="<?php echo get_the_ID(); ?>" >
						<ul>
							<li>Share: </li>
							<?php echo electroref_sharethis_nav(get_the_ID()); ?>
							<li><div class="wishlistprodiocn"><a href="javascript:void(null)"><?php echo electoreftech_wishlist_status(get_the_ID(), 'txt'); ?></a></div></li>
						</ul>
					</div>
					<div class="book-now"><a href="#" data-toggle="modal" data-target="#booknowModal">Book Now</a></div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Book Now -->
<div id="booknowmodalbox">
	<div class="modal fade" id="booknowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Book Now</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
				</div>
				<div class="modal-body">
					<div class="booknow-form">
						<form action="/">
							<div class="form-group">
								<label>Full Name<span>*</span></label>
								<input type="text" name="fname" class="form-control" placeholder="" required>
							</div>
							<div class="form-group">
								<label>Your Email<span>*</span></label>
								<input type="text" name="ename" class="form-control" placeholder="" required>
							</div>
							<div class="form-group">
								<label>Your Phone<span>*</span></label>
								<input type="text" name="pname" class="form-control" placeholder="" required>
							</div>
							<div class="form-group">
								<label>Message<span>*</span></label>
								<textarea class="form-control" placeholder="Message" rows="3"></textarea>
							</div>
							<div class="send-message">
								<input type="submit" name="submit" value="Send">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Detail Page Section End -->
<!-- Related Product -->
<section id="detailview-product">
	<div class="container">
		<div class="relatedtabpanel">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item"> <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a> </li>
				<li class="nav-item"> <a class="nav-link" id="additionalinfo-tab" data-toggle="tab" href="#additionalinfo" role="tab" aria-controls="additionalinfo" aria-selected="false">Additional Info</a> </li>
				<li class="nav-item"> <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Product Reviews</a> </li>
			</ul>
		</div>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
				<div class="overviewrelated">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="tab-pane fade" id="additionalinfo" role="tabpanel" aria-labelledby="additionalinfo-tab">
				<div class="overviewrelated">
				<?php echo wpautop( get_post_meta( get_the_ID(), 'product_add_info', true ) ); ?>
				</div>
			</div>
			<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
				<div class="producttab-inside">
					<h4>2 Review For Apple Watch Series 5</h4>
					<div class="writereviewadd"><a href="#" data-toggle="modal" data-target="#writeaReview">Write a review</a></div>
					<!-- Write a review -->
					<div class="writereviewmodal">
				<div class="modal fade" id="writeaReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title" id="exampleModalLabel">Login to Electro-ref Tech</h5>
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				    <div class="loginwritereview">
				    	<form action="/">
				    		<div class="form-group">
				    			<input type="text" name="uname" class="form-control" placeholder="Username" required="">
				    		</div>
				    		<div class="form-group">
				    			<input type="password" name="password" class="form-control" placeholder="********" required="">
				    		</div>
				    			<div class="frgotpasscondition">
				    		 	<div class="row">
				    		 		<div class="col-lg-6">
				    		 			 <div class="privacy-policy">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1"><a href="#">Remember Me</a></label>
                                        </div>
                                    </div>
				    		 		</div>
				    		 		<div class="col-lg-6">
				    		 	    <p class="lost_password">
                                   <a href="#" data-toggle="modal" data-target="#forgotpasswordModal">Forgot Password?</a>
                                    </p>
				    		 		</div>
				    		 		
				    		 	</div>
				    		 </div>
				    		 <div class="modal-footer">
				    		 
				    		 	<div class="row">
				    		 		<div class="col-lg-6 pl-0">
				    		 			<p>Not registered?<a href="#">Create an account</a></p>
				    		 		</div>
				    		 		<div class="col-lg-6 pr-0">
				    		 			<div class="cancelloginin">
				    		 		<button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
				                    <button type="button" class="btn btnlogininlectro">Login In</button>
				                </div>
				    		 		</div>
				    		 	</div>
				    		 	 
				             </div>
				    	</form>
				    </div>
				  </div>
				</div>
				</div>
				</div>
                 </div>
					<div class="productreviewlist">
						<ul>
							<li>
								<div class="media">
									<img class="align-self-start mr-3" src="img/team1-1.jpg" alt="review author immages">
									<div class="media-body">
										<div class="ratingwrap">
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></span>
										</div>
										<h5 class="mt-0">Ramesh Mahato</h5>
										<p class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i>July 7, 2020</p>
										<p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="media">
									<img class="align-self-start mr-3" src="img/team3-1.jpg" alt="review author immages">
									<div class="media-body">
										<div class="ratingwrap">
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></span>
										</div>
										<h5 class="mt-0">Ramesh Mahato</h5>
										<p class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i>July 7, 2020</p>
										<p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="media">
									<img class="align-self-start mr-3" src="img/team2-1.jpg" alt="review author immages">
									<div class="media-body">
										<div class="ratingwrap">
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></span>
											<span><a href="#"><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></span>
										</div>
										<h5 class="mt-0">Ramesh Mahato</h5>
										<p class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i>July 7, 2020</p>
										<p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<!-- Add a review -->
					<div class="addreview-product">
						<h2>Add Review</h2>
						<div class="dpagerating">
							<ul>
								<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="reviewformfc">
							<form>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="fname" class="form-control" placeholder="Enter your full name...">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" name="fname" class="form-control" placeholder="Enter your email address...">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="addreview" placeholder="Write Your Review" rows="6"></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="post-review">
											<input type="submit" name="submit" value="Post Review">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /Main Body Section End -->
	<!-- Best Sellers Section Start -->
	<?php 	
	

	$terms = get_the_terms( get_the_ID(), 'product_cat' );
	
	$tax_query_meta = [];
	
	$args = array(
		'posts_per_page' => 10,
		'post_type' => 'product',
		'post__not_in' => [$current_post_id] ,
		'orderby' => 'rand'
	);
	
	if ( $terms && ! is_wp_error( $terms ) ) : 
		
		$draught_links = array();
		
		foreach ( $terms as $term ) {
			$draught_links[] = $term->slug;
		}
			
		$tax_query_meta[] = array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => $draught_links,
						);
						
		$args['tax_query'] = array(
			'relation' => 'AND',
			$tax_query_meta,
		);

	endif;

	$myposts = get_posts( $args );  
	if($myposts){
	?>
<section id="best-selllers">
	<div class="container">
		<div class="mainfoodtitle">
			<h2>View related products</h2>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="pharproductLists">
					<div class="owl-theme bestselllerowl">
						<?php 
						foreach( $myposts as $post ) :
							setup_postdata($post);

							$related_post_id = $post->ID; 
							get_template_part(
								'template-parts/product/product',
								'carosal',
								array(
									'post_id' => $related_post_id,
								)
							);
						endforeach;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php  }

	endwhile; // End of the loop.

get_footer();
