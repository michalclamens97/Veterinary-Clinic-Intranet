$(document).ready(function() {
	//Cargo todos los registros
	cargar_datos();


function cargar_datos(datos) {
	
	
	$.ajax({

			//url de la pagina a la que se van a enviar los datos
			url:'mostrar_consultas_informe_medico.php',
			//metodo a utilizar
			method:'POST',
			//datos que voy a enviar, los que recibe la funcion por parametro (pueden estar vacios o no)
			data:{datos:datos},
			//funcion que recibe los resultados, como parametro le pongo un nombre cualquiera el cual va a servir para hacer referencia a estos resultados
			success:function(data)
   						{
    						//SI HAY UN SUCCESS, ES DECIR SI SE OBTUVIERON RESULTADOS ENTONCES QUE ME CARGE LOS DATOS EN EL DIV CON ID RESULTADO
    						$('#resultado').html(data);
   						}					
	});

}

 
$('#buscar').keyup(function() {
	
	var busqueda = $(this).val();

	if (busqueda !='') {
		cargar_datos(busqueda);
	}else{
		cargar_datos();
	}

});



});