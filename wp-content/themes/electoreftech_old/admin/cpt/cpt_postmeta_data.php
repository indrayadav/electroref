<?php 
/* Event =>  list with all bets on the event 
-------------------------------------------------*/
function event_meta_boxes_bet_list(){
  add_meta_box('event_bet_list_id','Event Bet','event_bet_list_box','event','normal','low');	
}

function event_bet_list_box($post){
  global $wpdb;
  $post_id = $post->ID;
  wp_nonce_field( plugin_basename(__FILE__), 'gamf_event_bet_noncename' );

  $sql = 'SELECT * FROM ' . $wpdb->prefix . 'responses WHERE 1= 1 and event_id = '. $post_id;

  $result = $wpdb->get_results($sql);

  if($result){
    $count = 1;
  ?>
  <div style="width:100%;">
  <table class="gamf-pm-box">
    <thead>
        <tr>
            <th width="6%">#</th>
            <th><?php  _e('Navn', 'gamf') ?></th>
            <th><?php  _e('Begivenhet', 'gamf') ?></th>
            <th><?php  _e('Svar', 'gamf') ?></th>
            <th><?php  _e('poeng scoret', 'gamf') ?></th>
            <th><?php  _e('Riktig?', 'gamf') ?></th>
            <th><?php  _e('Dato', 'gamf') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($result as $entry ) {

              $class = ($count%2 == 1 ? 'class="alternate "' : ''); 
              $selected_option = array(
                'name' => '',
                'point' => '0',
                'correct' => '0',
            );  
            if($entry->selected_option){
              $selected_option = maybe_unserialize( $entry->selected_option );
            }
          ?>
        <tr <?php echo $class; ?>>

            <td><?php echo $count;  ?></td>
            <td><?php
              $user_info = get_userdata($entry->user_id);
              echo $user_info->user_login; ?> </td>
            <td><?php echo get_the_title($entry->event_id); ?></td>                            
            <td><?php echo $selected_option['name']; ?></td>  
            <td><?php echo $selected_option['point']; ?></td>  
            <td><?php  
            $correct = '__';
            if($selected_option['correct'] == '1'){
              $correct = '<img src="'. GAMF_URL . '/assets/images/icons/correct.png">';
            } 
            echo $correct; ?></td>  
            <td><?php echo  date("j M, Y", strtotime($entry->response_date) ); ?></td>  
        </tr>

         <?php  
        $count++;   

    }
    ?></tbody>
    </table>
  </div>
  <?php 
  }
}

add_action('add_meta_boxes','event_meta_boxes_bet_list');

?>