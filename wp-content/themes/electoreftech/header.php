<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Electoreftech
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "ElectroRefTechnology",
    "url": "https://www.electroreftech.com/",
    "address": "Kupandole, Lalitpur, Nepal",
    "sameAs": [
      "https://www.facebook.com/electroreftech.com",
      "https://twitter.com/home",
      "https://www.linkedin.com/company/t/",
      "https://www.instagram.com/electroreftech/?hl=en"
    ],
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Kupandole, Lalitpur, Nepal",
    "addressRegion": "Bagmati",
    "postalCode": "00977",
    "addressCountry": "NP"
  }
  }
</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Electro-Ref Tech">
    <meta name="author" content="Electro-Ref Tech">
    <meta name="google-site-verification" content="-lp6YNHU26wrKMoU7QXLDKzYXQj1tFe9erCgaXkyORc" />
	<?php wp_head(); ?>
    	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-31914987-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-31914987-3');
</script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <!-- Main Wrapper -->
    <div id="main-book-wrapper">
        <!-- Header -->
        <header id="header" class="header">
            <div class="top-head">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-5 col-lg-4">
                            <div class="top-left">
                                <ul>
                                    <li><i class="fa fa-phone-square" aria-hidden="true"></i>+977-1-5260961</li>
                                    <li class="topsocialicons">
                                        <span><a href="https://www.facebook.com/electroref.tech/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></span>
                                        <span><a href="https://twitter.com/nepal_achouse/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
                                        <span><a href="https://www.youtube.com/channel/UCIXsEn0OD1Pe7l1NX4qpV9A" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></span>
                                        <span><a href="https://www.instagram.com/electroreftech/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></span>
                                        <span><a href="https://www.pinterest.com/electroreftech/" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></span>
                                        <span><a href="https://wa.me/97798841031632" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-6 d-none d-sm-block">
                            <div class="minicart">
                                <div class="minicartinner">
                                      <ul>
                                        <li>     <div class="carticon">
                                        <a href="<?php echo esc_url( home_url( '/compare/' ) ); ?>">
                                            <span class="carticoninner">
                                                <i class="fa fa-balance-scale" aria-hidden="true"></i>
                                                <span class="cartcount bigcounter compare_total"><?php echo electoreftech_compare_total(); ?></span>
                                            </span>
                                        </a>
                                    </div></li>
                                        <li>     <div class="carticon">
                                        <a href="<?php echo esc_url( home_url( '/watchlist/' ) ); ?>">
                                            <span class="carticoninner">
                                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                <span class="cartcount bigcounter watch_total"><?php echo electoreftech_watch_total(); ?></span>
                                            </span>
                                        </a>
                                    </div></li>
                                    </ul>
                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-2 d-none d-sm-block">
                            <div class="loginin">
                              <?php if(is_user_logged_in()){
                                  $current_user = wp_get_current_user();   ?>
                                <a href="javascript:void(null)"><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo $current_user->user_login; ?>!</a> 
                                <?php }  else { ?>  
                                 <a href="<?php echo esc_url( home_url( '/login/' ) ); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i>Login In</a> 
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Product -->
            <div class="form-relative">
                <div class="site-search-form">
                    <button class="btn btn-close" id="search-close"><img src="<?php echo get_template_directory_uri(); ?>/img/close.png"></button>
                    <div class="form-search-box">
                    <form class="navbar-form" action="<?php echo esc_url( home_url( '/products-air-conditioner-price-nepal/' ) ); ?>" method="get" role="search">
                            <div class="input-group">
                                <input type="text" name="query"  class="form-control" placeholder="Search...">
                                <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="header_area">
                <div class="main_header_area animated">
                    <div class="container">
                        <nav id="navigation1" class="navigation">
                            <!-- Logo Area Start -->
                            <div class="nav-header">
                                <div class="logo"><a class="nav-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/electro-ref-techlogo.png" class="img-fluid" alt="Electro-Ref Tech"></a></div>
                                <div class="nav-toggle"></div>
                            </div>
                            <!-- Search panel Start -->
                            <div class="nav-search">
                                <div class="search-icon">
                                    <a href="javascript:void(0)" id="site-spop"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                                <form>
                                    <div class="nav-search-inner">
                                        <input type="search" name="search" placeholder="Search Here">
                                        <input name='max-results' type='hidden' value='6'>
                                    </div>
                                </form>
                            </div>
                            <!-- Main Menus Wrapper -->
                            <div class="nav-menus-wrapper">
                                <div class="navbarmenuleft"><img class="img-fluid" alt="Electroref Tech" src="<?php echo get_template_directory_uri(); ?>/img/electro-ref-techlogo11.png"></div>
                                <ul class="nav-menu align-to-right">
                                    <li><a href="<?php echo esc_url( home_url( '/about-electro-ref-tech-ac-nepal/' ) ); ?>">About</a></li>
                                    <li><a href="<?php echo esc_url( home_url( '/services-repair-maintenance-kathmandu-nepal/' ) ); ?>">Services</a></li>
                                    <li><a href="#">Products</a>
                                    <div class="megamenu-panel">
                                            <?php 
                                                $prod_cat1 = [];
                                                $prod_cat2 = [];
                                                $prod_cat3 = [];
                                                $prod_cat4 = [];
                                                $cnt = 0;

                                                $terms = get_terms( array(
                                                    'taxonomy' => 'product_cat',
                                                    'hide_empty' => true,
                                                ) );
                                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                                    foreach ( $terms as $term ) { 
                                                        $cnt++;
                                                        $prod_cat_data = [
                                                            'name' => $term->name,
                                                            'url' => $brand_url = home_url( '/products-air-conditioner-price-nepal/' ) . '?prod_cat='.  $term->slug,
                                                        ];

                                                        if($cnt == 2){
                                                            $prod_cat2[] = $prod_cat_data;
                                                        } elseif ($cnt == 3){                                                    
                                                            $prod_cat3[] = $prod_cat_data;
                                                        } elseif ($cnt == 4){     
                                                            $prod_cat4[] = $prod_cat_data;
                                                        }else {  
                                                            $prod_cat1[] = $prod_cat_data;
                                                        }


                                                        if($cnt %4 == 0){
                                                            $cnt = 0;
                                                        }
                                                    }
                                                }
                                            ?>
                                            <div class="megamenu-lists">
                                                <?php  if($prod_cat1) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($prod_cat1 as $b){
                                                        echo '<li><a href="'. $b['url'] .'">'. $b['name'].'</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 
                                                /* Column 2 
                                                ------------------------- */
                                                if($prod_cat2) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($prod_cat2 as $b){
                                                        echo '<li><a href="'. $b['url'] .'">'. $b['name'].'</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 

                                                /* Column 3 
                                                ------------------------- */
                                                if($prod_cat3) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($prod_cat3 as $b){
                                                        echo '<li><a href="'. $b['url'] .'">'. $b['name'].'</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 

                                                /* Column 4 
                                                ------------------------- */
                                                if($prod_cat4) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($prod_cat4 as $b){
                                                        echo '<li><a href="'. $b['url'] .'">'. $b['name'].'</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 
                                                
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="#">Brands</a>
                                        <div class="megamenu-panel brandmenupanel">
                                            <?php 
                                                $brand1 = [];
                                                $brand2 = [];
                                                $brand3 = [];
                                                $brand4 = [];
                                                $cnt = 0;

                                                $terms = get_terms( array(
                                                    'taxonomy' => 'brand',
                                                    'hide_empty' => true,
                                                    'parent'   => 0,
                                                ) );
                                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                                    foreach ( $terms as $term ) { 
                                                        $thumb = get_term_meta( $term->term_id, '_product_brand_brand', true );
                                                        $brand_featured = get_term_meta( $term->term_id, '_product_brand_featured', true );
                                                
                                                        if(!empty($brand_featured) && !empty($thumb) && $cnt < 13 ) {
                                                            $cnt++;
                                                            $brand_data = [
                                                                'name' => $term->name,
                                                                'url' => $brand_url = home_url( '/products-air-conditioner-price-nepal/' ) . '?prod_brand='.  $term->slug,
                                                                'thumb' => get_term_meta( $term->term_id, '_product_brand_brand', true ),
                                                            ];
                                                            
                                                        // print_r($brand_data);
                                                            if($cnt == 2){
                                                                $brand2[] = $brand_data;
                                                            } elseif ($cnt == 3){                                                    
                                                                $brand3[] = $brand_data;
                                                            } elseif ($cnt == 4){     
                                                                $brand4[] = $brand_data;
                                                            }else {  
                                                                $brand1[] = $brand_data;
                                                            }


                                                            if($cnt %4 == 0){
                                                                $cnt = 0;
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                            <div class="megamenu-lists">
                                                <?php  if($brand1) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($brand1 as $b){
                                                        echo '<li><a href="'. $b['url'] .'"> <img src="'. $b['thumb'].'" alt="'. $b['name'] .'"> <span>'. $b['name'].'</span></a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 
                                                /* Column 2 
                                                ------------------------- */
                                                if($brand2) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($brand2 as $b){
                                                        echo '<li><a href="'. $b['url'] .'"> <img src="'. $b['thumb'].'" alt="'. $b['name'] .'"> <span>'. $b['name'].'</span></a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 

                                                /* Column 3 
                                                ------------------------- */
                                                if($brand3) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($brand3 as $b){
                                                      echo '<li><a href="'. $b['url'] .'"> <img src="'. $b['thumb'].'" alt="'. $b['name'] .'"> <span>'. $b['name'].'</span></a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 

                                                /* Column 4 
                                                ------------------------- */
                                                if($brand4) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($brand4 as $b){
                                                        echo '<li><a href="'. $b['url'] .'"> <img src="'. $b['thumb'].'" alt="'. $b['name'] .'"> <span>'. $b['name'].'</span></a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 
                                                
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="<?php echo esc_url( home_url( '/blog-nepal/' ) ); ?>">Blog</a></li>
                                    <li><a href="<?php echo home_url( '/contact-electro-ref-tech-nepal/' ); ?>">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>