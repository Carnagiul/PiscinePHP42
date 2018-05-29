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
	sort($result);
	$result = implode("\n", $result);
	echo "$result\n";
}
else
	echo "";
?>
