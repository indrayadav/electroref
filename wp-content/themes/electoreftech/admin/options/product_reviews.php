<?php
global $wpdb;
$per_page = 10;
$page_number = 1;
$cond = ''; 
$msg = '';


if ( ! empty( $_REQUEST['page_number'] ) ) {
    $page_number = $_REQUEST['page_number'];
 }


$page_cond = '';
$page = isset($_REQUEST['page'])?$_REQUEST['page']:'';
$mode = isset($_REQUEST['mode'])?$_REQUEST['mode']:'';

if( $mode == 'delete' ){    
  electoreftech_delete_record( 'reviews', 'id', $_REQUEST[pid]);
  $msg = __('Rrecord has been deleted.', 'electoreftech');
} 

if( $mode == 'status' ){ 
    $state = 'Published';   
    if($_REQUEST['state'] == 'Published'){
      $state = 'Pending';
    }
  electoreftech_update_field( 'reviews', 'status', $state, 'id', $_REQUEST[pid]);
  $msg = __('State has been updated.', 'electoreftech');
} 

if(isset($_REQUEST['listing_id']) && !empty($_REQUEST['listing_id'])){ 
  $cond .= ' AND post_id = ' . esc_sql( $_REQUEST['listing_id'] );
  $page_cond .= '&post_id='.  esc_sql( $_REQUEST['listing_id'] );
}

if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])){ 
  $cond .= ' AND user_id = ' . esc_sql( $_REQUEST['user_id'] );
  $page_cond .= '&user_id='.  esc_sql( $_REQUEST['user_id'] );
}

$result = electoreftech_all_data( 'reviews', $cond, $per_page, $page_number, 'id', 'desc');

?>

<div id="wpbody" role="main">
  <div id="wrap">
    <div class="wrap">
      <h2><?php _e('Product Reviews', 'earnest'); ?></h2>
    </div>
    <?php
      if(!empty($msg)){
        echo '<div class="wrap"><div id="message" class="updated" style="margin-left:0;">';
        echo '<p>'.$msg.'</p>';
        echo '</div></div>';
      }

      require get_template_directory() . '/admin/options/prod-nav.php';
    ?>

        <div class="wrap">
          <div class="padding-box">
           <div class="data_heading"> 

              <div class="earnest_breadcrumb_wrap" style="float:none;"><ul class="earnest_breadcrumb">
              <?php 
          echo '<li>'. __('Products', 'earnest') . '</li>';
          echo '<li>' . __('Product Reviews', 'earnest') . '</li>';
          
          ?>
           </ul></div>
              <div class="search-box">

                <form class="fs_admin_search" action="" method="get">
                <input type="hidden" id="page" name="page" value="<?php echo $page;?>">

                <select class="gamf_selectbox" name="listing_id">
                  <option value=""><?php _e( 'Any Product', 'gamf' ); ?></option>
                  <?php 
                  global $post;

                  $args = array(
                  'numberposts' => -1,
                  'post_type' => 'product'
                    );
                  
                  $myposts = get_posts( $args );
                  if($myposts){
                      foreach( $myposts as $post ) :
                          setup_postdata($post);
                      
                          echo '<option value="'. $post->ID.'"';

                          if( isset( $_REQUEST['listing_id']) && $_REQUEST['listing_id'] == $post->ID){
                              echo ' selected="selected"';
                          }

                          $trimmed = wp_trim_words( get_the_title($post->ID), 8, $more = null );

                          echo '>'. $trimmed .'</option>';

                      endforeach;
                  }
                  ?>
                  </select>   

                <select class="gamf_selectbox" name="user_id">
                  <option value=""><?php _e( 'All User', 'gamf' ); ?></option>
                  <?php 
                  global $post;

                  $blogusers = get_users( );
                  
                  if($blogusers){
                    foreach ( $blogusers as $user ) {
                      
                          echo '<option value="'. $user->ID.'"';

                          if( isset( $_REQUEST['user_id']) && $_REQUEST['user_id'] == $user->ID){
                              echo ' selected="selected"';
                          }

                          $user_info = get_userdata($user->ID);
                          $username = $user_info->user_login;
                          $user_full_name = $username;
                          if(!empty( $user_info->first_name ) && $user_info->last_name){
                            $user_full_name = $user_info->first_name . ' '. $user_info->last_name .'('. $username . ')';
                          }
                          echo '>'. $user_full_name .'</option>';

                        }
                  }
                  ?>
                  </select>   
                  
                <input type="submit" id="search-submit" class="button button-primary" value="Search">
                </form>

               
              </div>
              <div class="clear"></div>
          </div>

            <table width="100%" class="order_list wp-list-table widefat fixed striped pages">
                    <thead>
                        <tr>
                            <th width="6%">#</th>
                            <th><?php  _e('User', 'earnest') ?></th>
                            <th><?php  _e('Product', 'earnest') ?></th>
                            <th><?php  _e('Reviews', 'earnest') ?></th>
                            <th><?php  _e('Rating', 'earnest') ?></th>
                            <th><?php  _e('Status', 'earnest') ?></th>
                            <th><?php  _e('Date', 'earnest') ?></th>
                            <th><?php  _e('Action', 'earnest') ?></th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php 

                    if( $result ) {
                        $count = ($page_number - 1 ) * $per_page + 1;
                        $class = '';
                            foreach( $result as $entry ) {
                              $class = ($count%2 == 1 ? 'class="alternate "' : ''); 
                            
                            ?> <?php add_ThickBox(); ?>
                            <tr <?php echo $class; ?>>

                            <td><?php echo $count;  ?></td>
                            <td><?php 
                            $user_info = get_userdata($entry->user_id);
                            $username = $user_info->user_login;
                            $user_full_name = $username;
                            if(!empty( $user_info->first_name ) && $user_info->last_name){
                              $user_full_name = $user_info->first_name . ' '. $user_info->last_name .'('. $username . ')';
                            }

                            echo '<a href="'. admin_url( 'user-edit.php?user_id='. $entry->user_id) .'">'. esc_attr( $user_full_name ) .'</a>';

                            ?> </td>
                            <td> <a href="<?php echo get_permalink($entry->post_id);?>" target="_blank">
                            <?php echo get_the_title($entry->post_id); ?> </a> </td>
                            <td><?php echo $entry->review; ?> </td>
                            <td><?php echo $entry->rating; ?> </td>
                            <td><?php 
                            $status_img = ($entry->status == 'Published' ? 'verified.png' : 'unverified.png');
                             ?>
                            <img src="<?php echo get_template_directory_uri()."/admin/assets/img/" . $status_img; ?>">
                             </td>
                            <td><?php echo  date("j M, Y", strtotime($entry->added_date) ); ?></td> 
                            <td>
        <a href="#TB_inline?&width=550&height=400&inlineId=view_detail_<?php echo $count; ?>" class="thickbox" title="View"><img src="<?php echo get_template_directory_uri()."/admin/assets/img/view.png"; ?>"> </a>  
        <a href="<?php echo $_SERVER["PHP_SELF"]?>?page=<?php echo $page;?>&pid=<?php echo $entry->id;?>&mode=status&state=<?php echo $entry->status; ?>" 
        onclick="return confirm('Are you sure to update?')"><img src="<?php echo get_template_directory_uri()."/admin/assets/img/" . $status_img; ?>"> </a> 
        <a href="<?php echo $_SERVER["PHP_SELF"]?>?page=<?php echo $page;?>&pid=<?php echo $entry->id;?>&mode=delete" onclick="return confirm('Are you sure to delete?')"><img src="<?php echo get_template_directory_uri()."/admin/assets/img/delete.png"; ?>"> </a></td>
                            </tr>

                            <div id="view_detail_<?php echo $count; ?>" style="display:none;">
                            
                              <div class="order_list wp-list-table widefat fixed striped ">
                              <p> <strong>Product : </strong><a href="<?php echo get_permalink($entry->post_id);?>" target="_blank">
                            <?php echo get_the_title($entry->post_id); ?> </a> </p> 
                                <p> <strong>Rating : </strong><?php echo $entry->rating; ?>/5 </p> 
                                <p> <strong>Review : </strong><br /><?php echo $entry->review; ?> </p>  
                              </div>
                            </div>

                            <?php $count++;  } 
                        } else { ?>

                        <?php } ?>


                    </tbody>
                <tfoot>
                    <tr>
                           <th width="6%">#</th>
                            <th><?php  _e('User', 'earnest') ?></th>
                            <th><?php  _e('Product', 'earnest') ?></th>
                            <th><?php  _e('Reviews', 'earnest') ?></th>
                            <th><?php  _e('Rating', 'earnest') ?></th>
                            <th><?php  _e('Status', 'earnest') ?></th>
                            <th><?php  _e('Date', 'earnest') ?></th>
                            <th><?php  _e('Action', 'earnest') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <?php  
  
  $total_records = electoreftech_record_count('rental_perfomance', $cond);  
  $total_pages = ceil($total_records / $per_page);  
  $pagLink = "<div class='gamf_pagination'><ul>";  
  for ($i=1; $i<=$total_pages; $i++) {  
               $page_parameters = '?page=' . $page . '&page_number='. $i. $page_cond;
               $pagLink .= "<li";

               if( isset($page_number) && $page_number == $i){
                  $pagLink .= " class='active'";
               }               
               
               $pagLink .= "><a href='" .  $_SERVER["PHP_SELF"] .  $page_parameters ."'>".$i."</a></li>";  
  };  
  echo  $pagLink;
  echo "</ul></div>";  
  ?>

    </div>