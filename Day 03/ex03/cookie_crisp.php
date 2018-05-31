<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/31/18
 * Time: 1:18 PM
 */
if (isset($_GET["action"]) && $_GET["action"] != "")
{
    if ($_GET["action"] == "set")
    {
        if (isset($_GET["name"]) && $_GET["name"] != "")
        {
            if (isset($_GET["value"]) && $_GET["value"] != "")
            {
                setcookie($_GET["name"], $_GET["value"]);
            }
        }
    }
    if ($_GET["action"] == "get")
    {
        if (isset($_GET["name"]) && $_GET["name"])
        {
            if (isset($_COOKIE[$_GET["name"]]))
            {
                echo $_COOKIE[$_GET["name"]] . "\n";
            }
        }
    }
    if ($_GET["action"] == "del")
    {
        if (isset($_GET["name"]) && $_GET["name"])
        {
            if (isset($_COOKIE[$_GET["name"]]))
            {
               unset($_COOKIE[$_GET["name"]]);
            }
        }
    }
}