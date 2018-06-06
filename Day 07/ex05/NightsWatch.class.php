<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 9:41 PM
 */

class NightsWatch implements IFighter
{
    private $recruit;

    function recruit($recruit)
    {
        $this->recruit[] = $recruit;
    }

    function fight()
    {
        foreach ($this->recruit as $recruit)
            if (method_exists($recruit, 'fight'))
                $recruit->fight();
    }
}