$(document).ready(function() {
	
	$("#siguiente").click(function() {
		$("#midiv").slideUp(350);
		$("#titulo1").hide();
		$(this).hide();

		$("#midiv2").show();
		$("#titulo2").show();
		$("#anterior").show();

	});

	$("#anterior").click(function () {
		$("#midiv2").slideUp(350);
		$("#titulo2").hide();
		$(this).hide();

		$("#midiv").show();
		$("#titulo1").show();
		$("#siguiente").show();

	});

});



/*
	$("#siguiente").click(function() {
		
		if ($("#midiv").hasClass("escondido")) {

			$("#titulo1").show();
			$("#midiv").removeClass("escondido");

			$("#midiv2").addClass("escondido");
			$("#titulo2").hide();

			
		}else{

			$("#midiv").addClass("escondido");
			$("#titulo1").hide();

			$("#midiv2").removeClass("escondido");
			$("#titulo2").show();
		

		}

	});













*/