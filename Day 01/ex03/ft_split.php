#!/usr/bin/php
<?php
	function ft_split($array)
	{
		$explode = explode(" ", $array);
		if ($explode)
			sort($explode);
		return ($explode);
	}
?>
