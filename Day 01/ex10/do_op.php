#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 6:32 AM
 */
if ($argc == 4)
{
    $nb1 = intval($argv[1]);
    $nb2 = intval($argv[3]);
    $operand = trim($argv[2]);
    $result = 0;
    if ($operand == '+')
        $result = $nb1 + $nb2;
    if ($operand == '*')
        $result = $nb1 * $nb2;
    if ($operand == '/')
        $result = $nb1 / $nb2;
    if ($operand == '-')
        $result = $nb1 - $nb2;
    if ($operand == '%')
        $result = $nb1 % $nb2;
    echo $result;
}
else
    echo "Incorrect Parameters";
echo "\n";