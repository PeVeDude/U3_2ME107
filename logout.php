<?php
/*
	Användaren loggas ut genom att Sessionsvariablerna tas bort och man skickas till login-sidan
*/
	session_start(); 
	unset($_SESSION['user_id']);
        unset($_SESSION['event_id']);
	header('Location: login.php');
?>