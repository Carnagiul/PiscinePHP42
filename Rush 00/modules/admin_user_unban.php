<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 4:27 PM
 */

if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1)
{
    if (isset($_GET['user_id']) && $_GET['user_id'] != '' && $_GET['user_id'] != $_SESSION['user']['id'])
    {
        $ret = sql_select("SELECT * FROM `" . TABLE_USER . "` WHERE `id`='" . intval($_GET['user_id']) . "'");
        if ($ret && $ret['id'] && $ret['admin'] == 0)
        {
            sql_update("UPDATE `" . TABLE_USER . "` SET `banni` = '0' WHERE `users`.`id` = '" . intval($_GET['user_id']) . "'; ");
            $page = "Cette utilisateur a ete debanni";
        }
        else
            $page = "Cette utilisateur ne peut etre debanni";
    }
    else
    {
        header('Location: index.php?mod=admin_list_user');
        $page = "Cette utilisateur ne peut etre debanni";
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