$(document).ready(function () {
	//Le agrego al select que tine las especies un evento de tipo change para detectar cuando se cambia de opcion
	$("#especie").change(function () {
		//Obtengo la opcion del select que se selecciono
		$("#especie option:selected").each(function () {
			//Obtengo el valor de esa opcion
			especie = $(this).val();
			//Mando por post esta especie para hacer la consulta php con esa especie y luego traerme los resultados, ya 
			//que el metodo post tiene tres parametros, el archivo al que le vamos a mandar los datos, los datos a enviar, y la 
			//funcion que va a recibir los datos devueltos por parametro, en este caso cree una funcion anonima dentro del mismo 
			//metodo post y a los datos devueltos que voy a recibir los nombre data
			$.post("obtener_raza3.php", {especie: especie}, function(data) {
				//le agrego el resultado obtenido (los option del select con los datos segun la raza) a mi select de raza
				$("#raza").html(data);
			})
		})

	})

		
		
			
	
});