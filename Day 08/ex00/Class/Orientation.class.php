<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 11:49 AM
 */

class Orientation
{
    const NORD = 1;
    const SUD = 2;
    const EST = 3;
    const OUEST = 4;
    private $const;

    public function __construct($const)
    {
        $this->const = $const;
    }

    /**
     * @return int
     */
    public function getConst(): int
    {
        return $this->const;
    }

    /**
     * @param int $const
     */
    public function setConst(int $const)
    {
        if ($const >= 1 && $const <= 4)
            $this->const = $const;
        else
            $this->const = 0;
    }
}