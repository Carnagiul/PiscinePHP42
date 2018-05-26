<?php

class Tpl
{
	public static $verbose = false;
	private $filename = NULL;
	private $data;

	public function __construct($verbrose = false)
	{
		if ($verbrose == true)
			$this->verbrose = true;
	}

	public function __destruct()
	{
		return ;
	}

	public function setFileName($filename)
	{
		if (file_exists('templates/default/' . $filename . '.html'))
			$this->setFile($filename);
	}

	public function addData($field, $value)
	{
		if (isset($field))
			$this->data[$field] = $value;
	}

	public function getData($field)
	{
		if (isset($field))
		{
			if (isset($this->data[$field]))
			{
				return ($this->data[$field]);
			}
		}
		return (NULL);
	}

	private function setFile($file)
	{
		$this->filename = $file;
	}

	public function getFile()
	{
		return ($this->filename);
	}

	public function construire()
	{
		if ($this->getFile() != NULL)
			$content = file_get_contents('templates/default/' . $this->getFile() . '.html');
		else
			$content = file_get_contents('templates/default/blank.html');
		foreach ($this->data as $key => $value)
			$content = str_replace("{{$key}}", $value, $content);
		return ($content);
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
    	return (file_get_contents('docs/Tpl.doc.txt'));
    }
}

?>