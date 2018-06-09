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
    $ret = sql_query("SELECT * FROM `" . TABLE_USER . "`");
    tpl_setpage('admin/list_user');
    while ($line = mysqli_fetch_array($ret))
    {
        tpl_add_data('admin_user_id', $line['id']);
        tpl_add_data('admin_user_name', $line['name']);
        tpl_add_data('admin_user_mail', $line['mail']);
        if ($line['banni'] == 0)
            tpl_add_data('admin_user_ban', "<a href='index.php?mod=admin_user_ban&user_id=" . $line['id'] . "'>Bannir cet utilisateur</a>");
        else
            tpl_add_data('admin_user_ban', "<a href='index.php?mod=admin_user_unban&user_id=" . $line['id'] . "'>DeBannir cet utilisateur</a>");
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