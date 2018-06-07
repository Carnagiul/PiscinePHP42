<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 12:00 PM
 */

class Map
{
    private $map;

    public function __construct(int $x, int $y)
    {
        for ($i = 0; $i < $x; $i++)
            for ($j = 0; $j < $y; $j++)
                $this->map[$i][$j] = 0;
        $this->generate_obstacle(12, 16,11, 13);
        $this->generate_obstacle(96, 109,66, 69);
        $this->generate_obstacle(31, 32,31, 31);
    }

    public function generate_obstacle(int $xmin, int $xmax, int $ymin, int $ymax)
    {
        for ($x = $xmin; $x <= $xmax; $x++)
            for ($y = $ymin; $y <= $ymax; $y++)
                $this->map[$x][$y] = -1;
    }

    public function place_objet(Ship $ship)
    {
        if (($ship->getOrientation()->getConst() == Orientation::NORD) || ($ship->getOrientation()->getConst() == Orientation::SUD))
        {
            for ($x = $ship->getPosX() - intval($ship->getWidth() / 2); $x <= $ship->getPosX() + intval($ship->getWidth() / 2); $x++)
                for ($y = $ship->getPosY() - intval($ship->getHeight() / 2); $y <= $ship->getPosY() + intval($ship->getHeight() / 2); $y++)
                {
                    $this->map[$x][$y] = $ship->getId();
                }
        }
        if (($ship->getOrientation()->getConst() == Orientation::EST) || ($ship->getOrientation()->getConst() == Orientation::OUEST))
        {
            for ($x = $ship->getPosX() - ($ship->getHeight() / 2); $x < $ship->getPosX() + ($ship->getHeight() / 2); $x++)
                for ($y = $ship->getPosY() - ($ship->getWidth() / 2); $y < $ship->getPosY() + ($ship->getWidth() / 2); $y++)
                    $this->map[intval($x)][intval($y)] = $ship->getId();
        }
    }

    public function getMap()
    {
        return ($this->map);
    }
}