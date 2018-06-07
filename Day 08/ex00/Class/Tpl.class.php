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

	public function setFileName(String $filename)
	{
		if (file_exists('Template/' . $filename . '.html'))
			$this->setFile($filename);
	}

	public function addData(String $field, String $value)
	{
		if (isset($field))
			$this->data[$field] = $value;
	}

	public function getData(String $field): String
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

	private function setFile(String $file)
	{
		$this->filename = $file;
	}

	public function getFile(): String
	{
		return ($this->filename);
	}

	public function construire(): String
	{
		if ($this->getFile() != NULL)
			$content = file_get_contents('Template/' . $this->getFile() . '.html');
		else
			$content = file_get_contents('Template/blank.html');
		foreach ($this->data as $key => $value)
			$content = str_replace("{{{$key}}}", $value, $content);
		return ($content);
	}

	public function toggle_verbrose()
	{
		$this->verbose = ($this->verbose) ? false : true;
	}

	public function getVerbrose(): bool
	{
		return ($this->verbose);
	}

    public function doc(): String
    {
    	return (file_get_contents('docs/Tpl.doc.txt'));
    }
}

?>