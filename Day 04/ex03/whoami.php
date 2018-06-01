<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 11:20 AM
 */

@session_start();

if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "")
    echo $_SESSION["loggued_on_user"] . "\n";
else
    echo "ERROR\n";