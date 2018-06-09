<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 11:16 AM
 */

trait Entity
{
    private $width;
    private $height;
    private $pos_x;
    private $pos_y;
    private $name;
    private $id;
    private $max_health;
    private $max_sheild;
    private $actual_health;
    private $actual_shield;
    private $orientation;
    private $img;
    private $min_manoeuvre;
    private $manoeuvre;
    private $has_move = 0;
    private $power;
    private $bonus_shoot;

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width)
    {
        $this->width = $width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height)
    {
        $this->height = $height;
    }

    public function getPosX(): int
    {
        return $this->pos_x;
    }

    public function setPosX(int $pos_x)
    {
        $this->pos_x = $pos_x;
    }

    public function getPosY(): int
    {
        return $this->pos_y;
    }

    public function setPosY(int $pos_y)
    {
        $this->pos_y = $pos_y;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getMaxHealth(): int
    {
        return $this->max_health;
    }

    public function setMaxHealth(int $max_health)
    {
        $this->max_health = $max_health;
    }

    public function getMaxSheild():int
    {
        return $this->max_sheild;
    }

    public function setMaxSheild(int $max_sheild)
    {
        $this->max_sheild = $max_sheild;
    }

    public function getActualHealth(): int
    {
        return $this->actual_health;
    }

    public function setActualHealth(int $actual_health)
    {
        $this->actual_health = $actual_health;
    }

    public function getActualShield(): int
    {
        return $this->actual_shield;
    }

    public function setActualShield(int $actual_shield)
    {
        $this->actual_shield = $actual_shield;
    }

    /**
     * @return Orientation
     */
    public function getOrientation(): Orientation
    {
        return $this->orientation;
    }

    /**
     * @param Orientation $orientation
     */
    public function setOrientation(Orientation $orientation)
    {
        $this->orientation = $orientation;
    }

    /**
     * @return string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg(string $img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getMinManoeuvre(): int
    {
        return $this->min_manoeuvre;
    }

    public function setMinManoeuvre(int $min_manoeuvre)
    {
        $this->min_manoeuvre = $min_manoeuvre;
    }

    public function getManoeuvre(): int
    {
        return $this->manoeuvre;
    }

    public function setManoeuvre(int $manoeuvre)
    {
        $this->manoeuvre = $manoeuvre;
    }

    /**
     * @return int
     */
    public function getHasMove(): int
    {
        return $this->has_move;
    }

    /**
     * @param int $has_move
     */
    public function setHasMove(int $has_move)
    {
        $this->has_move = $has_move;
    }

    /**
     * @return int
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param int $power
     */
    public function setPower(int $power)
    {
        $this->power = $power;
    }

    /**
     * @return mixed
     */
    public function getBonusShoot(): int
    {
        return $this->bonus_shoot;
    }

    /**
     * @param mixed $bonus_shoot
     */
    public function setBonusShoot(int $bonus_shoot)
    {
        $this->bonus_shoot = $bonus_shoot;
    }
}