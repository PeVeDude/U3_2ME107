$(document).ready(function () {

	if(document.getElementById("nMeals")) {
		$("#nMeals").keyup(function(event){
			var inputFields = "";
			for (var i=1; i<=$("#nMeals").val(); i++) {
				inputFields += "Meal " + i + ": <input type='text' id='meal" + i + "' name='meal" + i + "'/></br>";
			}
			$("#rateform").html(inputFields + "<input type='submit' value='Make QR code happen' onclick='qrReq(" + i + ");'/>");

		})
	}
});

function qrReq(nrOfMeals) {
	
	var dishes = "";
	for (var i=1; i<nrOfMeals; i++) {
		dishes += $("#meal"+ i).val()+",";
	}

	var rateUrl = "http://mlab1.msi.vxu.se/~jn222bd/qrproject/rate/rate.php?dishes=";

	var qrString = "<img src=https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=" + rateUrl + dishes + ">";

	//alert(meal1 + meal2 + meal3 + meal4 + meal5 + meal6);
	alert(qrString);

	document.getElementById('QR').innerHTML=qrString;
}