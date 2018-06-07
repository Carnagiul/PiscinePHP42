<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 3:03 PM
 */

function	collide($ship, $x, $y)
{
	global $map;

	if ($ship->getOrientation() == Orientation::NORD || $ship->getOrientation() == Orientation::SUD)
	{
		for ($i = 0; $i < $ship->getWidth(); $i++)
			for ($j = 0; $j < $ship->getHeight(); $j++)
			{
				if (($x + $i - intval($ship->getWidth() / 2)) < 0 ||
					($y + $j - intval($ship->getHeight() / 2)) < 0)
					return (true);
				$c = $map->getMap()[($x + $i - intval($ship->getWidth() / 2))][($y + $j - intval($ship->getHeight() / 2))];
				if ($c != 0 && $c != $ship->getId())
					return (true);
			}
	}
	else
	{
		for ($i = 0; $i < $ship->getHeight(); $i++)
			for ($j = 0; $j < $ship->getWidth(); $j++)
			{
				if (($x + $i - intval($ship->getHeight() / 2)) < 0 ||
					($y + $j - intval($ship->getWidth() / 2)) < 0)
					return (true);
				$c = $map->getMap()[($x + $i - intval($ship->getHeight() / 2))][($y + $j - intval($ship->getWidth() / 2))];
				if ($c != 0 && $c != $ship->getId())
					return (true);
			}
	}
	return (false);
}

if ($_SESSION["PlayerTurn"] == 1)
    $ship = $_SESSION["Vessel_P1"][$_SESSION["Vessel_P1_get"]];
if ($_SESSION["PlayerTurn"] == 2)
    $ship = $_SESSION["Vessel_P2"][$_SESSION["Vessel_P2_get"]];


$speed = 100;

$diff_x = abs($ship->getPosX() - $_GET["x"]);
$diff_y = abs($ship->getPosY() - $_GET["y"]);

if ($diff_x + $diff_y <= $speed)
{
	if (($diff_x < $diff_y || !$diff_y) && $diff_x)
	{
		$a = ($_GET["y"] - $ship->getPosY()) / ($_GET["x"] - $ship->getPosX());
		$b = $ship->getPosY() - $a * $ship->getPosX();
		$move = ($_GET["x"] - $ship->getPosX()) / $diff_x;
		for ($x = $ship->getPosX(); $x != $_GET["x"] + $move; $x += $move)
		{
			$y = $a * $x + $b;
			if (collide($ship, $x, $y) == false)
			{
				$ship->setPosX($x);
				$ship->setPosY($y);
			}
			else
				break ;
		}
	}
	else if (!$diff_x && $diff_y)
	{
		$a = ($_GET["x"] - $ship->getPosX()) / ($_GET["y"] - $ship->getPosY());
		$b = $ship->getPosX() - $a * $ship->getPosY();
		$move = ($_GET["y"] - $ship->getPosY()) / $diff_y;
		for ($y = $ship->getPosY(); $y != $_GET["y"] + $move; $y += $move)
		{
			$x = $a * $y + $b;
			if (collide($ship, $x, $y) == false)
			{
				$ship->setPosX($x);
				$ship->setPosY($y);
			}
			else
				break ;
		}
	}

	if ($_SESSION["PlayerTurn"] == 1)
	    $_SESSION["Vessel_P1"][$_SESSION["Vessel_P1_get"]] = $ship;
	if ($_SESSION["PlayerTurn"] == 2)
	    $_SESSION["Vessel_P2"][$_SESSION["Vessel_P2_get"]] = $ship;

}
