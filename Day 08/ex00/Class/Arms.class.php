<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 8:27 PM
 */

class Arms
{
    private $id;
    private $name;
    private $short_range;
    private $medium_range;
    private $long_rang;
    private $dmg_short;
    private $dmg_medium;
    private $dmg_long;
    private $reload_duration;
    private $reload;
    private $arms_type;
    private $need_sleep;
    private $shoot_type;

    const   laser = 1;
    const   missil = 2;
    const   explode = 3;
    const   cone = 4;

    const   north = 1;
    const   east = 2;
    const   south = 3;
    const   west = 4;

    public function getNeedSleep(): bool
    {
        return $this->need_sleep;
    }

    public function setNeedSleep(bool $need_sleep)
    {
        $this->need_sleep = $need_sleep;
    }

    public function getArmsType(): int
    {
        return $this->arms_type;
    }

    public function setArmsType(int $arms_type)
    {
        if ($arms_type >= self::laser && $arms_type <= self::cone)
            $this->arms_type = $arms_type;
    }

    /**
     * @return int
     */
    public function getReload(): int
    {
        return $this->reload;
    }

    /**
     * @param int $reload
     */
    public function setReload(int $reload)
    {
        $this->reload = $reload;
    }

    /**
     * @return int
     */
    public function getReloadDuration(): int
    {
        return $this->reload_duration;
    }

    /**
     * @param int $reload_duration
     */
    public function setReloadDuration(int $reload_duration)
    {
        $this->reload_duration = $reload_duration;
    }

    /**
     * @return int
     */
    public function getDmgLong(): int
    {
        return $this->dmg_long;
    }

    /**
     * @param int $dmg_long
     */
    public function setDmgLong(int $dmg_long)
    {
        $this->dmg_long = $dmg_long;
    }

    /**
     * @return int
     */
    public function getDmgMedium(): int
    {
        return $this->dmg_medium;
    }

    /**
     * @param int $dmg_medium
     */
    public function setDmgMedium(int $dmg_medium)
    {
        $this->dmg_medium = $dmg_medium;
    }

    /**
     * @return int
     */
    public function getDmgShort(): int
    {
        return $this->dmg_short;
    }

    /**
     * @param int $dmg_short
     */
    public function setDmgShort(int $dmg_short)
    {
        $this->dmg_short = $dmg_short;
    }

    /**
     * @return int
     */
    public function getMediumRange(): int
    {
        return $this->medium_range;
    }

    /**
     * @param int $medium_range
     */
    public function setMediumRange(int $medium_range)
    {
        $this->medium_range = $medium_range;
    }

    /**
     * @return int
     */
    public function getLongRang(): int
    {
        return $this->long_rang;
    }

    /**
     * @param int $long_rang
     */
    public function setLongRang(int $long_rang)
    {
        $this->long_rang = $long_rang;
    }

    /**
     * @return int
     */
    public function getShortRange(): int
    {
        return $this->short_range;
    }

    /**
     * @param int $short_range
     */
    public function setShortRange(int $short_range)
    {
        $this->short_range = $short_range;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getShootType(): int
    {
        return $this->shoot_type;
    }

    /**
     * @param mixed $shoot_type
     */
    public function setShootType(int $shoot_type)
    {
        if ($shoot_type >= self::north && $shoot_type <= self::west)
            $this->shoot_type = $shoot_type;
    }

}