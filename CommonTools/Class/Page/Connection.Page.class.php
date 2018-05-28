<?php

class Connection implements PageInterface
{
	public static $verbose = false;

	public function __construct($verbose = false)
	{
		if ($verbose == true)
			$this->verbose = true;
	}

	public function __destruct()
	{
		return ;
	}

	public function display()
	{
		global $tpl;

		if (isset($_POST))
			$this->form_post();
		if (isset($_GET))
			$this->form_get();
		if (isset($_SESSION["user"]))
			$tpl->setFileName("connection_log");
		else
			$tpl->setFileName("connection");
	}

	public function form_post()
	{
		global $user;
		global $lang;

		if ($_POST["action"] == "connect")
		{
			$pass = isset($_POST['pass']) ? $_POST['pass'] : "";
			$name = isset($_POST['name']) ? $_POST['name'] : "";
			$ret = $user->connect($name, $pass);
			echo $lang->getLang($ret, 'FR');
		}
		if ($_POST["action"] == "disconnect")
		{
			$ret = $user->disconnect();
			echo $lang->getLang($ret, 'FR');
		}
	}

	public function form_get()
	{
		global $user;
		global $lang;

		if ($_GET["action"] == "disconnect")
		{
			$ret = $user->disconnect();
			echo $lang->getLang($ret, 'FR');
		}
	}

	public function ajax_get()
	{

	}

	public function ajax_php()
	{

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
		return (file_get_contents('docs/Connection.doc.txt'));
	}
}

?>
