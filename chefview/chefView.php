<?php
    session_start();
    require('chefViewCode.php');
    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }

?>

<html>
<head>
	<title>FoodReview</title>
	<link rel='stylesheet' href='../css/style.css' />
    <script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
    <script type='text/javascript' src='../js/qr.js'></script>
    <script type="text/javascript" src="../js/jquery.raty.js"></script>
    <script type='text/javascript' src='../js/index.js'></script>
    <link rel='stylesheet' href='../css/bootstrap.min.css'>

</head>
<body>
	<div id='header'>
        <h1><a href='chefView.php'>FoodReview</a></h1>
    </div>
    <div id="dishes">
        <?php echoDishes() ?>
    </div>
    
</body>
</html>
