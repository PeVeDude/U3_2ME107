<?php 

// IMPORTS
require_once "../db_functions.php";
require_once "flickr.code.php";

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
				$dishNames = "<div class='".$i."' style='margin-bottom:7px;'><input type='checkbox' id='checkbox".$i."' name='dish' value='{$dishName[1]}'><i class='name'>{$dishName[0]}</i><div class='star".$i."' style='display:none; margin-top:10px;'></div></div><div id='commentDiv".$i."' style='display:none'><input type='text' id='comment".$i."' name='comment".$i."' placeholder='Comment..' disabled><i class='optional'> * Optional</i>";
				echo $dishNames;
				getPics($dishName[0]);
				echo "</div><br/>";
				$i++;
			}
		}
		
		echo "<input type='submit' class='btn'>";
		echo "</form>";
	}

	public function getDishesGroup($dishes) {	
		$dishArray		=	explode(",", $dishes);
		$i = 1;
		echo "<form action='?'>";
		foreach ($dishArray as &$dish) {

			if(!$dish == "") {
				$dbQuery	=	"SELECT name, D_ID FROM dishes WHERE D_ID={$dish}";
				$result	= query_db($dbQuery,$this->MySQL);
				$dishName = mysql_fetch_row($result); 
				$dishName = "<div class='".$i."' style='margin-bottom:7px;'>{$dishName[0]} </div><input type='hidden' name='dishGrp' value='{$dishName[1]}'>";
				echo $dishName;
				$i++;
			}
		}
		echo "<div class='starGrp' style='display:block; margin-top:10px;'></div>";
		echo "<input type='text' id='commentGrp' name='commentGrp' placeholder='Comment..'><i class='optional'> * Optional</i><br />";
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
			@$dishID	= explode("=", $array[$i]);
			@$dishRating	= explode("=", $array[$i+1]);
			@$dishComment	= explode("=", $array[$i+2]);
			if (!@$dishComment[1] == "") {
				if (strpos($dishComment[1],'+') !== false) {
					$dishComment 	= str_replace('+', ' ', $dishComment[1]);
					$dishComment 	=  urldecode($dishComment);
				}

				else {
					$dishComment = $dishComment[1];
					$dishComment 	=  urldecode($dishComment);
				}
				$addDishRating		=	"INSERT INTO dishsingle (S_ID, D_ID, rating, comment) VALUES ({$singleRateID[0]}, {$dishID[1]}, {$dishRating[1]}, '{$dishComment}')";
				$resultAdd			= 	query_db($addDishRating,$this->MySQL);
			}

			else {
				$addDishRating		=	"INSERT INTO dishsingle (S_ID, D_ID, rating, comment) VALUES ({$singleRateID[0]}, {$dishID[1]}, {$dishRating[1]}, '{$dishComment[1]}')";
				$resultAdd			= 	query_db($addDishRating,$this->MySQL);
			}
			$i++;
			$i++;
		}
	}
	public function addGrpRating($array) {
		$rating	= explode("=", $array[count($array)-2]);
		$grpComment	= explode("=", $array[count($array)-1]);
		$grpComment = str_replace('+', ' ', $grpComment[1]);
		$grpComment =  urldecode($grpComment);
		$grpComment =  utf8_decode($grpComment);
		$addQuerySingleRate	=	"INSERT INTO grouprate (G_ID, rating, comment) VALUES (null, {$rating[1]}, '{$grpComment}')";
		$resultAdd			= 	query_db($addQuerySingleRate,$this->MySQL);
		
		$getID				=	"SELECT G_ID FROM grouprate ORDER BY G_ID DESC LIMIT 1";
		$resultGet			= 	query_db($getID,$this->MySQL);
		$grpRateID 		= 	mysql_fetch_row($resultGet);

		for ($i = 0; $i < count($rating); $i++) {
			$dishArray	= explode("=", $array[$i]);
			$addDishRating		=	"INSERT INTO dishgroup (D_ID, G_ID) VALUES ({$dishArray[1]}, {$grpRateID[0]})";
			$resultAdd			= 	query_db($addDishRating,$this->MySQL);
		}
	}
}

?>