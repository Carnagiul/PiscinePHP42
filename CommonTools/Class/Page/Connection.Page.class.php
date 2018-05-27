<?php

class Connection
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
		return ("");
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