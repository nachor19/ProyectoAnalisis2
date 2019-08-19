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
        <script>
        $( function() {
        $( "#fechaUp" ).datepicker({ minDate: setFecha()});
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
            <li><a href="#tabs-5">Administrador</a></li>
          </ul>
          <div id="tabs-1">
            <button type="submit" class="btn btn-outline-success pull-right" id="agregarCliente" data-toggle="modal" data-target="#agregarClienteModal">Agregar cliente</button>
            <div id="miResultado"></div>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_clientes">
                <thead>
                <th>Cedula</th>
                 <th>Nombre</th>
                 <th>Apellidos</th>
                 <th>Correo Electronico</th>
                 <th>Telefono</th> 
                 <th></th>
                 <th></th>
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>
          <div id="tabs-2">
            <button type="submit" class="btn btn-outline-success pull-right" id="sacarCita" data-toggle="modal" data-target="#sacarCitaModal">Agregar cita</button>
            <div id="miResultadoC"></div>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_citas">
                <thead>
                <th># Cita</th>
                 <th>Barbero</th>
                 <th>Horario</th>
                 <th>Cedula</th>
                 <th>Cliente</th>
                 <th>Fecha</th>
                 <th>Descripcion</th>
                 <th>Estado</th>
                 <th>Servicio</th>
                 <th>Precio</th> 
                 <th></th>
                 <th></th>
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>
          <div id="tabs-3">
            <button type="submit" class="btn btn-outline-success pull-right" id="agregarBarbero" data-toggle="modal" data-target="#agregarBarbModal">Agregar barbero</button>
            <div id="miResultadoB"></div>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_barberos">
                <thead>
                <th>Cedula</th>
                 <th>Nombre</th>
                 <th>Apellidos</th>
                 <th>Correo Electronico</th>
                 <th>Telefono</th> 
                 <th></th>
                 <th></th>
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>
            <div id="tabs-4">
            <button type="submit" class="btn btn-outline-success pull-right" id="agregarProducto" data-toggle="modal" data-target="#agregarProductoModal">Agregar producto</button>
            <div id="miResultadoP"></div>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_productos">
                <thead>
                <th># Producto</th>
                 <th>Nombre</th>
                 <th>Descripcion</th>
                 <th>Precio</th>
                 <th>Cantidad</th>
                 <th></th>
                 <th></th> 
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>
        <div id="tabs-5">
            <button type="submit" class="btn btn-outline-success pull-right" id="agregarAdmin" data-toggle="modal" data-target="#agregarAdminModal">Agregar administrador</button>
            <div id="miResultadoA"></div>
            <table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_admins">
                <thead>
                <th>Cedula</th>
                 <th>Nombre</th>
                 <th>Apellidos</th>
                 <th>Correo Electronico</th>
                 <th>Telefono</th> 
                 <th></th>
                 <th></th>
                 </thead>
                 <tbody>
                </tbody>
            </table>
          </div>

       <!-- Modal para cliente -->
        <div class="modal fade bg-dark text-white" id="agregarClienteModal" tabindex="-1" role="dialog" aria-labelledby="agregarClienteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Registre los datos del cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div id="miResp"></div>
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
        <div class="modal fade bg-dark text-white" data-keyboard="false" id="sacarCitaModal" tabindex="-1" role="dialog" aria-labelledby="sacarCitaModal" aria-hidden="true">
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
                        <div class="form-group" id="descErrUp">
                            <label for="descUp" class="text-dark">Descripcion:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="descUp" name="descUp" required>
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

           <div class="modal fade" id="modalSuccessCita" tabindex="-1" role="dialog" aria-labelledby="modalSuccessCita" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">¡Cita agregada!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>
          <!-- Modal para cliente -->
        <div class="modal fade bg-dark text-white" data-keyboard="false" id="actualizarClienteModal" tabindex="-1" role="dialog" aria-labelledby="actualizarClienteModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Actualice los datos del cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="cedulaErrUp">
                            <label for="cedulaUp" class="text-dark">Cedula:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="cedulaUp" name="cedulaUp" readonly="readonly" required>
                        </div>
                        <div id="cedulaUpErr"></div>
                        <div class="form-group" id="nombreErrUp">
                            <label for="nombreUp" class="text-dark">Nombre:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="nombreUp" name="nombreUp" required>
                        </div>
                        <div id="nombreUpErr"></div>
                        <div class="form-group" id="primerApellidoDivUp">
                            <label for="primerApellidoUp" class="text-dark">Primer apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="primerApellidoUp" name="primerApellidoUp" required>
                        </div>
                        <div id="primerApellidoUpErr"></div>
                        <div class="form-group" id="segundoApellidoDivUp">
                            <label for="segundoApellidoUp" class="text-dark">Segundo apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="segundoApellidoUp" name="segundoApellidoUp">
                        </div>
                        <div id="segundoApellidoUpErr"></div>
                        <div class="form-group" id="telefonoDivUp">
                            <label for="telefonoUp" class="text-dark">Telefono:</label>
                            <input autocomplete="off" type="tel" class="form-control" id="telefonoUp" onkeypress="return soloNumeros(event)" maxlength="8" name="telefonoUp">
                        </div>
                        <div id="telefonoUpErr"></div>
                        <div class="form-group" id="emailDivUp">
                            <label for="emailUp" class="text-dark">Correo:</label>
                            <input autocomplete="off" type="email" class="form-control" id="emailUp" name="emailUp" required>
                        </div>
                        <div id="emailUpErr"></div>
                        <div class="form-group">
                            <label for="rolUp">Rol: </label>
                            <select class="form-control" id="rolUp" name="rolUp" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT NOMBRE_ROL FROM roles;");
                                    while($fila = mysqli_fetch_array($datos)){
                                        echo "<option>" . strtoupper($fila['NOMBRE_ROL']) . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="realizarActualizacion('actualizarCliente')">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para informacion -->
        <div class="modal fade" id="modalSuccessUp" tabindex="-1" role="dialog" aria-labelledby="modalSuccessUp" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">¡Cliente actualizado satisfactoriamente!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                        <div class="form-group" id="idCitaUpErr">
                            <label for="idCitaUp" class="text-dark"># Cita:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="idCitaUp" name="idCitaUp" readonly="readonly" required>
                        </div>
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
                        <button type="button" class="btn btn-success" onclick="realizarActualizacionCita('realizarActualizacionCita')">Sacar cita</button>
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

        <div class="modal fade bg-dark text-white" id="agregarBarbModal" tabindex="-1" role="dialog" aria-labelledby="agregarBarbModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Registre los datos del barbero</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="cedulaBarbDiv">
                            <label for="cedulaBarb" class="text-dark">Número de cédula:</label>
                            <input autocomplete="off" type="text" class="form-control" id="cedulaBarb" placeholder="Cedula" maxlength="9" onkeypress="return soloNumeros(event)" name="cedulaBarb" required>
                        </div>
                        <div id="cedulaBarbErr"></div>
                        <div class="form-group" id="nombreBarbDiv">
                            <label for="nombreBarb" class="text-dark">Nombre:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="nombreBarb" placeholder="Nombre" name="nombreBarb" required>
                        </div>
                        <div id="nombreBarbErr"></div>
                        <div class="form-group" id="primerApellidoBarbDiv">
                            <label for="primerApellidoBarb" class="text-dark">Primer apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="primerApellidoBarb" placeholder="Primer apellido" name="primerApellidoBarb" required>
                        </div>
                        <div id="primerApellidoBarbErr"></div>
                        <div class="form-group" id="segundoApellidoBarbDiv">
                            <label for="segundoApellidoBarb" class="text-dark">Segundo apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="segundoApellidoBarb" placeholder="Segundo apellido" name="segundoApellidoBarb">
                        </div>
                        <div id="telefonoBarbErr"></div>
                        <div class="form-group" id="telefonoBarbDiv">
                            <label for="telefonoBarb" class="text-dark">Telefono:</label>
                            <input autocomplete="off" type="tel" class="form-control" id="telefonoBarb" onkeypress="return soloNumeros(event)" maxlength="8" placeholder="Telefono como 12345678" name="telefonoBarb">
                        </div>
                        <div id="telefonoBarbErr"></div>
                        <div class="form-group" id="emailBarbDiv">
                            <label for="emailBarb" class="text-dark">Correo:</label>
                            <input autocomplete="off" type="email" class="form-control" id="emailBarb" placeholder="Correo" name="emailBarb" required>
                        </div>
                        <div id="emailBarbErr"></div>
                        <div class="form-group" id="pwdBarbDiv">
                            <label for="pwdBarb" class="text-dark">Contraseña:</label>
                            <input autocomplete="off" type="password" class="form-control" id="pwdBarb" placeholder="Digite su contraseña" name="pwdBarb">
                        </div>
                        <div id="pwdBarbErr"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="guardarBarberoA('guardarBarbero')">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal exito -->
        <div class="modal fade" id="modalSuccessBarb" tabindex="-1" role="dialog" aria-labelledby="modalSuccessBarb" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">¡Barbero agregado!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bg-dark text-white" data-keyboard="false" id="actualizarBarberoModal" tabindex="-1" role="dialog" aria-labelledby="actualizarBarberoModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Actualice los datos del barbero</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div id="miRespB"></div>
                    <div class="modal-body">
                        <div class="form-group" id="cedulaBarbErrUp">
                            <label for="cedulaBarbUp" class="text-dark">Cedula:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="cedulaBarbUp" name="cedulaBarbUp" readonly="readonly" required>
                        </div>
                        <div id="cedulaBarbUpErr"></div>
                        <div class="form-group" id="nombreBarbErrUp">
                            <label for="nombreBarbUp" class="text-dark">Nombre:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="nombreBarbUp" name="nombreBarbUp" required>
                        </div>
                        <div id="nombreBarbUpErr"></div>
                        <div class="form-group" id="primerApellidoBarbDivUp">
                            <label for="primerApellidoBarbUp" class="text-dark">Primer apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="primerApellidoBarbUp" name="primerApellidoBarbUp" required>
                        </div>
                        <div id="primerApellidoBarbUpErr"></div>
                        <div class="form-group" id="segundoApellidoBarbDivUp">
                            <label for="segundoApellidoBarbUp" class="text-dark">Segundo apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="segundoApellidoBarbUp" name="segundoApellidoBarbUp">
                        </div>
                        <div id="segundoApellidoBarbUpErr"></div>
                        <div class="form-group" id="telefonoBarbDivUp">
                            <label for="telefonoBarbUp" class="text-dark">Telefono:</label>
                            <input autocomplete="off" type="tel" class="form-control" id="telefonoBarbUp" onkeypress="return soloNumeros(event)" maxlength="8" name="telefonoBarbUp">
                        </div>
                        <div id="telefonoBarbUpErr"></div>
                        <div class="form-group" id="emailBarbDivUp">
                            <label for="emailBarbUp" class="text-dark">Correo:</label>
                            <input autocomplete="off" type="email" class="form-control" id="emailBarbUp" name="emailBarbUp" required>
                        </div>
                        <div id="emailBarbUpErr"></div>
                        <div class="form-group">
                            <label for="rolBarbUp">Rol: </label>
                            <select class="form-control" id="rolBarbUp" name="rolBarbUp" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT NOMBRE_ROL FROM roles;");
                                    while($fila = mysqli_fetch_array($datos)){
                                      if($fila['NOMBRE_ROL'] == 'BARBERO'){
                                        echo '<option selected>' . $fila['NOMBRE_ROL'] . '</option>';
                                      }else{
                                        echo "<option>" . $fila['NOMBRE_ROL'] . "</option>";
                                      }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="realizarActualizacionB('actualizarBarbero')">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para informacion -->
        <div class="modal fade" id="modalSuccessBarUp" tabindex="-1" role="dialog" aria-labelledby="modalSuccessBarUp" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">Barbero actualizado satisfactoriamente!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bg-dark text-white" data-keyboard="false" id="agregarAdminModal" tabindex="-1" role="dialog" aria-labelledby="agregarAdminModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Registre los datos del administrador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div id="miRespA"></div>
                    <div class="modal-body">
                        <div class="form-group" id="cedulaAdminDiv">
                            <label for="cedulaAdmin" class="text-dark">Cedula:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" maxlength="9" onkeypress="return soloNumeros(event)" id="cedulaAdmin" name="cedulaAdmin" required>
                        </div>
                        <div id="cedulaAdminErr"></div>
                        <div class="form-group" id="nombreAdminDiv">
                            <label for="nombreAdmin" class="text-dark">Nombre:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="nombreAdmin" name="nombreAdmin" required>
                        </div>
                        <div id="nombreAdminErr"></div>
                        <div class="form-group" id="primerApellidoAdminDiv">
                            <label for="primerApellidoAdmin" class="text-dark">Primer apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="primerApellidoAdmin" name="primerApellidoAdmin" required>
                        </div>
                        <div id="primerApellidoAdminErr"></div>
                        <div class="form-group" id="segundoApellidoAdminDiv">
                            <label for="segundoApellidoAdmin" class="text-dark">Segundo apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="segundoApellidoAdmin" name="segundoApellidoAdmin">
                        </div>
                        <div id="segundoApellidoAdminErr"></div>
                        <div class="form-group" id="telefonoAdminDiv">
                            <label for="telefonoAdmin" class="text-dark">Telefono:</label>
                            <input autocomplete="off" type="tel" class="form-control" id="telefonoAdmin" onkeypress="return soloNumeros(event)" maxlength="8" name="telefonoAdmin">
                        </div>
                        <div id="telefonoAdminErr"></div>
                        <div class="form-group" id="emailAdminDiv">
                            <label for="emailAdmin" class="text-dark">Correo:</label>
                            <input autocomplete="off" type="email" class="form-control" id="emailAdmin" name="emailAdmin" required>
                        </div>
                        <div id="emailAdminErr"></div>
                        <div class="form-group" id="pwdBarbDiv">
                            <label for="pwdBarb" class="text-dark">Contraseña:</label>
                            <input autocomplete="off" type="password" class="form-control" id="pwdAdmin" placeholder="Digite su contraseña" name="pwdAdmin">
                        </div>
                        <div id="pwdAdminErr"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="registrarAdmin('registrarAdmin')">Registrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para informacion -->
        <div class="modal fade" id="modalSuccessAdmin" tabindex="-1" role="dialog" aria-labelledby="modalSuccessAdmin" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">Administrador registrado satisfactoriamente!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bg-dark text-white" data-keyboard="false" id="agregarProductoModal" tabindex="-1" role="dialog" aria-labelledby="agregarProductoModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Registre los datos del producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div id="miRespA"></div>
                    <div class="modal-body">
                        <div class="form-group" id="nomProdDiv">
                            <label for="nombreProd" class="text-dark">Nombre del producto:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="nombreProd" name="nombreProd" required>
                        </div>
                        <div id="nombreProdErr"></div>
                        <div class="form-group" id="descProdDiv">
                            <label for="descProd" class="text-dark">Descripcion:</label>
                            <input autocomplete="off" type="text" class="form-control" id="descProd" name="descProd" required>
                        </div>
                        <div id="descProdErr"></div>
                        <div class="form-group" id="precioProdDiv">
                            <label for="precioProd" class="text-dark">Precio:</label>
                            <input autocomplete="off" type="text" class="form-control" onkeypress="return soloNumeros(event)" id="precioProd" name="precioProd">
                        </div>
                        <div id="precioProdErr"></div>
                        <div class="form-group" id="cantProdDiv">
                            <label for="cantProd" class="text-dark">Cantidad:</label>
                            <input autocomplete="off" type="number" class="form-control" id="cantProd" min="0" name="cantProd">
                        </div>
                        <div id="cantProdErr"></div>
                        <br>
                        <div class="form-group" id="imgProdDiv">
                          <label class="file">
                          <input type="file" id="file"/>
                          <label for="file" class="btn-2">Cargar imagen</label>
                          </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="registrarProducto('registrarProducto')">Registrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para informacion -->
        <div class="modal fade" id="modalSuccessProd" tabindex="-1" role="dialog" aria-labelledby="modalSuccessProd" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">Producto registrado satisfactoriamente!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>

                <div class="modal fade bg-dark text-white" data-keyboard="false" id="actualizarProductoModal" tabindex="-1" role="dialog" aria-labelledby="actualizarProductoModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Actualice los datos del producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div id="miResp"></div>
                    <div class="modal-body">
                            <div class="form-group" id="idProdDivUp">
                            <label for="idProdUp" class="text-dark">Id del producto:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="idProdUp" name="idProdUp" readonly="readonly" required>
                        </div>
                        <div class="form-group" id="nomProdDivUp">
                            <label for="nombreProdUp" class="text-dark">Nombre del producto:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="nombreProdUp" name="nombreProdUp" required>
                        </div>
                        <div id="nombreProdErrUp"></div>
                        <div class="form-group" id="descProdDivUp">
                            <label for="descProdUp" class="text-dark">Descripcion:</label>
                            <input autocomplete="off" type="text" class="form-control" id="descProdUp" name="descProdUp" required>
                        </div>
                        <div id="descProdErrUp"></div>
                        <div class="form-group" id="precioProdDivUp">
                            <label for="precioProdUp" class="text-dark">Precio:</label>
                            <input autocomplete="off" type="text" class="form-control" onkeypress="return soloNumeros(event)" id="precioProdUp" name="precioProdUp">
                        </div>
                        <div id="precioProdErrUp"></div>
                        <div class="form-group" id="cantProdDivUp">
                            <label for="cantProdUp" class="text-dark">Cantidad:</label>
                            <input autocomplete="off" type="number" class="form-control" id="cantProdUp" min="0" name="cantProdUp">
                        </div>
                        <div id="cantProdErrUp"></div>
                        <br>
                        <div class="form-group" id="imgProdDivUp">
                          <label class="file">
                          <input type="file" id="fileUp"/>
                          <label for="fileUp" class="btn-2">Cargar imagen</label>
                          </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="realizarActualizacionP('actualizarProducto')">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para informacion -->
        <div class="modal fade" id="modalSuccessProdUp" tabindex="-1" role="dialog" aria-labelledby="modalSuccessProdUp" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">Producto actualizado satisfactoriamente!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bg-dark text-white" data-keyboard="false" id="actualizarAdminModal" tabindex="-1" role="dialog" aria-labelledby="actualizarAdminModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark">Actualice los datos del administrador</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div id="respAdminUp"></div>
                    <div class="modal-body">
                        <div class="form-group" id="cedulaAdminDivUp">
                            <label for="cedulaAdminUp" class="text-dark">Cedula:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="cedulaAdminUp" name="cedulaAdminUp" readonly="readonly" required>
                        </div>
                        <div id="cedulaAdminUpErr"></div>
                        <div class="form-group" id="nombreAdminUpDiv">
                            <label for="nombreAdminUp" class="text-dark">Nombre:</label>
                            <input autofocus autocomplete="off" type="text" class="form-control" id="nombreAdminUp" name="nombreAdminUp" required>
                        </div>
                        <div id="nombreAdminUpErr"></div>
                        <div class="form-group" id="primerApellidoAdminDivUp">
                            <label for="primerApellidoAdminUp" class="text-dark">Primer apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="primerApellidoAdminUp" name="primerApellidoAdminUp" required>
                        </div>
                        <div id="primerApellidoAdminUpErr"></div>
                        <div class="form-group" id="segundoApellidoAdminDivUp">
                            <label for="segundoApellidoAdminUp" class="text-dark">Segundo apellido:</label>
                            <input autocomplete="off" type="text" class="form-control" id="segundoApellidoAdminUp" name="segundoApellidoAdminUp">
                        </div>
                        <div id="segundoApellidoAdminUpErr"></div>
                        <div class="form-group" id="telefonoAdminDivUp">
                            <label for="telefonoAdminUp" class="text-dark">Telefono:</label>
                            <input autocomplete="off" type="tel" class="form-control" id="telefonoAdminUp" onkeypress="return soloNumeros(event)" maxlength="8" name="telefonoAdminUp">
                        </div>
                        <div id="telefonoAdminUpErr"></div>
                        <div class="form-group">
                            <label for="rolAdminUp">Rol: </label>
                            <select class="form-control" id="rolAdminUp" name="rolAdminUp" required>
                                <?php
                                    $datos = mysqli_query($conn, "SELECT NOMBRE_ROL FROM roles;");
                                    while($fila = mysqli_fetch_array($datos)){
                                      if($fila['NOMBRE_ROL'] == 'ADMINISTRADOR'){
                                        echo '<option selected>' . $fila['NOMBRE_ROL'] . '</option>';
                                      }else{
                                        echo "<option>" . $fila['NOMBRE_ROL'] . "</option>";
                                      }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="realizarActualizacionAdmin('actualizarAdmin')">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para informacion -->
        <div class="modal fade" id="modalSuccessAdminUp" tabindex="-1" role="dialog" aria-labelledby="modalSuccessAdminUp" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark">¡Administrador actualizado satisfactoriamente!</h4>
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