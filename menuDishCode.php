<?php
	require "db_functions.php"; // Hämta db_functions.php
    //Globala variabler
    global $db;
    global $did;
    global $result;
    $db = open_db(); //Databasen öppnas
    if (isset($_GET['id'])) { 
        $did = $_GET['id']; 
    }

    $qry = "SELECT name FROM jn222bd.dishes WHERE D_ID = " . $did;
    $result = query_db($qry,$db);


    function echoDish()
    {
    	global $db;
        global $did;
        global $result;

        $name = mysql_result($result, 0, 'name');
		    
		$qry = "SELECT AVG(rating) FROM jn222bd.dishsingle WHERE D_ID = " . $did;
		$result = query_db($qry,$db);
		$avg =  mysql_result($result, 0, 'AVG(rating)');
		if($avg == ""){
			$avg = "Not rated";
		}

        echo "<div class='thedish'>";
        echo "<h3>" . $name . "</h3>";
        echo "<div class='stars'></div>";

        if($avg == ""){
            $avg = 0;
            echo "Not rated";
        }

        echo "<script> $('.stars').raty({
            half: true,
            score: " . $avg . ",
            readOnly: true
            }); </script>";
		 
    }

    function echoRecomend()
    {
    	echo "algotihme!!! Make recomendededed foooooods!";
    }

?>