<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/31/18
 * Time: 2:00 PM
 */

    header('Content-Type: text/plain');

function display_auth()
{
    echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>\n";
}

function display_non_auth()
{
    echo "<html><body>\nBonjour " . $_SERVER["PHP_AUTH_USER"] . "<br />\n<img src='data:image/png;base64," . base64_encode(file_get_contents('../img/42.png')) . "'>\n</body></html>\n";
}

if (isset($_SERVER["PHP_AUTH_USER"]) && $_SERVER["PHP_AUTH_USER"] == "zaz")
{
    if (isset($_SERVER["PHP_AUTH_PW"]) && $_SERVER["PHP_AUTH_PW"] == "jaimelespetitsponeys")
    {
        display_auth();
    }
    else
        display_non_auth();
}
else
    display_non_auth();