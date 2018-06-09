<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 9:09 AM
 */

function endofcreate() {
    echo "ERROR\n";
    header('Location: create.html');
    exit();
}

function doneofcreate() {
    echo "OK\n";
    header('Location: index.html');
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
        file_put_contents("./private/passwd", serialize($content), LOCK_EX);
        doneofcreate();
    }
    else
    {
        if (file_exists('./private/chat') == false)
            mkdir('./private');
        $pass = hash("sha512", $pass);
        $content = array(array("login" => $login, "passwd" => $pass));
        file_put_contents("./private/passwd", serialize($content));
        doneofcreate();
    }
}
else
    endofcreate();