<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 5:41 PM
 */

if (isset($_POST["action"]) && $_POST["action"] == "move" && isset($_POST["x"]) && isset($_POST["y"]))
    include ("modules/move.php");
if (isset($_POST["action"]) && $_POST["action"] == "shoot" && isset($_POST["x"]) && isset($_POST["y"]))
    include ("modules/shoot.php");

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
else {
    if ($ship instanceof Ship && $ship->getCanOrder() == 1) {
        $k = 0;
        $k2 = 0;
        for ($k = 0; $k < $motor; $k++)
            $k2 += rand(0, 6);
        $ship->setManoeuvre($ship->getMinManoeuvre() + $k2);
        $k2 = 0;
        for ($k = 0; $k < $shield; $k++)
            $k2 += rand(0, 6);
        $ship->setActualShield($ship->getMaxSheild() + $k2);
        $k2 = 0;
        for ($k = 0; $k < $repair; $k++)
            $k2 += rand(0, 6);
        $ship->setActualHealth($ship->getActualHealth() + $k2);
        if ($ship->getActualHealth() > $ship->getMaxHealth())
            $ship->setActualHealth($ship->getMaxHealth());
        $ship->setBonusShoot($shoot);
        $ship->setCanOrder(0);
        $ship->updateOrder();
    }
    $tpl->setFileName('move');
    $tpl->addData("min_x_move", $ship->getPosX() - $ship->getManoeuvre());
    $tpl->addData("max_x_move", $ship->getPosX() + $ship->getManoeuvre());
    $tpl->addData("pos_x_move", $ship->getPosX());
    $tpl->addData("pos_y_move", $ship->getPosY());
    $tpl->addData("min_y_move", $ship->getPosY() - $ship->getManoeuvre());
    $tpl->addData("max_y_move", $ship->getPosY() + $ship->getManoeuvre());
    $page2 = "";
    $page2 .= $tpl->construire();
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
    $page2 .= $tpl->construire();
    $tpl->addData("other_page", $page2);
}


