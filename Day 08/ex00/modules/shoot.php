<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 3:02 PM
 */

function	shoot_collide($ship, $x, $y, $data)
{
    global $map;

    $i = 0;
    $j = 0;
    for ($i = 0; $i < $data; $i++) {
        for ($j = 0; $j < $data; $j++) {
            if (($x + $i) < 0 ||
                ($y + $j) < 0)
                return (true);
            if (($x + $i) > 100 ||
                ($y + $j) > 100)
                return (true);
            $c = $map->getValueAt($x + $i, $y + $j);
            if (!($c == 0 || $c == (1 + ($ship->getVesselId() % 4))))
                return (true);
        }
    }
    $c = $map->getValueAt($x + $i, $y + $j);
    if (!($c == 0 || $c == (1 + ($ship->getVesselId() % 4))))
        return (true);
    return (false);
}

function plotLine($x0, $y0, $x1, $y1)
{
    global $map2;
    global $map;
    global $ship;
    global $debug;

    $xDist = abs($x1 - $x0);
    $yDist = -abs($y1 - $y0);
    if($x0 < $x1)
        $xStep = 1;
    else
        $xStep = -1;

    if($y0 < $y1)
        $yStep = 1;
    else
        $yStep = -1;

    $plotError = $xDist + $yDist;

    while($x0 != $x1 || $y0 != $y1) {
        if(2 * $plotError - $yDist > $xDist - 2 * $plotError) {
            $plotError += $yDist;
            $x0 += $xStep;
        } else {
            $plotError += $xDist;
            $y0 += $yStep;
        }
        if ($debug)
            echo "<pre>" . $map->getValueAt($x0, $y0) . " :: " . $ship->getVesselId() . "</pre>";
        if (shoot_collide($ship, $x0, $y0, 0) == false)
            $map2->setValueAt($x0, $y0, "Preview");
        else
            break ;
    }
}

if ($debug)
    echo "<pre>Ship is aiming</pre><br />";
if (isset($_POST["submit"]) && $_POST["submit"] == "Preview")
{

    if ($debug)
        echo "<pre>Ship finding target</pre><br />";
    if ($ship instanceof Ship)
    {
        $arm = NULL;
        $id = $_POST["Arms"];
        foreach ($ship->getArms() as $arms)
            if ($arms->getId() == $id)
                $arm = $arms;
        if (isset($arm) && $arm instanceof Arms)
        {
            if (isset($_POST["x"]) && isset($_POST["y"]))
            {
                if ($debug)
                    echo "<pre>Print Laser Path</pre><br />";
                plotLine($ship->getPosX(), $ship->getPosY(), $_POST["x"], $_POST["y"]);
            }
        }
    }
}