<?php
    session_start();

    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }

    unset($_SESSION['event_id']);

?>
<!DOC html>
<head>
	<title>FoodReview</title>
	<link href="style/main.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div id="header">
           <h1>FoodReview</h1>
        </div>
    <div id="login_form">
        <h2>Login</h2>
            <form name="user_login" action="auth.php" method="post">
                <p><label>Username: </label> <input type="text" name="username" size="30"/></p>
                <p><label>Password: </label> <input type="password" name="pass" size="30"/></p>
                <p><input type="submit" name="login" value="Log in" /></p>
            </form>
	    <?php failed() ?>
    </div>

</body>
</html>