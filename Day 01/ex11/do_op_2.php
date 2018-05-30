#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 6:32 AM
 */
if ($argc == 2)
{
    $set = $argv[1];
    $set = str_replace("*", " * ", $set);
    $set = str_replace("/", " / ", $set);
    $set = str_replace("-", " - ", $set);
    $set = str_replace("+", " + ", $set);
    $set = str_replace("%", " % ", $set);
    $regex = array_filter(preg_split('/\s+/', $set));
    $nb1 = $regex[0];
    $operand = $regex[1];
    $nb2 = $regex[2];
    $result = 0;
    if ((ctype_digit($nb1) == false) || ctype_digit($nb2) == false)
        $result = "Syntax Error";
    else if ($operand == '+')
        $result = $nb1 + $nb2;
    else if ($operand == '*')
        $result = $nb1 * $nb2;
    else if ($operand == '/')
        $result = $nb1 / $nb2;
    else if ($operand == '-')
        $result = $nb1 - $nb2;
    else if ($operand == '%')
        $result = $nb1 % $nb2;
    else
        $result = "Syntax Error";
    echo $result;
}
else
    echo "Incorrect Parameters";
echo "\n";