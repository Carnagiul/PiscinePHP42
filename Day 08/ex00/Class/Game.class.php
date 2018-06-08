<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/8/18
 * Time: 7:22 PM
 */

class Game
{
    private $id;
    private $turn;
    private $user_1;
    private $user_2;
    private $user_3;
    private $user_4;
    private $player;
    private $max_player;

    public function load_from_db(int $id)
    {
        global $sql;

        $data = $sql->select("SELECT * FROM `game` WHERE `id`='$id'");
        $this->setTurn($data['turn']);
        $this->setId($id);
        $this->setPlayer($data['player']);
    }

    public function endMyTurn()
    {
        global $sql;

        $this->setPlayer($this->getPlayer() + 1);
        if ($this->getPlayer() > $this->getMaxPlayer())
            $this->setPlayer(1);
        $ret = $sql->select_array("SELECT * FROM `fight` WHERE `game_id`='" . $this->getId() . "' AND `vessel_played`='1'");
        if (!(isset($ret[0])))
        {
            $sql->Update("UPDATE `fight` SET `vessel_played`=1 WHERE `game_id`='".$this->getId()."';");
            $this->setTurn($this->getTurn() + 1);
        }
        $sql->Update("UPDATE `game` SET `player` = '".$this->getPlayer()."' WHERE `game`.`id` ='".$this->getId()."';");
        $sql->Update("UPDATE `game` SET `turn` = '".$this->getTurn()."' WHERE `game`.`id` ='".$this->getId()."';");
    }

    /**
     * @return mixed
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @param mixed $turn
     */
    public function setTurn($turn)
    {
        $this->turn = $turn;
    }

    /**
     * @return mixed
     */
    public function getUser1()
    {
        return $this->user_1;
    }

    /**
     * @param mixed $user_1
     */
    public function setUser1($user_1)
    {
        $this->user_1 = $user_1;
    }

    /**
     * @return mixed
     */
    public function getUser2()
    {
        return $this->user_2;
    }

    /**
     * @param mixed $user_2
     */
    public function setUser2($user_2)
    {
        $this->user_2 = $user_2;
    }

    /**
     * @return mixed
     */
    public function getUser3()
    {
        return $this->user_3;
    }

    /**
     * @param mixed $user_3
     */
    public function setUser3($user_3)
    {
        $this->user_3 = $user_3;
    }

    /**
     * @return mixed
     */
    public function getUser4()
    {
        return $this->user_4;
    }

    /**
     * @param mixed $user_4
     */
    public function setUser4($user_4)
    {
        $this->user_4 = $user_4;
    }

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    /**
     * @return mixed
     */
    public function getMaxPlayer()
    {
        return $this->max_player;
    }

    /**
     * @param mixed $max_player
     */
    public function setMaxPlayer($max_player)
    {
        $this->max_player = $max_player;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}