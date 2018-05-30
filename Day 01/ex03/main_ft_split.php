#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 7:52 AM
 */

require_once ("ft_split.php");


foreach ($argv as $a)
{
    $array = ft_split($a);
    var_dump($array);
}


?>