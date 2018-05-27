<?php

require_once ("Sql.class.php");
require_once ("User.class.php");
require_once ("Tpl.class.php");
require_once ("Lang.class.php");
require_once ("Menu.class.php");

session_start();

$sql = new Sql();
$user = new User();
$tpl = new Tpl();
$lang = new Lang();
$menu = new Menu();

$sql->connect();
$lang->loadAllLang();

$ret = $user->connect("coin@minegamers.fr", "coinAPcoin");

$menu->load_menu();
print_r($menu->getMenu());

var_dump(array($sql, $user, $tpl, $lang, $menu));

?>