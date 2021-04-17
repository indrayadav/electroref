<?php 
/* Template Name: Services
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

while ( have_posts() ) :
	the_post();

	$banner_img = get_template_directory_uri(). '/img/page_banner.jpg';
	$electroref_page_banner = get_post_meta(get_the_ID(), 'electroref_page_banner', true);

	if(isset($electroref_page_banner) && !empty($electroref_page_banner)){
		$banner_img = $electroref_page_banner;
	}
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

<?php 	 endwhile; // End of the loop.			
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'service',	
		'order'   => 'DESC',
);
$wp_query = new WP_Query( $args );	
if ( $wp_query->have_posts() ) {			
?>
        <!-- Services Section Start -->
        <section id="ourserviesec" class="ourservices-page">
            <div class="container">
                <div class="mainfoodtitle">
                    <h2>Our Services</h2>
                </div>
                <div class="row">
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
				$post_id = get_the_ID(); 
				get_template_part(
					'template-parts/blog/blog',
					'grid',
					array(
						'post_id' => $post_id,
					)
				);
				endwhile;
	    ?>
                </div>
            </div>
        </section>

<?php  } 

get_footer();
