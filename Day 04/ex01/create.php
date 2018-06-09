<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 9:09 AM
 */

function endofcreate() {
    echo "ERROR\n";
    exit();
}

function doneofcreate() {
    echo "OK\n";
    exit();
}

$pass = "";
$login = "";

if ($_POST['submit'] && $_POST['submit'] == "OK")
{
    if ($_POST['login'] != '')
    {
        if ($_POST['passwd'] != '')
        {
            $login = $_POST['login'];
            $pass = $_POST['passwd'];
        }
    }
}
if ($pass != '' && $login != '')
{
    if (file_exists('./private/passwd'))
    {
        $content = unserialize(file_get_contents("./private/passwd"));
        foreach ($content as $line)
        {
            if ($line["login"] == $login)
                endofcreate();
        }
        $pass = hash("sha512", $pass);
        $content[] = array("login" => $login, "passwd" => $pass);
        file_put_contents("./private/passwd", serialize($content));
        doneofcreate();
    }
    else
    {
        mkdir('./private');
        $content = "";
        $pass = hash("sha512", $pass);
        $content[] = array("login" => $login, "passwd" => $pass);
        file_put_contents("./private/passwd", serialize($content), LOCK_EX);
        doneofcreate();
    }
}
else
    endofcreate();