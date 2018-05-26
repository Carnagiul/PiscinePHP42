<?php

class User 
{

	public static $verbose = false;
	private $id;
	private $name;
	private $mail;
	private $pass;

	public function __construct($verbose)
	{
		if ($verbose == true)
			$this->verbose = true;
	}

	public function __destruct()
	{
		return ;
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

	public function createUser($name, $mail, $pass)
	{
		if (is_nameExist($name) == 0)
			return ("Error, username is already set");
		if (is_mailExist($mail) <= 0)
			return ("Error, mail is already set");
		if (strcmp($mail, $pass) == 0)
			return ("Error, password to easy");
		if (strcmp($name, $pass) == 0)
			return ("Error, password to easy");
		if (strcmp(strrev($name), $pass) == 0)
			return ("Error, password to easy");
		if (strlen($name) < 8)
			return ("Error, password to easy");
		$i = $sql->update("INSERT INTO users name='" . $name . "', pass='" . md5($pass) . "', mail='" . $mail . "'");
		echo "test : $i <br />";
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
		if (is_nameExist($name) == 1)
			$request = "SELECT * FROM users WHERE name='" . $name . "'";
		else if (is_nameExist($name) == 0)
			$request = "SELECT * FROM users WHERE mail='" . $name . "'";
		else
			return ;
		$user = $sql->select($request);
		if ($user['pass'] == md5($pass))
			$this->setUser($user['id']);
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
			$_SESSION["user"] = $user;
		}
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
		$this->id = $id;
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