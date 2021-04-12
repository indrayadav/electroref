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
					'paged'          => $paged
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
										
										<?php  echo electoreftech_product_price( $post_id);  ?>
										<div class="viewrightmks"><a href="<?php echo get_permalink($post_id); ?>">VIEW MORE</a></div>
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
