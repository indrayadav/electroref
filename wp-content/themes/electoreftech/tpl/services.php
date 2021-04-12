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
        
		<div class="Our-Services-area pt-120 pb-65">
			<div class="container">
				<div class="section-info text-center mb-60">
					<h2><?php echo get_the_title(); ?></h2>
					<?php 
					$electroref_sub_heading = get_post_meta(get_the_ID(), 'electroref_sub_heading', true);
					if(isset($electroref_sub_heading) && !empty($electroref_sub_heading)){
						echo '<p>'. $electroref_sub_heading .'</p>'; 
					}

					?>
				</div>
				<div class="row">
					<?php
					$args = array(
						'posts_per_page' => -1,
						'post_type' => 'service',
						'orderby' => 'menu_order',
					);
					
					$myposts = get_posts( $args );
					if($myposts){
						foreach( $myposts as $post ) :
							setup_postdata($post);
		
							$post_id = $post->ID;
							$icon_img = '';

							$service_icon = get_post_meta($post_id, 'service_icon', true);
							if(isset($service_icon) && !empty($service_icon)){
								$icon_img = '<div class="our-services-icon"><i class="'. $service_icon .'"></i></div>'; 
							} else if ( has_post_thumbnail($post_id) ) {
								$icon_img = '<div class="our-services-icon">' . get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'aligncenter' ,  'itemprop' => 'work' ) ) . '</div>';
							}


						?>
							<div class="col-md-4 col-sm-6">
						<div  itemscope itemtype="http://n.whatwg.org/work" itemref="licenses" class="our-services-wrapper text-center mb-50">
							<?php echo $icon_img; ?>
							<div class="our-services-text">
								<h3  itemprop="title"><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h3>
								<p><?php echo get_the_excerpt($post_id); ?></p>
							</div>
						</div>
					</div>
						<?php 
					 endforeach;
					 wp_reset_postdata();
					}
					
					?>
				</div>
			</div>
		</div>

<?php 
endwhile; // End of the loop.
get_footer();
