$(document).ready(function() {
	//Cargo todos los registros
	cargar_datos();

//Creo una funcion la cual va a cargar los datos de la base de datos, esta funcion va a recibir un parametro(datos). Cabe destacar que en buscar.php hay dos casos,
//el primero es cuando no se le pasa un parametro a la funcion, es decir cuando no se ha escrito nada en el buscador, en este caso lo que hago es mostrar todos los
//registros de la base de datos. El segundo caso es cuando si recibe un parametro, es decir cuando se escribe algo en el buscador(para ello es que cree la funcion con el
//evento keyup), en este caso voy a mostrar los registros segun lo que el usuario escriba
function cargar_datos(datos) {
	
	//Metodo ajax, este metodo rebice la url a la cual voy a mandar los datos, el metodo a utilizar(post o get), los datos a enviar (en este caso esos datos son los que se envian
	//por parametro en la funcion) y una funcion la cual se va a encargar de recibir los resultados de los datos que fueron enviados, a esa funcion se le pone por parametro
	//un nombre cualquiera el cual va a ser referencia a los resultados obtenidos, en este caso los llame data
	$.ajax({

			//url de la pagina a la que se van a enviar los datos
			url:'mostrar_consultas.php',
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


//Esta funcion lo que hace es detectar y guardar lo que el usuario va escribiendo en el buscador, esto lo guardo en la variable busqueda, primero pregunto si la variable
//no esta vacia, es decir si se escribio algo, si este es el caso entonces llamo a mi funcion cargar datos y le paso como parametro lo que el usuario escribio
//para que me muestre los registros segun con lo que el usuario escribio, en caso de que no escribio nada entonces simplemente llamo a mi funcion 
//cargar datos pero no le paso ningun parametro, es decir me va a mostrar todos los registros 
$('#buscar').keyup(function() {
	
	var busqueda = $(this).val();

	if (busqueda !='') {
		cargar_datos(busqueda);
	}else{
		cargar_datos();
	}

});



});