<?php
	require "../db_functions.php"; // Hämta db_functions.php
    //Globala variabler
    global $db;
    global $did;
    global $result;
    $db = open_db(); //Databasen öppnas
    if (isset($_GET['id'])) { 
        $did = $_GET['id']; 
    }

    $qry = "SELECT name FROM jn222bd.dishes";
    $result = query_db($qry,$db);


    function echoDish()
    {
    	global $db;
        global $did;
        global $result;

        $name = mysql_result($result, 0, 'name');
		    
		$qry = "SELECT AVG(rating) FROM jn222bd.dishsingle WHERE D_ID = " . $did;
		$avgresult = query_db($qry,$db);
		$avg =  mysql_result($avgresult, 0, 'AVG(rating)');

		if($avg == ""){
			$avg = "Ej betygsatt";
		}

        echo "<div class='thedish'>";
        echo "<h3>" . $name . "</h3>";
        echo "<p> Enskilt medelbetyg: " . $avg . "</p>";
        echo ""
        echo "<div class='single'";
		echo "</div>";
        echo "</div>";
		 
    }

    function echoName()
    {
        global $result;
        $name = mysql_result($result, 0, 'name');
        echo $name;
    }

?>