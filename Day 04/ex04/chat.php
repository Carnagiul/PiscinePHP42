<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 11:53 AM
 */

function setTimezone($default)
{
    $timezone = "";

    if (is_link("/etc/localtime")) {

        $filename = readlink("/etc/localtime");

        $pos = strpos($filename, "zoneinfo");
        if ($pos) {
            $timezone = substr($filename, $pos + strlen("zoneinfo/"));
        } else {
            $timezone = $default;
        }
    }
    else {

        $timezone = file_get_contents("/etc/timezone");
        if (!strlen($timezone)) {
            $timezone = $default;
        }
    }
    date_default_timezone_set($timezone);
}

setTimezone('UTC');


    if (file_exists('./private/chat'))
    {
        $content = unserialize(file_get_contents('./private/chat'));
        foreach ($content as $line)
            echo "[" . date("H:i", $line["time"]) . "] <b>" . $line["login"] . "</b>: " . $line["msg"] . "<br />";
    }
?>