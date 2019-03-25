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
                echo "El correo ingresado ya ha sido registrado.";
                return;
            }else if(mysqli_num_rows($sql2) > 0){
                echo "La cedula ingresada ya ha sido registrada";
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
                    } else {
                        $_SESSION['rol'] = 'admin';
                        echo "Bienvenido admin";
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