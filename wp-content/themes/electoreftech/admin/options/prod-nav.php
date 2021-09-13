<?php
$active_page = 'gdmp';
	if($_REQUEST['page'] && !empty($_REQUEST['page']) ){
		$active_page = $_REQUEST['page'];
	}

$gdmp_admin_nav = array(
					array(
						'nav_text' => __('Product Reviews', 'earnest'),
						'nav_link' => admin_url( 'admin.php?page=electro-product-reviews'),
						'nav_class' => ($active_page == 'electro-product-reviews' ? 'nav-tab  nav-tab-active' : 'nav-tab'),
					),

					array(
						'nav_text' => __('Requested Quotes', 'earnest'),
						'nav_link' => admin_url( 'admin.php?page=requested-quote'),
						'nav_class' => ($active_page == 'requested-quote' ? 'nav-tab  nav-tab-active' : 'nav-tab'),
					),



			);

			if($gdmp_admin_nav){
					echo '<h2 class="nav-tab-wrapper">';
				foreach ($gdmp_admin_nav as $admin_nav) {

						echo '<a href="'.$admin_nav['nav_link'].'" class="'.$admin_nav['nav_class'].'">'.$admin_nav['nav_text'].'</a>';
				}
				echo '</h2>';
			}

?>