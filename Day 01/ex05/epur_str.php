#!/usr/bin/php
<?php

	$result = "";
	if (count($argv) == 2)
		$result = implode(" ", array_filter(preg_split('/\s+/', $argv[1])));
	echo "$result\n";
?>
