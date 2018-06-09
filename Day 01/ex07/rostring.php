#!/usr/bin/php
<?php

$result = NULL;

if (isset($argv[1]))
{
	$regex = array_filter(preg_split('/\s+/', trim($argv[1])));
	foreach ($regex as $r)
		$result[] = $r;
	$result[] = $result[0];
	unset($result[0]);
	$result = implode(" ", $result);
	echo "$result\n";
}
else
	echo "";
?>
