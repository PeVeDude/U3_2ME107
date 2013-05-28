<?php
	error_reporting(E_ALL);
	require_once "rate.code.php";

	$rate = new rate();
?>
<html>
 	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>U3_2ME107 Rate</title>
		<link rel="stylesheet" href="../css/style.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="../js/index.js"></script>
		<script type="text/javascript" src="../js/jquery.raty.js"></script>
		
		<link rel="stylesheet" href="../css/bootstrap.min.css">
	</head>
	<body>
		<p><div id="group-wise" class='btn btn-large' style='margin-bottom:5px; margin-right:5px; padding-left:7px; padding-right:7px;'>Rate group-wise</div></p>
		
		<div id="rate-grp">
			<?php
				if(@$_GET['dishes']) {
					$rate->getDishesGroup($_GET['dishes']);
				}
			?>
		</div>

		<p><div id="individually"  class='btn btn-large' style='margin-bottom:5px; margin-right:5px; padding-left:7px; padding-right:7px;'>Rate individually</div></p>
		
		<div id="rate-ind">
			<?php
				if(@$_GET['dishes']) {
					$rate->getDishes($_GET['dishes']);
				}
			?>
		</div>
		<div id="rateDiv">
			<?php
				if(@$_GET['dish']) {
					$url_link = htmlspecialchars($HTTP_SERVER_VARS['QUERY_STRING']);
					$array	= explode("&amp;", $url_link);
					$rate->addDishes($array);
				}
				else if(@$_GET['dishGrp']) {
					$url_link = htmlspecialchars($HTTP_SERVER_VARS['QUERY_STRING']);
					$array	= explode("&amp;", $url_link);
					$rate->addGrpRating($array);
				}
			?>
		</div>
	</body>
</html>