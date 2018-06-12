<?php
/**
 * Created by PhpStorm.
 * User: Schtroumpfette
 * Date: 12/06/2018
 * Time: 15:59
 */

namespace user;


class user
{
    private $_id;
    private $_name;
    private $_mail;
    private $_pass;
    private $_descr;
    private $_avatar;
    private $_isBanned;
    private $_isActiv;
    private $_lastConnect;
    private $_ip;
    private $_os;
    private $_isAdmin;
    private $_verbose;

    public function __construct($verbose = false)
    {
        $this->setVerbose($verbose);
        if ($this->getVerbose() == false)
            $this->debugVerbrose(0);
    }

    public function __destruct()
    {
        if ($this->getVerbose() == true)
            $this->debugVerbrose(1);
    }

    /**
     * @return mixed
     */
    public function getVerbose(): int
    {
        return $this->_verbose;
    }

    /**
     * @param mixed $verbose
     */
    public function setVerbose(int $verbose): void
    {
        $this->_verbose = $verbose;
    }

    /**
     * @return mixed
     */
    public function getisAdmin(): int
    {
        return $this->_isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin): void
    {
        $this->_isAdmin = $isAdmin;
    }

    /**
     * @return mixed
     */
    public function getOs(): string
    {
        return $this->_os;
    }

    /**
     * @param mixed $os
     */
    public function setOs($os): void
    {
        $this->_os = $os;
    }

    /**
     * @return mixed
     */
    public function getIp(): string
    {
        return $this->_ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip): void
    {
        $this->_ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getLastConnect(): int
    {
        return $this->_lastConnect;
    }

    /**
     * @param mixed $lastConnect
     */
    public function setLastConnect($lastConnect): void
    {
        $this->_lastConnect = $lastConnect;
    }

    /**
     * @return mixed
     */
    public function getisActiv(): int
    {
        return $this->_isActiv;
    }

    /**
     * @param mixed $isActiv
     */
    public function setIsActiv($isActiv): void
    {
        $this->_isActiv = $isActiv;
    }

    /**
     * @return mixed
     */
    public function getAvatar(): string
    {
        return $this->_avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->_avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getisBanned(): int
    {
        return $this->_isBanned;
    }

    /**
     * @param mixed $isBanned
     */
    public function setIsBanned($isBanned): void
    {
        $this->_isBanned = $isBanned;
    }

    /**
     * @return mixed
     */
    public function getDescr(): string
    {
        return $this->_descr;
    }

    /**
     * @param mixed $descr
     */
    public function setDescr($descr): void
    {
        $this->_descr = $descr;
    }

    /**
     * @return mixed
     */
    public function getPass(): string
    {
        return $this->_pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass): void
    {
        $this->_pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getMail(): string
    {
        return $this->_mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->_mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->_id = $id;
    }

    private function debugVerbrose(int $int): void
    {
        print ("User ( ");
        print ("Id:". $this->getId() . ",");
        print ("Name:". $this->getName() . ",");
        print ("Descr:". $this->getDescr() . ",");
        print ("isBanned:". $this->getisBanned() . ",");
        print ("isAdmin:". $this->getisAdmin() . ",");
        print ("isActiv:". $this->getisActiv() . ",");
        print ("LastConnect:". $this->getLastConnect() . ",");
        print ("Os:". $this->getOS() . ",");
        print ("Ip:". $this->getIp());
        if ($int == 1)
            print (") Destruct");
        if ($int  == 0)
            print (") Construct");
    }
}