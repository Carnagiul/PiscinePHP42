<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 6:46 PM
 */

if ($_SESSION['user'])
{
    tpl_setpage('log/home');
    tpl_add_data('username', $_SESSION['user']['name']);
    $page = tpl_construire();
}
else
{
    tpl_setpage('public/home');
    $page = tpl_construire();
}