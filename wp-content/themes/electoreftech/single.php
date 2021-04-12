<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Electoreftech
 */

get_header();

$banner_img = get_template_directory_uri(). '/img/electroref_tech_blog_nepal.jpg';
$post_blog_banner = get_post_meta(get_the_ID(), 'post_blog_banner', true);
if(isset($post_blog_banner) && !empty($post_blog_banner)){
	$banner_img = $post_blog_banner;
}

?>
        <div class="breadcrumb-banner-area ptb-120 bg-opacity" style="background-image:url(<?php echo $banner_img; ?>)">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumb-text text-center">
						<h1 class="blog_single_title"><?php echo get_the_title(); ?></h1>						
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="blog-area pt-120 pb-90">
			<div class="container">
				<div class="row">

				<?php
					while ( have_posts() ) :
						the_post();

						?>
					<div class="col-md-8 mb-30">
						<article class="blog-post">
							<?php if (has_post_thumbnail() ){
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), 'single-post-thumbnail' );
								$image_url = $image[0];
								?>
							<div class="blog-thumb">
								<a href="#"><img src="<?php echo $image_url; ?>" alt=""></a>
							</div>
							<?php } ?>
							<div class="blog-content">
						
								<div class="blog-meta">
								    <span><?php echo get_the_date( 'l F j, Y' ); ?></span>
									<span><a href="#"><?php the_author_meta( 'user_nicename' , $author_id ); ?> </a></span>
								</div>
								<?php the_content(); ?>

								
								<div class="next-prev">
								<?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i> prev post', true ); ?>
								<?php next_post_link( '%link', 'next post <i class="fa fa-angle-right"></i>', true ); ?>

                                </div>

								<?php 
								            $args = array(
												'post_type' 	 => 'post',
												'posts_per_page' => 3,
												'post__not_in' => [get_the_ID()],
											  );

											  $myposts = get_posts( $args );  
											  if($myposts){
								?>
								<div class="related-post">
                                <h3 class="sidebar-title">Related Post</h3>
									<div class="row">
											<?php foreach( $myposts as $post ) :
											setup_postdata($post);
											$post_id = $post->ID; 
											?>
										<div class="col-md-4 col-sm-4">
											<div class="single-related-post mb-30">
												<?php if (has_post_thumbnail($post_id) ){
												$image = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), 'single-post-thumbnail' );
												$image_url = $image[0];
												?>
												<a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'alignleft' ) ); ?></a>
												<?php } ?>

												<div class="related-post-title">
													<h3><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h3>
													<span><?php echo get_the_date( 'F j, Y' ); ?></span>
												</div>
											</div>
										</div>
											<?php  endforeach; ?>
									</div>

								</div>

								 <?php } ?>

							</div>
						</article>
					</div>

					<?php 

					endwhile; // End of the loop.
					?>
					<div class="col-md-4 mb-30">
					<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>




<?php

get_footer();
