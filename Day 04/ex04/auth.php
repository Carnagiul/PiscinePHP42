<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 11:24 AM
 */

function auth($login, $passwd)
{
    $pass = $passwd;
    if ($pass != '' && $login != '')
    {
        $new_pass = hash("sha512", $pass);
        if (file_exists('./private/passwd'))
        {
            $content = unserialize(file_get_contents("./private/passwd"));
            $i = 0;
            foreach ($content as $line)
            {
                if ($line["login"] == $login && $line["passwd"] == $new_pass)
                    return (true);
            }
        }
    }
    return (false);
}