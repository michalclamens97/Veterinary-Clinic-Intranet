
$(document).ready(function(){

//Oculto los elementos que tengan la clase sub(los submenus) cuando cargue la pagina
$('.sub').hide();
/*con esto decimos que en mi clase menu quiero seleccionar solamente los elementos li que tengan
un elemento ul (por eso se pone has) , es decir voy a seleccionar solo a mis submenus. El .click 
es una funcion para que ocurra un evento cuando le demos click a los submenus*/
	$('.menu li:has(ul)').click(function(e){
		e.preventDefault(); //para que no redireccione a ningun lado al darle click

/*es decir si este elemento(this se refiere al elemento al que se le haga click) tiene la 
clase activado  se la quitamos y ocultamos los ul hijos(ocultamos el submenu) del elemento que fue clickeado*/
			
			if ($(this).hasClass('activado')){
			$(this).removeClass('activado');
			$(this).children('ul').slideUp();

		}else{



/*es decir si estoy en un submenu ese submenu es el que tiene la clase activado , entonces al darle click al otro submenu me va a ocultar
el submenu anterior($('.menu li ul').slideUp();) y le va a quitar la clase activado ($('.menu li').removeClass('activado');)
, y al nuevo submenu al que le hice click le va agregar la clase activado ($(this).addClass('activado');) y me va a mostrar el contenido del 
submenu ($(this).children('ul').slideDown();)*/

/*NOTA:si le doy click a un solo submenu las dos primeras lineas no las toma en cuenta ya que no hay otro submenu abierto por lo que no
tiene nada que cerrar, entonces simplemente me agrega la clase activado al menu que le di click y con el slidedown muestro su contenido,
 es decir al darle click a un solo submenu me va a tomar en cuenta solo las dos ultimas lineas de este codigo (la 37 y 38)*/

 /*NOTA 2: la primera ves que se le da click a un submenu (mientra no haya otro abierto) toma en cuenta nada mas las dos ultimas
 lineas de este else, si se le da click a un submenu y ya hay otro abierto toma en cuentas las 4 lineas de este else, y si esta 
 un submenu abierto y se le da click a su mismo boton entonces tomas en cuenta las lineas del if*/

			$('.menu li ul').slideUp();
			$('.menu li').removeClass('activado');
			$(this).addClass('activado');
			$(this).children('ul').slideDown();
		}
	});

/*accedemos a los elementos a de los submenus  */
$('.menu li ul li a').click(function(){
	/*aqui estoy diciendo que al hacer click en cada enlace me envie a la pagina que le coloque en html,
	para determinar a que enlace le estoy dando click utilizo this y al poner this.attr(href) obtengo
	el atributo href (su url) del enlace a que le di click*/
window.location.href=$(this).attr("href");

});

});