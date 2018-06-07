<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 5:41 PM
 */

if (isset($_POST["action"]) && $_POST["action"] == "move" && isset($_POST["x"]) && isset($_POST["y"]))
    include ("modules/move.php");

$motor = 0;
$shield = 0;
$shoot = 0;
$repair = 0;
if (isset($_POST["motor"]))
    $motor = (intval($_POST["motor"]) < 0) ? 0 : intval($_POST["motor"]);
if (isset($_POST["motor"]))
    $shield = (intval($_POST["shield"]) < 0) ? 0 : intval($_POST["shield"]);
if (isset($_POST["motor"]))
    $shoot = (intval($_POST["shoot"]) < 0) ? 0 : intval($_POST["shoot"]);
if (isset($_POST["repair"]) && $ship->getHasMove() != 0)
    $repair = (intval($_POST["repair"]) < 0) ? 0 : intval($_POST["repair"]);
if ($motor + $shield + $shoot + $repair > $ship->getPower())
{
    include ("modules/ordre.php");
}
else
{
    if ($ship instanceof Ship)
    {
        $ship->setManoeuvre($ship->getManoeuvre() + ($motor * rand(1, 6)));
        $ship->setActualShield($ship->getMaxSheild() + ($shield * rand(1, 6)));
        $ship->setActualHealth($ship->getActualHealth() + ($repair * rand(1, 6)));
        if ($ship->getActualHealth() > $ship->getMaxHealth())
            $ship->setActualHealth($ship->getMaxHealth());
        $ship->setBonusShoot(0 + ($shoot * rand(1, 6)));
    }
    $tpl->setFileName('move');
    $tpl->addData("min_x_move", $ship->getPosX() - $ship->getManoeuvre());
    $tpl->addData("max_x_move", $ship->getPosX() + $ship->getManoeuvre());
    $tpl->addData("pos_x_move", $ship->getPosX());
    $tpl->addData("pos_y_move", $ship->getPosY());
    $tpl->addData("min_y_move", $ship->getPosY() - $ship->getManoeuvre());
    $tpl->addData("max_y_move", $ship->getPosY() + $ship->getManoeuvre());
    echo $tpl->construire();
    $tpl->setFileName('shoot');
    $arms = $ship->getArms();
    $line = "";
    $tpl->setFileName('shoot_option');
    foreach ($arms as $arm)
    {
        if ($arm instanceof Arms)
        {
            $tpl->addData("arm_name", $arm->getName());
            $tpl->addData("arm_id", $arm->getId());
            $line .= $tpl->construire();
        }
    }
    $tpl->setFileName('shoot');
    $tpl->addData("arms", $line);
    echo $tpl->construire();
}

