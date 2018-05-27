<?php

class Menu 
{

	public static $verbose = false;
	private $bdd_table_name = "menu";
	private $menu;

	public function __construct($verbose = false)
	{
		if ($verbose == true)
			$this->verbose = true;
	}

	public function __destruct()
	{
		return ;
	}
	
	private function gen_menu($array)
	{
		global $sql;
		global $user;
		global $lang;

		$id = 0;
		foreach ($array as $menu)
		{
			$this->menu[$id]["name"] = $menu["name"];
			$this->menu[$id]["value"] = $lang->getLang($menu["lang"], $user->getLang());
			$id++;
		}
	}

	public function getMenu()
	{
		global $tpl;

		$page = "";
		$tpl->setFileName("menu");
		foreach ($this->menu as $menu)
		{
			$tpl->addData("menu_page", $menu["name"]);
			$tpl->addData("menu_value", $menu["value"]);
			$page .= $tpl->construire();
		}
		return ($page);
	}

	public function load_menu()
	{
		global $sql;
		global $user;

		if ($user instanceof User && $sql instanceof Sql)
		{
			if (isset($user) && isset($_SESSION["user"]))
			{
				if ($user->getAdmin() == 1)	
					$menu = $sql->select_array("SELECT * FROM `" . $this->bdd_table_name . "` WHERE `always`= 1  OR `logged`= 1  OR `admin`= 1 ");
				else
					$menu = $sql->select_array("SELECT * FROM `" . $this->bdd_table_name . "` WHERE `always`= 1  OR `logged`= 1 AND `admin`=0");
			}
			else
				$menu = $sql->select_array("SELECT * FROM `" . $this->bdd_table_name . "` WHERE `always`= 1  OR `logged`= 0");
			$this->gen_menu($menu);
		}
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