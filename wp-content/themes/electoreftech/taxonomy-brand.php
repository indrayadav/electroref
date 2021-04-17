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
$term = get_term_by( 'id', $t_id, 'brand' );

 ?>
<section id="breadcrumb-nf">
	<div class="container">
	<h1><?php echo $term->name; ?></h1>
		<?php
			if ( function_exists( 'electoreftech_breadcrumbs' ) ) {
				electoreftech_breadcrumbs();
			}
			?>
	</div>
</section>
<?php 
				
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args = array(
		'posts_per_page' => 8,
		'post_type' => 'product',
		'paged'          => $paged,
		'tax_query'     	=> array(
			array(
				'taxonomy'  => 'brand',
				'field'     => 'id',
				'terms'     => array($t_id)
			)
		)
	);
	$wp_query = new WP_Query( $args );
	$total_record = $wp_query->found_posts;
	
?>

<!-- Main Body Section Start -->
<section id="main-body" class="product-page">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<?php get_sidebar('product'); ?>
			</div>
			<div class="col-md-8 col-lg-9">
				<?php 
				if( $wp_query->have_posts() ) {
					$cnt = 0;
					?>
					<div class="count-orderby">
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<p class="product-result-count">
								<?php echo $total_record; ?> products found.</p>
							</div>
						</div>
					</div>	

					<div class="row">
					<?php 
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post_id = get_the_ID();
					$price = get_post_meta($post_id, 'product_price', true);
					$cnt++;
					get_template_part(
						'template-parts/product/product',
						'grid',
						array(
							'post_id' => $post_id,
						)
					);
			
					if($cnt == 4 ){
						echo '</div><div class="row">';
					}
							endwhile;
					?>
					</div>
					<?php
						if ( function_exists( 'electoreftech_pagination' ) ) {
						echo '<div class="pagination-block d-flex justify-content-center">';
						electoreftech_pagination();
						echo '</div>';
					}
					wp_reset_query(); 
					?>
			</div>

					
			<?php  	
				} else {
					echo '<p> No products were found matching your selection.</p>';
				}
				?>
			</div>
		</div>
	</div>
</section>



<?php 

get_footer();
