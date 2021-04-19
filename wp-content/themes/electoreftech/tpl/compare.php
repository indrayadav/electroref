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
        <?php 
            $compare_posts = [];
            $compare_total = electoreftech_compare_total();	

            if($compare_total > 0 ) {

              $guest_id = electoreftech_guest_id();
              if(is_user_logged_in()){
                  $current_user = wp_get_current_user();
                  $cond_cnt = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';  
                }else {
                  $cond_cnt = ' AND guest_id = "'. $guest_id . '"'; 
              }

              $result = electoreftech_all_data('compare', $cond_cnt);

              if($result){
                $cnt = 0;
                // heading
                $compare_data['prod_cnt'][] = __('<strong>-</strong>', 'electoreftech'); 
                $compare_data['prod'][] = __('<strong>Products</strong>', 'electoreftech'); 
                $compare_data['brand'][] = __('<strong>Brand Name</strong>', 'electoreftech'); 
                $compare_data['product_type'][] = __('<strong>Product</strong>', 'electoreftech'); 
                $compare_data['warranty'][] = __('<strong>Warranty</strong>', 'electoreftech'); 
                $compare_data['installation_fee'][] = __('<strong>Installation Fee </strong>', 'electoreftech'); 
                $compare_data['delivery_fee'][] = __('<strong>Delivery Fee</strong>', 'electoreftech'); 
                $compare_data['model'][] = __('<strong>Model No</strong>', 'electoreftech'); 
                $compare_data['readmore'][] = __('<strong>-</strong>', 'electoreftech'); 

                  foreach($result as $w){
                      $product_id = $w->post_id; 
                      $cnt++;

                      $compare_data['prod_cnt'][] = 'Product #'. $cnt . '<span class="compare_delete"><input type="hidden" class="post_id" value="'. $product_id.'" ><a href=""><i class="fa fa-minus-circle"></i> REMOVE</a></span>';
                      $prod = '<a href="'. get_permalink($product_id).'">';
                      
                      if ( has_post_thumbnail($product_id) ) {
                       $featured_img_url =  get_the_post_thumbnail_url($product_id, 'thumbnail');                        
                      }
                      else {
                        $featured_img_url = get_template_directory_uri() . '/img/no_image.png';
                      }
                      $prod .= '<img src="' . $featured_img_url . '"  class="img-fluid" />';
                      $prod .= '</a><div class="pharprodesccompare"> <h4><a href="'. get_permalink($product_id).'">'. get_the_title($product_id).'</a></h4></div>';
                      $prod .= electoreftech_product_price($product_id);

                      $compare_data['prod'][] =  $prod;
                      //brand 
                      $terms = get_the_terms( $product_id, 'brand' );
                      if ( $terms && ! is_wp_error( $terms ) ) : 
     
                        $draught_links = [];
                       
                        foreach ( $terms as $term ) {
                          $draught_links[] = $term->name;
                        }
                                   
                        $compare_data['brand'][] = join( ", ", $draught_links ); 
                      endif;                        
                      

                      // type
                      $product_type = get_post_meta($product_id, 'product_type', true);
                      if(isset($product_type) && !empty($product_type)){
                        $compare_data['product_type'][] = $product_type;
                      } else {
                        $compare_data['product_type'][] = 'N/A';
                      }

                      // type
                      $product_warranty = get_post_meta($product_id, 'product_warranty', true);
                      if(isset($product_warranty) && !empty($product_warranty)){
                        $compare_data['warranty'][] = $product_warranty;
                      } else{
                        $compare_data['warranty'][] = 'N/A';
                      }

                      // installation_fee
                      $product_installation_fee = get_post_meta($product_id, 'product_installation_fee', true);
                      if(isset($product_installation_fee) && !empty($product_installation_fee)){
                        $compare_data['installation_fee'][] = $product_installation_fee;
                      } else{
                        $compare_data['installation_fee'][] = 'N/A';
                      }

                      // product_delivery_fee
                      $product_installation_fee = get_post_meta($product_id, 'product_installation_fee', true);
                      if(isset($product_installation_fee) && !empty($product_installation_fee)){
                        $compare_data['delivery_fee'][] = $product_installation_fee;
                      } else{
                        $compare_data['delivery_fee'][] = 'N/A';
                      }

                      // product_model
                      $product_model = get_post_meta($product_id, 'product_model', true);
                      if(isset($product_model) && !empty($product_model)){
                        $compare_data['model'][] = $product_model;
                      } else{
                        $compare_data['model'][] = 'N/A';
                      }

                      // Readmore
                      $compare_data['readmore'][] = '<div class="electrobtn"><a href="'. get_permalink($product_id).'">View More</a></div>';

                  }


                }


        ?>
        <div class="compareproductlistbox">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <tbody>
                    
                    <?php 
                    foreach($compare_data as $brand_key => $val) {
                    if($brand_key){
                      echo '<tr>';
                      foreach($compare_data[$brand_key] as $brand ){
                        echo '<td>'. $brand .'</td>';
                      }
                      echo '</tr>';
                    }
                    
                    }
                    ?>                 

                  </tbody>
                </table>
            </div>
        </div>
        <?php    } else{
           _e( "<p>You haven't added any product yet!</p>", 'electoreftech' );
        } ?>
    </div>
</section>
    
</section>
<?php 

get_footer();
