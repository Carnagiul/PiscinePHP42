<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 11:56 AM
 */

require_once ('Class/Orientation.class.php');
require_once ('Class/Arms.class.php');
require_once ('Class/Entity.traits.php');
require_once ('Class/Ship.class.php');
require_once ('Class/Map.class.php');
require_once ('Class/Tpl.class.php');

function create_arm0()
{
    $arm = new Arms();
    $arm->setName("Laser");
    $arm->setId(1);
    $arm->setArmsType(Arms::laser);
    $arm->setDmgLong(5);
    $arm->setDmgMedium(7);
    $arm->setDmgShort(9);
    $arm->setLongRang(80);
    $arm->setMediumRange(50);
    $arm->setShortRange(20);
    $arm->setNeedSleep(0);
    $arm->setReloadDuration(0);
    $arm->setReload(0);
    return $arm;
}

function create_arm1()
{
    $arm = new Arms();
    $arm->setName("Missil");
    $arm->setId(2);
    $arm->setArmsType(Arms::missil);
    $arm->setDmgLong(5);
    $arm->setDmgMedium(7);
    $arm->setDmgShort(9);
    $arm->setLongRang(80);
    $arm->setMediumRange(50);
    $arm->setShortRange(20);
    $arm->setNeedSleep(0);
    $arm->setReloadDuration(0);
    $arm->setReload(0);
    return $arm;
}

function create_arm2()
{
    $arm = new Arms();
    $arm->setName("Laser 2");
    $arm->setId(3);
    $arm->setArmsType(Arms::laser);
    $arm->setDmgLong(5);
    $arm->setDmgMedium(7);
    $arm->setDmgShort(9);
    $arm->setLongRang(80);
    $arm->setMediumRange(50);
    $arm->setShortRange(20);
    $arm->setNeedSleep(0);
    $arm->setReloadDuration(0);
    $arm->setReload(0);
    return $arm;
}

$map = new Map(150, 100);
$map2 = new Map(150, 100);
$tpl = new Tpl();

$laser = create_arm0();
$laser2 = create_arm2();
$missil = create_arm1();

session_start();

if (isset($_GET['reset']) && $_GET['reset'] == "ouijereset")
    unset($_SESSION["Turn"]);

if ($_SESSION["Turn"] == 0 || !(isset($_SESSION["Turn"])))
{
    $_SESSION["Vessel_P1"] = array(new Ship(1), new Ship(2));
    $_SESSION["Vessel_P2"] = array(new Ship(3), new Ship(4));
    if (isset($_SESSION["Vessel_P1"]))
    {
        for ($i = 0; isset($_SESSION["Vessel_P1"][$i]); $i++)
            $_SESSION["Vessel_P1"][$i]->addArms($laser);
    }
    if (isset($_SESSION["Vessel_P2"]))
    {
        for ($i = 0; isset($_SESSION["Vessel_P2"][$i]); $i++)
            $_SESSION["Vessel_P2"][$i]->addArms($missil);
    }
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


if (isset($_SESSION["Vessel_P1"]))
{
    for ($i = 0; isset($_SESSION["Vessel_P1"][$i]); $i++)
        $map2->place_objet($_SESSION["Vessel_P1"][$i]);
}
if (isset($_SESSION["Vessel_P2"]))
{
    for ($i = 0; isset($_SESSION["Vessel_P2"][$i]); $i++)
        $map2->place_objet($_SESSION["Vessel_P2"][$i]);
}
$data = $map2->getMap();

$real_map = "<table>";
for ($i = 0; $i < 150; $i++)
{
    $real_map .= "<tr>";
    for ($j = 0; $j < 100; $j++)
        $real_map .= "<td class='" . $i . "_" . $j . "'>" . $data[$i][$j] . "</td>";
    $real_map .= "</tr>";
}
echo $real_map;



