<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 6:03 PM
 */

@session_start();

define("TABLE_USER", "users");

error_reporting(-1);

require_once ("NoClass/Template.php");
require_once ("NoClass/Sql.php");
require_once ("NoClass/User.php");

sql_connect();

if (isset($_GET['mod']))
    $mod = $_GET['mod'];
else
    $mod = $_GET['mod'];

$file = "";


    tpl_setpage('menu/menu_log');
    tpl_add_data('menu_log', tpl_construire());

    tpl_setpage('menu/menu_public');
    tpl_add_data('menu_public', tpl_construire());


if (file_exists('modules/' . $mod . '.php'))
    $file = $mod;
else
    $file = "home";

$page_notif = "";

tpl_setpage('header');
tpl_add_data('PageName', $file);
echo tpl_construire();

include ("modules/" . $file . ".php");


tpl_add_data('Notifs', $page_notif);
tpl_setpage('footer');
echo tpl_construire();

sql_close();
