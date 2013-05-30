<?php
	require "../db_functions.php"; // Hämta db_functions.php
    //Globala variabler
    global $db;
    global $did;
    global $result;
    global $avg;
    $db = open_db(); //Databasen öppnas
    if (isset($_GET['id'])) { 
        $did = $_GET['id']; 
    }

    $qry = "SELECT name FROM jn222bd.dishes WHERE D_ID = " . $did;
    $result = query_db($qry,$db);


    function echoSingleDishRating()
    {
    	global $db;
        global $did;
        global $result;
        global $avg;

        $name = mysql_result($result, 0, 'name');
		    
		$qry = "SELECT AVG(rating) FROM jn222bd.dishsingle WHERE D_ID = " . $did;
		$result = query_db($qry,$db);
		$avg =  mysql_result($result, 0, 'AVG(rating)');

		if($avg == ""){
			$avg = "Not rated";
		}

        echo "<h4>Singlerating:</h4> <div class='starsS'></div></p>";

        if($avg == ""){
            $avg = 0;
            echo "Not rated";
        }

        echo "<script> $('.starsS').raty({
            half: true,
            score: " . $avg . ",
            readOnly: true
            }); </script>";

        echo "</div>";

		 
    }

    function echoGrpDishRating() {
        global $db;
        global $did;
        global $result;
        global $avg;

        $qry = "SELECT name, AVG(rating) FROM jn222bd.dishes as d, jn222bd.grouprate as gr, jn222bd.dishgroup as g WHERE d.D_ID = g.D_ID AND d.D_ID = " . $did . " AND g.G_ID = gr.G_ID";
        $result = query_db($qry,$db);
        $grAvg =  mysql_result($result, 0, 'AVG(rating)');

        echo "<h4>Grouprating:</h4> <div class='starsG'></div>";

        if($grAvg == ""){
            $grAvg = 0;
            echo "Not rated";
        }
        echo "<script> $('.starsG').raty({
            half: true,
            score: " . $grAvg . ",
            readOnly: true
            }); </script>";
    }

    function echoName()
    {
        global $result;
        $name = mysql_result($result, 0, 'name');
        echo $name;
    }

    function echoTotal()
    {
        global $db;
        global $did;
        global $avg;
        global $result;

        $name = mysql_result($result, 0, 'name');

        echo "<div class='thedish'>";
        echo "<h3>" . $name . "</h3>";

        $groupvalues = array();
        $groupids = array();
        $dishratings = array();
        echo "Totalrating: <div class='starsS'></div>";

        $qry= "SELECT d.name, gr.rating, gr.G_ID FROM jn222bd.dishes as d, jn222bd.grouprate as gr, jn222bd.dishgroup as g WHERE d.D_ID = g.D_ID AND d.D_ID = " . $did . " AND g.G_ID = gr.G_ID";
        $result = query_db($qry,$db);

        if(mysql_num_rows($result) > 0 ) {

            while($res = mysql_fetch_object($result)) {
            
                array_push($groupvalues, $res->rating);
                array_push($groupids, $res->G_ID);
            }//End while
        
        }//End if

        for ($i=0; $i < count($groupids); $i++) { 
            $qry= "SELECT d.name, d.D_ID, gr.G_ID FROM jn222bd.dishes as d, jn222bd.grouprate as gr, jn222bd.dishgroup as g WHERE d.D_ID = g.D_ID AND g.G_ID = " . $groupids[$i] . " AND g.G_ID = gr.G_ID AND NOT d.D_ID = " . $did;
            $result = query_db($qry,$db);

            if(mysql_num_rows($result) > 0 ) {

                while($res = mysql_fetch_object($result)) {
                
                    $qry2 = "SELECT AVG(rating) FROM jn222bd.dishsingle WHERE D_ID = " . $res->D_ID;
                    $result2 = query_db($qry2,$db);
                    $avgGr = mysql_result($result2, 0, 'AVG(rating)');
                    array_push($dishratings, $avgGr);
                    
                }//End while
            
            }//End if
            echo "Gruppens medelvärde: " . $groupvalues[$i] . ".....";
            echo "Rättens värde : " . $avg . ".....";
            echo  var_dump($dishratings);
            $dishratings = array();

        }

        
    }

    function echoSingleComments()
    {
        global $db;
        global $did;
            
        $qry = "SELECT comment FROM jn222bd.dishsingle WHERE D_ID = " . $did;
        $result = query_db($qry,$db);

        if(mysql_num_rows($result) > 0 ) {

            echo "<b>Comments</b>";
            while($res = mysql_fetch_object($result)) {
            
                echo "<div id='comment'>";
                echo $res->comment;
                echo "</div>";
            }//End while
        
        }//End if
    }

    function echoGrpComments()
    {
        global $db;
        global $did;
        global $result;

        $name = mysql_result($result, 0, 'name');
            
        $qry = "SELECT comment FROM jn222bd.dishes as d, jn222bd.grouprate as gr, jn222bd.dishgroup as g WHERE d.D_ID = g.D_ID AND d.D_ID = " . $did . " AND g.G_ID = gr.G_ID";
        $result = query_db($qry,$db);

        if(mysql_num_rows($result) > 0 ) {
            echo "<b>Comments from groups where '{$name}' is included</b>";
            while($res = mysql_fetch_object($result)) {
            
                echo "<div id='grpComment'>";
                echo $res->comment;
                echo "</div>";
            }//End while
        
        }//End if
    }

?>