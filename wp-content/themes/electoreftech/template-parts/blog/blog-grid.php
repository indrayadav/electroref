<?php 
$post_id = $args['post_id'];
?>
<div class="col-md-4 col-lg-4">
    <div class="ourserbox">
        <div class="servicesimg">
        <a href="<?php echo get_permalink($post_id);?>">
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                }
                else {
                    echo '<img src="' . get_template_directory_uri() . '/img/no_image.png"  class="img-fluid" />';
                }
            ?>
        </a>
        </div>
        <div class="ourservice-desc">
            <h4><a href="<?php echo get_permalink($post_id);?>"><?php echo get_the_title($post_id); ?></a></h4>
            <p><?php echo wpautop(wp_trim_words( get_the_content(), 18, null )); ?></p>
            <div class="electrobtn"><a href="<?php echo get_permalink($post_id);?>">View More</a></div>
        </div>
    </div>
</div>