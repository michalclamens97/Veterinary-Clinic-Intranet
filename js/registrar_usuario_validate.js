$(document).ready(function () {
	
	$("#form_registro").validate({

		rules:{



			pass:{

				required:true,
				rangelength:[4,8] //Con esto validamos el numero maximo y minimo de CARACTERES (numeros y letras), el minimo es de 8 y el maximo de 16
			},

			repass:{

				equalTo:"#pass", //Con esto validamos que el campo confirma sea igual al campo password 
				

			}

		},//Fin de rules
		messages:{

			
			pass:{
				required:"Campo obligatorio",
				rangelength:"La contraseña debe ser de 4 a 8 caracteres"
			},

			repass:{
				equalTo:"Las contraseñas no son iguales",

			}


		},//Fin de mensajes

		//Para decidir donde colocar los mensaje de error
		errorPlacement:function(error, element) {
			
			//Aqui decimos si el elemento que desencadeno la validacion es un elemento de tipo radio o un elemento de tipo checkbox
			if (element.is(":radio") || element.is(":checkbox")) {
				//Si es un radio o un checkbox, Aqui decimos que el mensaje de error me lo agregue al elemento padre del elemento que desencadeno la validacion 
				error.appendTo(element.parent());

			}else{

				//Si no es un radio o un checkbox , entonces decimos que me ponga el mensaje de error despues del elemento que desencadeno la validacion
				error.insertAfter(element);

			}

		}

	});//Fin del validate


});