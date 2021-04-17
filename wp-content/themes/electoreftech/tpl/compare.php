<?php 
/* Template Name: Compare 
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
<section id="electroprod-compare">
    <div class="container">
        <div class="compareproductlistbox">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th width="168" scope="col"></th>
      <th width="219" scope="col"><a href="http://localhost/projects/electroref/product/changhong-1-5-ton-wall-mount-split-uvc-air-conditioner/"><img src="<?php bloginfo('template_url'); ?>/img/aircooler.png" class="img-fluid" alt="Product"></a><div class="pharprodesccompare"> <h4><a href="http://localhost/projects/electroref/product/changhong-1-5-ton-wall-mount-split-uvc-air-conditioner/">Changhong 1.5 Ton Wall Mount Split UVC Air Conditioner</a></h4></div><div class="priceproddel">NRs 60,690.00<span>NRs 74,100.00</span></div></th>
         <th width="292" scope="col"><a href="http://localhost/projects/electroref/product/changhong-1-5-ton-wall-mount-split-uvc-air-conditioner/"><img src="<?php bloginfo('template_url'); ?>/img/aircooler.png" class="img-fluid" alt="Product"></a><div class="pharprodesccompare"> <h4><a href="http://localhost/projects/electroref/product/changhong-1-5-ton-wall-mount-split-uvc-air-conditioner/">Changhong 1.5 Ton Wall Mount Split UVC Air Conditioner</a></h4></div><div class="priceproddel">NRs 60,690.00<span>NRs 74,100.00</span></div></th>
         <th width="293" scope="col"><a href="http://localhost/projects/electroref/product/changhong-1-5-ton-wall-mount-split-uvc-air-conditioner/"><img src="<?php bloginfo('template_url'); ?>/img/aircooler.png" class="img-fluid" alt="Product"></a><div class="pharprodesccompare"> <h4><a href="http://localhost/projects/electroref/product/changhong-1-5-ton-wall-mount-split-uvc-air-conditioner/">Changhong 1.5 Ton Wall Mount Split UVC Air Conditioner</a></h4></div><div class="priceproddel">NRs 60,690.00<span>NRs 74,100.00</span></div></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Brand Name</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">Product</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">Warranty</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
     <tr>
      <th scope="row">Installation Fee</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
     <tr>
      <th scope="row">Delivery Fee</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
     <tr>
      <th scope="row"></th>
      <td><div class="electrobtn"><a href="#">View More</a></div></td>
      <td><div class="electrobtn"><a href="#">View More</a></div></td>
      <td><div class="electrobtn"><a href="#">View More</a></div></td>
    </tr>

  </tbody>
</table>
            </div>
        </div>
    </div>
</section>
    
</section>
<?php 

get_footer();
