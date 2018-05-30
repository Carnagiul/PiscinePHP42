#!/usr/bin/php
<?php

/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 9:37 AM
 */

function setTimezone($default)
{
	$timezone = "";

	if (is_link("/etc/localtime")) {

		$filename = readlink("/etc/localtime");

		$pos = strpos($filename, "zoneinfo");
		if ($pos) {
			$timezone = substr($filename, $pos + strlen("zoneinfo/"));
		} else {
			$timezone = $default;
		}
	}
	else {

		$timezone = file_get_contents("/etc/timezone");
		if (!strlen($timezone)) {
			$timezone = $default;
		}
	}
	date_default_timezone_set($timezone);
}

setTimezone('UTC');

$file = fopen("/var/run/utmpx", "r");
$binary_size = 628; //Size of Struct
$binary_data = "a256a/a4b/a32c/id/ie/I2f/a256g/i16h"; //Data of struct
while ($read = fread($file, $binary_size))
{
	$data = unpack($binary_data, $read);
	$content[$data['c']] = $data;
}
ksort($content);
foreach ($content as $key  => $value)
{
	if (isset($value["a"]) && isset($value["e"]) && $value["e"] == 7)
		echo $value["a"] . " " . $key . "\t" . date("F d H:i", $value["f1"]) . "\n";
}
?>
