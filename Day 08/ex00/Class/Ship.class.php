<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 11:54 AM
 */

class Ship
{
    use Entity;

    public function __construct(int $id)
    {
        if ($id == 1)
        {
            $this->setId($id);
            $this->setName("Vessel 1");
            $this->setWidth(3);
            $this->setHeight(1);
            $this->setMaxHealth(10);
            $this->setMaxSheild(10);
            $this->setActualHealth(10);
            $this->setActualShield(10);
            $this->setOrientation(new Orientation(Orientation::NORD));
            $this->setImg("none");
            $this->setPosX(4);
            $this->setPosY(4);
        }
        if ($id == 2)
        {
            $this->setId($id);
            $this->setName("Vessel 2");
            $this->setWidth(3);
            $this->setHeight(2);
            $this->setMaxHealth(10);
            $this->setMaxSheild(10);
            $this->setActualHealth(10);
            $this->setActualShield(10);
            $this->setOrientation(new Orientation(Orientation::EST));
            $this->setImg("none");
            $this->setPosX(10);
            $this->setPosY(10);
        }
        if ($id == 3)
        {
            $this->setId($id);
            $this->setName("Vessel 1");
            $this->setWidth(3);
            $this->setHeight(1);
            $this->setMaxHealth(10);
            $this->setMaxSheild(10);
            $this->setActualHealth(10);
            $this->setActualShield(10);
            $this->setOrientation(new Orientation(Orientation::NORD));
            $this->setImg("none");
            $this->setPosX(140);
            $this->setPosY(90);
        }
        if ($id == 4)
        {
            $this->setId($id);
            $this->setName("Vessel 2");
            $this->setWidth(3);
            $this->setHeight(2);
            $this->setMaxHealth(10);
            $this->setMaxSheild(10);
            $this->setActualHealth(10);
            $this->setActualShield(10);
            $this->setOrientation(new Orientation(Orientation::EST));
            $this->setImg("none");
            $this->setPosX(135);
            $this->setPosY(85);
        }
    }
}