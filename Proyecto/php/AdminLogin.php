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
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <style type="text/css">
            label {color: black; font-family: 'Indie Flower', cursive;}
        </style>


		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js "></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>
        <script>
        $( function() {
        $( "#tabs" ).tabs();
        } );
        </script>
        <script>
        $( function() {
        $( "#fecha" ).datepicker({ minDate: setFecha()});
        } );
        </script>
		<!-- nuestros estilos-->
        <link rel="stylesheet" type="text/css" href="../css/estiloslogin.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css">

		<!-- font awesome library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">
        .nombreCli{
            text-align: left;
        }
        </style>
	</head>
    
    <body onload="cargarTablas()">
        <div>
            <div>
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
						<li><a class="nav-link" href="AjustesAdmin.php">Ajustes</a></li>
						<li><button type="button" class="btn btn-link" onclick="cerrarSesion('cerrarSesion')">Salir</button></li>
					</ul>
				</div>
			</nav> 	
        </div>  
        
        
        <div class="row">
            <div class="col-xs-8 col-sm-8">
                <p><h2 class="pull-left">Administrador</h2></p>
                
                <p><h2 >Bienvenido, <?php echo $_SESSION['nombre'] ?> </h2></p>
            </div>
        </div>        
        <hr/>
            
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">Clientes</a></li>
            <li><a href="#tabs-2">Citas</a></li>
            <li><a href="#tabs-3">Barberos</a></li>
            <li><a href="#tabs-4">Productos</a></li>
          </ul>
          <div id="tabs-1">
            <button type="submit" class="btn btn-outline-success pull-right" id="agregarCliente" data-toggle="modal" data-target="#agregarClienteModal">Agregar cliente</button>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_clientes">
                <thead>
                <th>Cedula</th>
                 <th>Nombre</th>
                 <th>Apellidos</th>
                 <th>Correo Electronico</th>
                 <th>Telefono</th> 
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>
          <div id="tabs-2">
            <button type="submit" class="btn btn-outline-success pull-right" id="sacarCita" data-toggle="modal" data-target="#sacarCitaModal">Agregar cita</button>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_citas">
                <thead>
                <th># Cita</th>
                 <th>Barbero</th>
                 <th>Horario</th>
                 <th>Cedula</th>
                 <th>Cliente</th>
                 <th>Fecha</th>
                 <th>Descripcion</th>
                 <th>Servicio</th>
                 <th>Precio</th> 
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>
          <div id="tabs-3">
            <button type="submit" class="btn btn-outline-success pull-right" id="agregarBarbero" data-toggle="modal" data-target="#agregarBarberoModal">Agregar barbero</button>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_barberos">
                <thead>
                <th>Cedula</th>
                 <th>Nombre</th>
                 <th>Apellidos</th>
                 <th>Correo Electronico</th>
                 <th>Telefono</th> 
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>
            <div id="tabs-4">
            <button type="submit" class="btn btn-outline-success pull-right" id="agregarProducto" data-toggle="modal" data-target="#agregarProductoModal">Agregar producto</button>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_productos">
                <thead>
                <th># Producto</th>
                 <th>Nombre</th>
                 <th>Descripcion</th>
                 <th>Precio</th>
                 <th>Cantidad</th> 
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>
        </div>

       <!-- Modal para cliente -->
        <div class="modal fade bg-dark text-white" id="agregarClienteModal" tabindex="-1" role="dialog" aria-labelledby="agregarClienteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Registre los datos del cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="cedulaDiv">
                            <label for="cedula" class="text-dark">Número de cédula:</label>
                            <input autocomplete="off" type="text" class="form-control" id="cedula" placeholder="Cedula" maxlength="9" onkeypress="return soloNumeros(event)" name="cedula" required>
                        </div>
                        <div id="cedulaErr"></div>
                        <div class="form-group" id="nombreDiv">
                            <label for="nombre" class="text-dark">Nombre:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required>
                        </div>
                        <div id="nombreErr"></div>
                        <div class="form-group" id="primerApellidoDiv">
                            <label for="primerApellido" class="text-dark">Primer apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="primerApellido" placeholder="Primer apellido" name="primerApellido" required>
                        </div>
                        <div id="primerApellidoErr"></div>
                        <div class="form-group" id="segundoApellidoDiv">
                            <label for="segundoApellido" class="text-dark">Segundo apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="segundoApellido" placeholder="Segundo apellido" name="segundoApellido">
                        </div>
                        <div class="form-group" id="telefonoDiv">
                            <label for="telefono" class="text-dark">Telefono:</label>
                            <input autocomplete="off" type="tel" class="form-control" id="telefono" onkeypress="return soloNumeros(event)" maxlength="8" placeholder="Telefono como 12345678" name="telefono">
                        </div>
                        <div id="telefonoErr"></div>
                        <div class="form-group" id="emailDiv">
                            <label for="email" class="text-dark">Correo:</label>
                            <input autocomplete="off" type="email" class="form-control" id="email" placeholder="Correo" name="email" required>
                        </div>
                        <div id="emailErr"></div>
                        <div class="form-group" id="pwdDiv">
                            <label for="pwd" class="text-dark">Contraseña:</label>
                            <input autocomplete="off" type="password" class="form-control" id="pwd" placeholder="Digite su contraseña" name="pwd">
                        </div>
                        <div id="pwdErr"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="guardarClienteA('guardarCliente')">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal exito -->
        <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="modalSuccess" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">¡Cliente agregado!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bg-dark text-white" data-keyboard="false" data-backdrop="static" id="sacarCitaModal" tabindex="-1" role="dialog" aria-labelledby="sacarCitaModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           <div class="modal-header">
            <h5 class="modal-title text-dark">Sacar cita</h5>
            </div>
            <div class="modal-body">
                        <div id="resultados"></div>
                        <div class="form-group">
                            <label for="barbero">Barbero: </label>
                            <select class="form-control" id="barbero" name="barbero" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT NOMBRE FROM usuario WHERE ROL = 3;");
                                    while($fila = mysqli_fetch_array($datos)){
                                        echo "<option>" . $fila['NOMBRE']. "</option>";
                                    }
                                ?>
                            </select>
                        </div>
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
                            <label for="horario">Servicio: </label>
                            <select class="form-control" id="servicio" name="servicio" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT NOMBRESERVICIO FROM servicio;");
                                    while($fila = mysqli_fetch_array($datos)){
                                        echo "<option>" . $fila['NOMBRESERVICIO']. "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cliente">Cliente: </label>
                            <select class="form-control" id="cliente" onchange="showAll('cargarDatos')" name="cliente" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT CEDULA FROM usuario WHERE ROL = 1;");
                                    while($fila = mysqli_fetch_array($datos)){
                                        echo "<option>" . $fila['CEDULA']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="datosInput">
                            <label id="lblNombre" form="nombreCli" style="display: inline-block;">Nombre: </label>
                            <input type="text" class="nombreCli" id="nombreCli" readonly="readonly" style="text-align: left; width: 230px;"><br><br>
                            <label id="lblApellido1" form="nombreCli" style="display: inline-block;">Primer apellido: </label>
                            <input type="text" type="hidden" id="Apellido1Cli" readonly="readonly" style="text-align: left; width:230px;"><br><br>
                            <label id="lblApellido2" form="nombreCli" style="display: inline-block;">Segundo apellido: </label>
                            <input type="text" type="hidden" id="Apellido2Cli" readonly="readonly" style="text-align: left; width:230px;">
                        </div>
                        <br>
                        <div class="form-group">
                        <label for="fecha">Fecha: </label><br>
                            <input type="text" name="fecha" id="fecha" required>
                            <span class="validity"></span>
                        </div>
                        <div>
                            <a data-dismiss="modal" data-toggle="modal" href="#agregarClienteModal">Es cliente nuevo? Registrelo</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Volver</button>
                        <button type="button" class="btn btn-success" onclick="sacarCitaAdmin('sacarCitaAdmin')">Sacar cita</button>
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