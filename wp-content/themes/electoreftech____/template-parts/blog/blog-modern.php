<?php 
$post_id = $args['post_id'];
?>
<div class="col-md-4 col-lg-4">
    <div class="blogbox">
        <div class="blogimg">
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
            <div class="blogdate">
                <?php echo get_the_date( 'd', $post_id ); ?><span><?php echo get_the_date( 'M', $post_id ); ?></span>
            </div>
        </div>
        <div class="blogdesc">
            <h4><a href="<?php echo get_permalink($post_id);?>"><?php echo get_the_title($post_id); ?></a></h4>
            <p><?php echo wpautop(wp_trim_words( get_the_content(), 18, null )); ?></p>
            <div class="postauthorreadmore">
                <div class="innerauthorreadmore">
                    <ul>
                        <li><i class="fa fa-user-o" aria-hidden="true"></i>Electro-Ref Tech</li>
                        <li><a href="<?php echo get_permalink($post_id);?>">Read More<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>