<?php 

/**
 * 
 */
class DB
{
	private $con;
	public function connect()
	{	
		include_once "constants.php";
		$this->con = new PDO("mysql:host=".SERVER.";dbname=".DBNAME,USERNAME ,PASSWORD);
		$this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		if ($this->con) 
		{
			//echo 'connexion reussie';
			return $this->con;
		}
		else
		{
			return "connexion echouée";
		}
	}
}

//$db = new DB();
//$db->connect();
