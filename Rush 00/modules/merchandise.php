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
        var_dump($ret_merch);
    }
}

$group = 1;
if (isset($_GET['searchBy']) && $_GET['searchBy'] != '')
    $group = $_GET['searchBy'];
if ($group != 1)
    $ret = sql_query("SELECT * FROM `" . MERCH_TABLE . "` WHERE `group_id`='" . $group . "'");
else
    $ret = sql_query("SELECT * FROM `" . MERCH_TABLE . "`");
$page = "";
$line = "";
tpl_setpage('merch/item');
if ($ret)
{
   while ($data = mysqli_fetch_assoc($ret))
   {
            tpl_add_data("nom", $data['name']);
            tpl_add_data("prix", $data['price']);
            tpl_add_data("dispo", $data['amount']);
            tpl_add_data("id", $data['id']);
            tpl_add_data("image", $data['image']);
            $line .= tpl_construire();
    }
    tpl_setpage('merch/merch_page');
    tpl_add_data('merchandise_page', $line);
}
else
{
    tpl_setpage('merch/none');
}
$page = tpl_construire();