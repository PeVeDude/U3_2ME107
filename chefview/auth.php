<?php

    session_start();
    require "db_functions.php";
    $db = open_db();
    $u = mysql_real_escape_string($_POST['username']); //Hämtar användarnamnet från loginsidan
    $p = mysql_real_escape_string($_POST['pass']); //Hämtar lösenordet från loginsidan
    
    $qry = 'SELECT U_ID FROM Admin WHERE user = "' . $u . '" AND password = "' . md5($p) . '" LIMIT 1'; //Frågeställnings som hittar användaren med de korrekta användarnamnet och lösenordet
    $result = query_db($qry,$db);
    
//Ifall Användaren fanns sätts 2 sessionsvariabler, ett för användarnamnet och ett för användarens ID. Sedan skickas man vidare till hemsidan
    if(mysql_num_rows($result) > 0)
    
    {
	    
	    $_SESSION['user_id'] = mysql_result($result, 0, 'M_ID');
	    header('Location: review.php');
            
    }
	//ifall användaren inte fanns skickas man till loginsidan med login satt till failed.
    else {
        
	   header('Location: login.php?login=failed');
            
    }
    
    close_db($db);
    
?>