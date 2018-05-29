<?php

function ft_is_sort($array)
{
	if (is_array($array))
	{
		$tmp = $array;
		sort($tmp);
		if ($tmp == $array)
			return (true);
		return (false);
	}
	else
	{
		return (true);
	}
}

?>
