<?php

    require_once 'config_bd.php';

    if(isset($_POST['llave'])){


        // si es guardar un usuario
        if($_POST['llave'] == "guardarCliente"){
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $primerApellido = $_POST['primerApellido'];
            $segundoApellido = $_POST['segundoApellido'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $hashed_pwd = password_hash(trim($_POST['pwd']), PASSWORD_DEFAULT);

            // verificar si ese correo aun no exite
            $sql = mysqli_query($conn, "SELECT * FROM usuario WHERE emailc = '$email';");
            $sql2 = mysqli_query($conn, "SELECT * FROM usuario WHERE cedula = '$cedula';");

            if (mysqli_num_rows($sql) > 0) {
                echo "email";
                return;
            }else if(mysqli_num_rows($sql2) > 0){
                echo "id";
                return;
            }
            else{
                // insertar los datos
                $query = mysqli_query($conn, "INSERT INTO usuario (cedula, nombre, primerapellido, segundoapellido, emailc, contrasenna, telefono) VALUES ('$cedula', '$nombre', '$primerApellido', '$segundoApellido', '$email', '$hashed_pwd', '$telefono');");
                
                // traer nombre y id del usuario
                $query = mysqli_query($conn, "SELECT cedula, nombre FROM usuario WHERE emailc = '$email';");

                // iniciar sesion
                session_start();

                // crear un arreglo asociativo con los resultados
                $datos = mysqli_fetch_array($query);
                
                // salvarlos en la sesion
                $_SESSION['cedula'] = $datos['cedula'];
                $_SESSION['nombre'] = $datos['nombre'];

                echo "Guardado";
                }
            }
            if($_POST['llave'] == "realizarActualizacionCita"){
            $id_cita = $_POST['id_cita'];
            $barbero = $_POST['barbero'];
            $horario = $_POST['horario'];
            $servicio = $_POST['servicio'];
            $hora = $_POST['hora']; 

            $query = mysqli_query($conn, "SELECT * FROM USUARIO WHERE rol = 3;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['NOMBRE'] == $barbero){
                    $id_barbero = $fila['CEDULA'];
                    break;
                }
            }
            $query = mysqli_query($conn, "SELECT * FROM HORARIO;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['ID_HORARIO'] == $horario){
                    $idhor = $fila['ID_HORARIO'];
                    $id = explode(":", $idhor);
                    $id_horario = $id[0]."0000";
                    break;
                }
            }
            // obtener servicio
            $query = mysqli_query($conn, "SELECT * FROM SERVICIO;");
            while($fila = mysqli_fetch_array($query)){
                if($fila['NOMBRESERVICIO'] == $servicio){
                    $id_servicio = $fila['ID_SERVICIO'];
                    break;
                }
            }
            $query2 = mysqli_query($conn, "SELECT FECHA FROM CITA WHERE ID_CITA = '$id_cita'");
            $resp = mysqli_fetch_array($query2);
            $fecha = $resp['FECHA'];
            $fecha = strtotime($fecha);
             //SACO CLIENTE Y FECHA
            date_default_timezone_set('America/Costa_Rica');
            //hago un datetime en fechacom
            $fechacom = new DateTime($hora);
            //le defino el formato de la base de datos
            $date =  strtotime($fechacom->format('Y-m-d'));
            $hoy = strtotime(date('Y-m-d'));

            if($hoy >= $fecha){
                echo "No se permite modificar citas con fechas anteriores o igual al dia hoy";
                return;
            }else{
                    $query = mysqli_query($conn, "SELECT * FROM CITA WHERE FECHA = '$date' AND ID_HORARIO = '$id_horario' AND ID_BARBERO = '$id_barbero' AND ID_CITA = 'id_cita';"); 
                    if(mysqli_num_rows($query) > 0){
                        echo "Ya hay cita con este barbero en ese horario"; 
                    }
                    else if(mysqli_query($conn, "CALL SP_ACTUALIZARCITA('$id_cita', '$id_barbero', '$id_horario', '$id_servicio', '$date');")){
                        echo "Se actualizo";
                    }        
                    else{
                        echo "No se actualizo";
                    }
            }
        }

            if($_POST['llave'] == "eliminarCita"){
                $id_cita = $_POST['id'];
                $query = mysqli_query($conn, "DELETE FROM CITA WHERE ID_CITA = '$id_cita';");
                    echo 'Cita eliminada exitosamente.';
            }
            if($_POST['llave'] == "obtenerCita"){
            $id_cita = $_POST['id'];
            $query = mysqli_query($conn, "CALL SP_DATOSACTUALIZARCITA('$id_cita');");
            $array = mysqli_fetch_array($query);
            $array[4] = date("m/d/Y", strtotime($array[4]));
            echo json_encode($array);
            }
            //si es iniciar sesion
            if($_POST['llave'] == "iniciarSesion"){
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];

            // ver si ese correo existe en base de datos
            $query = mysqli_query($conn, "SELECT cedula, nombre, emailc, contrasenna, rol FROM usuario WHERE emailc = '$email';");

            if(mysqli_num_rows($query) > 0){
                // crear arreglo asociativo con los resultados
                $datos = mysqli_fetch_array($query);    

                // si existe el correo, verificar clave
                if(password_verify($pwd, $datos['contrasenna'])){
                    // contraseña correcta, iniciar sesion
                    session_start();
                    // salvarlos en la sesion
                    $_SESSION['cedula'] = $datos['cedula'];
                    $_SESSION['nombre'] = $datos['nombre'];
                    if ($datos['rol'] == 1 ) {
                        $_SESSION['rol'] = 'cliente';
                        echo "Bienvenido cliente";
                        return;
                    } if ($datos['rol'] == 2) {
                        $_SESSION['rol'] = 'admin';
                        echo "Bienvenido admin";
                        return;
                    } if ($datos['rol'] == 3) {
                        $_SESSION['rol'] = 'barbero';
                        echo "Bienvenido barbero";
                        return;
                    } else {
                        echo "Correo o contraseña inválidos.";
                        return;
                    }
                    
                }
                else{
                    // contraseña incorrecta
                    echo "Correo o contraseña inválidos.";
                    return;
                }
            }
            else{
                echo "Correo o contraseña inválidos.";
                return;
            }
        }
                // si es cambiar de correo
        if($_POST['llave'] == "cambioCorreo"){
            session_start();
            $id_usuario = $_SESSION['cedula'];
            $email = $_POST['email'];

            if(!mysqli_query($conn, "UPDATE usuario SET emailc = '$email' WHERE cedula = '$id_usuario';")){
                echo "Error!";
                return;
            }
            else{
                exit("Cambiado");
            }
        }

        // si es cambiar de contraseña
        if($_POST['llave'] == "cambioPwd"){
            session_start();
            $id_usuario = $_SESSION['cedula'];
            $hashed_pwd = password_hash(trim($_POST['pwd']), PASSWORD_DEFAULT);

            if(!mysqli_query($conn, "UPDATE usuario SET contrasenna = '$hashed_pwd' WHERE cedula = '$id_usuario';")){
                echo "Error!";
                return;
            }
            else{
                exit("Cambiado");
            }
        }
        
                // si es cerrar sesion
        if($_POST['llave'] == "cerrarSesion"){
            // inicializar la sesion
            session_start();
            // eliminar los datos de sesion en servidor
            $_SESSION = array();
            // destruir la sesion y revisar por errores
            if(session_destroy()){
                echo "Cerrada";
                return;
            }
            else{
                echo "Ocurrió un error, por favor inténtelo de nuevo.";
                return;
            }
        }
                // si es eliminar usuario
        if($_POST['llave'] == "eliminarCuenta"){
            // inicializar la sesion
            session_start();
            $id_usuario = $_SESSION['cedula'];

            // eliminar los datos de sesion en servidor
            $_SESSION = array();
            // destruir la sesion y revisar por errores
            if(session_destroy()){
                // eliminar todas las compras de este usuario            
                if(!mysqli_query($conn, "DELETE FROM cita WHERE cedula = '$id_usuario';")){
                    echo "Error!";
                    return;
                }
                // eliminar al usuario
                if(!mysqli_query($conn, "DELETE FROM usuario WHERE cedula = '$id_usuario';")){
                    echo "Error!";
                    return;
                }
            }
            else{
                echo "Error!";
                return;
            }
        }

        }
        $conn->close();
?>