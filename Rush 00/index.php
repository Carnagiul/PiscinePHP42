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
require_once ("NoClass/Merch.php");

sql_connect();

if (isset($_GET['mod']))
    $mod = $_GET['mod'];
else
    $mod = $_GET['mod'];

$file = "";

if (file_exists('modules/' . $mod . '.php'))
    $file = $mod;
else
    $file = "home";

$page_notif = "";

tpl_setpage('header');
tpl_add_data('PageName', $file);
echo tpl_construire();

include ("modules/" . $file . ".php");


if (isset($_SESSION['user']))
    tpl_setpage('menu/menu_log');
else
    tpl_setpage('menu/menu_public');

tpl_add_data('menu', tpl_construire());



$panier = "<ul>";
if (isset($_SESSION['merch']))
{
    foreach ($_SESSION['merch'] as $key => $value)
    {
        $panier .= "\n<li>$key : $value</li>\n";
    }
}
$panier .= "</ul>";



tpl_add_data('panier', $panier);
tpl_add_data('Notifs', $page_notif);
tpl_setpage('footer');
echo tpl_construire();

sql_close();
