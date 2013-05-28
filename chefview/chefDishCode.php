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
		$result = query_db($qry,$db);
		$avg =  mysql_result($result, 0, 'AVG(rating)');
        $qry = "SELECT name, AVG(rating) FROM jn222bd.dishes as d, jn222bd.grouprate as gr, jn222bd.dishgroup as g WHERE d.D_ID = g.D_ID AND d.D_ID = " . $did . " AND g.G_ID = gr.G_ID";
        $result = query_db($qry,$db);
        $grAvg =  mysql_result($result, 0, 'AVG(rating)');
		if($avg == ""){
			$avg = "Ej betygsatt";
		}

        echo "<div class='thedish'>";
        echo "<h3>" . $name . "</h3>";
        echo "<p> Totalt medelbetyg: ALGORHITMS-FLOOOP-III-DOP</p>";
        echo "<p> Enskilt medelbetyg: " . $avg . "</p>";
        echo "<p> Gruppvärderings medelbetyg: " . $grAvg . "</p>";
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