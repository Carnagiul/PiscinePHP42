#!/usr/bin/php
<?php

$result = NULL;
foreach ($argv as $key => $set)
{
	if ($key > 0)
	{
		$regex = array_filter(preg_split('/\s+/', trim($set)));
		foreach ($regex as $r)
			$result[] = $r;
	}
}
if (isset($argv[1]))
{
	$result_str = NULL;
	$result_int = NULL;
	$result_end = NULL;

	foreach ($result as $r)
	{
		if (ctype_alpha($r))
			$result_str[] = $r;
		else if (ctype_digit($r))
			$result_int[] = $r;
		else
			$result_end[] = $r;
	}
	if (isset($result_str))
	{
		sort($result_str, SORT_STRING | SORT_FLAG_CASE);
		$result = implode("\n", $result_str);
		echo "$result\n";
	}
	if (isset($result_int))
	{
		sort($result_int, SORT_NUMERIC | SORT_FLAG_CASE);
		$result = implode("\n", $result_int);
		echo "$result\n";
	}
	if (isset($result_end))
	{
		sort($result_end, SORT_FLAG_CASE | SORT_NATURAL);
		$result = implode("\n", $result_end);
		echo "$result\n";
	}
}
else
	echo "";
?>
