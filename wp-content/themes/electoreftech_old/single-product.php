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
			?>
        <div class="breadcrumb-banner-area ptb-120 bg-opacity" style="background-image:url(<?php echo $banner_img; ?>)">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumb-text text-center">
						<h2><?php echo get_the_title(); ?></h2>
						
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="project-details-2 pb-90 pt-40">
			<div class="container">
				<div class="row">
				    <div class="col-sm-5 col-md-5">
						<div class="project-details-2-wrapper mb-30">
							<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');  ?>
							<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
								<a href="<?php echo $featured_img_url; ?>">
								<img src="<?php echo $featured_img_url; ?>" alt="" width="400" height="400">
								<!-- <?php //the_post_thumbnail(array( 400, 400 )); ?> -->
									
								</a>
							</div>
							<ul class="thumbnails">
								<li>
									<a href="<?php echo $featured_img_url; ?>" data-standard="<?php echo $featured_img_url; ?>">
									<?php the_post_thumbnail(array( 140, 140 )); ?>
									</a>
								</li>
								<?php 
									
									$product_galleries = get_post_meta( get_the_ID(), 'product_gallery_list', true );									
									foreach ($product_galleries as $key => $image) {
										$img = wp_get_attachment_image_src($key, array('140','140'), true ); ?>
									<li>
									<a href="<?php echo $image; ?>" data-standard="<?php echo $image; ?>">
										<img src="<?php echo $img[0]; ?>" alt="" />
									</a>
								</li>
								<?php	}
								?>
								
							</ul>
							<?php 
								// if ( has_post_thumbnail() ) {
								// 	the_post_thumbnail(array( 400, 400 ));
								// }
							?>
						</div>
					</div>
					<div class="col-sm-7 col-md-7">
						<div class="project-details-2-wrapper mb-30">
							<div class="project-details-2-content">
								
                           <p><?php echo get_the_excerpt(); ?></p>
								<ul class="deatils-menu pt-20">
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
								<div class="priceinfo">
									<?php
										echo electoreftech_product_price(get_the_ID());
									?>
								</div>
								<?php echo electroref_sharethis_nav(get_the_ID()); ?>
								<div class="read-more">
										<a href="#" data-toggle="modal" data-target="#booknow">Book Now</a>
										<a href="tel:+9779818776832" >Call us</a>
										
									</div>
										<!-- Book Now -->
										<div id="booknowbutton">
<div class="modal fade" id="booknow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Book Now</h4>
      </div>
      <div class="modal-body">
        <div class="booknow-model">
			 <?php echo do_shortcode('[contact-form-7 id="302" title="Book Product"]'); ?>
        </div>
      </div>
  </div>
</div>
									</div>
								</div>


							</div>
						</div>
					</div>

				</div>
				<div class="product-details">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">Overview</a></li>
    <li role="presentation"><a href="#additionalinfo" aria-controls="additionalinfo" role="tab" data-toggle="tab">Additional Info</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="overview">
    	<div class="productinfo">
    		<?php the_content(); ?>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="additionalinfo">
    	<div class="productinfo">
    		<h3>Additional Info</h3>
    	</div>
    </div>
  </div>
					
				</div>

				<div class="related-product">
					<h2>Related Products</h2>
					<div class="row">
					<?php 	
					
					$terms = get_the_terms( get_the_ID(), 'product_cat' );
					
					$tax_query_meta = [];
					
					$args = array(
						'posts_per_page' => 4,
						'post_type' => 'product',
						'post__not_in' => array( $current_post_id ),
						'orderby' => 'rand'
					);
					
					if ( $terms && ! is_wp_error( $terms ) ) : 
                     
                        $draught_links = array();
                     
                        foreach ( $terms as $term ) {
                            $draught_links[] = $term->slug;
                        }
                                             
                        $on_draught = join( ", ", $draught_links );
                          
                        $tax_query_meta[] = array(
                                            'taxonomy' => 'product_cat',
                                            'field'    => 'slug',
                                            'terms'    => $on_draught,
                                        );
                                        
                        $args['tax_query'] = array(
                          'relation' => 'AND',
                          $tax_query_meta,
                        );
                
                    endif;
					
				

					$myposts = get_posts( $args );  
					if($myposts){
						// echo '<h2>Related Products</h2>';
						
						foreach( $myposts as $post ) :
							setup_postdata($post);

							$related_post_id = $post->ID; 
							$price = get_post_meta($related_post_id, 'product_price', true);
							?>
							<div class="col-md-3 col-sm-6">
								<div class="blog-wrapper mb-30">
									<div class="blog-img">
										<a href="<?php echo get_permalink($related_post_id); ?>">
										<?php 
										// Must be inside a loop.
										 
										if ( has_post_thumbnail($related_post_id) ) {
											the_post_thumbnail($related_post_id);
										}
										else {
											echo '<img src="' . get_template_directory_uri() . '/img/no_image.png" />';
										}
									
										?></a>
									</div>
									<div class="blog-text">
										<div class="blog-info">
											<h3><a href="<?php echo get_permalink($related_post_id); ?>"><?php echo get_the_title($related_post_id); ?></a></h3>
										</div>
										<div class="blog-date">
											<span class="PriceName">
											<?php  echo electoreftech_price( $price );  ?></span>
											<span class="read-more"><a href="<?php echo get_permalink($related_post_id); ?>">VIEW MORE</a></span>
										</div>
									</div>
								</div>
							</div>
	
						
							<?php 


						endforeach;
					}
		
					wp_reset_postdata();
					
				?>
			</div>
				</div>


			</div>
		</div>

<?php 

		endwhile; // End of the loop.
		?>


<?php

get_footer();
