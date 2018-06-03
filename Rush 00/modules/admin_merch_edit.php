<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 4:27 PM
 */

if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1)
{
    if (isset($_GET['merch_id']) && $_GET['merch_id'] != '')
    {
        $ret = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($_GET['merch_id']) . "'");
        if ($ret && $ret['id'])
        {
            if (isset($_POST['name']))
                sql_update("UPDATE `" . MERCH_TABLE . "` SET `name` = '" . htmlentities($_POST['name']) . "' WHERE `id` = '" . intval($_GET['merch_id']) . "'; ");
            if (isset($_POST['description']))
                sql_update("UPDATE `" . MERCH_TABLE . "` SET `description` = '" . htmlentities($_POST['description']) . "' WHERE `id` = '" . intval($_GET['merch_id']) . "'; ");
            if (isset($_POST['image']) && (@GetImageSize($_POST['image'])))
                sql_update("UPDATE `" . MERCH_TABLE . "` SET `image` = '" . htmlentities($_POST['image']) . "' WHERE `id` = '" . intval($_GET['merch_id']) . "'; ");
            if (isset($_POST['amount']) && intval($_POST['amount']) > 0)
                sql_update("UPDATE `" . MERCH_TABLE . "` SET `amount` = '" . intval($_POST['amount']) . "' WHERE `id` = '" . intval($_GET['merch_id']) . "'; ");
            if (isset($_POST['price']) && intval($_POST['price']) > 0)
                sql_update("UPDATE `" . MERCH_TABLE . "` SET `price` = '" . intval($_POST['price']) . "' WHERE `id` = '" . intval($_GET['merch_id']) . "'; ");
            $data = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($_GET['merch_id']) . "'");
            tpl_setpage('admin/edit_merch');
            tpl_add_data('merch_name', $data['name']);
            tpl_add_data('merch_description', $data['description']);
            tpl_add_data('merch_image', $data['image']);
            tpl_add_data('merch_amount', $data['amount']);
            tpl_add_data('merch_price', $data['price']);
            $page = tpl_construire();
        }
        else
            $page = "Cette marchandise ne peut etre modifier";
    }
    else
    {
        header('Location: index.php?mod=admin_list_merch');
        $page = "Cette marchandise ne peut etre modifier";
    }
}
else
{
    if (isset($_SESSION['user']))
        tpl_setpage('log/home');
    else
        tpl_setpage('public/home');
    header('Location: index.php');
    $page = tpl_construire();
}