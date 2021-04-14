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

<section id="all-blog-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="left-blog-lists">
                            <div class="blogboxpage">
                                <div class="blogimgpage">
								<?php if (has_post_thumbnail() ){
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(  get_the_ID() ), 'single-post-thumbnail' );
								$image_url = $image[0];
									echo '<img src="' . $image_url . '"  class="img-fluid" alt="blog images" >';
								}
								?>
                                   
                                </div>
                                <div class="blogcomment blogdetailcomment">
                                    <ul>
                                        <li><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo get_the_date( 'l F j, Y' ); ?></li>
                                        <li><i class="fa fa-user" aria-hidden="true"></i>By Electro-Ref Tech</li>
                                    </ul>
                                </div>
                                <div class="blogdetaildesc">
                                    <h2><?php the_title();?></h2>
									<?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-4">
						<?php get_sidebar(); ?>
					</div>
                </div>
            </div>
        </section>
<?php endwhile; // End of the loop. ?>    



<?php

get_footer();
