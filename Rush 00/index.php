<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 6:03 PM
 */

@session_start();

require_once ("NoClass/Template.php");
require_once ("NoClass/Sql.php");

if (isset($_GET['mod']))
    $mod = $_GET['mod'];
else
    $mod = $_GET['mod'];

$file = "";



if (file_exists('modules/' . $mod . '.php'))
    $file = $mod;
else
    $file = "home";

tpl_setpage('header');
tpl_add_data('PageName', $file);
echo tpl_construire();

include ("modules/" . $file . ".php");

tpl_setpage('footer');
echo tpl_construire();
