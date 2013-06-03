<?php
	require "db_functions.php"; // Hämta db_functions.php
    //Globala variabler
    global  $db;
    global  $did;
    Global  $result;
    $db     = open_db(); //Databasen öppnas
    if (isset($_GET['id'])) { 
        $did = $_GET['id']; 
    }

    $qry    = "SELECT name FROM jn222bd.dishes WHERE D_ID = " . $did;
    $result = query_db($qry,$db);


    function echoDish()
    {
    	global $db;
        global $did;
        global $result;

        $name    = mysql_result($result, 0, 'name');
		$qry     = "SELECT AVG(rating) FROM jn222bd.dishsingle WHERE D_ID = " . $did;
		$result  = query_db($qry,$db);
		$avg     =  mysql_result($result, 0, 'AVG(rating)');
		if($avg == ""){
			$avg = "Not rated";
		}

        echo    "<div class='thedish'>";
        echo    "<h3>" . $name . "</h3>";
        echo    "<div class='stars'></div>";

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
        global $db;
        global $did;
        global $result;
        $qry    = "SELECT d.name as name, ds.S_ID, d.D_ID as id FROM dishsingle as ds, dishes as d WHERE ds.S_ID IN (SELECT S_ID FROM dishsingle WHERE D_ID = ".$did.") AND d.D_ID = ds.D_ID AND NOT d.D_ID = ".$did."";
        $result = query_db($qry,$db);

        $dishes = array();
        if(mysql_num_rows($result) > 0 ) {

            while($res = mysql_fetch_object($result)) {
                    array_push($dishes, $res->id);
            }//End while
        
        }//End if
        $countedDishes = array_count_values($dishes);
        arsort($countedDishes);
        $i = 0;
        echo "<h4>Recommended dishes.</h4>";
        foreach ($countedDishes  as $key => $value)  {
            $qry = "SELECT d.name as name, d.D_ID as id, AVG(ds.rating) as rating FROM dishsingle as ds, dishes as d WHERE d.D_ID = ".$key." AND ds.D_ID = d.D_ID";
            $result = query_db($qry,$db);
            $res = mysql_fetch_object($result);
            if($i < 5) {
                echo "<a href='menuDish.php?id=".$res->id."'>".$res->name."</a> ";
                echo "<div class='starsRec" . $i . "'></div><br/>";
                echo "<script> $('.starsRec" . $i . "').raty({
                                    half: true,
                                    score: " . $res->rating . ",
                                    readOnly: true
                                }); </script>";
                $i++;
            }
        }
    }

?>