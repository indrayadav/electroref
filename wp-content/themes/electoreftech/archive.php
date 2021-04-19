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

<section id="breadcrumb-nf">
	<div class="container">
	<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php
			if ( function_exists( 'electoreftech_breadcrumbs' ) ) {
				electoreftech_breadcrumbs();
			}
			?>
	</div>
</section>

<!-- Blog Section Start -->
<section id="all-blog-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
			<?php if ( have_posts() ) : ?>
				<div class="row">
					<?php  
					while ( have_posts() ) :
									the_post();

					$post_id = get_the_ID(); 
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
			the_posts_navigation();

			else :
	
				get_template_part( 'template-parts/content', 'none' );
	
			endif;
			 ?>	
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
