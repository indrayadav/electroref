<?php 
/* Template Name: Product 
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

$cate = get_queried_object();
$t_id = $cate->term_id;
$term = get_term_by( 'id', $t_id, 'product_cat' );

 ?>
 
 <?php 


	$banner_img = get_template_directory_uri(). '/img/page_banner.jpg';

 ?>

        <div class="breadcrumb-banner-area ptb-120 bg-opacity" style="background-image:url(<?php echo $banner_img; ?>)">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumb-text text-center">
						<h2><?php echo $term->name; ?></h2>
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



		<div class="blog-area pt-120 pb-90">
			<div class="container">
			<div class="row">
				<div class="col-md-3 mb-30">
					<?php get_sidebar('product'); ?>
				</div>

				<div class="col-md-9 mb-30">
					<div class="all-products">
                <div class="row">
				<?php 
				
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'posts_per_page' => 6,
					'post_type' => 'product',
					'paged'          => $paged,
					'tax_query'     	=> array(
						array(
							'taxonomy'  => 'product_cat',
							'field'     => 'id',
							'terms'     => array($t_id)
						)
					)
				);


				$wp_query = new WP_Query( $args );
				if( $wp_query->have_posts() ) { 
				 
						while ( $wp_query->have_posts() ) : $wp_query->the_post();

						 $post_id = get_the_ID(); 
						 $price = get_post_meta($post_id, 'product_price', true);
						?>
						<div class="col-md-4 col-sm-6">
							<div class="blog-wrapper mb-30">
								<div class="blog-img">
									<a href="<?php echo get_permalink($post_id); ?>">
									<?php 
									// Must be inside a loop.
									 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail();
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
										<span class="PriceName">
										<?php  echo electoreftech_price( $price );  ?></span>
										<span class="viewrightmks"><a href="<?php echo get_permalink($post_id); ?>">VIEW MORE</a></span>
									</div>
								</div>
							</div>
						</div>

					
						<?php 
						
							endwhile;			
						
						?>
					
					
					<?php 
						if ( function_exists( 'electoreftech_pagination' ) ) {
							echo '<div class="clearfix"></div><div class="pagination-block">';
							electoreftech_pagination();
							echo '</div>';
						}
					}
					
					wp_reset_query(); 
					?>
					</div>
				</div>
			</div>

				</div>
			</div>
		</div>

<?php 

get_footer();
