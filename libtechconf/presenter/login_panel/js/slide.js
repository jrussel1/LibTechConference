$(document).ready(function() {
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	$(".signup").click(function(){
		if($("div#panel").css("display")!="block")
			{
				$("div#panel").slideDown("slow");
			}
		else{
				$("div#panel").slideUp("slow");
			}
		$("#toggle a").toggle();
	
	});	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		
		
});