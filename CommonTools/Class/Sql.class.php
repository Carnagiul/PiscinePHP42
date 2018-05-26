<?php

define ('BDD_HOST', 'localhost');
define ('BDD_NOM', 'dbname');
define ('BDD_USER', 'dbuser');
define ('BDD_PASS', 'dbpass');

class Sql 
{

    private $sql = NULL;
    private $nombrerequetes = 0;
	public static $verbose = false;

	public function __construct($verbose)
	{
		if ($verbose == true)
			$this->verbose = true;
	}

	public function __destruct()
	{
		return ;
	}

    function connect()
    {
 		$options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
        $this->sql = new PDO('mysql:host=' . BDD_HOST . ';dbname=' . BDD_NOM, BDD_USER, BDD_PASS, $options);
    }

    function select($texte)
    {
		if (!(isset($this->sql)))
			return (NULL);
    	$ret[0] = $this->sql->query($texte);
        if($ret[0]){
            $ret[1] = $ret[0]->rowCount();
            if($ret[1] > 1)
                $ret[2] = $ret[0]->fetchall(PDO::FETCH_ASSOC);
            else if($ret[1] == 1)
                $ret[2] = $ret[0]->fetch(PDO::FETCH_ASSOC);
            else
            {
                $ret[2] = NULL;
            }
        }
        $this->nombrerequetes++;
        return ($ret[2]);
    }

    function select_array($texte)
    {
		if (!(isset($this->sql)))
			return (NULL);
    	$ret[0] = $this->sql->query($texte);
        if($ret[0]){
            $ret[1] = $ret[0]->rowCount();
            if($ret[1] > 1)
                $ret[2] = $ret[0]->fetchall(PDO::FETCH_ASSOC);
            else if($ret[1] == 1)
                $ret[2][0] = $ret[0]->fetch(PDO::FETCH_ASSOC);
            else
            {
                $ret[2][0] = NULL;
            }
            $this->nombrerequetes++;
            return ($ret[2]);
        }
    }
	
    function select1($texte)
    {
		if (!(isset($this->sql)))
			return (NULL);
    	$array = 0;
        $ret[0] = $this->sql->query($texte);
        if($ret[0])
        {
            $ret[1] = $ret[0]->rowCount();      
	        if ($ret[1] == 1)
	        {
                $ret[2] = $ret[0]->fetch(PDO::FETCH_ASSOC);
	        	if (isset($ret[2][0]))
	        	    $array = $ret[2][0];
            }
        }
        $this->nombrerequetes++;
        return ($array);
    }
	
    function Update($texte)
    {
		if (!(isset($this->sql)))
			return (NULL);
        try {
            $req = $this->sql->prepare($texte);
            $req->execute();
        } catch(Exception $e) {
            echo '<p class="text-error">Exception ->'.$e->getMessage().'</p><pre>'. $texte .'</pre>';
            return false;
        }
        $this->nombrerequetes++;
        return (bool)$req;
    }


    public function doc()
    {
    	return (file_get_contents('docs/Sql.doc.txt'));
    }

    public function getRequestCount()
    {
    	retrun ($this->nombrerequetes);
    }
}

?>