<?php

define("TABLE_USER", "users");

class User 
{

	public static $verbose = false;
	private $bdd_table_name = "users";
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
	private $admin = 0;
	private $lang = 'FR';

	public function __construct($verbose = false)
	{
		if ($verbose == true)
			$this->verbose = true;
	}

	public function __destruct()
	{
		return ;
	}

	public function UnRegisterUser($id)
	{
		global $sql;

		if ($this->UserExist($id) == 0)
			return ("user_not_exist");
		if ($this->getAdmin() == 0)
			return ("not_an_admin");
		if ($this->getId() == intval($id))
			return ("user_is_you");
		$user = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE id='" . intval($id) . "'");
		if ($user["admin"] >= 1)
			return ("user_is_admin");
		$request = "DELETE FROM `" . $this->bdd_table_name . "` WHERE `users`.`id` = '" . intval($id) . "'";
		$sql->update($request);
		return ("user_removed");
	}

	public function BanUserId($id, $reason)
	{
		global $sql;

		if ($this->UserExist($id) == 0)
			return ("user_not_exist");
		if ($this->getAdmin() == 0)
			return ("not_an_admin");
		$user = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE id='" . intval($id) . "'");
		if ($user["banni"] == 1)
			return ("user_is_ban");
		if ($user["id"] == $this->getId())
			return ("user_is_you");
		if ($user["admin"] >= 1)
			return ("user_is_admin");
		$sql->update("UPDATE `" . $this->bdd_table_name . "` SET `banni` = '1' WHERE `users`.`id` = '" . intval($id) . "';");
		$sql->update("UPDATE `" . $this->bdd_table_name . "` SET `reason_ban` = '" . $reason . "' WHERE `users`.`id` = '" . intval($id) . "';");
		return ("user_ban");
	}

	public function UnBanUserId($id)
	{
		global $sql;

		if ($this->UserExist($id) == 0)
			return ("user_not_exist");
		if ($this->getAdmin() == 0)
			return ("not_an_admin");
		$user = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE id='" . intval($id) . "'");
		if ($user["banni"] == 0)
			return ("user_is_not_ban");
		if ($user["id"] == $this->getId())
			return ("user_is_you");
		if ($user["admin"] >= 1)
			return ("user_is_admin");
		$sql->update("UPDATE `" . $this->bdd_table_name . "` SET `banni` = '0' WHERE `users`.`id` = '" . intval($id) . "';");
		$sql->update("UPDATE `" . $this->bdd_table_name . "` SET `reason_ban` = '' WHERE `users`.`id` = '" . intval($id) . "';");
		return ("user_unban");
	}

	public function is_banni($id)
	{
		global $sql;

		$user = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE id='" . intval($id) . "' AND banni='1'");
		if (isset($user))
			return (0);
		return (1);
	}

	public function is_nameExist($name)
	{
		global $sql;

		$user = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE name='" . $name . "'");
		if (isset($user))
			return (0);
		return (1);
	}

	public function is_mailExist($mail)
	{
		global $sql;

		$user = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE mail='" . $mail . "'");
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
			return ("username_is_missing");
		if (!(isset($mail)))
			return ("email_is_missing");
		if (!(isset($pass)))
			return ("password_is_missing");
		if ($this->is_nameExist($name) == 0)
			return ("username_already_exist");
		if ($this->is_mailExist($mail) <= 0)
			return ("email_already_exist");
		if (strcmp($mail, $pass) == 0)
			return ("email_equals_password");
		if (strcmp($name, $pass) == 0)
			return ("username_equals_password");
		if (strcmp(strrev($name), $pass) == 0)
			return ("username_rev_equals_password");
		if (strlen($pass) <= 8)
			return ("password_too_short");
		$sql->update("INSERT INTO `" . $this->bdd_table_name . "` (`id`, `name`, `mail`, `pass`, `ip`, `descr`, `avatar`, `banni`, `reason_ban`, `last_co`, `admin`, `lang`) VALUES (NULL, '" . $name . "', '" . $mail . "', '" . md5($pass) . "', '0.0.0.0', 'Aucune Description', '', '0', '', '" . time() . "', '0', 'FR'	);");
		return ("user_succesfully_created");
	}

	public function UserExist($id)
	{
		global $sql;

		$user = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE id='" . intval($id) . "'");
		if (isset($user))
			return (1);
		return (0);
	}

	public function disconnect()
	{
		if (isset($_SESSION["user"]))
		{
			unset($_SESSION["user"]);
			return ("user_disconnect");
		}
		else
			return ("user_still_disconnect");
	}

	public function connect($name = NULL, $pass = NULL)
	{
		global $sql;

		if (!(isset($_SESSION["user"])))
		{
			$request = NULL;
			if (!(isset($name)))
				return ("username_is_missing");
			if (!(isset($pass)))
				return ("password_is_missing");				
			if ($this->is_nameExist($name) == 1)
				$request = "SELECT * FROM `" . $this->bdd_table_name . "` WHERE name='" . $name . "'";
			if ($this->is_mailExist($name) == 0)
				$request = "SELECT * FROM `" . $this->bdd_table_name . "` WHERE mail='" . $name . "'";
			if ($request == NULL)
				return ("user_not_exist");
			$user = $sql->select($request);
			if ($user['pass'] == md5($pass))
			{
				$ret = $this->setUser($user['id']);
				return ("user_connected");
			}
			else
				return ("wrong_credential");			
		}
		else
		{
			$ret = $this->setUser($_SESSION["user"]["id"]);
			return ("user_still_connected");
		}
	}

	public function setUser($id)
	{
		global $sql;

		if ($this->is_banni($id) == 0)
			return ("you_are_ban");
		if ($this->UserExist($id))
		{
			$user = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE id='" . intval($id) . "'");
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
			if (isset($user["admin"]))
				$this->setAdmin($user["admin"]);
			if (isset($user["lang"]))
				$this->setLang($user["lang"]);
			$this->setIp();
			if (isset($_SESSION["user"]))
				$ret = "user_connected";
			else
				$ret = "user_still_connected";
			$_SESSION["user"] = $user;
			return ($ret);
		}
		if ($_SESSION["user"])
		{
			unset($_SESSION["user"]);
			return ("account_not_exist");
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
	    	$sql->update("UPDATE `" . $this->bdd_table_name . "` SET `ip` = '" . $this->ip . "' WHERE `users`.`id` = '" . intval($this->getId()) . "';");
	}

	private function getIp()
	{
	    return ($this->ip);
	}

	private function setLastConnection($timestamp)
	{
		global $sql;

		$this->last_connection = intval($timestamp);
    	$sql->update("UPDATE `" . $this->bdd_table_name . "` SET `last_co` = '" . time() . "' WHERE `users`.`id` = '" . intval($this->getId()) . "';");

	}

	public function getLastConnection()
	{
		return ($this->last_connection);
	}

	private function setLang($lang)
	{
		$this->lang = $lang;
	}

	public function getLang()
	{
		return ($this->lang);
	}

	private function setAdmin($admin)
	{
		$this->admin = intval($admin);
	}

	public function getAdmin()
	{
		return ($this->admin);
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

	public function toggle_verbrose()
	{
		$this->verbose = ($this->verbose) ? false : true;
	}

	public function getVerbrose()
	{
		return ($this->verbose);
	}

    public function doc()
    {
    	return (file_get_contents('docs/User.doc.txt'));
    }
}

?>