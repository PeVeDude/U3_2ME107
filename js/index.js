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

	$('.stars').raty({
		half: true
	});
	
	var starArray = new Array();
 	$( "input" ).on( "change", function() {
	  	$('#rate-ind input[type=checkbox]').each(function (j) {
	  		checkbox = $("."+(j+1)+" input:checked").val();

		  	if($("."+(j+1)+" input:checked").is(':checked') == true){
		  		$('.star'+ (j+1) +'').css("display", "block");
		  		if(starArray['.star'+ (j+1)]) {
					$('.star'+ (j+1) +'').raty({
						score: starArray['.star'+ (j+1)],
						half: true,
						starHalf : '../img/star-half-big.png',
						starOff  : '../img/star-off-big.png',
						starOn   : '../img/star-on-big.png',
						click: function(score, evt) {
						    starArray['.star'+ (j+1)] = score;
						 }
					});
				}
				else {
					$('.star'+ (j+1) +'').raty({
						half: true,
						click: function(score, evt) {
						    starArray['.star'+ (j+1)] = score;
						 }
					});
				}
			}
		
			else if($("."+(j+1)+" input:checked").is(':checked') == false){
				$('.star'+ (j+1) +'').css("display", "none");

			}
		});
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
 	/*
 	$( "input" ).on( "click", function() {
	  $( "#rateDiv" ).html( $("input:checked").val() + " is checked!" );
	});
	*/
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