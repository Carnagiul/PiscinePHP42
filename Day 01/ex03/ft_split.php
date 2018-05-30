#!/usr/bin/php
<?php
	function ft_split($array)
	{
		$explode = preg_split('/\s+/', $array);
		if ($explode)
			sort($explode);
		return ($explode);
	}
?>
