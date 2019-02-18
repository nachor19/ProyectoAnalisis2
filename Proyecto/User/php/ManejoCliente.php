<?php

    require_once 'config_bd.php';

    if(isset($_POST['llave'])){


        // si es guardar un cliente
        if($_POST['llave'] == "guardarCliente"){
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $primerApellido = $_POST['primerApellido'];
            $segundoApellido = $_POST['segundoApellido'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $hashed_pwd = password_hash(trim($_POST['pwd']), PASSWORD_DEFAULT);

            // verificar si ese correo aun no exite
            $sql = mysqli_query($conn, "SELECT * FROM cliente WHERE emailc = '$email';");

            if (mysqli_num_rows($sql) > 0) {
                echo "El correo ingresado ya ha sido registrado.";
                return;
            }
            else{
                // insertar los datos
                $query = mysqli_query($conn, "INSERT INTO cliente (cedula, nombre, primerapellido, segundoapellido, emailc, contrasenna, telefono) VALUES ('$cedula', '$nombre', '$primerApellido', '$segundoApellido', '$email', '$hashed_pwd', '$telefono');");
                
                // traer nombre y id del cliente
                $query = mysqli_query($conn, "SELECT cedula, nombre FROM cliente WHERE emailc = '$email';");

                // iniciar sesion
                session_start();

                // crear un arreglo asociativo con los resultados
                $datos = mysqli_fetch_array($query);
                
                // salvarlos en la sesion
                $_SESSION['id_usuario'] = $datos['cedula'];
                $_SESSION['nombre'] = $datos['nombre'];

                echo "Guardado";
            }
        }
    }
            //si es iniciar sesion
            if($_POST['llave'] == "iniciarSesion"){
            $email = $_POST['email'];
            $pwd = $_POST['pwd'];

            // ver si ese correo existe en base de datos
            $query = mysqli_query($conn, "SELECT cedula, nombre, emailc, contrasenna FROM cliente WHERE emailc = '$email';");

            if(mysqli_num_rows($query) > 0){
                // crear arreglo asociativo con los resultados
                $datos = mysqli_fetch_array($query);    

                // si existe el correo, verificar clave
                if(password_verify($pwd, $datos['contrasenna'])){
                    // contraseña correcta, iniciar sesion
                    session_start();
                    // salvarlos en la sesion
                    $_SESSION['id_usuario'] = $datos['cedula'];
                    $_SESSION['nombre'] = $datos['nombre'];
                    
                    echo "Correcto";
                    return;
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
?>