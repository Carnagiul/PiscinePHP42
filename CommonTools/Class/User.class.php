<?php

class User 
{

	public static $verbose = false;
	private $id;
	private $name;
	private $mail;
	private $pass;
	private $ip;
	private $descr;
	private $avatar;
	private $banni;
	private $reason_ban;
	private $last_connection;

	public function __construct($verbose = false)
	{
		if ($verbose == true)
			$this->verbose = true;
	}

	public function __destruct()
	{
		return ;
	}

	public function is_banni($id)
	{
		global $sql;

		$user = $sql->select("SELECT * FROM users WHERE id='" . intval($id) . "' AND banni='1'");
		if (isset($user))
			return (0);
		return (1);
	}

	public function is_nameExist($name)
	{
		global $sql;

		$user = $sql->select("SELECT * FROM users WHERE name='" . $name . "'");
		if (isset($user))
			return (0);
		return (1);
	}

	public function is_mailExist($mail)
	{
		global $sql;

		$user = $sql->select("SELECT * FROM users WHERE mail='" . $mail . "'");
		if (isset($user))
			return (0);
		if (filter_var($mail, FILTER_VALIDATE_EMAIL))
			return (1);
		return (-1);
	}

	public function createUser($name = NULL, $mail = NULL, $pass = NULL)
	{
		global $sql;

		if (!(isset($name)))
			return ("Error, name is missing");
		if (!(isset($mail)))
			return ("Error, mail is missing");
		if (!(isset($pass)))
			return ("Error, pass is missing");
		if ($this->is_nameExist($name) == 0)
			return ("Error, username is already set");
		if ($this->is_mailExist($mail) <= 0)
			return ("Error, mail is already set");
		if (strcmp($mail, $pass) == 0)
			return ("Error, password to easy");
		if (strcmp($name, $pass) == 0)
			return ("Error, password to easy");
		if (strcmp(strrev($name), $pass) == 0)
			return ("Error, password to easy");
		if (strlen($pass) < 8)
			return ("Error, password to easy");
		$sql->update("INSERT INTO `users` (`id`, `name`, `mail`, `pass`) VALUES (NULL, '" . $name . "', '" . $mail . "', '" . md5($pass) . "');");
		return ("Succes, user succesfully created");
	}

	public function UserExist($id)
	{
		global $sql;

		$user = $sql->select("SELECT * FROM users WHERE id='" . intval($id) . "'");
		if (isset($user))
			return (1);
		return (0);
	}

	public function connect($name, $pass)
	{
		global $sql;

		$request = NULL;
		if ($this->is_nameExist($name) == 1)
			$request = "SELECT * FROM users WHERE name='" . $name . "'";
		if ($this->is_mailExist($name) == 0)
			$request = "SELECT * FROM users WHERE mail='" . $name . "'";
		if ($request == NULL)
			return ;
		$user = $sql->select($request);
		if ($user['pass'] == md5($pass))
			$this->setUser($user['id']);
		$this->setIp();
	}

	public function setUser($id)
	{
		global $sql;

		if ($this->UserExist($id))
		{
			$user = $sql->select("SELECT * FROM users WHERE id='" . intval($id) . "'");
			if (isset($user["name"]))
				$this->setName($user["name"]);
			if (isset($user["mail"]))
				$this->setMail($user["mail"]);
			if (isset($user["pass"]))
				$this->setPass($user["pass"]);
			if (isset($user["id"]))
				$this->setId($user["id"]);
			if (isset($user["avatar"]))
				$this->setAvatar($user["avatar"]);
			if (isset($user["descr"]))
				$this->setDescr($user["descr"]);
			if (isset($user["banni"]))
				$this->setBanni($user["banni"]);
			if (isset($user["reason_ban"]))
				$this->setReasonBan($user["reason_ban"]);
			if (isset($user["last_co"]))
				$this->setLastConnection($user["last_co"]);
			$_SESSION["user"] = $user;
		}
	}

	public function setIp()
	{
		global $sql;

	    $this->ip = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $this->ip = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $this->ip = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $this->ip = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $this->ip = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	        $this->ip = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $this->ip = getenv('REMOTE_ADDR');
	    else
	        $this->ip = 'UNKNOWN';

	    if ($this->id > 0)
	    	$sql->update("UPDATE `users` SET `ip` = '" . $this->ip . "' WHERE `users`.`id` = '" . intval($this->getId()) . "';");
	}

	public function getIp()
	{
	    return ($this->ip);
	}

	private function setLastConnection($timestamp)
	{
		global $sql;

		$this->last_connection = intval($timestamp);
    	$sql->update("UPDATE `users` SET `last_co` = '" . time() . "' WHERE `users`.`id` = '" . intval($this->getId()) . "';");

	}

	public function getLastConnection()
	{
		return ($this->last_connection);
	}

	private function setReasonBan($reason_ban)
	{
		$this->reason_ban = $reason_ban;
	}

	public function getReasonBan()
	{
		return ($this->reason_ban);
	}

	private function setBanni($banni)
	{
		$this->banni = intval($banni);
	}

	public function getBanni()
	{
		return ($this->banni);
	}

	private function setAvatar($avatar)
	{
		$this->avatar = $avatar;
	}

	public function getAvatar()
	{
		return ($this->avatar);
	}

	private function setDescr($descr)
	{
		$this->descr = $descr;
	}

	public function getDescr()
	{
		return ($this->descr);
	}

	private function setPass($pass)
	{
		$this->pass = $pass;
	}

	public function getPass()
	{
		return ($this->pass);
	}

	private function setMail($mail)
	{
		$this->mail = $mail;
	}

	public function getMail()
	{
		return ($this->mail);
	}

	private function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return ($this->name);
	}
	
	private function setId($id)
	{
		$this->id = intval($id);
	}

	public function getId()
	{
		return ($this->id);
	}

    public function doc()
    {
    	return (file_get_contents('docs/User.doc.txt'));
    }
}

?>