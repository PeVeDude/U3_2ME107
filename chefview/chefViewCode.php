<?php
	require "../db_functions.php"; // Hämta db_functions.php
    //Globala variabler
    global $db;
    $db = open_db(); //Databasen öppnas

    function echoDishes()
    {
    	global $db;

    	$qry = "SELECT name, D_ID FROM jn222bd.dishes";

    	$result = query_db($qry,$db);

    	if(mysql_num_rows($result) > 0 ) {

    	    while($res = mysql_fetch_object($result)) {
		    
		    $qry = "SELECT AVG(rating) FROM jn222bd.dishsingle WHERE D_ID = " . $res->D_ID;
		    $avgresult = query_db($qry,$db);
		    $avg =  mysql_result($avgresult, 0, 'AVG(rating)');
		    
    		echo "<div class='dish'><a href='chefDish.php?id=" . $res->D_ID . "'>" . $res->name . "</a> ";
    		echo "<div class='stars". $res->D_ID ."'></div>";
			echo "</div>";
			
			if($avg == ""){
		    	$avg = 0;
		    	echo "Not rated";
		    }
			echo "<script> $('.stars" . $res->D_ID . "').raty({
				half: true,
				score: " . $avg . ",
				readOnly: true
				}); </script>";
    		}//End while
		
	    }//End if  
    }

?>