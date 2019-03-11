<?php

	require_once 'config_bd.php';
?>
<html>
<head>
   <meta charset="utf-8">
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="HTML, CSS, JavaScript">
   <title>Ver Citas</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="../css/EstilosVerCita.css">
   <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <script>
      $(document).ready(function()
      {
         $("#verCitaModal").modal("show");
         $('#verCitaModal').modal({backdrop: 'static', keyboard: false})
      });
    </script>
</head>
<body onload="setFecha()">
   <div class="modal fade bg-dark text-white" data-keyboard="false" data-backdrop="static" id="verCitaModal" tabindex="-1" role="dialog" aria-labelledby="verCitaModal" aria-hidden="true">
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
	                            	$datos = mysqli_query($conn, "SELECT nombreb FROM barbero;");
	                                while($fila = mysqli_fetch_array($datos)){
	                               		echo "<option>" . $fila['nombreb']. "</option>";
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
                   			<label for="fecha">Fecha: </label><br>
							<input type="date" name="fecha" id="fecha" required>
							<span class="validity"></span>
						</div>
						<div>
							<a href="http://localhost/ProyectoAnalisis2/Proyecto/User/html/index.html">Registrarse</a>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-dark" onclick="volver()">Cancelar</button>
						<button type="button" class="btn btn-success" onclick="consultarCita('consulta')">Consultar</button>
					</div>
           </div>
      </div>
   </div>
</div>
		<!-- javascript nuestro -->
		<script src="../js/JavaScript.js"></script>
</body>
</html>