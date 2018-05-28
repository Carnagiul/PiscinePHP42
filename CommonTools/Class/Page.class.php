<?php

class Page
{
	public static $verbose = false;
    private $bdd_table_name = "page";
    private $page;

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
        global $sql;

        $request = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE `page='" . $page . "'`");
        if (!(isset($request)))
            $request = $sql->select("SELECT * FROM `" . $this->bdd_table_name . "` WHERE `page='index'`");
        if (file_exists('Page/' . $request['class'] .' .Page.Class.php'))
        {
            require_once ('Page/' . $request['class'] .' .Page.Class.php');
            $this->setPage(new $request['class']());
        }
        else
        {
            require_once ('Page/Index.Page.Class.php');
            $this->setPage(new Index());
        }
    }

    public function getPage()
    {
        return ($this->page);
    }

    public function display()
    {
        global $tpl;

        $tpl->setFileName('header');
        echo $tpl->construire();
        if ($this->page instanceof PageInterface)
            $this->page->display();
        $tpl->setFileName('footer');
        echo $tpl->construire();
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