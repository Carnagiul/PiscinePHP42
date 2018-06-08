<?php

$ship->updateMove($ship->getMinManoeuvre());
$ship->updateTurn();
$game->endMyTurn();

$ship_data = NULL;
while (!($ship_data))
{
    $ship_data = $sql->select("SELECT * FROM `fight` WHERE `game_id`='" . $game->getId() . "' AND `vessel_owner`='" . $game->getPlayer() . "' AND `vessel_played`='1' LIMIT 1");
    if (!($ship_data))
        $game->endMyTurn();
    $count_row++;
    if ($count_row >= $game->getMaxPlayer())
        die("Fin de la partie, Try again soon");
}

if ($debug)
    echo "<pre>Ship get on db</pre><br />";

$ship = new Ship($ship_data['vessel_id']);
$ship->load_from_sql($ship_data['id']);