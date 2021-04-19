<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Electoreftech
 */

get_header();
?>

<section id="breadcrumb-nf">
	<div class="container">
	<h1><?php	printf( esc_html__( 'Search Results for: %s', 'electoreftech' ), ' "' . get_search_query() . '"' );
		?></h1>
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
<?php 
get_footer();
