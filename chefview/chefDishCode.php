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

        echo "<h4>Singlerating:</h4> <div class='starsS'></div>";

        if($avg == ""){
            $avg = 0.5;
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
            $grAvg = 0.5;
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
        $qry = "SELECT AVG(rating) FROM jn222bd.dishsingle WHERE D_ID = " . $did;
        $result = query_db($qry,$db);
        $avg =  mysql_result($result, 0, 'AVG(rating)');

        echo "<div class='thedish'>";
        echo "<h3>" . $name . "</h3>";

        $groupvalues = array();
        $groupids = array();
        $grouplenght = array();
        $dishcount = array();
        echo "<h4>Totalrating:</h4> <div class='starsT'></div><div class='line'></div>";

        $qry= "SELECT d.name, gr.rating, gr.G_ID FROM jn222bd.dishes as d, jn222bd.grouprate as gr, jn222bd.dishgroup as g WHERE d.D_ID = g.D_ID AND d.D_ID = " . $did . " AND g.G_ID = gr.G_ID";
        $result = query_db($qry,$db);

        if(mysql_num_rows($result) > 0 ) {

            while($res = mysql_fetch_object($result)) {
            
                array_push($groupvalues, $res->rating);
                array_push($groupids, $res->G_ID);
            }//End while
        
        }//End if

        for ($i=0; $i < count($groupids); $i++) { 
            $qry= "SELECT d.name, d.D_ID, gr.G_ID FROM jn222bd.dishes as d, jn222bd.grouprate as gr, jn222bd.dishgroup as g WHERE d.D_ID = g.D_ID AND g.G_ID = " . $groupids[$i] . " AND g.G_ID = gr.G_ID";
            $result = query_db($qry,$db);
            $thedishCount = 0;
            $groupCount = 0;

            if(mysql_num_rows($result) > 0 ) {

                while($res = mysql_fetch_object($result)) {
                    
                    if($did == $res->D_ID){
                        $thedishCount ++;
                    }

                    $groupCount++;
                    
                }//End while
                array_push($grouplenght, $groupCount);
                array_push($dishcount, $thedishCount);
            
            }//End if
        }

        calculateTotal($groupvalues, $grouplenght, $dishcount);
    }

    function calculateTotal($values, $gCount, $dCount)
    {
        global $did;
        global $db;

        $sRatings = 0;
        $totalSingleRatings = 0;
        $totalperc = 0;
        $totalrate = 0;
        $percArray = array();
        $percOfWeight = array();
       
        for ($i=0; $i < count($gCount); $i++) {
            $perc = $dCount[$i]/$gCount[$i];
            $totalperc += $perc;
            array_push($percArray, $perc);
        }
      
        for ($i=0; $i < count($percArray); $i++) {
            $pow = $percArray[$i]/$totalperc;
            array_push($percOfWeight, $pow);
        }

        for ($i=0; $i < count($percOfWeight); $i++) {
            $totalrate += $percOfWeight[$i]*$values[$i];
           
        }
        
        $qry = "SELECT rating  FROM jn222bd.dishsingle WHERE D_ID = " . $did;
        $result = query_db($qry,$db);

        if(mysql_num_rows($result) > 0 ) {

                while($res = mysql_fetch_object($result)) {
                    
                    $totalSingleRatings += $res->rating;

                    $sRatings++;
                    
                }//End while
            
        }//End if
        $ratings = $sRatings + count($values);
        $totalValue = $totalSingleRatings + $totalrate * count($values);
        $finalrate = $totalValue/$ratings;
        echo "<script> $('.starsT').raty({
            half: true,
            score: " . $finalrate . ",
            readOnly: true
            }); </script>";

    }

    function echoSingleComments()
    {
        global $db;
        global $did;
            
        $qry = "SELECT comment FROM jn222bd.dishsingle WHERE D_ID = " . $did;
        $result = query_db($qry,$db);

        if(mysql_num_rows($result) > 0 ) {

            echo "<br/><h5>Comments:</b></h5>";
            echo "<div id='singlecomments'>";
            while($res = mysql_fetch_object($result)) {
                if (!$res->comment == "") {
                    echo "<div id='comment' style='font-size:13px;'><b>";
                    echo $res->comment;
                    echo "</b></div><div class='line' style='width:150px; margin-bottom: 7px; margin-top:7px;'></div>";
                }
            }//End while
            echo "</div>";
            echo "<div class='line'></div>";
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
            echo "<br/><h5>Comments from groups where '{$name}' is included:</h5>";
            echo "<div id='grpcomments'>";
            while($res = mysql_fetch_object($result)) {
                if (!$res->comment == "") {
                    echo "<div id='comment' style='font-size:13px;'><b>";
                    echo $res->comment;
                    echo "</b></div><div class='line' style='width:150px; margin-bottom: 7px; margin-top:7px;'></div>";  
                }
            }//End while
            echo "</div>";
        }//End if
        else {
            echo "No comments!";
        }
    }

?>