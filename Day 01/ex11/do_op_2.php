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
	$set = trim($argv[1]);
	$set = str_replace("*", " * ", $set);
	$set = str_replace("/", " / ", $set);
	$set = str_replace("-", " - ", $set);
	$set = str_replace("+", " + ", $set);
	$set = str_replace("%", " % ", $set);
	$regex = preg_split('/\s+/', $set);
	$nb1 = $regex[0];
	$operand = $regex[1];
	$nb2 = $regex[2];
	$result = 0;
	if ((ctype_digit($nb1) == false) || ctype_digit($nb2) == false)
		$result = "Syntax Error";
	else if ($operand == '+')
		$result = intval($nb1) + intval($nb2);
	else if ($operand == '*')
		$result = intval($nb1) * intval($nb2);
	else if ($operand == '/' && intval($nb2) != 0)
		$result = intval($nb1) / intval($nb2);
	else if ($operand == '-')
		$result = intval($nb1) - intval($nb2);
	else if ($operand == '%' && intval($nb2) != 0)
		$result = intval($nb1) % intval($nb2);
	else
		$result = "Syntax Error";
	echo $result;
}
else
	echo "Incorrect Parameters";
echo "\n";
