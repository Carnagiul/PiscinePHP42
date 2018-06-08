<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 11:56 AM
 */

require_once ('Class/Sql.class.php');
require_once ('Class/Game.class.php');
require_once ('Class/Orientation.class.php');
require_once ('Class/Arms.class.php');
require_once ('Class/Entity.traits.php');
require_once ('Class/Ship.class.php');
require_once ('Class/Map.class.php');
require_once ('Class/Tpl.class.php');

$debug = true;

$sql = new Sql();
$sql->connect();

$map = new Map(150, 100);
$map2 = new Map(150, 100);
$tpl = new Tpl();

if ($debug)
    echo "<pre>Page initilized</pre><br />";

$tpl->addData("other_page", "");

session_start();

if ($debug)
    echo "<pre>Session start</pre><br />";

if (isset($_GET['reset']) && $_GET['reset'] == "ouijereset")
    unset($_SESSION["Turn"]);

if ($_SESSION["Turn"] == 0 || !(isset($_SESSION["Turn"])))
{
    $sql->Update("DELETE FROM `fight`");
    $sql->Update("DELETE FROM `game`");
    $new_ship = new Ship(1);

    $new_ship->spawn_shipAt(2, 2, 1, 1);
    $new_ship->spawn_shipAt(25, 25, 2, 1);
    $new_ship->spawn_shipAt(50, 50, 3, 1);
    $new_ship->spawn_shipAt(70, 70, 4, 1);
    $sql->Update("INSERT INTO `game` (`id`, `user1_id`, `user2_id`, `user3_id`, `user4_id`, `vessel_user1`, `vessel_user2`, `vessel_user3`, `vessel_user4`, `turn`, `player`) VALUES
(1, 1, 2, 3, 4, '1', '2', '3', '4', '1', '1');");

    $_SESSION["Turn"] = 1;
}

if ($debug)
    echo "<pre>Game start</pre><br />";

$game = new Game();
$game->setMaxPlayer(4);
$game->load_from_db(1);

$map->placeShips($game->getId());

$ship = NULL;

$ship_data = NULL;
$count_row = 0;


if ($debug)
    echo "<pre>Ship placed on map</pre><br />";

$ship_data = $sql->select("SELECT * FROM `fight` WHERE `game_id`='" . $game->getId() . "' AND `vessel_owner`='" . $game->getPlayer() . "' AND `vessel_played`='1' LIMIT 1");
while (!($ship_data))
{
    if (!($ship_data))
        $game->endMyTurn();
    $count_row++;
    $ship_data = $sql->select("SELECT * FROM `fight` WHERE `game_id`='" . $game->getId() . "' AND `vessel_owner`='" . $game->getPlayer() . "' AND `vessel_played`='1' LIMIT 1");
    if ($count_row >= $game->getMaxPlayer())
        die("Fin de la partie, Try again soon");
}

if ($debug)
    echo "<pre>Ship get on db</pre><br />";

$ship = new Ship($ship_data['vessel_id']);
$ship->load_from_sql($ship_data['id']);

if ($debug)
    echo "<pre>Ship loaded on db</pre><br />";


if ($debug)
    echo "<pre>Ship set and prepare page</pre><br />";

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


if ($debug)
    echo "<pre>page Load</pre><br />";


$tpl->setFileName('test');
$tpl->addData("turn", $game->getTurn());
$tpl->addData("player", $game->getPlayer());
$tpl->addData("vessel", $ship->getVesselId());
$tpl->addData("title", $tpl->construire());

$map2->placeShips($game->getId());

$data = $map2->getMap();

$real_map = "<table border='1'>";
for ($i = 0; $i < 150; $i++)
{
    $real_map .= "<tr>";
    for ($j = 0; $j < 100; $j++)
        $real_map .= "<td class='" . $i . "_" . $j . " object_" . $data[$i][$j] . "'>&nbsp;</td>";
    $real_map .= "</tr>";
}

$tpl->setFileName('header');
$tpl->addData('page', $real_map);
echo $tpl->construire();



if ($debug)
    echo "<pre>Page printed</pre><br />";
