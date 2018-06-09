<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 11:27 AM
 */

@session_start();

require_once ("auth.php");

if (isset($_GET["submit"]) && $_GET["submit"] == "OK")
{
    if (isset($_GET["login"]) && $_GET["login"] != "")
    {
        if (isset($_GET["passwd"]) && $_GET["passwd"] != "")
        {
            if (auth($_GET["login"], $_GET["passwd"]))
            {
                $_SESSION["loggued_on_user"] = $_GET["login"];
                echo "OK";
                exit();
            }
            else
                $_SESSION["loggued_on_user"] = "";
        }
    }
}
echo "ERROR\n";