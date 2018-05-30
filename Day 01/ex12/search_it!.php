#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 6:32 AM
 */
$i = 2;
if ($argc > 2) {
    $table = NULL;
    $c = 0;
    while (isset($argv[$i])) {
        $table = explode(":", $argv[$i]);
        if (isset($table[0]) && isset($table[1]) && $table[0] == $argv[1])
        {
            echo $table[1] . "\n";
            $c++;
        }
        $i++;
    }
}
