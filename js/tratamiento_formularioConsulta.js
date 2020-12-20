$(document).ready(function () {

	//Le agrego un evento de tipo change al select de los medicamentos para obtener el medicamento cada ves que se seleccione o 
	//deseleccione una opcion
	$("#medicamentos").change(function () {
		
	//Guardo el medicamento que se selecciono en una variable (si se seleccionan varios se van a ir guardando todos en esta variable
	//separados por coma, ejemplo: medicamento1, medicamento2)
		var medicamentoS = $(this).val();

	//Guardo en otra variable los medicamentos pero separados por un espacio(\n) en ves de una coma
		var medicamentos_separados = medicamentoS.join(',').replace(/,/g, ': \n').split();
		
	
	//Muestro los medicamentos que se van seleccionando en el input del tratamiento
		$('#tratamiento').val(medicamentos_separados);


	})



});