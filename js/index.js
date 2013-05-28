$(document).ready(function () {
	$("#group-wise").click(function() {
		if(!$("#rate-grp").is(":visible")) {
		  $("#rate-grp").css("display", "block");
		}
		else if($("#rate-grp").is(":visible")) {
		  $("#rate-grp").css("display", "none");
		}
	});
	$("#individually").click(function() {
	  if(!$("#rate-ind").is(":visible")) {
		  $("#rate-ind").css("display", "block");
		}
		else if($("#rate-ind").is(":visible")) {
		  $("#rate-ind").css("display", "none");
		}
	});
});