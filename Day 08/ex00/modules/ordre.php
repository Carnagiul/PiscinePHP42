<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 3:59 PM
 */

if ($ship != NULL && $ship instanceof Ship)
{
    $tpl->setFileName('ordre');
    $tpl->addData("moved", ($ship->getHasMove() != 0) ? "hidden" : "");
    $tpl->addData("PPTotal", ($ship->getPower() != 0) ? strval($ship->getPower()) : "0");
    echo $tpl->construire();
}