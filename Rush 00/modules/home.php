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
    tpl_add_data('username', 'Admin');
    tpl_add_data('pass', '0xff');
    echo tpl_construire();
}
else
{
    tpl_setpage('public/home');
    echo tpl_construire();
}