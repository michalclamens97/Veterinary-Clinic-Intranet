<!--Columna para el menu-->
			<div class="barra-lateral col-md-2">
				<div class="logo text-center">
					<img style="height:220px;" src="img/logo3.png">
					
				</div>
				<!--Al colocar d-flex decimos que queremos usar flexbox, y al colocar d-sm-block es para que se ajuste el menu en dispositivos moviles. El justify-conten-center lo pongo para centrar el contenido. El flex-wrap lo pongo para que los enlaces se coloquen uno abajo del otro-->
				<nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
					<a href="index_usuario.php"><i class="icon-home"></i><span>Inicio</span></a>
					<a href="formulario_insertar_cliente.php"><i class="icon-user-add"></i><span>Insertar Cliente</span></a>
					<li><a href="#"><i class="icon-eye"></i><span>Mostrar</span></a>
						<ul class="sub">
							<li><a href="mostrar_consultas_dataTable.php"><i class="icon-th-thumb"></i><span>Consultas</span></a></li>
							<li><a href="mostrar_mascotas_dataTable.php"><i class="icon-guidedog"></i><span>Mascotas</span></a></li>
							<li><a href="mostrar_certificados_dataTable.php"><i class="icon-doc-text"></i><span>Cerficados Vacunación</span></a></li>
							<li><a href="mostrar_constancias_dataTable.php"><i class="icon-bug"></i><span>Constancia Parásitos</span></a></li>
							<li><a href="mostrar_informe_medico_dataTable.php"><i class="icon-ambulance"></i><span>Informe Médico</span></a></li>
						</ul>
					</li>

					<li><a href="#"><i class="icon-menu"></i><span>Paneles</span></a>
						<ul class="sub">
							<li><a href="mostrar_clientes_dataTable.php"><i class="icon-user"></i><span>Panel Clientes</span></a></li>
							<li><a href="index_panel_productos.php"><i class="icon-menu"></i><span>Panel Productos</span></a></li>
							<li><a href="index_panel_medicamentos.php"><i class="icon-hospital"></i><span>Panel Medicamentos</span></a></li>
							<?php if ($_SESSION['usuario'] == "admin"){  ?>
							<li><a href="index_administracion.php"><i class="icon-doc-text"></i><span>Panel Administración</span></a></li>
							<?php }else{?>
							<li><a href="index_administracion_usuario.php"><i class="icon-doc-text"></i><span>Panel Administración</span></a></li>
							<?php   }?>
							<li><a href="index_panel_general.php"><i class="icon-clipboard"></i><span>Panel General</span></a></li>
						</ul>
					</li>
					
					<?php if ($_SESSION['usuario'] == "admin"){  ?>
					<a href="manuales/Manual de Usuario (Administrador).pdf" target="_blank"><i class="icon-clipboard"></i><span>Manual</span></a>
					<?php }else{?>
					<a href="manuales/Manual de Usuario (Normal).pdf" target="_blank"><i class="icon-clipboard"></i><span>Manual</span></a>
					<?php   }?>
					<a href="cerrar.php"><i class="icon-logout"></i><span>Cerrar Sesión</span></a>

				</nav>
			</div> <!--Fin columna del menu-->