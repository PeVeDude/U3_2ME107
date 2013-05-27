<?php 

// IMPORTS
require_once "db_functions.php";

class rate
{
	private $MySQL;					// Håller en instans av databasklassen.
	
	/**
	 * Klassens konstruktor påbörjar anslutningen 
	 * till databasen.
	 */
	public function __construct()
	{
		/*$this->initDatabase();
		$this->logout();*/
		$this->MySQL = open_db();
	}
		
	/**
	 * Fuktionen upprättar förbindelse med databasen, för mer 
	 * information se databasklassen(Database.class.php).
	 */
	/*public function initDatabase()
	{
		$hostname = config::DB_HOSTNAME;
		$username = config::DB_USERNAME;
		$password = config::DB_PASSWORD;
		$database = config::DB_DATABASE;
			
		$this->MySQL = new Database();
		$this->MySQL->connect($hostname, $username, $password, $database);
	}*/

	/* Funktionen tar emot parametrarna från
	 * inputfälten i login.php och skickar en
	 * query till databasen. Returnerar sen tillbaka
	 * resultatet.
	 */
	 
	public function getDishes($dishes) {	
		//$output = "{$dishes}";
		$dishArray		=	explode(",", $dishes);
		foreach ($dishArray as &$dish) {
			$dbQuery	=	"SELECT name FROM dishes WHERE D_ID={$dish}";
			$result	= query_db($dbQuery,$this->MySQL);
			$dishName = mysql_fetch_row($result); 
			$dishName = "{$dishName[0]} <br/>";
			echo $dishName;
		}
	}
}

?>