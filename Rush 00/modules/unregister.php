<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 6:39 PM
 */

if (isset($_SESSION['user']))
{
    if ($_GET['delme'] != '' && $_GET['delme'] == "yes")
    {
        if ($_SESSION['user']['admin'] == 1)
        {
            tpl_setpage('unregister/notadmin');
            header('Location: index.php');
            $page = tpl_construire();
        }
        else
        {
            $id = $_SESSION['user']['id'];
            sql_update("DELETE FROM `users` WHERE `users`.`id` = '" . $id . "'");
            unset($_SESSION['user']);
            tpl_setpage('unregister/deleted');
            $page = tpl_construire();
        }
    }
    else
    {
        tpl_setpage('unregister/really');
        $page = tpl_construire();
    }
}
else
{
    tpl_setpage('public/home');
    header('Location: index.php');
    $page = tpl_construire();
}