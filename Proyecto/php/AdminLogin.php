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
		<!-- nuestros estilos-->
        <link rel="stylesheet" type="text/css" href="../css/EstilosLogin.css">
        <link rel="stylesheet" type="text/css" href="../css/custom.css">

		<!-- font awesome library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

    <!-- javascript nuestro -->
	<script src="../js/JavaScript.js"></script>

    <script>
        function openProductos() {
            window.location.replace("verProductos.php");
            return false;
        }
    </script>
    
   
</body>