<?php

    session_start();
    require "db_functions.php";
    $db = open_db();
    $u = mysql_real_escape_string($_POST['username']); //H�mtar anv�ndarnamnet fr�n loginsidan
    $p = mysql_real_escape_string($_POST['pass']); //H�mtar l�senordet fr�n loginsidan
    
    $qry = 'SELECT U_ID FROM Admin WHERE user = "' . $u . '" AND password = "' . md5($p) . '" LIMIT 1'; //Fr�gest�llnings som hittar anv�ndaren med de korrekta anv�ndarnamnet och l�senordet
    $result = query_db($qry,$db);
    
//Ifall Anv�ndaren fanns s�tts 2 sessionsvariabler, ett f�r anv�ndarnamnet och ett f�r anv�ndarens ID. Sedan skickas man vidare till hemsidan
    if(mysql_num_rows($result) > 0)
    
    {
	    
	    $_SESSION['user_id'] = mysql_result($result, 0, 'M_ID');
	    header('Location: review.php');
            
    }
	//ifall anv�ndaren inte fanns skickas man till loginsidan med login satt till failed.
    else {
        
	   header('Location: login.php?login=failed');
            
    }
    
    close_db($db);
    
?>