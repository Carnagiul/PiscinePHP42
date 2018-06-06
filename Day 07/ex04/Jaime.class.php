<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 9:40 PM
 */

class Jaime
{
    function sleepWith($a)
    {
        if ($a instanceof Tyrion)
            print ("Not even if I'm drunk !" . PHP_EOL);
        if ($a instanceof Sansa)
            print ("Let's do this." . PHP_EOL);
        if ($a instanceof Cersei)
            print ("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
    }
}