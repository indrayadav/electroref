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
                        echo $before . $cats . $after;
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
            $price_format = 'NPR '.number_format($price ,2);
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
            $price_format .= '<div class="priceproddel" itemprop="offers" itemtype="http://schema.org/Offer" itemscope>';
            $price_format .= 'NPR '.number_format($product_sale_price ,2);
            $price_format .= '<span>NPR '.number_format($product_price ,2) .'</span>';
            $price_format .= '<meta itemprop="price" content="'. str_replace( ',', '', number_format($product_price ,2) ) .'" />';
            $price_format .= '<link itemprop="url" href="'. get_permalink($post_id).'" />
            <meta itemprop="availability" content="https://schema.org/InStock" />
            <meta itemprop="priceCurrency" content="NPR" />
            <meta itemprop="priceValidUntil" content="2021-11-20" />';
            $price_format .= '</div>';
        } else{
            $price_format .= '<div class="priceproddel" itemprop="offers" itemtype="http://schema.org/Offer" itemscope>';
            $price_format .= 'NPR '.number_format($product_price ,2);
            $price_format .= '<meta itemprop="price" content="'. str_replace( ',', '', number_format($product_price ,2)) .'" />';
            $price_format .= '<link itemprop="url" href="'. get_permalink($post_id).'" />
              <meta itemprop="availability" content="https://schema.org/InStock" />
              <meta itemprop="priceCurrency" content="NPR" />
              <meta itemprop="priceValidUntil" content="2021-11-20" />';
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
            $args['meta_type'] = 'NUMERIC';
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
       
      
          // echo '<pre>';
          // print_r($args);
          // echo '</pre>';

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

            $content .= '<div class="col-12 col-md-6 col-lg-3">
            <div class="pharprodbox">
                <div class="pharprodimg"> <a href="'. get_permalink($post_id) .'">';
            
            if ( has_post_thumbnail() ) {
                $content .= get_the_post_thumbnail($post_id, 'thumbnail', [ 'class' => 'img-fluid'] );
            }
            else {
                $content .=  '<img src="' . get_template_directory_uri() . '/img/no_image.png"  class="img-fluid" />';
            }
                
            $content .= '</a> </div>
                <div class="pharprodesc">
                    <h4><a href="'. get_permalink($post_id) .'">'. get_the_title($post_id) .'</a></h4>';
            $content .=  electoreftech_product_rating($post_id);
            $content .=  electoreftech_product_price($post_id);
            $content .=  electoreftech_watchcompare($post_id);
                   
            $content .= '</div>
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
  

     
      $content .= '<li><a href="javascript:void(null);" class="facebookshare" onClick = "fb_callout(&quot;'.$share_url.'&quot;, &quot;'.$share_img.'&quot;, &quot;'.$share_title.'&quot;, &quot;'.$share_txt.'&quot;);"><span class="share-icons face-book"><i class="fa fa-facebook"></i></span> Share</a></li>';
      $content .= '<li><a href="javascript:void(null);" class="tweetshare" onClick ="share_on_twitter(&quot;'.$share_url.'&quot;, &quot;'.$share_title.'&quot;);"><span class="share-icons twitter"><i class="fa fa-twitter"></i></span> Tweet</a></li>';
     
      $content .= '<li><a href="javascript:void(null);" class="pinshare" onClick = "pin_it_now(&quot;'.$share_url.'&quot;, &quot;'.$share_img.'&quot;, &quot;'.$share_title.'&quot;);"><span class="share-icons google"><i class="fa fa-pinterest"></i></span> Pin it</a></li>';

  
      return $content;
      
    }
  }
  
add_filter('manage_product_posts_columns', 'product_columns', 5, 2);
add_action('manage_product_posts_custom_column', 'product_custom_columns', 10, 2);
 
function product_columns($columns){
    
     $temp['cb'] = 'cb';
     $temp['featured_image'] = 'Images';
     $temp['title'] = 'Title';
     $temp['post_views_count'] = 'Views';
     $columns = array_merge($temp,$columns);;

    return $columns; 
}
 
function product_custom_columns($column_name, $id){
    if($column_name == 'featured_image'){
        echo the_post_thumbnail( 'thumbnail' );
    }

    if($column_name == 'post_views_count'){
        echo electoreftech_get_post_view($id). ' times';
    }
}

function hytteguiden_admin_script() {
    	wp_enqueue_style( 'electro_admin_style', get_template_directory_uri() . '/admin/assets/css/admin_style.css', array(), '1.9' );


}
add_action( 'admin_enqueue_scripts', 'hytteguiden_admin_script' );

/* Product rating 
----------------------- */
if ( ! function_exists( 'electoreftech_product_rating' ) ) {
	function electoreftech_product_rating($post_id) {
        $content = '';
        return '';

        $content .= '<div class="prodrating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
        <ul>  <span style="display:none;" itemprop="ratingValue">5</span>
              <span style="display:none;"  itemprop="ratingCount">123</span>
            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
        </ul>
    </div>';

    return $content;
    }
}

/* Product Offer Tag 
----------------------- */ 
if ( ! function_exists( 'electoreftech_product_offer_tag' ) ) {
	function electoreftech_product_offer_tag($post_id) {
        $content = '';
        $product_offer_tag = get_post_meta($post_id, 'product_offer_tag', true);

        if(isset($product_offer_tag) && !empty($product_offer_tag)){
            $product_offer_start_date = get_post_meta($post_id, 'product_offer_start_date', true);
            $product_offer_end_date = get_post_meta($post_id, 'product_offer_end_date', true);

            $stratDate = date('Y-m-d', strtotime($product_offer_start_date));
            $endDate = date('Y-m-d', strtotime($product_offer_end_date));


            if ((date('Y-m-d', time()) >= $stratDate) && (date('Y-m-d', time()) <= $endDate)){
                $content .= '<span class="productsale">'. $product_offer_tag.'</span>';
            }

        }

        
        return $content;
    }
}

function electoreftech_get_post_view($post_id) {
    $count = get_post_meta( $post_id, 'post_views_count', true );
    if(empty($count)){ $count = 0; }
    return "$count";
}
function electoreftech_set_post_view($post_id) {
    $key = 'post_views_count';
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}

  /* Get rating star from number */

    function electoreftech_get_product_brand($post_id) { 
      $content = ''; 
     $terms = get_the_terms( $post_id, 'brand' );
      if ( $terms && ! is_wp_error( $terms ) ) : 

        $brands = array();
        foreach ( $terms as $term ) {
          $brands[] = $term->name;
        }
                   
        $content = join( ", ", $brands );
      endif;
  
      return $content; 
    } 


/* Electtrroref General functions
===========================================  */
function electoreftech_record_count( $tbl_name, $cond = '') {
    global $wpdb;
  
    $sql = 'SELECT COUNT(*) FROM ' . $wpdb->prefix . $tbl_name . ' WHERE 1= 1'; 
    if($cond != '' ){
        $sql .= $cond;
    }

    return $wpdb->get_var( $sql );
}

function electoreftech_delete_cond_data( $tbl_name, $cond = '') {
    global $wpdb;

    $sql = 'delete from ' . $wpdb->prefix . $tbl_name .  ' WHERE 1= 1'; 

    if($cond != '' ){
        $sql .= $cond;
    }
    $wpdb->query($sql);
}

function electoreftech_all_data( $tbl_name, $cond = '', $per_page = 5, $page_number = 1, $orderby = 'id', $order = 'desc' ) {

    global $wpdb;
  
    $sql = 'SELECT * FROM ' . $wpdb->prefix . $tbl_name . ' WHERE 1= 1';  
    
    if($cond != '' ){
        $sql .= $cond;
    }
  
    $sql .= ' ORDER BY ' .$orderby;
    $sql .= ' '.$order;  
    $sql .= " LIMIT $per_page";
  
    $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;      
    $result = $wpdb->get_results( $sql );
  
    return $result;
  }

  function electoreftech_delete_record( $tbl_name, $pk_field = 'id', $pk_val = '') {
    global $wpdb;
  
    $sql = 'delete from ' . $wpdb->prefix . $tbl_name . ' WHERE '. $pk_field.'= '. $pk_val; 
    $wpdb->query($sql);
  }

  function electoreftech_update_field( $tbl_name, $update_field, $update_val, $pk_field = 'id', $pk_val = '') {
    global $wpdb;
  
    $sql = 'update ' . $wpdb->prefix . $tbl_name . ' SET '. $update_field.' = "'. $update_val .'" WHERE '. $pk_field.'= '. $pk_val; 
    $wpdb->query($sql);
  }

/* Electtrroref Theme activation hook
................................................. */

if ( ! function_exists( 'electoreftech_create_dynamic_table' ) ) {
	function electoreftech_create_dynamic_table() {
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $sql_wishlist = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."wishlist` ( `id` bigint(20) not null auto_increment,
     `post_id` int(10) not null,
     `user_id` varchar(100) not null,
     `guest_id` varchar(30) not null, 
     `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY  (`id`));";

    dbDelta($sql_wishlist);

    $sql_compare = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."compare` ( `id` bigint(20) not null auto_increment,
    `post_id` int(10) not null,
    `user_id` varchar(100) not null,
    `guest_id` varchar(30) not null, 
    `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY  (`id`));";

   dbDelta($sql_compare);

   $sql_reviews = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."reviews` ( `id` bigint(20) not null auto_increment,
   `post_id` int(10) not null,
   `user_id` varchar(100) not null,
   `rating` varchar(30) not null, 
   `review` text,
   `status` ENUM('Pending', 'Published'),
   `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY  (`id`));";

  dbDelta($sql_reviews);

  $sql_request_quote = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."request_quotes` ( `id` bigint(20) not null auto_increment,
  `post_id` int(11) not null,
  `cust_name` varchar(100) not null,
  `cust_email` varchar(130) not null, 
  `cust_phone` varchar(130) not null, 
  `cust_msg` text,
  `status` ENUM('Requested', 'Sent'),
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY  (`id`));";

 dbDelta($sql_request_quote);

     // Main Categgories
     $sql_main_categories = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."main_categories` ( `id` bigint(20) not null auto_increment, 
     `title` varchar(240) not null,
     `term_ids` text,
     `item_order` int(11), PRIMARY KEY  (`id`));";
 
     dbDelta($sql_main_categories);

    }
}
add_action('after_switch_theme', 'electoreftech_create_dynamic_table');


/* Electoreftech Theme initialization 
................................................. */
/* Random Key Generate */
if ( ! function_exists( 'electoreftech_random_keygen' ) ) {
    function electoreftech_random_keygen($n = 20) { 
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
      $randomString = ''; 
  
      for ($i = 0; $i < $n; $i++) { 
          $index = rand(0, strlen($characters) - 1); 
          $randomString .= $characters[$index]; 
      } 
  
      return $randomString; 
    } 
  }

function electoreftech_guest_id() {
    $content = '';
    if(!isset($_COOKIE['guest_auth_token'])) {
      $user_auth =  electoreftech_random_keygen();
      setcookie( 'guest_auth_token', $user_auth, time() + 78436438, '/' );
      $content = $user_auth;
    } else{
      $content = $_COOKIE['guest_auth_token'];
    }
  
    return $content;
  }

if ( ! function_exists( 'electoreftech_init' ) ) {
    function electoreftech_init( ) {
      electoreftech_guest_id();
    }
  }
  
  add_action( 'init', 'electoreftech_init' );


/* Electtrroref Wishlist functions
===========================================  */

if ( ! function_exists( 'electoreftech_watch_total' ) ) {
	function electoreftech_watch_total() {
        $guest_id = electoreftech_guest_id();
        if(is_user_logged_in()){
            $current_user = wp_get_current_user();  
            $insert_data['user_id'] = $current_user->ID;
            $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
            $cond_cnt = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';  
          }else {
            $cond .= ' AND guest_id = "'. $guest_id . '"'; 
            $cond_cnt = ' AND guest_id = "'. $guest_id . '"'; 
        }

        $total_records = electoreftech_record_count('wishlist', $cond); 
        return $total_records;

    }
}

if ( ! function_exists( 'electoreftech_watchcompare' ) ) {
	function electoreftech_watchcompare($post_id) {
        $content = '';
        $content .= '<div class="addtocompare"><ul><li><div class="wishcompareicon">';
        $content .= '<input type="hidden" class="post_id" value="'. $post_id .'" >';
        $content .= '<span><a href="javascript:void(null)" class="comparelist" title="Compare">'. electoreftech_compare_status($post_id) .'</a></span>';
        $content .= '<span><a href="javascript:void(null)" class="watchlist" title="Watchlist">'. electoreftech_wishlist_status($post_id) .'</a></span>';
        $content .= '</div></li> </ul> </div>';

        return $content;
    }
}

if ( ! function_exists( 'electoreftech_save_wishlist' ) ) {
    function electoreftech_save_wishlist() {
      global $wpdb;
      $response_arr 	= array();
      $theme_path = get_template_directory_uri();
  
      $cond = ' AND post_id = '. $_POST['post_id'];   
      $guest_id = electoreftech_guest_id();
  
      $insert_data =  array(
        'guest_id' => $guest_id,
        'post_id' => $_POST['post_id'],
      );
  
      if(is_user_logged_in()){
        $current_user = wp_get_current_user();  
        $insert_data['user_id'] = $current_user->ID;
        $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
        $cond_cnt = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';  
      }else {
        $cond .= ' AND guest_id = "'. $guest_id . '"'; 
        $cond_cnt = ' AND guest_id = "'. $guest_id . '"'; 
      }
  
    
      $total_records = electoreftech_record_count('wishlist', $cond);     
  
      if($total_records > 0){
        electoreftech_delete_cond_data( 'wishlist', $cond);
        
        $response_arr['txt'] = __(' Save to watchlist', 'electoreftech');
        $response_arr['message'] = __('<i class="fa fa-heart-o" aria-hidden="true"></i>', 'electoreftech');
      }else{
  
        $wpdb->insert($wpdb->prefix.'wishlist', $insert_data );
        $response_arr['txt'] = __(' Remove from watchlist', 'electoreftech'); 
        $response_arr['message'] = __('<i class="fa fa-heartbeat" aria-hidden="true"></i>', 'electoreftech');
      }
      $total_records = electoreftech_record_count('wishlist', $cond_cnt); 
      $response_arr['my_total_wishlist'] = $total_records;
  
      echo json_encode($response_arr);
      exit;
      
    }
  }
  
  add_action( 'wp_ajax_electoreftech_save_wishlist', 'electoreftech_save_wishlist');
  add_action( 'wp_ajax_nopriv_electoreftech_save_wishlist', 'electoreftech_save_wishlist');

  /*  Get wishlist status */
  if ( ! function_exists( 'electoreftech_wishlist_status' ) ) {
    function electoreftech_wishlist_status($post_id, $page = '') {
      global $wpdb;
      $content = '';
      $theme_path = get_template_directory_uri();
  
      $cond = ' AND post_id = '. $post_id;   
      $guest_id = electoreftech_guest_id();
  
      if(is_user_logged_in()){
        $current_user = wp_get_current_user();  
        $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
      }else {
        $cond .= ' AND guest_id = "'. $guest_id . '"'; 
      }
  
      $total_records = electoreftech_record_count('wishlist', $cond);  
      if($total_records > 0){  
        $txt =   __(' Remove from watchlist', 'electoreftech');      
        $content = __('<i class="fa fa-heartbeat" aria-hidden="true"></i>', 'electoreftech');
      } else {
        $txt =   __(' Save to watchlist', 'electoreftech'); 
        $content = __('<i class="fa fa-heart-o" aria-hidden="true"></i>', 'electoreftech');
      }  

      if(!empty($page)){
        $content .= $txt;
      }
  
      return $content;
    }
  }

  /* Electtrroref Compare List functions
===========================================  */

if ( ! function_exists( 'electoreftech_compare_total' ) ) {
	function electoreftech_compare_total() {
        $guest_id = electoreftech_guest_id();
        if(is_user_logged_in()){
            $current_user = wp_get_current_user();  
            $insert_data['user_id'] = $current_user->ID;
            $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
            $cond_cnt = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';  
          }else {
            $cond .= ' AND guest_id = "'. $guest_id . '"'; 
            $cond_cnt = ' AND guest_id = "'. $guest_id . '"'; 
        }

        $total_records = electoreftech_record_count('compare', $cond); 
        return $total_records;

    }
}

  /*  Get wishlist status */
  if ( ! function_exists( 'electoreftech_compare_status' ) ) {
    function electoreftech_compare_status($post_id, $page = '') {
      global $wpdb;
      $content = '';
  
      $cond = ' AND post_id = '. $post_id;   
      $guest_id = electoreftech_guest_id();
  
      if(is_user_logged_in()){
        $current_user = wp_get_current_user();  
        $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
      }else {
        $cond .= ' AND guest_id = "'. $guest_id . '"'; 
      }
  
      $total_records = electoreftech_record_count('compare', $cond);  
      if($total_records > 0){  
        $txt =   __(' Remove from compare list', 'electoreftech');      
        $content = __('<i class="fa fa-hourglass-start" aria-hidden="true"></i>', 'electoreftech');
      } else {
        $txt =   __(' Save to compare list', 'electoreftech'); 
        $content = __('<i class="fa fa-balance-scale" aria-hidden="true"></i>', 'electoreftech');
      }  

      if(!empty($page)){
        $content .= $txt;
      }
  
      return $content;
    }
  }

  if ( ! function_exists( 'electoreftech_save_comparelist' ) ) {
    function electoreftech_save_comparelist() {
      global $wpdb;
      $response_arr 	= array();
      $theme_path = get_template_directory_uri();
  
      $cond = ' AND post_id = '. $_POST['post_id'];   
      $guest_id = electoreftech_guest_id();
  
      $insert_data =  array(
        'guest_id' => $guest_id,
        'post_id' => $_POST['post_id'],
      );
  
      if(is_user_logged_in()){
        $current_user = wp_get_current_user();  
        $insert_data['user_id'] = $current_user->ID;
        $cond .= ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';   
        $cond_cnt = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';  
      }else {
        $cond .= ' AND guest_id = "'. $guest_id . '"'; 
        $cond_cnt = ' AND guest_id = "'. $guest_id . '"'; 
      }
  
    
      $total_records = electoreftech_record_count('compare', $cond);     
  
      if($total_records > 0){
        electoreftech_delete_cond_data( 'compare', $cond);
        
        $response_arr['txt'] = __(' Save to compare', 'electoreftech');
        $response_arr['message'] = __('<i class="fa fa-balance-scale" aria-hidden="true"></i>', 'electoreftech');
      }else{
  
        $wpdb->insert($wpdb->prefix.'compare', $insert_data );
        $response_arr['txt'] = __(' Remove from compare', 'electoreftech'); 
        $response_arr['message'] = __('<i class="fa fa-hourglass-start" aria-hidden="true"></i>', 'electoreftech');
      }
      $total_records = electoreftech_record_count('compare', $cond_cnt); 
      $response_arr['my_total_compare'] = $total_records;
  
      echo json_encode($response_arr);
      exit;
      
    }
  }
  
  add_action( 'wp_ajax_electoreftech_save_comparelist', 'electoreftech_save_comparelist');
  add_action( 'wp_ajax_nopriv_electoreftech_save_comparelist', 'electoreftech_save_comparelist');


  /* Add review ---------------------------*/
  if ( ! function_exists( 'electoreftech_save_review' ) ) {
    function electoreftech_save_review() {
      global $wpdb;
      $response_arr 	= array();
      $response_arr['msg'] = __("Your review hasn't been posted, Please try later!.", 'electoreftech');

      if(is_user_logged_in()){
        $current_user = wp_get_current_user(); 

        $insert_data =  array(
          'review' => $_POST['review'],
          'post_id' => $_POST['post_id'],
          'rating' => $_POST['post_rating'],
          'status' => 'Pending',
          'user_id' => $current_user->ID,
         );

        $wpdb->insert($wpdb->prefix.'reviews', $insert_data );

        $response_arr['msg'] = __('Your review has been posted, we will shortly verify to publish it.', 'electoreftech');
      }

      echo json_encode($response_arr);
      exit;

    }
  }
  add_action( 'wp_ajax_electoreftech_save_review', 'electoreftech_save_review');
  add_action( 'wp_ajax_nopriv_electoreftech_save_review', 'electoreftech_save_review');

  /* Get rating star from number */
if ( ! function_exists( 'electoreftech_rating_star' ) ) {
  function electoreftech_rating_star($n = 5) { 
    $content = '<div class="ratingwrap">'; 

    for ($i = 1; $i <= 5; $i++) { 
      $rating_class = ($i <= $n ? 'fa fa-star' : 'fa fa-star-o');
      $content .= '<span><a href="#"><i class="'.$rating_class .'" aria-hidden="true"></i></a></span>';
    } 

    $content .= '</div>';

    return $content; 
  } 
}

  /* Request Quote ---------------------------*/
  if ( ! function_exists( 'electoreftech_request_quote' ) ) {
    function electoreftech_request_quote() {
      global $wpdb;
      $error = [];
      $valid_email;
      $response_arr 	= array('status' => 'error');      

      if(!($_POST['cust_name']) || empty($_POST['cust_name'])){
        $error[] = 'Name';
      }
      if(!($_POST['cust_email']) || empty($_POST['cust_email'])){
        $error[] = 'Email';
      }

      if (!filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL)) {
        $valid_email = ' Email must be valid.';
      }

      if(!($_POST['cust_phone']) || empty($_POST['cust_phone'])){
        $error[] = 'Phone';
      }

      if(!($_POST['cust_msg']) || empty($_POST['cust_msg'])){
        $error[] = 'Message';
      }

      if(!empty($error)){
        $response_arr['msg'] = implode(", ",$error) . " must be filled out." . $valid_email;
      } else {

        $insert_data =  array(
          'cust_name' => $_POST['cust_name'],
          'cust_email' => $_POST['cust_email'],
          'cust_phone' => $_POST['cust_phone'],
          'post_id' => $_POST['product_id'],
          'cust_msg' => $_POST['cust_msg'],
          'status' => 'Requested',
         );

        $wpdb->insert($wpdb->prefix.'request_quotes', $insert_data );

        $response_arr['status'] = 'success';
        $response_arr['msg'] = __('Your request has been posted, we will shortly reply you.', 'electoreftech');
      }

      echo json_encode($response_arr);
      exit;

    }
  }
  add_action( 'wp_ajax_electoreftech_request_quote', 'electoreftech_request_quote');
  add_action( 'wp_ajax_nopriv_electoreftech_request_quote', 'electoreftech_request_quote');
?>