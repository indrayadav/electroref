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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Electro-Ref Tech">
    <meta name="author" content="Electro-Ref Tech">

	<?php wp_head(); ?>
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
                                        <span><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></span><span><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></span><span><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></span><span><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></span><span><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></span><span><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-6 d-none d-sm-block">
                            <div class="minicart">
                                <div class="minicartinner">
                                    <div class="carticon">
                                        <a href="#">
                                            <span class="carticoninner">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <span class="cartcount bigcounter">2</span>
                                            </span>
                                            <span class="itemtotal shoppingcarttotal"><span>Rs.100.00</span></span>
                                        </a>
                                    </div>
                                    <div class="cartdropdown">
                                        <div class="minicartitem">
                                            <div class="minicartimg">
                                                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/foodproduct-7.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="cartinfo">
                                                <h5><a href="#">Cream Colored luctus pulvinar</a></h5>
                                                <span class="cartprice"><span class="money">Rs.50.00</span></span>
                                            </div>
                                            <div class="cart_remove">
                                                <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="minicartitem">
                                            <div class="minicartimg">
                                                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/foodproduct-7.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="cartinfo">
                                                <h5><a href="#">Cream Colored luctus pulvinar</a></h5>
                                                <span class="cartprice"><span class="money">Rs.50.00</span></span>
                                            </div>
                                            <div class="cart_remove">
                                                <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="pricecontent">
                                            <div class="carttotalprice">
                                                <span class="label">Total</span>
                                                <span class="value shoppingcarttotal"><span class="money">Rs.100.00</span></span>
                                            </div>
                                        </div>
                                        <div class="mincartcheckout">
                                            <a href="#">CheckOut</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-2 d-none d-sm-block">
                            <div class="loginin"> <a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Login In</a> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search Product -->
            <div class="form-relative">
                <div class="site-search-form">
                    <button class="btn btn-close" id="search-close"><img src="<?php echo get_template_directory_uri(); ?>/img/close.png"></button>
                    <div class="form-search-box">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...">
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
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="products.html">Products</a></li>
                                    <li><a href="#">Brands</a>
                                        <div class="megamenu-panel">
                                            <?php 
                                                $brand1 = [];
                                                $brand2 = [];
                                                $brand3 = [];
                                                $brand4 = [];
                                                $cnt = 0;

                                                $terms = get_terms( array(
                                                    'taxonomy' => 'brand',
                                                    'hide_empty' => true,
                                                ) );
                                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                                    foreach ( $terms as $term ) { 
                                                        $cnt++;
                                                        $brand_data = [
                                                            'name' => $term->name,
                                                            'url' => $brand_url = home_url( '/products-air-conditioner-price-nepal/' ) . '?prod_brand='.  $term->slug,
                                                        ];

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
                                            ?>
                                            <div class="megamenu-lists">
                                                <?php  if($brand1) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($brand1 as $b){
                                                        echo '<li><a href="'. $b['url'] .'">'. $b['name'].'</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 
                                                /* Column 2 
                                                ------------------------- */
                                                if($brand2) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($brand2 as $b){
                                                        echo '<li><a href="'. $b['url'] .'">'. $b['name'].'</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 

                                                /* Column 3 
                                                ------------------------- */
                                                if($brand3) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($brand3 as $b){
                                                        echo '<li><a href="'. $b['url'] .'">'. $b['name'].'</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 

                                                /* Column 4 
                                                ------------------------- */
                                                if($brand4) {
                                                    echo '<ul class="megamenu-list list-col-4">';
                                                    foreach($brand4 as $b){
                                                        echo '<li><a href="'. $b['url'] .'">'. $b['name'].'</a></li>';
                                                    }
                                                    echo '</ul>';
                                                } 
                                                
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>