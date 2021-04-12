<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Electoreftech
 */

get_header();
?>
		<div class="blog-area pt-120 pb-90">
			<div class="container">

			<div class="row">
					<div class="col-md-8 mb-30">
					<?php if ( have_posts() ) : ?>

						<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

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
								<h2 class="post-title"><a href="<?php echo get_permalink($post_id); ?>"><span class="pe-7s-pin"></span><?php echo get_the_title($post_id); ?></a></h2>
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

			the_posts_navigation();
					
						
						else :

							get_template_part( 'template-parts/content', 'none' );
				
						endif;
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
