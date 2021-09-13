<?php

global $wpdb;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
$message = '';
if (isset($_POST['bannerbtn'])) {
    if ($mode == 'edit') {
        $wpdb->update($wpdb->prefix . 'main_categories', array('title' => addslashes($_POST['pr_title']), 'term_ids' => maybe_serialize($_POST['term_ids']), 'item_order' => $_POST['item_order']), array('id' => $_POST['bannerid']));
    } else {
        $wpdb->insert($wpdb->prefix . 'main_categories', array('title' => addslashes($_POST['pr_title']), 'term_ids' => maybe_serialize($_POST['term_ids']), 'item_order' => $_POST['item_order']));
    }
    $message = __('Record has been saved.', 'eaddons');
}
if ($mode == 'delete') {
    $wpdb->query("delete from " . $wpdb->prefix . "main_categories where id=$_REQUEST[pid]");
    $message = __('Record has been deleted.',  'eaddons');
}

?>
<div id="wrap">
    <div class="wrap">
        <h2>
          <?php _e('Main Categories',  'eaddons'); ?>
            <a href="<?php echo admin_url('admin.php?page=product-main-cat'); ?>&mode=add" class="button button-primary button-small"><?php _e('Add New',  'eaddons'); ?></a>
        </h2>
    </div>
    <?php if (!empty($message)) : ?>
        <div class="wrap">
            <div id="message" class="updated" style="margin-left:0; padding:10px;"><?php echo $message; ?></div>
        </div>
    <?php endif; ?>
    <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
        <tr>
            <td width="50%">
                <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
                    <form name="bannerfrm" action="" method="post" enctype="multipart/form-data">
                        <?php
                        if ($mode == 'edit') {
                            $result_update = $wpdb->get_row("select * from " . $wpdb->prefix . "main_categories where id=$_REQUEST[pid]");
                        } ?>
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <strong>
                                        <?php
                                        if ($mode == 'edit') {
                                            echo __('Update', 'eaddons');
                                        } else {
                                            echo __('Add', 'eaddons');
                                        }
                                        _e('Price Range', 'eaddons'); ?>
                                    </strong>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label> <?php _e('Main Category', 'eaddons'); ?> : </label> </td>
                                <td>
                                    <input type="text" name="pr_title" style="width:200px;" id="pr_title" value="<?php if ($mode == 'edit') {
                                                                                                                        echo stripslashes($result_update->title);
                                                                                                                    } ?>" />
                                    <input type="hidden" name="bannerid" value="<?php if ($mode == 'edit') echo $result_update->id; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td><label> <?php _e('Choose categories', 'eaddons'); ?> : </label></td>
                                <td>
                                <div class="main_cat_fields">
                                <?php $term_ids = [];
                                if ($mode == 'edit') {
                                  $term_ids =  maybe_unserialize($result_update->term_ids);
                                }
                                
                                    $terms = get_terms( array(
                                      'taxonomy' => 'product_cat',
                                      'hide_empty' => true,
                                      'parent'   => 0,
                                  ) );
                                  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
                                    foreach ( $terms as $term ) { 
                                      ?>
                                      <span>
                            <input type="checkbox"  name="term_ids[]" <?php if (in_array($term->term_id, $term_ids)) { echo ' checked';} ?> value="<?php echo $term->term_id; ?>">
                            <label for="<?php echo $term->name; ?>"><?php echo $term->name; ?></label> </span>
<?php 
                                    }
                                  }
                                ?> </div>
                                
                               </td>
                            </tr>

                            <tr>
                                <td><label> <?php _e('Display Order', 'eaddons'); ?> : </label></td>
                                <td><input type="text" name="item_order" style="width:200px;" id="item_order" value="<?php if ($mode == 'edit') {
                                                                                                                        echo stripslashes($result_update->item_order);
                                                                                                                    } ?>" /></td>
                            </tr>

                            <tr>
                                <td>&nbsp; </td>
                                <td><input type="submit" class="button button-primary button-large" name="bannerbtn" value=" <?php esc_attr_e('Save', 'eaddons'); ?>" style="cursor:pointer;" /></td>
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="2"><strong> <?php _e('Note', 'eaddons'); ?></strong> : <?php _e('Please avoid currency sign and decimal value.', 'eaddons'); ?> </th>
                            </tr>
                        </tfoot>

                    </form>
                </table>
            </td>
            <td width="50%">
                <table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
                    <thead>
                        <tr>
                            <th width="8%">#</th>
                            <th width="20%"><?php _e('Title', 'eaddons'); ?> </th>
                            <th width="40%"><?php _e('Sub Cattegories', 'eaddons'); ?></th>
                            <th width="10%"><?php _e('Order', 'eaddons'); ?></th>
                            <th width="22%"><?php _e('Action', 'eaddons'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $wpdb->get_results("select * from " . $wpdb->prefix . "main_categories WHERE 1= 1 order by item_order ASC ");
                        if ($result) {
                           
                            $count = 1;
                            $class = '';
                            foreach ($result as $entry) {
                                if ($count % 2 == 1) {
                                    $class = 'class="alternate "';
                                } else {
                                    $class = '';
                                } ?>
                                <tr <?php echo $class; ?>>
                                    <td><?php echo $count; ?></td>
                                    <td><strong><?php echo stripslashes($entry->title); ?></strong></td>
                                    <td><?php $term_ids =  maybe_unserialize($entry->term_ids);
                                    $t_name = [];
                                    if($term_ids){
                                      foreach($term_ids as $t_id){
                                        $t_name[] = get_term( $t_id )->name;
                                      }
                                    }
                                    echo implode(", ",$t_name);

                                    ?></td>
                                    <td><?php echo stripslashes($entry->item_order); ?></td>

                                    <td> <a href="<?php echo admin_url('admin.php?page=product-main-cat'); ?>&pid=<?php echo $entry->id; ?>&mode=edit">Edit</a> | <a href="<?php echo admin_url('admin.php?page=product-main-cat'); ?>&pid=<?php echo $entry->id; ?>&mode=delete" onclick="return confirm('Are you sure you want to delete?')">Delete </a></td>
                                </tr>
                            <?php
                                    $count++;
                                }
                            } else { ?>
                            <tr class="alternate ">
                                <td colspan="4"><?php _e('No Record Found.', 'eaddons'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                        <th width="8%">#</th>
                            <th width="20%"><?php _e('Title', 'eaddons'); ?> </th>
                            <th width="40%"><?php _e('Sub Cattegories', 'eaddons'); ?></th>
                            <th width="10%"><?php _e('Order', 'eaddons'); ?></th>
                            <th width="22%"><?php _e('Action', 'eaddons'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
</div>