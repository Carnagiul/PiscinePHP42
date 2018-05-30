#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 7:58 AM
 */

require_once ("ft_is_sort.php");

function ft_split($array)
{
    $explode = preg_split('/\s+/', $array);
    if ($explode)
        sort($explode);
    return ($explode);
}

foreach ($argv as $a)
{
    $array = ft_split($a);
    $array["boolean"] = ft_is_sort($array);
    var_dump($array);
}