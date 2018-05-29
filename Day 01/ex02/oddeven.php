#!/usr/bin/php
<?php

	function ispair($c)
	{
		echo "Le chiffre $c est Pair\n";
	}

	function isimpair($c)
	{
		echo "Le chiffre $c est Impair\n";
	}

	function notInt($c)
	{
		echo "'$c' n'est pas un chiffre\n";
	}

	$stdin = fopen('php://stdin', 'r');
	while ($stdin)
	{
		echo "Entrez un nombre: ";
		$l = fgets(STDIN);
		if ($l == NULL)
			break ;
		$line = str_replace("\n", "", $l);
		if (is_numeric($line))
			($line % 2 == 0) ? ispair(intval($line)) : isimpair(intval($line));
		else
			notInt($line);
	}

?>
