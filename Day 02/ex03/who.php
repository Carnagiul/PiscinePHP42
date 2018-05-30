#!/usr/bin/php
<?php

/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 9:37 AM
 */

$binarydata = "";

$content = unpack("C*", file_get_contents("/var/run/utmpx"));

//$output = shell_exec("who");
$cc = NULL;
foreach ($content as $c)
    if ($c != 0)
        if ($c >= 0 && $c <= 126)
            $cc .= chr($c);
echo $cc;
//echo $content;
?>