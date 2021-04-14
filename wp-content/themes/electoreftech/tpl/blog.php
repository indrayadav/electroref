<?php 
/* Template Name: Blog 
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

$banner_img = get_template_directory_uri(). '/img/page_banner.jpg';
$electroref_page_banner = get_post_meta(get_the_ID(), 'electroref_page_banner', true);

if(isset($electroref_page_banner) && !empty($electroref_page_banner)){
	$banner_img = $electroref_page_banner;
}
 ?>
 
 <?php 
 while ( have_posts() ) :
	the_post();
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
<?php endwhile; // End of the loop. ?>    


	<!-- Blog Section Start -->
	<section id="all-blog-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
				<?php 
				
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'posts_per_page' => 6,
					'post_type' => 'post',
					'paged'          => $paged
				);
				
				$wp_query = new WP_Query( $args );
				if( $wp_query->have_posts() ) { 
				?>
					<div class="row">
						<?php  
						while ( $wp_query->have_posts() ) : $wp_query->the_post();

						$post_id = $wp_query->ID; 
						$author_id=$wp_query->post_author;
							get_template_part(
								'template-parts/blog/blog',
								'modern2',
								array(
									'post_id' => $post_id,
								)
							);
						endwhile;
						?>
					</div>
				
				<?php 
					if ( function_exists( 'electoreftech_pagination' ) ) {
						echo '<div class="pagination-block">';
						electoreftech_pagination();
						echo '</div>';
					}
				
				wp_reset_query(); 
				} ?>	
				</div>
				<div class="col-lg-4">
				<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</section>
        <!-- /Blog Section End -->

<?php 

get_footer();
