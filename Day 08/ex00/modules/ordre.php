<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 3:59 PM
 */

echo "test3" . PHP_EOL;
if ($ship != NULL)
{
    $tpl->tpl_setpage('ordre');
    echo "test 4" . PHP_EOL;
    $tpl->tpl_add_data("moved", ($ship->getHasMove() != 0) ? "hidden" : "");
    echo "test 5" . PHP_EOL;
    $tpl->tpl_add_data("PP_MAX", $ship->getPuissanceDispo());
    echo "test 6" . PHP_EOL;
    echo $tpl->tpl_construire();
    echo "test 7" . PHP_EOL;
}
