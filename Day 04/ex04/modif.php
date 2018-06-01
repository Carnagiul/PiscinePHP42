<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 9:09 AM
 */

function endofcreate() {
    echo "ERROR\n";
    header('Location: modif.html');
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
        if ($_POST['oldpw'] != '')
        {
            if ($_POST['newpw'] != '')
            {
                if ($_POST['newpw'] == $_POST['oldpw'])
                {
                    $login = $_POST['login'];
                    $pass = $_POST['newpw'];
                }
            }
        }
    }
}
if ($pass != '' && $login != '')
{
    $new_pass = hash("sha512", $pass);
    if (file_exists('./private/passwd'))
    {
        $content = unserialize(file_get_contents("./private/passwd"));
        $content2 = NULL;
        $i = 0;
        foreach ($content as $line)
        {
            if ($line["login"] == $login && $line["passwd"] != $new_pass)
            {
                $i = 1;
                $line["passwd"] = $new_pass;
            }
            $content2[] = $line;
        }
        if ($i == 1)
        {
            file_put_contents("./private/passwd", serialize($content2), LOCK_EX);
            doneofcreate();
        }
        endofcreate();
    }
    else
        endofcreate();
}
else
    endofcreate();