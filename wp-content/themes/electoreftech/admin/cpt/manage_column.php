<?php
/* Manage column for Event */
function gamf_event_columns( $columns ) {

    $columns = array(
      'cb'                    => $columns['cb'],
      'featured_image'        => __( 'Images', 'gamf' ),
      'title'                 => __( 'Title', 'gamf' ),
      'event_opening_date'    => __( 'Åpningsdato', 'gamf' ),
      'event_close_date_time' => __( 'Lukk dato og tid', 'gamf' ),
      'event_start_time'      => __( 'Starttid', 'gamf' ),
      'event_address'         => __( 'Adresse', 'gamf' ),
      'date'                  => __( 'Date', 'gamf' ),
    );

  return $columns;
}
add_filter( 'manage_event_posts_columns', 'gamf_event_columns' );

function gamf_event_column( $column, $post_id ) {

  // Image column
  if ( 'featured_image' === $column ) {
    echo gamf_post_featured_image($post_id);
  }

    // Event Opening Date
    if ( 'event_opening_date' === $column ) {
       echo gamf_post_meta_value($post_id, 'event_opening_date');
    }

    // Event Closing Date
    if ( 'event_close_date_time' === $column ) {
      echo date("Y-m-d H:i", gamf_post_meta_value($post_id, 'event_close_date_time') );
    }

    // start Time
    if ( 'event_start_time' === $column ) {
       echo gamf_post_meta_value($post_id, 'event_start_time');
    }

    // Event Address
    if ( 'event_address' === $column ) {
      echo gamf_post_meta_value($post_id, 'event_address');
    }
}

add_action( 'manage_event_posts_custom_column', 'gamf_event_column', 10, 2);


/* Manage column for Athletes
-----------------------------------------  */

function gamf_athlete_columns( $columns ) {

  $columns = array(
    'cb'                   => $columns['cb'],
    'featured_image'       => __( 'Images', 'gamf' ),
    'title'                => __( 'Title', 'gamf' ),
    'athlete_firstname'    => __( 'Fornavn', 'gamf' ),
    'athlete_lastname'     => __( 'Etternavn', 'gamf' ),
    'athlete_club_id'      => __( 'Klubb', 'gamf' ),
    'athlete_nation_id'    => __( 'Nasjoner', 'gamf' ),
    'date'                 => __( 'Date', 'gamf' ),
  );

return $columns;
}
add_filter( 'manage_athlete_posts_columns', 'gamf_athlete_columns' );

function gamf_athlete_column( $column, $post_id ) {

  // Image column
  if ( 'featured_image' === $column ) {
    echo gamf_post_featured_image($post_id);
  }

  // First Name
  if ( 'athlete_firstname' === $column ) {
     echo gamf_post_meta_value($post_id, 'athlete_firstname');
  }

  // Last Name
  if ( 'athlete_lastname' === $column ) {
    echo gamf_post_meta_value($post_id, 'athlete_lastname');
  }

  // Club Name
  if ( 'athlete_club_id' === $column ) {
     echo gamf_post_name($post_id, 'athlete_club_id');
  }

  // Nasjoner
  if ( 'athlete_nation_id' === $column ) {
      $athlete_nation_id = get_post_meta($post_id, 'athlete_nation_id', true);
      if(isset($athlete_nation_id) && !empty($athlete_nation_id)){
        echo gamf_nation_name($athlete_nation_id, true);
      } else {
        echo '---';
      }
    
  }
}

add_action( 'manage_athlete_posts_custom_column', 'gamf_athlete_column', 10, 2);

/* Manage column for Clubs
-----------------------------------------  */

function gamf_club_columns( $columns ) {

  $columns = array(
    'cb'                   => $columns['cb'],
    'featured_image'       => __( 'Images', 'gamf' ),
    'title'                => __( 'Title', 'gamf' ),
    'club_nation_id'    => __( 'Nasjoner', 'gamf' ),
    'date'                 => __( 'Date', 'gamf' ),
  );

return $columns;
}
add_filter( 'manage_club_posts_columns', 'gamf_club_columns' );

function gamf_club_column( $column, $post_id ) {

  // Image column
  if ( 'featured_image' === $column ) {
    echo gamf_post_featured_image($post_id);
  }

  // Nasjoner
  if ( 'club_nation_id' === $column ) {
      $club_nation_id = get_post_meta($post_id, 'club_nation_id', true);
      if(isset($club_nation_id) && !empty($club_nation_id)){
        echo gamf_nation_name($club_nation_id, true);
      } else {
        echo '---';
      }
    
  }
}

add_action( 'manage_club_posts_custom_column', 'gamf_club_column', 10, 2);

/* Manage column for Arrangement
-----------------------------------------  */

function gamf_arrangement_columns( $columns ) {

  $columns = array(
    'cb'                       => $columns['cb'],
    'featured_image'           => __( 'Images', 'gamf' ),
    'title'                    => __( 'Title', 'gamf' ),
    'arrangement_area'         => __( 'Area', 'gamf' ),
    'arrangement_date'         => __( 'Dato', 'gamf' ),
    'arrangement_url'          => __( 'URL', 'gamf' ),
    'arrangement_time'         => __( 'Starttid', 'gamf' ),
    'arrangement_nation_id'    => __( 'Nasjoner', 'gamf' ),
    'date'                     => __( 'Date', 'gamf' ),
  );

return $columns;
}
add_filter( 'manage_arrangement_posts_columns', 'gamf_arrangement_columns' );

function gamf_arrangement_column( $column, $post_id ) {

  // Image column
  if ( 'featured_image' === $column ) {
    echo gamf_post_featured_image($post_id);
  }

    // Area
    if ( 'arrangement_area' === $column ) {
      echo gamf_post_meta_value($post_id, 'arrangement_area');
    }

    // Arrangement Date
    if ( 'arrangement_date' === $column ) {
      echo gamf_post_meta_value($post_id, 'arrangement_date');
    }

    // Arrangement Time
    if ( 'arrangement_time' === $column ) {
      echo gamf_post_meta_value($post_id, 'arrangement_time');
    }

    // Arrangement Link
    if ( 'arrangement_url' === $column ) {
      $arrangement_url = gamf_post_meta_value($post_id, 'arrangement_url');
      echo '<a href="'. $arrangement_url .'" target="_blank"> ';
      echo $arrangement_url;
      echo '</a>';
    }

  // Nasjoner
  if ( 'arrangement_nation_id' === $column ) {
      $arrangement_nation_id = get_post_meta($post_id, 'arrangement_nation_id', true);
      if(isset($arrangement_nation_id) && !empty($arrangement_nation_id)){
        echo gamf_nation_name($arrangement_nation_id, true);
      } else {
        echo '---';
      }
    
  }
}

add_action( 'manage_arrangement_posts_custom_column', 'gamf_arrangement_column', 10, 2);

/* Manage column for Questions
-----------------------------------------  */
function gamf_question_columns( $columns ) {

  $columns = array(
    'cb'                    => $columns['cb'],
    'title'                 => __( 'Title', 'gamf' ),
    'question_status'       => __( 'Status', 'gamf' ),
    'question_date'       => __( 'Date', 'gamf' ),
    'date'                  => __( 'Date', 'gamf' ),
  );

  return $columns;
}
add_filter( 'manage_question_posts_columns', 'gamf_question_columns' );

function gamf_question_column( $column, $post_id ) {

    // Status
    if ( 'question_status' === $column ) {
      $question_status =  get_post_meta($post_id, 'question_status', true);
      if(isset($question_status) && $question_status == 'close'){
        echo '<img src="'. GAMF_URL . '/assets/images/icons/lock.png' .'"  alt="Closed" title="Closed" >	';             
      } else{
        echo '<img src="'. GAMF_URL . '/assets/images/icons/unlocked.png' .'" alt="Open" title="Open">	';   
      }
    }

}

add_action( 'manage_question_posts_custom_column', 'gamf_question_column', 10, 2);

?>
