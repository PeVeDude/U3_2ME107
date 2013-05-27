<?php
	error_reporting(E_ALL);
	require_once "rate.code.php";

	$rate = new rate();
?>
<html>
 	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta http-equiv="content-type" content="text/html; charset=UTF8">
		<title>U3_2ME107 Rate</title>
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<p><div id="group-wise" class='btn btn-large' style='margin-bottom:5px; margin-right:5px; padding-left:7px; padding-right:7px;'>Rate group-wise</div></p>
		
		<div id="rate-grp">NEHEEEEEE</div>

		<p><div id="individually"  class='btn btn-large' style='margin-bottom:5px; margin-right:5px; padding-left:7px; padding-right:7px;'>Rate individually</div></p>
		
		<div id="rate-ind">HEELLLLLOLOOOO</div>
		<?php if(@$_GET['dishes']) {
			echo $rate->getDishes($_GET['dishes']);
		}
		?>
		<!--<b>Page where ppl rate stuff</b>
		<input type="checkbox" id="box1" value="1">
		<input type="checkbox" id="box2" value="2">
		<input type="checkbox" id="box3" value="3">
		<input type="checkbox" id="box4" value="4">
		<input type="checkbox" id="box5" value="5">
		<b>Page where ppl rate stuff</b>
		-->
		<div id="rateDiv">
		</div>
	</body>
</html>