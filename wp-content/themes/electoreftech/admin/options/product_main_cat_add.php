<?php

global $wpdb;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
$message = '';
if (isset($_POST['bannerbtn'])) {
    if ($mode == 'edit') {
        $wpdb->update($wpdb->prefix . 'entrada_price_range', array('pr_title' => addslashes($_POST['pr_title']), 'min_price' => $_POST['min_price'], 'max_price' => $_POST['max_price']), array('id' => $_POST['bannerid']));
    } else {
        $wpdb->insert($wpdb->prefix . 'entrada_price_range', array('pr_title' => addslashes($_POST['pr_title']), 'min_price' => $_POST['min_price'], 'max_price' => $_POST['max_price']));
    }
    $message = __('Record has been saved.', 'eaddons');
}
if ($mode == 'delete') {
    $wpdb->query("delete from " . $wpdb->prefix . "entrada_price_range where id=$_REQUEST[pid]");
    $message = __('Record has been deleted.',  'eaddons');
}

?>
<div id="wrap">
    <div class="wrap">
        <h2>
            <img src="<?php echo plugin_dir_url(dirname(__FILE__)); ?>assets/img/addons.png"> <?php _e('Price Range Settings',  'eaddons'); ?>
            <a href="<?php echo admin_url('admin.php?page=eaddons-price-range'); ?>&mode=add" class="button button-primary button-small"><?php _e('Add New',  'eaddons'); ?></a>
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
                            $result_update = $wpdb->get_row("select * from " . $wpdb->prefix . "entrada_price_range where id=$_REQUEST[pid]");
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
                                <td><label> <?php _e('Title', 'eaddons'); ?> : </label> </td>
                                <td>
                                    <input type="text" name="pr_title" style="width:200px;" id="pr_title" value="<?php if ($mode == 'edit') {
                                                                                                                        echo stripslashes($result_update->pr_title);
                                                                                                                    } ?>" />
                                    <input type="hidden" name="bannerid" value="<?php if ($mode == 'edit') echo $result_update->id; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td><label> <?php _e('Min. Price', 'eaddons'); ?> : </label></td>
                                <td><input type="text" name="min_price" style="width:200px;" id="min_price" value="<?php if ($mode == 'edit') {
                                                                                                                        echo stripslashes($result_update->min_price);
                                                                                                                    } ?>" /></td>
                            </tr>

                            <tr>
                                <td><label> <?php _e('Max. Price', 'eaddons'); ?> : </label></td>
                                <td><input type="text" name="max_price" style="width:200px;" id="max_price" value="<?php if ($mode == 'edit') {
                                                                                                                        echo stripslashes($result_update->max_price);
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
                            <th width="13%">#</th>
                            <th width="25%"><?php _e('Title', 'eaddons'); ?> </th>
                            <th width="40%"><?php _e('Price Range', 'eaddons'); ?></th>
                            <th width="22%"><?php _e('Action', 'eaddons'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $wpdb->get_results("select * from " . $wpdb->prefix . "entrada_price_range WHERE 1= 1 order by min_price ASC ");
                        if ($result) {
                            $currency_symbol = $this->eaddons_currency_symbol();
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
                                    <td><?php echo stripslashes($entry->pr_title); ?></td>
                                    <td><?php echo $currency_symbol . stripslashes($entry->min_price); ?> - <?php echo $currency_symbol . stripslashes($entry->max_price); ?></td>

                                    <td> <a href="<?php echo admin_url('admin.php?page=eaddons-price-range'); ?>&pid=<?php echo $entry->id; ?>&mode=edit">Edit</a> | <a href="<?php echo admin_url('admin.php?page=eaddons-price-range'); ?>&pid=<?php echo $entry->id; ?>&mode=delete" onclick="return confirm('Are you sure you want to delete?')">Delete </a></td>
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
                            <th width="13%">#</th>
                            <th width="25%"><?php _e('Title', 'eaddons'); ?> </th>
                            <th width="40%"><?php _e('Price Range', 'eaddons'); ?></th>
                            <th width="22%"><?php _e('Action', 'eaddons'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </td>
        </tr>
    </table>
</div>