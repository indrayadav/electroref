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
<section id="detail-page" itemscope="" itemtype="http://schema.org/Product">

   <meta itemprop="name" content="<?php echo get_the_title($current_post_id); ?>" />
    <link itemprop="url" href="<?php echo get_permalink($current_post_id);?>" />
    <meta itemprop="description" content="<?php echo get_the_excerpt($current_post_id); ?>" />
    <span class="d-none" itemprop="brand" itemtype="http://schema.org/Brand" itemscope>
        <meta itemprop="name" content="<?php echo electoreftech_get_product_brand($current_post_id); ?>" />
    </span>
    <?php $product_sku = get_post_meta($current_post_id, 'product_sku', true); ?>
	<meta itemprop="sku" content="<?php echo $product_sku; ?>" />
	
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="left-product-detailss">
					<div class="xzoom-container">
					<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
					echo '<link itemprop="image" href="'. $featured_img_url.'" />'; ?>
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
					<?php echo electoreftech_product_rating($current_post_id); ?>
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
					    <input type="hidden" class="post_id" id="post_id" value="<?php echo get_the_ID(); ?>" >
						<ul>
							<li>Share: </li>
							<?php echo electroref_sharethis_nav(get_the_ID()); ?>
							<li><div class="wishlistprodiocn"><a href="javascript:void(null)"><?php echo electoreftech_wishlist_status(get_the_ID(), 'txt'); ?></a></div></li>
						</ul>
					</div>
					<div class="book-now"><a href="#" data-toggle="modal" data-target="#booknowModal">Request A Quote</a></div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Book Now -->
<div class="modal fade" id="booknowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"> Request Product Quote Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="" id="frm_request_quote">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<input type="text" class="form-control" name="cust_name" id="cust_name" placeholder="Your Name">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<input type="text" class="form-control" name="cust_email" id="cust_email" placeholder="Your Email">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<input type="text" class="form-control" name="cust_phone" id="cust_phone" placeholder="Your Phone">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<select class="form-control" id="product_id">
							<option value="<?php echo $current_post_id; ?>"><?php echo get_the_title($current_post_id);?></option>
						</select>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<textarea class="form-control" placeholder="Message" rows="3" name="cust_msg" id="cust_msg"></textarea>
					</div>
				</div>

				<div class="col-lg-12" id="request_sent_msg"> </div>

			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn_request_quote">Request Quote</button>
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
				<li class="nav-item"> <a class="nav-link" id="specifications-tab" data-toggle="tab" href="#specifications" role="tab" aria-controls="specifications" aria-selected="false">Specifications</a> </li>
				<li class="nav-item"> <a class="nav-link" id="additionalinfo-tab" data-toggle="tab" href="#additionalinfo" role="tab" aria-controls="additionalinfo" aria-selected="false">Additional Info</a> </li>
				<li class="nav-item"> <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a> </li>
			</ul>
		</div>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
				<div class="overviewrelated">
					<?php the_content(); ?>
				</div>
			</div>

			<div class="tab-pane fade" id="specifications" role="tabpanel" aria-labelledby="specifications-tab">
				<div class="overviewrelated">
				<?php echo wpautop( get_post_meta( get_the_ID(), 'product_specifications', true ) ); ?>
				</div>
			</div>

			<div class="tab-pane fade" id="additionalinfo" role="tabpanel" aria-labelledby="additionalinfo-tab">
				<div class="overviewrelated">
				<?php echo wpautop( get_post_meta( get_the_ID(), 'product_add_info', true ) ); ?>
				</div>
			</div>
			<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
			<?php 
				$reviews_cond = ' AND post_id = '. $current_post_id . ' AND status = "Published"'; 
				$reviews = electoreftech_all_data('reviews', $reviews_cond);
			
			?>
				<div class="producttab-inside">
					<h4><?php echo count($reviews);?> Review For <?php echo get_the_title($current_post_id); ?></h4>
					<div class="writereviewadd">
					<?php  if(!is_user_logged_in()){ ?>
					<a href="#" data-toggle="modal" data-target="#writeaReview">Write a review</a>
					<?php } else { ?>
						<a href="javascript:void(null)" class="btn_write_review">Write a review</a>
					<?php } ?>
					</div>
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
					<?php 

					if($reviews){
					?>
						<ul>
						<?php foreach($reviews as $review){
							$user_info = get_userdata($review->user_id);
							?>
							<li>
								<div class="media">
									<img class="align-self-start mr-3" src="<?php print get_avatar_url($user->ID, ['size' => '40']); ?>" alt="<?php echo $user_info->user_login; ?>">
									<div class="media-body">
										<?php echo electoreftech_rating_star($review->rating); ?>
										<h5 class="mt-0"><?php echo $user_info->user_login; ?></h5>
										<p class="comment-date"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo date("Y-m-d", strtotime($review->added_date)); ?></p>
										<p><?php echo $review->review; ?></p>
									</div>
								</div>
							</li>
						<?php } ?>
						</ul>
					<?php } ?>
					</div>
					<!-- Add a review -->
					<?php  if(is_user_logged_in()){ ?>
					<div class="addreview-product">
						<h2>Add Review</h2>
						<div class="dpagerating choose_rating">
							<ul>
								<li><a href="javascript:void(null)" title="1"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="javascript:void(null)" title="2"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="javascript:void(null)" title="3"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="javascript:void(null)" title="4"><i class="fa fa-star" aria-hidden="true"></i></a></li>
								<li><a href="javascript:void(null)" title="5"><i class="fa fa-star" aria-hidden="true"></i></a></li>
							</ul>
							<input type="hidden" id="post_rating" value="5">

						</div>
						<div class="reviewformfc">
						<form action="" id="frm_review">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="review" id="review" placeholder="Write Your Review" rows="6"></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="post-review">
											<input type="submit" name="submit" value="Post Review">
										</div>
									</div>

									<div id="review_sent_msg"></div>
								</div>
						</form>
						</div>
					</div>
					<?php } ?>
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
