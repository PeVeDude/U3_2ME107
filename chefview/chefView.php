<?php
    session_start();
    require('chefViewCode.php');
    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }

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
    <div id="dishes">
        <?php echoDishes() ?>
    </div>

</body>
</html>