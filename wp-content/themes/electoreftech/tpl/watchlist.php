<?php 
/* Template Name: Watchlist
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

<section id="main-body" class="product-page">
	<div class="container">
        <?php
            $watchlist_posts = [];
            $watchlist_total = electoreftech_watch_total();	

            if($watchlist_total > 0 ) {

                $guest_id = electoreftech_guest_id();
                if(is_user_logged_in()){
                    $current_user = wp_get_current_user();
                    $cond_cnt = ' AND ( user_id ='. $current_user->ID . ' OR guest_id = "'. $guest_id . '")';  
                  }else {
                    $cond_cnt = ' AND guest_id = "'. $guest_id . '"'; 
                }

                $result = electoreftech_all_data('wishlist', $cond_cnt);

                if($result){
                    foreach($result as $w){
                        $watchlist_posts[] = $w->post_id;  
                    }
                }
                
                $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'product',
                    'post__in' => $watchlist_posts ,
                );


                $wp_query = new WP_Query( $args );
                $total_record = $wp_query->found_posts;

                if( $wp_query->have_posts() ) {
                        $cnt = 0;
                        echo '<div class="row">';
                        while ( $wp_query->have_posts() ) : $wp_query->the_post();
                        $post_id = get_the_ID();
                        $cnt++;
                        get_template_part(
                            'template-parts/product/product',
                            'grid',
                            array(
                                'post_id' => $post_id,
                            )
                        );
                
                if($cnt == 4 ){
                    echo '</div><div class="row">';
                }
                                endwhile;
                
                ?>
                
                
                <?php
                    echo '</div>';
                }
                
                wp_reset_query();
            } else {
                _e( "<p>You haven't saved any product yet!</p>", 'electoreftech' );
            }
            ?>
	</div>
</section      


<?php 
endwhile; // End of the loop.
get_footer();
