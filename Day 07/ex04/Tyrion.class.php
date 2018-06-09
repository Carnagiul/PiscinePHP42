<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 9:38 PM
 */

class Tyrion
{
    function sleepWith($a)
    {
        if ($a instanceof Cersei || $a instanceof Jaime)
            print ("Not even if I'm drunk !" . PHP_EOL);
        if ($a instanceof Sansa)
            print ("Let's do this." . PHP_EOL);
    }
}