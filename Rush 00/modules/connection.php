<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 6:49 PM
 */

if (isset($_SESSION['user']))
{
    tpl_setpage('log/home');
    tpl_add_data('username', 'Admin');
    tpl_add_data('pass', '0xff');
    echo tpl_construire();
}
else
{
    if (isset($_POST['user']) && isset($_POST['pass']))
    {
        $pass = $_POST['pass'];
        $user = $_POST['user'];
        if ($user == 'Admin' && $pass == 'test')
            $_SESSION['user'] = array('username' => $user);
    }
    if (isset($_SESSION['user']))
    {
        tpl_setpage('log/home');
        tpl_add_data('username', 'Admin');
        tpl_add_data('pass', '0xff');
        echo tpl_construire();
    }
    else
    {
        tpl_add_data('connection_username', (isset($_POST['user'])) ? $_POST['user'] : "");
        tpl_add_data('connection_password', (isset($_POST['pass'])) ? $_POST['pass'] : "");
        tpl_setpage('connection');
        echo tpl_construire();
    }
}