<?php 
if ( ! function_exists( 'electoreftech_breadcrumbs' ) ) {
	function electoreftech_breadcrumbs() {

            $showOnHome = 0;
            $delimiter = '';
            $home = __('Home', 'electoreftech');
            $showCurrent = 1;
            $before = '<li>';
            $after = '</li>';
            global $post;
            $homeLink = esc_url( home_url( '/' ) );
            if (is_home() || is_front_page()) {
                if ($showOnHome == 1){
                    echo '<ul class="breadcrumb-menu"><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';
                }
            }
            else {
                echo '<ul class="breadcrumb-menu"><li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
                if ( is_category() ) {
                    $thisCat = get_category(get_query_var('cat'), false);
                    if ($thisCat->parent != 0) {
                        echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                    }
                    echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
                }
                else if ( is_tax() ){
                    $thisterm 	= get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                    $thisparent = $thisterm->parent;
                    while ($thisparent):
                        $thisparents[] 	= $thisparent;
                        $new_parent 	= get_term_by( 'id', $thisparent, get_query_var( 'taxonomy' ));
                        $thisparent 	= $new_parent->parent;
                    endwhile;
                    if(!empty($thisparents)):
                        $thisparents = array_reverse($thisparents);
                        $woocommerce_permalinks_arr = array();
                        foreach ($thisparents as $parent):
                            $taxonomy_slug = get_query_var( 'taxonomy' );
                            $item 	= get_term_by( 'id', $parent, $taxonomy_slug);
                            $category_base = $item->taxonomy;
                            $woocommerce_permalinks = get_option( 'woocommerce_permalinks' );

                            $url = get_term_link( $item->term_id, $taxonomy_slug );

                            if( !empty( $woocommerce_permaitem->term_idlinks ) && $taxonomy_slug != 'destination'){
                                $woocommerce_permalinks_arr = maybe_unserialize( $woocommerce_permalinks );
                                $category_base = $woocommerce_permalinks_arr['category_base'];
                                $url = esc_url( home_url( '/' ) ) .$category_base.'/'.$item->slug;
                            }
                            
                            echo '<li><a href="'.$url.'">'.$item->name.'</a></li>';
                        endforeach;
                    endif;						
                    echo '<li>'.$thisterm->name.'</li>';
                }
                else if ( is_search() ) {
                    echo $before . 'Search results for "' . get_search_query() . '"' . $after;
                }
                else if ( is_day() ) {
                    echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
                    echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
                    echo $before . get_the_time('d') . $after;
                }
                else if ( is_month() ) {
                    echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
                    echo $before . get_the_time('F') . $after;
                }
                else if ( is_year() ) {
                    echo $before . get_the_time('Y') . $after;
                }
                else if ( is_single() && !is_attachment() ) {
                    if ( get_post_type() != 'post' ) {
                        $post_type 	= get_post_type_object(get_post_type());
                        $slug 		= $post_type->rewrite;
                        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
                        if ( $showCurrent == 1 ){
                            echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;						
                        }
                    }
                    else {
                        $cat 	= get_the_category(); $cat = $cat[0];
                        $cats 	= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                        if ($showCurrent == 0){
                            $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                        }
                        echo $cats;
                        if ($showCurrent == 1){ 
                            echo $before . get_the_title() . $after;
                        }
                    }
                }
                else if ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                    if ( is_tax( 'product_cat' ) ) {
                        echo $before . single_cat_title('', false) . $after;					  
                    }
                    else {
                        $post_type = get_post_type_object(get_post_type());
                        echo $before . $post_type->labels->singular_name . $after;
                    }
                }
                else if ( is_attachment() ) {
                    $parent = get_post($post->post_parent);
                    $cat 	= get_the_category($parent->ID); $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
                    if ($showCurrent == 1) {
                        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                    }
                }
                else if ( is_page() && !$post->post_parent ) {
                    if ($showCurrent == 1){
                        echo $before . get_the_title() . $after;
                    }
                }
                else if ( is_page() && $post->post_parent ) {
                    $parent_id  	= $post->post_parent;
                    $breadcrumbs 	= array();
                    while ($parent_id) {
                        $page 			= get_page($parent_id);
                        $breadcrumbs[] 	= '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                        $parent_id  	= $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        echo $breadcrumbs[$i];
                        if ($i != count($breadcrumbs)-1){
                            echo ' ' . $delimiter . ' ';
                        }
                    }
                    if ($showCurrent == 1){
                        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                    }
                }
                else if ( is_tag() ) {
                    echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
                }
                else if ( is_author() ) {
                    global $author;
                    $userdata = get_userdata($author);
                    echo $before . 'Articles posted by ' . $userdata->display_name . $after;
                }
                else if ( is_404() ) {
                    echo $before . 'Error 404' . $after;
                }
                if ( get_query_var('paged') ) {
                    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ){ 
                        echo ' (';
                    }
                    echo __('Page', 'electoreftech') . ' ' . get_query_var('paged');
                    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
                        echo ')';
                    }
                }
                echo '</ul>';
            }
 

	}
}


if ( ! function_exists( 'electoreftech_pagination' ) ) {
    function electoreftech_pagination( $echo = true ) {
        global $wp_query;

        $big = 999999999; // need an unlikely integer

        $pages = paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'type'  => 'array',
                'prev_next'   => true,
                'prev_text'    => __('« Prev'),
                'next_text'    => __('Next »'),
            )
        );

        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

            $pagination = '<ul class="pagination">';

            foreach ( $pages as $page ) {
                $pagination .= "<li>$page</li>";
            }

            $pagination .= '</ul>';

            if ( $echo ) {
                echo $pagination;
            } else {
                return $pagination;
            }
        }
    }
}

/*Contact form 7 remove span*/
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    $content = str_replace('<br />', '', $content);
        
    return $content;
});

if ( ! function_exists( 'electoreftech_price' ) ) {
	function electoreftech_price($price = '') {
        $price_format = '';
        if(!empty($price )){
            $price_format = 'NRs '.number_format($price ,2);
        }

        return $price_format;
    }
}

if ( ! function_exists( 'electoreftech_product_price' ) ) {
	function electoreftech_product_price($post_id) {
        $price_format = '';
        $product_price = get_post_meta($post_id, 'product_price', true);
        $product_sale_price = get_post_meta($post_id, 'product_sale_price', true);
        
        if(!empty($product_sale_price )){
            $price_format .= '<div class="PriceName">';
            $price_format .= 'NRs '.number_format($product_sale_price ,2);
            $price_format .= '<strike>NRs '.number_format($product_price ,2) .'</strike>';
            $price_format .= '</div>';
        } else{
            $price_format .= '<div class="PriceName">';
            $price_format .= ' NRs '.number_format($product_price ,2);
            $price_format .= '</div>';
        }


        return $price_format;
    }
}

/* Upload Galleries
............................ */

if ( ! function_exists( 'electro_filter_product' ) ) {
    function electro_filter_product(){
        $response_arr = [];
        $content = '';
        $record_count = '';
        $tax_query_meta = [];
        $meta_query = [];

        $paged = $_POST['paged']; 
        if( isset($_POST['opt_mode']) && $_POST['opt_mode'] == 'filter'){
          $paged = 1;
        }

        $args = array(
            'post_type' 	 => 'product',
            'posts_per_page' 	=> $_POST['posts_per_page'],
            'paged' 			=> $paged,
       );

       // sort product 
       if(!empty($_POST['filter_sort_product']) ){
            $filter_sort_product = explode("-",$_POST['filter_sort_product']);
            $args['meta_key'] = $filter_sort_product[0];
            $args['order'] = $filter_sort_product[1];
            $args['orderby'] = 'meta_value_num'; 
       }

       if(isset($_POST['query']) && !empty($_POST['query'])){
        $args['s'] = $_POST['query'];
      }

        // Taxonomies for product category
        if(!empty($_POST['filter_prod_cat']) ){
            $filter_prod_cat_slugs = explode(',',$_POST['filter_prod_cat']);
            $tax_query_meta[] = array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'slug',
                                    'terms'    => $filter_prod_cat_slugs,
                                );
    
        }

        // Taxonomies for product category
        if(!empty($_POST['filter_prod_brand']) ){
            $filter_prod_brand_slugs = explode(',',$_POST['filter_prod_brand']);
            $tax_query_meta[] = array(
                                    'taxonomy' => 'brand',
                                    'field'    => 'slug',
                                    'terms'    => $filter_prod_brand_slugs,
                                );
    
        }

        if($tax_query_meta){
            $args['tax_query'] = array(
                                  'relation' => 'AND',
                                  $tax_query_meta,
                                );
          }
        
        
        // price range
        if(isset($_POST['filter_min_price']) && !empty($_POST['filter_max_price'])){
            $meta_query[] = array(
                                'key' => 'product_price',
                                        'value' => array($_POST['filter_min_price'], $_POST['filter_max_price']),
                                        'type' => 'numeric',
                                        'compare' => 'BETWEEN'
                                );
        }

        if($meta_query){
            $args['meta_query'] =  array(
                                'relation' => 'AND',
                                $meta_query,
                            );
        }
       
      
        //   echo '<pre>';
        //   print_r($args);
        //   echo '</pre>';

       $cabinpost = new WP_Query( $args );
       $total_record = $cabinpost->found_posts;
       $load_more_record = $total_record - $_POST['posts_per_page'] * $paged;
       if($load_more_record <= 0){
         $load_more_record = 0;
       }

       if ( $cabinpost->have_posts() ) {
        $cnt = 0;
        $content .= '<div class="row">';
           
        while ( $cabinpost->have_posts() ) : $cabinpost->the_post();

            $post_id = get_the_ID();
            $cnt++;

            $content .= '<div class="col-md-3 col-sm-6">
            <div class="blog-wrapper mb-30">
                <div class="blog-img product-img-block">
                    <a href="' . get_permalink($post_id) . '">';

                    if ( has_post_thumbnail() ) {
                        $content .= get_the_post_thumbnail();
                    }
                    else {
                        $content .= '<img src="' . get_template_directory_uri() . '/img/no_image.png" />';
                    }

                $product_stock = get_post_meta($post_id, 'product_stock', true);
                if(isset($product_stock ) && $product_stock == 'stock_out'){
                    $content .= '<span class="out-of-stock-badge">Out of stock</span>';
                }

                $content .= '</a>
                </div>
                <div class="blog-text">
                    <div class="blog-info">
                        <h3><a href="' . get_permalink($post_id) . '">'.  get_the_title($post_id) .' </a></h3>
                    </div>
                    <div class="blog-date">' . electoreftech_product_price( $post_id) . '<div class="read-more"><a href="'.  get_permalink($post_id) .'">VIEW MORE</a></div>
                    </div>
                </div>
            </div>
        </div>';

        if($cnt == 4 ){
            $content .= '</div><div class="row">';
        }

        endwhile;

        $content .= '</div>';
     } 

     $record_message = sprintf( esc_html( _n( '%d product match your search criteria', '%d product match your search criteria.', $record_count, 'electoreftech' ) ), $record_count );
     $response_arr['content'] = $content;
     $response_arr['record_count'] = $record_message;
     $response_arr['total_record'] = $total_record. ' Products found.';
     $response_arr['load_more_text'] = __('<i class="fa fa-spinner"></i> Load more', 'electoreftech') . '('.$load_more_record . ')';

       echo json_encode($response_arr);
       exit;

    }
}
add_action( 'wp_ajax_electro_filter_product', 'electro_filter_product');
add_action( 'wp_ajax_nopriv_electro_filter_product', 'electro_filter_product');


/* Share the post */
if( !function_exists( 'electroref_sharethis_nav' ) ){
    function electroref_sharethis_nav($post_id){
      global $wpdb;
      $content = '';
          $share_img 		= '';
          $share_title 	= get_the_title( $post_id );
          $share_url 		= get_permalink( $post_id );
          $hytte_post 	= get_post( $post_id );
          $share_txt 		= wp_trim_words( strip_tags($hytte_post->post_content), 40, '' );
          if (has_post_thumbnail( $post_id ) ):
              $image 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
              $share_img 	= $image[0];
      endif;
  
      $content .= '<div class="share_this_post">';
      $content .= '<ul class="nav navbar navbar-left d-flex d-inline-flex">';
      $content .= '<li class="label read-more"><a href="javascript:void(null);"><i class="fa fa-share-alt"></i> '. __('Share', 'hytteguiden').'</a></li>';
      $content .= '<li class="facebook-bg read-more"><a href="javascript:void(null);" class="facebook" onClick = "fb_callout(&quot;'.$share_url.'&quot;, &quot;'.$share_img.'&quot;, &quot;'.$share_title.'&quot;, &quot;'.$share_txt.'&quot;);"><span class="share-icons face-book"><i class="fa fa-facebook"></i></span> Share</a></li>';
      $content .= '<li class="tweeter-bg read-more"><a href="javascript:void(null);" class="twitter" onClick ="share_on_twitter(&quot;'.$share_url.'&quot;, &quot;'.$share_title.'&quot;);"><span class="share-icons twitter"><i class="fa fa-twitter"></i></span> Tweet</a></li>';
     
      $content .= '<li class="pin-bg read-more"><a href="javascript:void(null);" class="pin" onClick = "pin_it_now(&quot;'.$share_url.'&quot;, &quot;'.$share_img.'&quot;, &quot;'.$share_title.'&quot;);"><span class="share-icons google"><i class="fa fa-pinterest"></i></span> Pin it</a></li>';
      $content .= '</ul></div><div class="clearfix"></div>';
  
      return $content;
      
    }
  }
  
add_filter('manage_product_posts_columns', 'product_columns', 5, 2);
add_action('manage_product_posts_custom_column', 'product_custom_columns', 10, 2);
 
function product_columns($columns){
    
     $temp['cb'] = 'cb';
     $temp['featured_image'] = 'Images';
     $columns = array_merge($temp,$columns);;

    return $columns; 
}
 
function product_custom_columns($column_name, $id){
    if($column_name == 'featured_image'){
        echo the_post_thumbnail( 'thumbnail' );
    }
}

function hytteguiden_admin_script() {
    	wp_enqueue_style( 'electro_admin_style', get_template_directory_uri() . '/admin/assets/css/admin_style.css', array(), '1.9' );


}
add_action( 'admin_enqueue_scripts', 'hytteguiden_admin_script' );
?>