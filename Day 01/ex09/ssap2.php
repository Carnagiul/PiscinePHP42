#!/usr/bin/php
<?php

$result = NULL;
foreach ($argv as $key => $set)
{
	if ($key > 0)
	{
		$regex = array_filter(preg_split('/\s+/', $set));
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
	sort($result_str, SORT_STRING | SORT_FLAG_CASE);
	sort($result_int, SORT_NUMERIC);
	sort($result_end);
	if (isset($result_str))
	{
		$result = implode("\n", $result_str);
		echo "$result\n";
	}
	if (isset($result_int))
	{
		$result = implode("\n", $result_int);
		echo "$result\n";
	}
	if (isset($result_end))
	{
		$result = implode("\n", $result_end);
		echo "$result\n";
	}
}
else
	echo "";
?>
