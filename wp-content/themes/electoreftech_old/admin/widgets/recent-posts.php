<?php
class JustoRecentPostsWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'recent-posts',
            __( 'Recent Posts', 'justo' ),
            array(
                'classname'   => 'recent-posts',
                'description' => __( 'Add recent posts to your widget.', 'justo' )
                )
        );

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
     public function widget( $args, $instance ) {
 				global $wpdb;
 				extract( $args );

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'justo') : $instance['title'], $instance, $this->id_base);
 				$post_options 		= isset( $instance['post_options'] ) ? $instance['post_options'] : '';
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

         echo $before_widget;
         if(!empty($title)){
           echo $before_title .$title. $after_title;
         }

         if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ){
           $number = 5;
         }else{
           $number = $instance['number'];
         }
     		 $args = array(
                'post_type' => 'post',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => $number,
                'ignore_sticky_posts' => true,
                'post_status' => 'publish',
                'no_found_rows' => true
     			);

   		if(! empty($post_options) && ($post_options == 'popular') ) {
   			$args['meta_key'] = '_post_views';
   			$args['orderby'] = 'meta_value_num';
   			}


 		$recent_posts = new WP_Query( $args );
 		$counter = 1;
 		if ( $recent_posts->have_posts() ) {
 			echo '<ul class="recent-posts">';
 			while ( $recent_posts->have_posts() ) : $recent_posts->the_post();

       $widget_post_heading = ' jt-pl-0';
       $widget_post_date = ' jt-pl-0';
 			?>
      <li>
        <?php if ( has_post_thumbnail() ) { ?>
          <div class="widget-posts-image">
          <a href="<?php echo get_the_permalink(); ?>"><?php the_post_thumbnail( array( 100, 100 ) ); ?> </a>
									</div>

         <?php } ?>
         <div class="widget-posts-body">
										<div class="widget-posts-meta"><?php echo get_the_date( 'j F, Y' ); ?></div>
										<h6 class="widget-posts-title"><a href="<?php echo get_the_permalink(); ?>"> <?php the_title(); ?> </a></h6>
					</div>
      </li>

 			<?php
 			$counter++;
 			endwhile;
 			echo '</ul>';

 				wp_reset_query();
 			}

         echo $after_widget;

     }


    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title'] = strip_tags( $new_instance['title'] );
      $instance['post_options'] = strip_tags( $new_instance['post_options'] );
      $instance['number'] = $new_instance['number'];
      $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
      return $instance;

    }

    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
      public function form( $instance ) {

    	$title = isset($instance['title']) ? esc_attr( $instance['title'] ) : '';
    	$post_options = isset($instance['post_options']) ? esc_attr( $instance['post_options'] ) : '';
    	$number = isset($instance['number']) ? $instance['number'] : '';
      $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
    	$post_options_val = array(
    						'recent' => __('Recent','justo'),
    						'popular' =>  __('Popular','justo')
  						);
            ?>

          <p>
              <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e( 'Title:', 'justo' ); ?></label>
              <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </p>
  				<p>
  					<label for="widget-tag_cloud-3-taxonomy"><?php esc_attr_e( 'Post Options:', 'justo' ); ?></label>
  					<select class="widefat" id="<?php echo $this->get_field_id('post_options'); ?>" name="<?php echo $this->get_field_name('post_options'); ?>">
  					<?php
  						foreach($post_options_val as $key => $item) {
  							$opt = '<option value="'.$key.'"';
  								if(isset($post_options) && ($post_options == $key)){
  								$opt .= ' selected="selected"';
  								}
  							$opt .= '>'.$item.'</option>';
  							echo $opt;
  						}
  						?>
  					</select>
  				</p>

          <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_attr_e( 'Number of posts to show:', 'justo' ); ?></label>
		        <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1"  value="<?php echo $number; ?>" size="3">
          </p>

          <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		          <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?', 'justo' ); ?></label></p>
      <?php
      }
  }

/* Register the widget */
	add_action( 'widgets_init', function(){
	     register_widget( 'JustoRecentPostsWidget' );
	});

?>