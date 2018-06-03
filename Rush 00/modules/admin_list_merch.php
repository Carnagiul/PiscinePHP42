<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 4:27 PM
 */

if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1)
{
    $list_group = "";
    $ret = sql_query("SELECT * FROM `" . MERCH_TABLE . "`");
    tpl_setpage('admin/list_merch');
    while ($line = mysqli_fetch_array($ret))
    {
        tpl_add_data('admin_merch_id', $line['id']);
        tpl_add_data('admin_merch_name', $line['name']);
        tpl_add_data('admin_merch_cmd', "<a href='index.php?mod=admin_merch_edit&merch_id=" . $line['id'] . "'>Editer cette marchandise</a>");
        $list_group .= tpl_construire();
    }
    $page = "<ul>$list_group</ul>";
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