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
    private $arms;
    private $canOrder;
    private $canShoot;
    private $vessel_id;

    public function __construct(int $id)
    {
        $this->init_from_sql($id);
    }

    public function update_shoot_chance(int $chance)
    {
        global $sql;

        $sql->Update("UPDATE `fight` SET `vessel_chance` = '".$chance."' WHERE `fight`.`id` = '".$this->getVesselId()."';");

    }

    public function updateHealth(int $health)
    {
        global $sql;

        $sql->Update("UPDATE `fight` SET `vessel_health` = '".$health."' WHERE `fight`.`id` = '".$this->getVesselId()."';");
    }

    public function updateShield(int $health)
    {
        global $sql;

        $sql->Update("UPDATE `fight` SET `vessel_shield` = '".$health."' WHERE `fight`.`id` = '".$this->getVesselId()."';");
    }

    public function updateOrder()
    {
        global $sql;

        $sql->Update("UPDATE `fight` SET `vessel_power` = '".$this->getCanOrder()."' WHERE `fight`.`id` = '".$this->getVesselId()."';");
    }

    public function updateTurnId(int $id)
    {
        global $sql;

        $sql->Update("UPDATE `fight` SET `vessel_turn` = '$id' WHERE `fight`.`id` = '".$this->getVesselId()."';");
    }

    public function updateTurn()
    {
        global $sql;

        $sql->Update("UPDATE `fight` SET `vessel_power` = '1' WHERE `fight`.`id` = '" . $this->getVesselId() . "';");
        $sql->Update("UPDATE `fight` SET `vessel_played` = '0' WHERE `fight`.`id` = '" . $this->getVesselId() . "';");
        $sql->Update("UPDATE `fight` SET `vessel_shoot` = '1'  WHERE `fight`.`id` = '" . $this->getVesselId() . "';");
    }

    public function spawn_shipAt(int $x, int $y, int $player, int $game_id)
    {
        global $sql;

        $sql->Update("INSERT INTO `fight` (`id`, `vessel_id`, `vessel_health`, `vessel_shield`, `vessel_turn`, `vessel_posx`, `vessel_posy`, `vessel_power`, `vessel_shoot`, `vessel_owner`, `vessel_played`, `vessel_move`, `vessel_chance`, `game_id`) VALUES (NULL, '" . $this->getId() . "', '" . $this->getMaxHealth() . "', '" . $this->getMaxSheild() . "', '0', '$x', '$y', '1', '1', '$player', '1', '" . $this->getMinManoeuvre() . "', '0', '$game_id');");
    }

    public function updateMove(int $move)
    {
        global $sql;

        $sql->Update("UPDATE `fight` SET `vessel_move` = '$move' WHERE `fight`.`id` = '" . $this->getVesselId() . "';");
    }

    public function updatePos(int $x, int $y)
    {
        global $sql;

        $sql->Update("UPDATE `fight` SET `vessel_posx` = '$x' WHERE `fight`.`id` = '" . $this->getVesselId() . "';");
        $sql->Update("UPDATE `fight` SET `vessel_posy` = '$y' WHERE `fight`.`id` = '" . $this->getVesselId() . "';");
    }

    public function load_from_sql(int $id)
    {
        global $sql;

        $data = $sql->select("SELECT * FROM `fight` WHERE `id`=$id");
        $this->setPosY($data['vessel_posx']);
        $this->setPosX($data['vessel_posy']);
        $this->setActualHealth($data['vessel_health']);
        $this->setActualShield($data['vessel_shield']);
        $this->setCanShoot($data['vessel_shoot']);
        $this->setCanOrder($data['vessel_power']);
        $this->setManoeuvre($data['vessel_move']);
        $this->setBonusShoot($data['vessel_chance']);
        $this->setVesselId($id);
    }

    public function init_from_sql(int $id)
    {
        global $sql;

        $data = $sql->select("SELECT * FROM `vessel` WHERE `id`='" . $id . "'");
        if (isset($data))
        {
            $this->setName($data['name']);
            $this->setId($id);
            $this->setWidth($data['width']);
            $this->setHeight($data['height']);
            $this->setMaxHealth($data['max_health']);
            $this->setMaxSheild($data['max_shield']);
            $this->setActualHealth($data['max_health']);
            $this->setActualShield($data['max_shield']);
            $this->setImg($data['tile']);
            $this->setMinManoeuvre($data['move']);
            $this->setPower($data['power']);
            $this->setPosY($data['posY']);
            $this->setPosX($data['posX']);
            $this->setCanOrder(1);
            $this->setCanShoot(1);
            $this->setOrientation(new Orientation(Orientation::NORD));
            $data_arms = explode(";", $data['Arms']);
            for ($i = 0; isset($data_arms[$i]); $i++)
                $this->addArms(new Arms($data_arms[$i]));

        }
    }

    public function addArms(Arms $arms)
    {
        $this->arms[] = $arms;
    }

    /**
     * @return mixed
     */
    public function getArms()
    {
        return $this->arms;
    }

    /**
     * @param mixed $arms
     */
    public function setArms($arms)
    {
        $this->arms = $arms;
    }

    /**
     * @return mixed
     */
    public function getCanOrder(): int
    {
        return $this->canOrder;
    }

    /**
     * @param mixed $canOrder
     */
    public function setCanOrder(int $canOrder)
    {
        $this->canOrder = $canOrder;
    }

    /**
     * @return mixed
     */
    public function getCanShoot()
    {
        return $this->canShoot;
    }

    /**
     * @param mixed $canShoot
     */
    public function setCanShoot($canShoot)
    {
        $this->canShoot = $canShoot;
    }

    /**
     * @return mixed
     */
    public function getVesselId()
    {
        return $this->vessel_id;
    }

    /**
     * @param mixed $vessel_id
     */
    public function setVesselId($vessel_id)
    {
        $this->vessel_id = $vessel_id;
    }

    public static function doc()
    {
        return (file_get_contents("docs/Ship.doc.txt"));
    }
}