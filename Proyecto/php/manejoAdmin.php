<?php

    require_once 'config_bd.php';
            session_start();

    if(isset($_POST['llave'])){
    date_default_timezone_set('America/Costa_Rica');

        // si se quiere cargar de nuevo la tabla
        if($_POST['llave'] == "cargarTablaClientes"){

            // obtener todas las citas para el cliente
            //lo comentado son intentos fallidos de usar sp
            //$query = mysqli_query($conn, "SELECT * FROM CITA WHERE CEDULA = '$id_usuario';");
            $query = mysqli_query($conn, "CALL SP_TABLACLIENTES();");
			if($query && $query->num_rows > 0){
				while($data = mysqli_fetch_assoc($query)){
                    $sub_array["cedula"] = $data['CEDULA'];
                    $sub_array['nombre'] = $data['NOMBRE'];
                    $sub_array['apellidos'] = $data['APELLIDOS'];
                    $sub_array['correo'] = $data['EMAILC'];
                    $sub_array ['telefono'] = $data['TELEFONO'];
                    $arreglo['data'][] = $sub_array;
                }
                echo json_encode($arreglo);
			}
            else{
                $arreglo['data'] = array();
                echo json_encode($arreglo);
                return;
            }
        }
                if($_POST['llave'] == "cargarTablaCitas"){

            // obtener todas las citas para el cliente
            //lo comentado son intentos fallidos de usar sp
            //$query = mysqli_query($conn, "SELECT * FROM CITA WHERE CEDULA = '$id_usuario';");
            $query = mysqli_query($conn, "CALL SP_CITAS();");
            if($query && $query->num_rows > 0){
                while($data = mysqli_fetch_assoc($query)){
                    $sub_array["idcita"] = $data['ID_CITA'];
                    $sub_array['nombre'] = $data['NOMBRE'];
                    $sub_array['horario'] = $data['ID_HORARIO'];
                    $sub_array['cedula'] = $data['CEDULA'];
                    $sub_array ['usuario'] = $data['USUARIO'];
                    $sub_array["fecha"] = $data['FECHA'];
                    $sub_array['desc'] = $data['DESCRIPCION'];
                    $sub_array['servicio'] = $data['NOMBRESERVICIO'];
                    $sub_array ['precio'] = $data['PRECIOSERVICIO'];
                    $arreglo['data'][] = $sub_array;
                }
                echo json_encode($arreglo);
            }
            else{
                $arreglo['data'] = array();
                echo json_encode($arreglo);
                return;
            }
        }
                if($_POST['llave'] == "cargarTablaBarberos"){

            // obtener todas las citas para el cliente
            //lo comentado son intentos fallidos de usar sp
            //$query = mysqli_query($conn, "SELECT * FROM CITA WHERE CEDULA = '$id_usuario';");
            $query = mysqli_query($conn, "CALL SP_BARBEROS();");
            if($query && $query->num_rows > 0){
                while($data = mysqli_fetch_assoc($query)){
                    $sub_array["cedula"] = $data['CEDULA'];
                    $sub_array['nombre'] = $data['NOMBRE'];
                    $sub_array['apellidos'] = $data['APELLIDOS'];
                    $sub_array['correo'] = $data['EMAILC'];
                    $sub_array ['telefono'] = $data['TELEFONO'];
                    $arreglo['data'][] = $sub_array;
                }
                echo json_encode($arreglo);
            }
            else{
                $arreglo['data'] = array();
                echo json_encode($arreglo);
                return;
            }
        }
                        if($_POST['llave'] == "cargarTablaProductos"){

            // obtener todas las citas para el cliente
            //lo comentado son intentos fallidos de usar sp
            //$query = mysqli_query($conn, "SELECT * FROM CITA WHERE CEDULA = '$id_usuario';");
            $query = mysqli_query($conn, "CALL SP_PRODUCTOS();");
            if($query && $query->num_rows > 0){
                while($data = mysqli_fetch_assoc($query)){
                    $sub_array["id_producto"] = $data['ID_PRODUCTO'];
                    $sub_array['nombre'] = $data['NOMBRE'];
                    $sub_array['desc'] = $data['DESCRIPCION'];
                    $sub_array['precio'] = $data['PRECIO'];
                    $sub_array ['cantidad'] = $data['CANTIDAD'];
                    $arreglo['data'][] = $sub_array;
                }
                echo json_encode($arreglo);
            }
            else{
                $arreglo['data'] = array();
                echo json_encode($arreglo);
                return;
            }
        }

        if($_POST['llave'] == "sacarCita"){
            $barbero = $_POST['barbero'];
            $servicio = $_POST['servicio'];
            $horario = $_POST['horario'];
            $fecha = $_POST['fecha'];           
            // obtener barbero
            $query = mysqli_query($conn, "SELECT * FROM BARBERO;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['NOMBREB'] == $barbero){
                    $id_barbero = $fila['ID_BARBERO'];
                    break;
                }
            }
            $query = mysqli_query($conn, "SELECT * FROM HORARIO;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['ID_HORARIO'] == $horario){
                    $id_horario = $fila['ID_HORARIO'];
                    break;
                }
            }
            // obtener servicio
            $query = mysqli_query($conn, "SELECT * FROM SERVICIO;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['NOMBRESERVICIO'] == $servicio){
                    $id_servicio = $fila['ID_SERVICIO'];
                    $precio = $fila['PRECIOSERVICIO'];
                    break;
                }
            }
             //SACO CLIENTE Y FECHA
            date_default_timezone_set('America/Costa_Rica');
            //hago un datetime en fechacom
            $fechacom = new DateTime($fecha);
            //le defino el formato de la base de datos
            $date =  $fechacom->format('Y-m-d');
            //fecha de hoy
            $fecha2 = date("Y-m-d");
            //hora de hoy
            $hora = date('H:i:s');
            $id_usuario = $_SESSION['cedula'];
            $query = mysqli_query($conn, "SELECT * FROM CITA WHERE FECHA = '$date' AND ID_HORARIO = '$id_horario' AND ID_BARBERO = '$id_barbero';"); 
            if(mysqli_num_rows($query) > 0){
                echo "Ya hay cita con este barbero en ese horario"; 
            }
            else{
                $query = mysqli_query($conn, "INSERT INTO CITA (ID_BARBERO, ID_HORARIO, ID_SERVICIO, PRECIO, CEDULA, FECHA) 
                        VALUES ('$id_barbero', '$id_horario', '$id_servicio', '$precio', '$id_usuario', '$date');");
                echo "Guardado";
            }
        }
        if($_POST['llave'] == "consulta"){
            $barbero = $_POST['barbero'];
            $horario = $_POST['horario'];
            $fecha = $_POST['fecha'];           
            // obtener barbero
            $query = mysqli_query($conn, "SELECT * FROM BARBERO;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['NOMBREB'] == $barbero){
                    $id_barbero = $fila['ID_BARBERO'];
                    break;
                }
            }
            $query = mysqli_query($conn, "SELECT * FROM HORARIO;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['ID_HORARIO'] == $horario){
                    $id_horario = $fila['ID_HORARIO'];
                    break;
                }
            }
             //SACO CLIENTE Y FECHA
            date_default_timezone_set('America/Costa_Rica');
            //hago un datetime en fechacom
            $fechacom = new DateTime($fecha);
            //le defino el formato de la base de datos
            $date =  $fechacom->format('Y-m-d');
            //fecha de hoy
            $fecha2 = date("Y-m-d");
            //hora de hoy
            $hora = date('H:i:s');
            $query = mysqli_query($conn, "SELECT * FROM CITA WHERE FECHA = '$date' AND ID_HORARIO = '$id_horario' AND ID_BARBERO = '$id_barbero';"); 
            if(mysqli_num_rows($query) > 0){
                echo "Ya hay cita con este barbero en ese horario"; 
            }
            else{
                echo "Sí hay espacio disponible para el horario consultado.<br> Registrese para reservar!";
            }
        }

    }                           
     $conn->close();


?>