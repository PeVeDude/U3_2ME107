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
	$('.star').raty({
		half: true
	});

	$('.stars').raty({
		half: true
	});
	/*$('#rate-ind input[type=checkbox]').each(function (i) {
		i++;
		console.log($('.checkbox'+ i +''));
		$('#checkbox'+ i +'').change(function(){
			if($('#checkbox'+ i +'').is(':checked')) {
				$('.star'+ i +'').css("display", "block");
			}
			else if(!$('#checkbox'+ i +'').is('checked')) {
				$('.star'+ i +'').css("display", "none");
			}
		});
	});*/
 	
 	$( "input" ).on( "click", function() {
	  $( "#rateDiv" ).html( $("input:checked").val() + " is checked!" );
	});

	//$( "#rate-ind input" ).on( "change", countChecked );
	/*
	$("#rate-ind input[type=checkbox]").each(function(i) {
		i++;
        var $this = $(this);           
        var student = $this.attr('data');
                
        var checkbox1 = $this.find('input.checkbox'+ i +'').is(':checked'); 
        var checkbox2 = $this.find('input.checkbox'+ i +'').is(':checked'); 
        //var checkbox3 = $this.find('input.checkbox'+ i +'').is(':checked'); 
    });*/
});