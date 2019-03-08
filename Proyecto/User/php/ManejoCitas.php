<?php

    require_once 'config_bd.php';
            session_start();

    if(isset($_POST['llave'])){

        // si se quiere cargar de nuevo la tabla
        if($_POST['llave'] == "cargarTabla"){

            // obtener todas las citas para el cliente
            //lo comentado son intentos fallidos de usar sp
            $id_usuario = $_SESSION['cedula'];
            $query = mysqli_query($conn, "SELECT * FROM CITA WHERE CEDULA = '$id_usuario';");
            //$query = mysql_query($conn, "CALL SP_TABLACLIENTE('$id_usuario');");
			$fecha = date('j-m-Y');
			if($query && $query->num_rows > 0){
				while($data = mysqli_fetch_assoc($query)){
                    $sub_array["fecha"] = $data['FECHA'];
                    $sub_array['hora_cita'] = $data['ID_HORARIO'];
                    //$sub_array['barbero'] = $data['BARBERON'];
                    $sub_array['barbero'] = $data['ID_BARBERO'];
                    $sub_array['servicio'] = $data['ID_SERVICIO'];
                    //$sub_array['servicio'] = $data['NOMBRESERVICIO'];
                    $sub_array ['precio'] = $data['PRECIO'];
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
            $fecha = date("Y-m-d");
            $id_usuario = $_SESSION['cedula'];
            $query = mysqli_query($conn, "SELECT * FROM CITA WHERE FECHA = '$fecha';");    
            while($fila = mysqli_fetch_array($query)){
                    if($fila['ID_BARBERO'] == $id_barbero && $fila['FECHA'] == $fecha && $fila['ID_HORARIO'] == $id_horario){
                        echo "Ya hay cita con este barbero en ese horario"; 
                        break;                
                    }else{
                   // insertar los datos
                    $query = mysqli_query($conn, "INSERT INTO CITA (ID_BARBERO, ID_HORARIO, ID_SERVICIO, PRECIO, CEDULA, FECHA) VALUES ('$id_barbero', '$id_horario', '$id_servicio', '$precio', '$id_usuario', NOW());");
                        echo "Guardado";
                        //echo $fila['ID_BARBERO'] ." " . $id_barbero ." ". $fila['FECHA'] . " " . $fecha;
                        break;
                    }
            }
        }

    }                           
     $conn->close();


?>