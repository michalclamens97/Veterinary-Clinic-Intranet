
  $(function () {
        var options = {
        	//Agrego mis patterns a mi mascara
            translation: {
            	//Para que no me agarre el 0
                '0': {pattern: /\d/},
                //Para que agarre solo numero del 1 al 9
                '1': {pattern: /[1-9]/},
                '9': {pattern: /\d/, optional: true},
                //Para que no agarre caracteres especiales
                '#': {pattern: /\d/, recursive: true},
                //Para si pongo cualaquier otra letra o caracter que no sea V,v,E,e me ponga automaticamente la letra V 
                'C': {pattern: /V|v|E|e/, fallback: 'V'}
            }
        };
        //Le agrego la mascara a la cedula
        $('#cedula').mask('C-19999999', options);

        $('#cedula').on('input', function (e) {
        	//Guardo la cedula que se ingreso
            var username = $(this).val();
            if (username.length > 9) {
            	//Es decir si la cedula que se ingreso es mayor a 9, es decir si el usuario ingreso V-24765424 que me guarde solo lo que esta despues del V-, es decir me guarda solo los numeros
                var cedula = username.substring(2);
                //Verifico si es mayor a 80000000, si es asi es extranjero por lo que pongo E- antes de la cedula
                if (cedula > 80000000) {
                    $(this).val('E-' + cedula);
                }
            }
        });
    });
