<?php

class Page
{
	public static $verbose = false;
	private $bdd_table_name = "page";

	public function __construct($verbose = false)
	{
		if ($verbose == true)
			$this->verbose = true;
	}

	public function __destruct()
	{
		return ;
	}

	public function page_exist($page = "index")
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
    	return (file_get_contents('docs/Page.doc.txt'));
    }
}

?>