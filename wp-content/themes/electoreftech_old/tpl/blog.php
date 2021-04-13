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
					<div class="col-md-8 mb-30">
						<?php  
						while ( $wp_query->have_posts() ) : $wp_query->the_post();

						$post_id = $wp_query->ID; 
						$author_id=$wp_query->post_author;
						?>
						<article class="blog-post mb-40">
							<?php if (has_post_thumbnail( $post_id ) ){
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(  $post_id ), 'single-post-thumbnail' );
								$image_url = $image[0];
							?>
								<div class="blog-thumb">
									<a href="<?php echo get_permalink($post_id); ?>"><img src="<?php echo $image_url; ?>" alt="<?php echo get_the_title($post_id); ?>">
										<div class="blog-icon">
											<span class="pe-7s-pin"></span>
										</div>
									</a>
								</div>
							<?php } ?>
							<div class="blog-content">
								<h2 class="post-title"><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h2>
								<div class="blog-meta">
									<span><?php echo get_the_date( 'l F j, Y' ); ?></span>
									<span><a href="#"><?php the_author_meta( 'user_nicename' , $author_id ); ?> </a></span>
								</div>
								<p><?php echo get_the_excerpt(); ?></p>
								<div class="read-more">
									<a href="<?php echo get_permalink($post_id); ?>">Read More</a>
								</div>
							</div>
						</article>
						<?php 
						
							endwhile;			
						
						?>
					
					
					<?php 
						if ( function_exists( 'electoreftech_pagination' ) ) {
							echo '<div class="pagination-block">';
							electoreftech_pagination();
							echo '</div>';
						}
					}
					
					wp_reset_query(); 
					?>
					</div>
					<div class="col-md-4 mb-30">
					<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>

<?php 

get_footer();
