<?php

class Lang
{
	public static $verbose = false;
	private $bdd_table_name = "lang";
	private $lang;

	public function __construct($verbrose = false)
	{
		if ($verbrose == true)
			$this->verbrose = true;
	}

	public function __destruct()
	{
		return ;
	}

	private function addLang($tag, $lang, $value)
	{
		$this->lang[$tag][$lang] = $value;
	}

	public function is_LangSet($tag)
	{
		global $sql;

		$request = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE tag='" . $tag . "'");
		if (isset($request))
			return (1);
		return (0);
	}

	public function getLang($tag, $lang)
	{
		global $sql;

		if (isset($this->lang[$tag][$lang]))
			return ($this->lang[$tag][$lang]);
		if ($this->is_LangSet($tag) == 0)
			return ("");
		$request = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE tag='" . $tag . "'");
		if (isset($request["FR"]))
			$this->addLang($tag, "FR", $request["FR"]);
		if (isset($request["EN"]))
			$this->addLang($tag, "EN", $request["EN"]);
		if (isset($request["DE"]))
			$this->addLang($tag, "DE", $request["DE"]);
		if (isset($request["IT"]))
			$this->addLang($tag, "IT", $request["IT"]);
		if (isset($request["RU"]))
			$this->addLang($tag, "RU", $request["RU"]);
		if (isset($this->lang[$tag][$lang]))
			return ($this->lang[$tag][$lang]);
		return ("");
	}

	public function loadAllLang()
	{
		global $sql;

		$request = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "`");
		foreach ($request as $lang)
		{
			if (isset($lang["FR"]))
				$this->addLang($lang["tag"], "FR", $lang["FR"]);
			if (isset($lang["EN"]))
				$this->addLang($lang["tag"], "EN", $lang["EN"]);
			if (isset($lang["DE"]))
				$this->addLang($lang["tag"], "DE", $lang["DE"]);
			if (isset($lang["IT"]))
				$this->addLang($lang["tag"], "IT", $lang["IT"]);
			if (isset($lang["RU"]))
				$this->addLang($lang["tag"], "RU", $lang["RU"]);
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
    	return (file_get_contents('docs/Lang.doc.txt'));
    }

}

?>