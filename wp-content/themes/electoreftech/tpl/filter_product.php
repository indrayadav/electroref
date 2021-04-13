<?php
/* Template Name: Product Page
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
?>
<?php
while ( have_posts() ) :
	the_post();
	$banner_img = get_template_directory_uri(). '/img/page_banner.jpg';
	$electroref_page_banner = get_post_meta(get_the_ID(), 'electroref_page_banner', true);
	if(isset($electroref_page_banner) && !empty($electroref_page_banner)){
		$banner_img = $electroref_page_banner;
	}
?>
<div class="breadcrumb-banner-area ptb-120 bg-opacity" style="background-image:url(<?php echo $banner_img; ?>)">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-text text-center">
					<h2><?php echo get_the_title(); ?></h2>
					<?php
					if ( function_exists( 'electoreftech_breadcrumbs' ) ) {
						electoreftech_breadcrumbs();
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endwhile; // End of the loop. ?>

<?php 
$posts_per_page = 8;
$$tax_query_meta = [];
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => 'product',
	'posts_per_page' 	=> $posts_per_page,
	'paged' 			=> $paged,
);

// sort product 
if(!empty($_REQUEST['orderby']) ){
	$filter_sort_product = explode("-",$_REQUEST['orderby']);
	$args['meta_key'] = $filter_sort_product[0];
	$args['order'] = $filter_sort_product[1];
	$args['orderby'] = 'meta_value_num'; 
}

if(isset($_REQUEST['query']) && !empty($_REQUEST['query'])){
	$args['s'] = $_REQUEST['query'];
}

if(!empty($_REQUEST['prod_cat']) ){
	$prod_cat_slugs = explode(',',$_REQUEST['prod_cat']);
	$tax_query_meta[] = array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => $prod_cat_slugs,
						);

}

// Taxonomies for product category
if(!empty($_REQUEST['prod_brand']) ){
	$prod_brand_slugs = explode(',',$_REQUEST['prod_brand']);
	$tax_query_meta[] = array(
							'taxonomy' => 'brand',
							'field'    => 'slug',
							'terms'    => $prod_brand_slugs,
						);

}

	if($tax_query_meta){
		$args['tax_query'] = array(
								'relation' => 'AND',
								$tax_query_meta,
							);
	}

	// price range
	if(isset($_REQUEST['min_price']) && !empty($_REQUEST['max_price'])){
		$meta_query[] = array(
							'key' => 'product_price',
									'value' => array($_REQUEST['min_price'], $_REQUEST['max_price']),
									'type' => 'numeric',
									'compare' => 'BETWEEN'
							);
	}

	if($meta_query){
		$args['meta_query'] =  array(
							'relation' => 'AND',
							$meta_query,
						);
	}

	//   echo '<pre>';
	//   print_r($args);
	//   echo '</pre>';
		
$wp_query = new WP_Query( $args );
$total_record = $wp_query->found_posts;
$load_more_record = $total_record - $posts_per_page;
if($load_more_record <= 0){
	$load_more_record = 0;
}

?>
<div class="blog-area pt-120 pb-90">
	<div class="container">
		<div class="row">
			<div class="col-md-3 mb-30">
				<div class="product-left-sidebar">
				<div class="selectprodcategory mb-3">
						<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSearch" aria-expanded="true" aria-controls="collapseSearch">
									Search
									</h4>
								</div>
								<div id="collapseSearch" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body filter_searchbox">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Search..." value="<?php if(isset($_REQUEST['query']) && !empty($_REQUEST['query'])){ echo $_REQUEST['query']; }?>" name="s" id="query">
											<div class="input-group-btn">
												<button class="btn btn-default" id="text_search" type="submit"> <i class="fa fa-search"></i></button>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="selectprodcategory mb-3">
						<div class="panel-group" id="accordion1" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Product Categories
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<div class="select-category">
											<select class="form-control" id="filter_prod_cat">
												<option value="">All categories</option>
												<?php 
													// Product Categories			
													$terms = get_terms( array(
														'taxonomy' => 'product_cat',
														'hide_empty' => true
													) );
													if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
											
														foreach ( $terms as $term ) {
															echo '<option value="'. $term->slug . '"';
															
															if(!empty($_REQUEST['prod_cat'] && $_REQUEST['prod_cat'] ==  $term->slug ) ){
																echo ' selected ="selected"';
															}
															
															echo '>'. $term->name  .'</option>';
														
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="selectprodcategory">
						<div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									Product Brands
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body">
										<div class="select-category">
											<select class="form-control" id="filter_prod_brand">
											<option value="">All brands</option>
											<?php 
													// Product Categories			
													$terms = get_terms( array(
														'taxonomy' => 'brand',
														'hide_empty' => true
													) );
													if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
											
														foreach ( $terms as $term ) {
															echo '<option value="'. $term->slug . '"';
															
															if(!empty($_REQUEST['prod_brand'] && $_REQUEST['prod_brand'] ==  $term->slug ) ){
																echo ' selected ="selected"';
															}
															
															echo '>'. $term->name  .'</option>';
														
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="selectprodcategory mb-3">
						<div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingThree">
									<h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
									Price Range
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
									<div class="panel-body">
										<div class="price-slider rangeslider">
											<div class="pricewrapper">
												<div class="range-slider">
													<div id="slide_filter_price" class="slider"></div>
												</div>
												<div class="extra-controls form-inline">
													<div class="form-group rangevaluemks">
														<label>Min:</label>
														<input type="text" id="filter_min_price" readonly class="js-input-from form-control" value="0" />
													</div>
													<div class="form-group rangevaluemks">
														<label>Max:</label>
														<input type="text" id="filter_max_price" readonly class="js-input-to form-control" value="0" />
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
			</div>
			<div class="col-md-9 mb-30">
				<div class="count-orderby">
					<div class="row">
						<div class="col-md-3">
							<p class="product-result-count">
							<?php echo $total_record; ?> products found.</p>
						</div>
						<div class="col-md-9">
							<div class="order-by">
								<select name="orderby" id="filter_sort_product" class="form-control">
									<option value="" >Default sorting</option>
									<option value="product_price-asc">Price low to high </option>
									<option value="product_price-desc">Price high to low</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="all-products searchlist">
					<div class="pre-loader" style="display:none">
						<img src="https://hytt.s3.amazonaws.com/uploads/2019/03/preloader-orange.gif" >
					</div>

					<div id="listing_holder">
						<?php						
							
						if( $wp_query->have_posts() ) {
								$cnt = 0;
								echo '<div class="row">';
								while ( $wp_query->have_posts() ) : $wp_query->the_post();
								$post_id = get_the_ID();
								$price = get_post_meta($post_id, 'product_price', true);
								$cnt++;
						?>
						<div class="col-md-3 col-sm-6">
							<div class="blog-wrapper mb-30">
								<div class="blog-img product-img-block">
									<a href="<?php echo get_permalink($post_id); ?>">
										<?php
										// Must be inside a loop.
										
										if ( has_post_thumbnail() ) {
											the_post_thumbnail();
										}
										else {
											echo '<img src="' . get_template_directory_uri() . '/img/no_image.png" />';
										}

										$product_stock = get_post_meta($post_id, 'product_stock', true);
										if(isset($product_stock ) && $product_stock == 'stock_out'){
											echo '<span class="out-of-stock-badge">Out of stock</span>';
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
						
						if($cnt == 4 ){
							echo '</div><div class="row">';
						}
										endwhile;
						
						?>
						
						
						<?php
							echo '</div>';
						}
						
						wp_reset_query();
						?>
					</div>

					<div class="loadmore text-center">
					<input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo $posts_per_page; ?>" />
          			<input type="hidden" id="paged" name="paged" value="2" />
						<button type="button" id="btn_load_more" class="btn btn-block btn-line-theme1"><i class="fa fa-spinner"></i> <?php _e('Load more', 'electoreftech'); ?><?php echo '('. $load_more_record .')';?></button>
					</div>

				   </div>

				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();