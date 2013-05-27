function qrReq() {
	
	var meal1 = document.getElementById('meal1').value;
	var meal2 = document.getElementById('meal2').value;
	var meal3 = document.getElementById('meal3').value;
	var meal4 = document.getElementById('meal4').value;
	var meal5 = document.getElementById('meal5').value;
	var meal6 = document.getElementById('meal6').value;

	var rateUrl = "http://mlab1.msi.vxu.se/~jn222bd/qrproject/rate.php?dishes=";
	var qrString = "<img src=https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=" + rateUrl + meal1 +","+ meal2 +","+ meal3 +","+ meal4 +","+ meal5 +","+ meal6 + ">";

	alert(qrString);

	document.getElementById('QR').innerHTML=qrString;
}