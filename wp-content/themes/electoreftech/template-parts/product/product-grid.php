<?php 
$post_id = $args['post_id'];
?>
<div class="col-12 col-md-6 col-lg-3" itemscope="" itemtype="http://schema.org/Product">
    <meta itemprop="name" content="<?php echo get_the_title($post_id); ?>" />
    <link itemprop="url" href="<?php echo get_permalink($post_id);?>" />
    <meta itemprop="description" content="<?php echo get_the_excerpt($post_id); ?>" />
    <span class="d-none" itemprop="brand" itemtype="http://schema.org/Brand" itemscope>
        <meta itemprop="name" content="<?php echo electoreftech_get_product_brand($post_id); ?>" />
    </span>
    <?php $product_sku = get_post_meta($post_id, 'product_sku', true); ?>
    <meta itemprop="sku" content="<?php echo $product_sku; ?>" />

    <div class="pharprodbox">
        <div class="pharprodimg"> 
        <a href="<?php echo get_permalink($post_id);?>">
            <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail('thumbnail', [ 'class' => 'img-fluid'] );
                    
                    $featured_img_url = get_the_post_thumbnail_url($post_id,'thumbnail');
                    echo '<link itemprop="image" href="'. $featured_img_url.'" />';
                }
                else {
                    echo '<img src="' . get_template_directory_uri() . '/img/no_image.png"  class="img-fluid" />';
                }
            ?>
    </a>     
        </div>
        <div class="pharprodesc">
            <h4><a href="<?php echo get_permalink($post_id);?>"><?php echo get_the_title($post_id); ?></a></h4>
            <?php echo electoreftech_product_rating($post_id); ?>
            <?php echo electoreftech_product_price($post_id); ?>
            <?php echo electoreftech_watchcompare($post_id); ?>
            
        </div>
    </div>
</div>