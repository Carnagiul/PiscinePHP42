<?php

require_once ("Sql.class.php");
require_once ("User.class.php");
require_once ("Tpl.class.php");

$sql = new Sql();
$user = new User();
$tpl = new Tpl();

$sql->connect();

$user->connect("coin@minegamers.fr", "coinAPcoin");
var_dump(array($sql, $user, $tpl));

?>