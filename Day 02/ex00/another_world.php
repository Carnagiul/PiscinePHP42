#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 8:42 AM
 */
if ($argc > 1)
{
    $value = trim($argv[1]);
    $result = preg_split('/\s+/', $value);
    echo implode(" ", $result) . "\n";
}


