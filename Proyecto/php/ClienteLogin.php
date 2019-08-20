<?php

	require_once 'config_bd.php';
    // iniciar la sesion
    session_start();
    // Si aun no hay sesion significa que el usuario no ha hecho login, redireccionar a login
    if(!isset($_SESSION['cedula']) || empty($_SESSION['cedula'])){
      header("location: index.html");
      exit;
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mae's</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="HTML, CSS, JavaScript">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

		<!-- bootstrap scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

		<!-- Google fonts -->
		<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet"> 

		<!-- Datatables info -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js "></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
    	 $( function() {
      	 $( "#fecha" ).datepicker({ minDate: setFecha()});
    	 $( "#fechaUp" ).datepicker({ minDate: setFecha()});
    	 } );
    	</script>

		<!-- nuestros estilos-->
		<link rel="stylesheet" type="text/css" href="../css/estiloslogin.css">

		<!-- font awesome library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body onload="start()">

		<!-- Navbar de la pagina -->
		<div id="navbar">
			<nav class="navbar navbar-expand-md navbar-light">
				<a class="navbar-brand" href="#"><img src="../img/logo.jpg" id="logo_img"></a>

				<!-- boton para colapsar navbar-->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#links">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- links del navbar -->
				<div class="collapse navbar-collapse" id="links">
					<ul class="navbar-nav">
						<li><a class="nav-link" href="#nosotros">Nosotros</a></li>
						<li><a class="nav-link" href="#contacto">Contáctenos</a></li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li><a class="nav-link" href="Ajustes.php">Ajustes</a></li>
						<li><button type="button" class="btn btn-link" onclick="cerrarSesion('cerrarSesion')">Salir</button></li>
					</ul>
				</div>
			</nav> 	
		</div>

		<div class="container-fluid">

			<!-- ordenar -->
			<div id="ordenar"></div>
			<div class="informacion">
				<div class="table-title" id="titulo">
					<div class="row">
						<div class="col-xs-8 col-sm-8">
							<h2 class="pull-left">Bienvenido, <?php echo $_SESSION['nombre'] ?> </h2>
						</div>
						<div class="col-xs-4 col-sm-4">
							<button type="submit" class="btn btn-outline-success pull-right" id="sacarCita" data-toggle="modal" data-target="#sacarCitaModal">Sacar cita</button>
							<button type="submit" class="btn btn-outline-primary pull-right producto" id="productos" onclick="openProductos()">Productos</button>
						</div>
					</div>
				</div>				
				<div>
					<div id="miResultadoC"></div>
					<table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_citas">
						<thead>
							<th>Fecha</th>
							<th>Hora cita</th>
							<th>Barbero</th>
							<th>Servicio</th>
							<th>Precio</th>
							<th></th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>


			<!-- nosotros -->
			<div id="nosotros"></div>
			<div class="informacion">
				<h3>&#x1F1E8;&#x1F1F7; Nuestra historia &#x1F1E8;&#x1F1F7;</h3>
				<p>
					Men’s Barbershop nace en el año 2015 como una barbería alternativa, moderna y familiar para el hombre de hoy.<br>
					Es un espacio para que una “tarea” constante se vuelva una experiencia agradable; la cual, ya sea por medio de videos, tablets, buena música, saborear un shot con sabor original y con productos de primera calidad, lo dejen con ganas de volver.<br>
					Los niños, adolescentes y adultos que nos visiten se sentirán cómodos y bien atendidos en un lugar agradable, limpio, de confianza y con barberos calificados tanto en cortes tradicionales como modernos.<br>
					Entendemos las múltiples ocupaciones del hombre, por eso ofrecemos un horario amplio.
				</p>
			</div>
			
			<!-- contactenos -->
			<div id="contacto"></div>
			<div class="informacion">
				<h3>¡Contáctenos!</h3>
				<p>Contáctenos al número teléfonico 4030-12-06<!-- numero de telefono -->.</p>
				<hr id="separacion"/>
				<h5>Síganos en nuestras redes</h5>
				<div id="redes_sociales" style="text-align: center; font-size: 20px">
					<a href="https://www.facebook.com/BarberiaMAES/?ref=br_rs" class="fa fa-facebook"></a>
					<a href="https://www.instagram.com/barberiamaes/?hl=es-la" class="fa fa-instagram"></a>
				</div>
			</div>
		</div>

		<hr/>

		<!-- pie de pagina -->
		<footer>
			<p style="text-align: center">Diseño y desarrollo por PROAN</p>
		</footer>

		<!-- Modal para sacar cita -->
		<div class="modal fade bg-dark" id="sacarCitaModal" tabindex="-1" role="dialog" aria-labelledby="sacarCitaModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-dark">Sacar cita</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div id="resultados"></div>
						<div class="form-group">
                   			<label for="horario">Horario: </label>
                  		  	<select class="form-control" id="horario" name="horario" required>
                      	  		<?php
	                            	$datos = mysqli_query($conn, "SELECT id_horario FROM horario;");
	                                while($fila = mysqli_fetch_array($datos)){
	                               		echo "<option>" . $fila['id_horario']. "</option>";
                           			}
                    	    	?>
                  		  	</select>
						</div>
						<div class="form-group">
                   			<label for="barbero">Barbero: </label>
                  		  	<select class="form-control" id="barbero" name="barbero" required>
                      	  		<?php
	                            	$datos = mysqli_query($conn, "SELECT NOMBRE FROM USUARIO WHERE ROL = 3");
	                                while($fila = mysqli_fetch_array($datos)){
	                               		echo "<option>" . $fila['NOMBRE']. "</option>";
                           			}
                    	    	?>
                  		  	</select>
						</div>
						<div class="form-group">
                   			<label for="servicio">Servicio: </label>
                  		  	<select class="form-control" id="servicio" name="servicio" required>
                      	  		<?php
	                            	$datos = mysqli_query($conn, "SELECT nombreservicio FROM servicio;");
	                                while($fila = mysqli_fetch_array($datos)){
	                               		echo "<option>" . $fila['nombreservicio']. "</option>";
                           			}
                    	    	?>
                  		  	</select>
						</div>
						<div class="form-group">
                   			<label for="fecha">Fecha: </label><br>
							<input type="text" name="fecha" id="fecha" style="width:250px;height:40px" required>
							<span class="validity"></span>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-success" onclick="sacarCita('sacarCita')">Sacar cita</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal para informacion -->
		<div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="modalSuccess" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-dark">¡Cita reservada satisfactoriamente!</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<b>¡Gracias por su visita!</b>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade bg-dark text-white" data-keyboard="false" id="sacarCitaModalUp" tabindex="-1" role="dialog" aria-labelledby="sacarCitaModalUp" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <div class="modal-header">
            <h5 class="modal-title text-dark">Actualizar cita</h5>
            </div>
            <div class="modal-body">
                        <div id="resultadosCita" style="color:black"></div>
                        <div class="form-group">
                            <label for="barberoUp">Barbero: </label>
                            <select class="form-control" id="barberoUp" name="barberoUp" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT NOMBRE FROM usuario WHERE ROL = 3;");
                                    while($fila = mysqli_fetch_array($datos)){
                                        echo "<option>" . $fila['NOMBRE']. "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="horarioUp">Horario: </label>
                            <select class="form-control" id="horarioUp" name="horarioUp" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT id_horario FROM horario;");
                                    while($fila = mysqli_fetch_array($datos)){
                                        echo "<option>" . $fila['id_horario']. "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="servicioUp">Servicio: </label>
                            <select class="form-control" id="servicioUp" name="servicioUp" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT NOMBRESERVICIO FROM servicio;");
                                    while($fila = mysqli_fetch_array($datos)){
                                        echo "<option>" . $fila['NOMBRESERVICIO']. "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="fechaUp">Fecha: </label><br>
                            <input type="text" name="fechaUp" id="fechaUp" required>
                            <span class="validity"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Volver</button>
                        <button type="button" class="btn btn-success" onclick="realizarActualizacionCitaC('realizarActualizacionCita')">Actualizar cita</button>
                    </div>
           </div>
      </div>
   </div>
           <div class="modal fade" id="modalSuccessUpCita" tabindex="-1" role="dialog" aria-labelledby="modalSuccessUpCita" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">Cita actualizada satisfactoriamente!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>

		<!-- javascript nuestro -->
		<script src="../js/javascript.js"></script>

		<script>
			function openProductos() {
				window.location.replace("verproductos.php");
				return false;
			}
		</script>
		
	</body>
</html>
