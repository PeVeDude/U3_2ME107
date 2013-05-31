<?php
	error_reporting(E_ALL);
	require_once "rate.code.php";

	$rate = new rate();
	ob_start();
?>
<html>
 	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>U3_2ME107 Rate</title>
		<link rel="stylesheet" href="../css/style.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="../js/index.js"></script>
		<script type="text/javascript" src="../js/jquery.raty.js"></script>
		<script type="text/javascript">
			function asdf() {
				document.getElementById("rateDiv").innerHTML = $(window).width();
				
			}
		</script>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
	</head>
	<body>
		<div id="rateDiv">
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
			<?php 
				if(@$_GET['rated']) {
					echo "<p style='color:red;'>You need to rate the ones you've checked before submitting!</p>";
				}
			?>
			<div id="rateDiv">
				<?php
					if(@$_GET['dish']) {
						if(!$_GET['score'] == null) {
							$url_link = htmlspecialchars($HTTP_SERVER_VARS['QUERY_STRING']);
							$array	= explode("&amp;", $url_link);
							$redirectDishes = "";
							for ($i = 0; $i < count($array); $i++) {
								$dishID	= explode("=", $array[$i]);
								$redirectDishes .= $dishID[1].",";
								$i++;
								$i++;
							}
							$redirectDishes = substr_replace($redirectDishes ,"",-1);
							echo $redirectDishes;
							header("Location: http://mlab1.msi.vxu.se/~jn222bd/qrproject/rate/rate.php?dishes=".$redirectDishes."&rated=no");
						}
						else {
							$url_link = htmlspecialchars($HTTP_SERVER_VARS['QUERY_STRING']);
							$array	= explode("&amp;", $url_link);
							$rate->addDishes($array);
						}
					}
					else if(@$_GET['dishGrp']) {
						$url_link = htmlspecialchars($HTTP_SERVER_VARS['QUERY_STRING']);
						$array	= explode("&amp;", $url_link);
						$rate->addGrpRating($array);
					}
				?>
			</div>
		</div>
	</body>
</html>
<? ob_flush(); ?>