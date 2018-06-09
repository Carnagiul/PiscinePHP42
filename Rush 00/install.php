<?php

/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 7:03 PM
 */

require_once ("NoClass/Sql.php");

sql_connect();

sql_execbackup("rush00.sql", 1);

sql_close();

header('Location: index.php');
echo "<h1>Le site est Pret</h1>";

?>