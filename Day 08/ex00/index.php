<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 11:56 AM
 */

require_once ('Class/Orientation.class.php');
require_once ('Class/Entity.traits.php');
require_once ('Class/Ship.class.php');
require_once ('Class/Map.class.php');
require_once ('Class/Tpl.class.php');

$map = new Map(150, 100);
$tpl = new Tpl();

session_start();

if (isset($_GET['reset']) && $_GET['reset'] == "ouijereset")
    $_SESSION["Turn"];

if ($_SESSION["Turn"] == 0 || !(isset($_SESSION["Turn"])))
{
    $_SESSION["Vessel_P1"] = array(new Ship(1), new Ship(2));
    $_SESSION["Vessel_P2"] = array(new Ship(3), new Ship(4));
    $_SESSION["Vessel_P1_get"] = 0;
    $_SESSION["Vessel_P2_get"] = 0;
    $_SESSION['PlayerTurn'] = 1;
    $_SESSION['Turn'] = 1;
}

if (isset($_SESSION["Vessel_P1"]))
{
    for ($i = 0; isset($_SESSION["Vessel_P1"][$i]); $i++)
        $map->place_objet($_SESSION["Vessel_P1"][$i]);
}
if (isset($_SESSION["Vessel_P2"]))
{
    for ($i = 0; isset($_SESSION["Vessel_P2"][$i]); $i++)
        $map->place_objet($_SESSION["Vessel_P2"][$i]);
}

$tpl->setFileName('test');
$tpl->addData("turn", $_SESSION["Turn"]);
$tpl->addData("player", $_SESSION["PlayerTurn"]);
$tpl->addData("vessel", ($_SESSION["PlayerTurn"] == 1) ? $_SESSION["Vessel_P1_get"] : $_SESSION["Vessel_P2_get"]);


echo "<h1>" . $tpl->construire() . "</h1>";

$ship = NULL;

if ($_SESSION["PlayerTurn"] == 1)
    $ship = $_SESSION["Vessel_P1"][$_SESSION["Vessel_P1_get"]];
if ($_SESSION["PlayerTurn"] == 2)
    $ship = $_SESSION["Vessel_P2"][$_SESSION["Vessel_P2_get"]];

if (isset($_GET['mod']))
    $mod = $_GET['mod'];
else
    $mod = $_GET['mod'];

$file = "";

if (file_exists('modules/' . $mod . '.php'))
    $file = $mod;
else
    $file = "home";

include ("modules/" . $file . ".php");


$data = $map->getMap();

$real_map = "<table>";
for ($i = 0; $i < 150; $i++)
{
    $real_map .= "<tr>";
    for ($j = 0; $j < 100; $j++)
        $real_map .= "<td class='" . $i . "_" . $j . "'>" . $data[$i][$j] . "</td>";
    $real_map .= "</tr>";
}
echo $real_map;



