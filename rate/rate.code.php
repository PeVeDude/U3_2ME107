<?php 

// IMPORTS
require_once "../db_functions.php";

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
		$dishArray		=	explode(",", $dishes);
		$i = 1;
		echo "<form action='?'>";
		foreach ($dishArray as &$dish) {

			if(!$dish == "") {
				$dbQuery	=	"SELECT name, D_ID FROM dishes WHERE D_ID={$dish}";
				$result	= query_db($dbQuery,$this->MySQL);
				$dishName = mysql_fetch_row($result); 
				$dishName = "<div class='".$i."'>{$dishName[0]} <input type='checkbox' id='checkbox".$i."' name='dish' value='{$dishName[1]}'><div class='star".$i."' style='display:none'></div></div><br/>";
				echo $dishName;
				$i++;
			}
		}
		echo "<input type='submit' class='btn'>";
		echo "</form>";
	}

	public function addDishes($array) {
		$addQuerySingleRate	=	"INSERT INTO singlerate (S_ID) VALUES (null)";
		$resultAdd			= 	query_db($addQuerySingleRate,$this->MySQL);
		$getID				=	"SELECT S_ID FROM singlerate ORDER BY S_ID DESC LIMIT 1";
		$resultGet			= 	query_db($getID,$this->MySQL);
		$singleRateID 		= 	mysql_fetch_row($resultGet);

		for ($i = 0; $i < count($array); $i++) {
			$nyarray	= explode("=", $array[$i]);
			$nyarray2	= explode("=", $array[$i+1]);
			echo $nyarray[1]." ";
			echo $nyarray2[1]."<br/>";
			$i++;
			$addDishRating		=	"INSERT INTO dishsingle (S_ID, D_ID, rating) VALUES ({$singleRateID[0]}, {$nyarray[1]}, {$nyarray2[1]})";
			$resultAdd			= 	query_db($addDishRating,$this->MySQL);
		}
	}
}

?>