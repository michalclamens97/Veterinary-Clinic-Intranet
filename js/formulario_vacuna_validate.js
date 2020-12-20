//Las declaraciones sencillas con una sola regla estan en html directamente

$(document).ready(function () {
	
	$("#form_registro").validate({

		//Para decidir donde colocar los mensaje de error
		errorPlacement:function(error, element) {
			
			//Aqui decimos si el elemento que desencadeno la validacion es un elemento de tipo radio o un elemento de tipo checkbox
			if (element.is(":radio") || element.is(":checkbox")) {
				//Si es un radio o un checkbox, Aqui decimos que el mensaje de error me lo agregue al elemento padre del elemento que desencadeno la validacion 
				error.insertBefore(element.parent());

			}else{

				//Si no es un radio o un checkbox , entonces decimos que me ponga el mensaje de error despues del elemento que desencadeno la validacion
				error.insertAfter(element);

			}

		}

	});//Fin del validate


});