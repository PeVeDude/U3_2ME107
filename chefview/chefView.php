<?php
    session_start();

    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }

    unset($_SESSION['event_id']);

?>

<html>
<head>
	<title>FoodReview</title>
	<link rel='stylesheet' href='../css/style.css' />
    <script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
    <script type='text/javascript' src='../js/qr.js'></script>
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
</head>
<body>
	<div id='header'>
           <h1>FoodReview</h1>
        </div>
    <div id='login_form'>
        <h2>Login</h2>
            <form name='user_login' action='auth.php' method='post'>
                <p><label>Username: </label> <input type='text' name='username' size='30'/></p>
                <p><label>Password: </label> <input type='password' name='pass' size='30'/></p>
                <p><input type='submit' name='login' value='Log in' /></p>
            </form>
	    <?php failed() ?>
    </div>

</body>
</html>
