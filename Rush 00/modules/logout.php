<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 6:58 PM
 */

if (isset($_SESSION['user']))
{
    $_SESSION['user'] = NULL;
    unset($_SESSION['user']);
}

header('Location: index.php');
tpl_setpage('home');
echo tpl_construire();
