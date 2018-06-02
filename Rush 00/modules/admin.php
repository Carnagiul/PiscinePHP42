<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 4:20 PM
 */

if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1)
{
    $admin_page = "home";

    if (isset($_GET['admin_mod']) && $_GET['admin_mod'] != '')
        $admin_page = $_GET['admin_mod'];
    if (!(file_exists('modules/admin_' . $admin_page . '.php')))
        $admin_page = 'home';
    include ('modules/admin_' . $admin_page . '.php');
}
else
{
    if (isset($_SESSION['user']))
        tpl_setpage('log/home');
    else
        tpl_setpage('public/home');
    header('Location: index.php');
    echo tpl_construire();
}