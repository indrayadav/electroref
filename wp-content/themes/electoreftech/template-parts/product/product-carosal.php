<?php 
$post_id = $args['post_id'];
?>
<div class="item">
    <div class="pharprodbox">
        <div class="pharprodimg"> <a href="<?php echo get_permalink($post_id);?>">
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                }
                else {
                    echo '<img src="' . get_template_directory_uri() . '/img/no_image.png"  class="img-fluid" />';
                }
            ?>
    </a> <?php echo electoreftech_product_offer_tag($post_id); ?></div>
        <div class="pharprodesc">
            <h4><a href="<?php echo get_permalink($post_id);?>"><?php echo get_the_title($post_id); ?></a></h4>
            <?php echo electoreftech_product_rating($post_id); ?>
            <?php echo electoreftech_product_price($post_id); ?>
               <div class="addtocompare">
                <ul>
                     <li><div class="wishcompareicon"><span><a href="#"><i class="fa fa-balance-scale" aria-hidden="true"></i></a></span><span><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></span></div></li>
                </ul>
            </div>
        </div>
    </div>
</div>