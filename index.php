<?php
    require('indexCode.php');
?>


<html>
 	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<title>U3_2ME107 Index</title>
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.raty2.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<div id="dishes">
			<h1><a href='index.php'>Menu</a></h1>
			<?php echoDishes() ?>
		</div>
	</body>
</html>