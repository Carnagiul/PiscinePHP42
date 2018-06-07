<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 3:59 PM
 */

if ($ship != NULL && $ship instanceof Ship)
{
    echo "test 0 ". PHP_EOL;
    $tpl->setFileName('ordre');
    echo "test 1 ". PHP_EOL;
    $tpl->addData("moved", ($ship->getHasMove() != 0) ? "hidden" : "");
    echo "test 2 ". PHP_EOL;
    $tpl->addData("PP_Total", $ship->getPuissanceDispo());
    echo "test 3 ". PHP_EOL;
    echo $tpl->construire();
}