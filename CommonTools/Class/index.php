<?php

require_once ("Sql.class.php");
require_once ("User.class.php");
require_once ("Tpl.class.php");
require_once ("Lang.class.php");

session_start();

$sql = new Sql();
$user = new User();
$tpl = new Tpl();
$lang = new Lang();

$sql->connect();
$lang->loadAllLang();

$ret = $user->connect("coin@minegamers.fr", "coinAPcoin");

echo "<pre>ret tag   : $ret <br />ret value : " . $lang->getLang($ret, $user->getLang()) . " </pre>";

var_dump(array($sql, $user, $tpl, $lang));

?>