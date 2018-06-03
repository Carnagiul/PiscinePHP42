<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 9:17 AM
 */

if (isset($_POST))
{
    if (isset($_POST['id']) && isset($_POST['amount']))
    {
        $ret_merch = __merch_add_merch($_POST['id'], $_POST['amount']);
    }
}

$group = 1;
if (isset($_GET['searchBy']) && $_GET['searchBy'] != '')
    $group = $_GET['searchBy'];
$ret = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `group_id`='" . $group . "'");
if ($ret)
{
    $page = "";

    tpl_setpage('log/merchandise/item');
    if (isset($ret['name']))
    {
        $data = $ret;
        tpl_add_data("nom", $data['name']);
        tpl_add_data("prix", $data['price']);
        tpl_add_data("dispo", $data['amount']);
        tpl_add_data("id", $data['id']);
        tpl_add_data("image", $data['image']);
        $page .= tpl_construire();
    }  else {
        foreach ($ret as $data) {
            tpl_add_data("nom", $data['name']);
            tpl_add_data("image", $data['image']);
            tpl_add_data("prix", $data['price']);
            tpl_add_data("dispo", $data['amount']);
            tpl_add_data("id", $data['id']);
            $page .= tpl_construire();
        }
    }
    tpl_add_data('merchandise_page', $page);
    if (isset($_SESSION['user']))
        tpl_setpage('public/merchandise/merch_page');
    else
        tpl_setpage('log/merchandise/merch_page');
    $page = tpl_construire();
}
else
{
    if (isset($_SESSION['user']))
        tpl_setpage('public/merchandise/none');
    else
        tpl_setpage('log/merchandise/none');
    $page = tpl_construire();
}