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
                    $sub_array ['eliminar'] = '<button type = "button" onclick="eliminarCliente(this.id)" name="eliminar" class="btn btn-danger btn-xs delete" id="'.$data['CEDULA'].'">Eliminar</button>';
                    $sub_array ['actualizar'] = '<button type = "button" onclick="actualizarCliente(this.id)" name="actualizar" class="btn btn-success" id="'.$data['CEDULA'].'">Actualizar</button>';
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
        if($_POST['llave'] == "cargarTablaAdmins"){

            $query = mysqli_query($conn, "CALL SP_ADMINISTRADORES();");
            if($query && $query->num_rows > 0){
                while($data = mysqli_fetch_assoc($query)){
                    $sub_array["cedula"] = $data['CEDULA'];
                    $sub_array['nombre'] = $data['NOMBRE'];
                    $sub_array['apellidos'] = $data['APELLIDOS'];
                    $sub_array['correo'] = $data['EMAILC'];
                    $sub_array ['telefono'] = $data['TELEFONO'];
                    $sub_array ['eliminar'] = '<button type = "button" onclick="eliminarAdmin(this.id)" name="eliminar" class="btn btn-danger btn-xs delete" id="'.$data['CEDULA'].'">Eliminar</button>';
                    $sub_array ['actualizar'] = '<button type = "button" onclick="actualizarAdmin(this.id)" name="actualizar" class="btn btn-success" id="'.$data['CEDULA'].'">Actualizar</button>';
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
                    $sub_array['estado'] = $data['ESTADO'];
                    $sub_array['servicio'] = $data['NOMBRESERVICIO'];
                    $sub_array['precio'] = $data['PRECIOSERVICIO'];
                    $sub_array ['eliminar'] = '<button type = "button" onclick="eliminarCita(this.id)" name="eliminar" class="btn btn-danger btn-xs delete" id="'.$data['ID_CITA'].'">Eliminar</button>';
                    $sub_array ['actualizar'] = '<button type = "button" onclick="actualizarCita(this.id)" name="actualizar" class="btn btn-success" id="'.$data['ID_CITA'].'">Actualizar</button>';
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
            $query = mysqli_query($conn, "CALL SP_BARBEROS();");
            if($query && $query->num_rows > 0){
                while($data = mysqli_fetch_assoc($query)){
                    $sub_array["cedula"] = $data['CEDULA'];
                    $sub_array['nombre'] = $data['NOMBRE'];
                    $sub_array['apellidos'] = $data['APELLIDOS'];
                    $sub_array['correo'] = $data['EMAILC'];
                    $sub_array ['telefono'] = $data['TELEFONO'];
                    $sub_array ['eliminar'] = '<button type = "button" onclick="eliminarBarbero(this.id)" name="eliminar" class="btn btn-danger btn-xs delete" id="'.$data['CEDULA'].'">Eliminar</button>';
                    $sub_array ['actualizar'] = '<button type = "button" onclick="actualizarBarbero(this.id)" name="actualizar" class="btn btn-success" id="'.$data['CEDULA'].'">Actualizar</button>';
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
            $query = mysqli_query($conn, "CALL SP_PRODUCTOS();");
            if($query && $query->num_rows > 0){
                while($data = mysqli_fetch_assoc($query)){
                    $sub_array["id_producto"] = $data['ID_PRODUCTO'];
                    $sub_array['nombre'] = $data['NOMBRE'];
                    $sub_array['desc'] = $data['DESCRIPCION'];
                    $sub_array['precio'] = $data['PRECIO'];
                    $sub_array ['cantidad'] = $data['CANTIDAD'];
                    $sub_array ['eliminar'] = '<button type = "button" onclick="eliminarProducto(this.id)" name="eliminar" class="btn btn-danger btn-xs delete" id="'.$data['ID_PRODUCTO'].'">Eliminar</button>';
                    $sub_array ['actualizar'] = '<button type = "button" onclick="actualizarProducto(this.id)" name="actualizar" class="btn btn-success" id="'.$data['ID_PRODUCTO'].'">Actualizar</button>';
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
                $query = mysqli_query($conn, "INSERT INTO usuario (cedula, nombre, primerapellido, segundoapellido, emailc, contrasenna, telefono, rol) VALUES ('$cedula', '$nombre', '$primerApellido', '$segundoApellido', '$email', '$hashed_pwd', '$telefono', 1);");
                echo "Guardado";
                }
            }
            if($_POST['llave'] == "registrarProducto"){
            $nombre = $_POST['nombre'];
            $desc = $_POST['desc'];
            $precio = $_POST['precio'];
            $cant = $_POST['cant'];
            $img = $_POST['img'];
            $temp = explode("\\", $img);
            $img = "../img/productos/".$temp[2];

            if(mysqli_query($conn, "INSERT INTO producto (NOMBRE, DESCRIPCION, PRECIO, CANTIDAD, IMAGEN) VALUES ('$nombre', '$desc', '$precio', '$cant', '$img');")){
                // insertar los datos
                echo "Guardado";
            }else{
                echo "No se pudo guardar";
            }
            }
        if($_POST['llave'] == "guardarBarbero"){
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
                $query = mysqli_query($conn, "INSERT INTO usuario (cedula, nombre, primerapellido, segundoapellido, emailc, contrasenna, telefono, rol) VALUES ('$cedula', '$nombre', '$primerApellido', '$segundoApellido', '$email', '$hashed_pwd', '$telefono', 3);");
                echo "Guardado";
                }
         }
            if($_POST['llave'] == "registrarAdmin"){
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
                $query = mysqli_query($conn, "INSERT INTO usuario (cedula, nombre, primerapellido, segundoapellido, emailc, contrasenna, telefono, rol) VALUES ('$cedula', '$nombre', '$primerApellido', '$segundoApellido', '$email', '$hashed_pwd', '$telefono', 2);");
                echo "Guardado";
                }
         }
        if($_POST['llave'] == "cargarDatos"){
            $cedula = $_POST['cedula'];
            $query = mysqli_query($conn, "SELECT NOMBRE, PRIMERAPELLIDO, SEGUNDOAPELLIDO FROM USUARIO WHERE CEDULA = '$cedula';");
            $array = mysqli_fetch_array($query);
            echo json_encode($array);
        }
        if($_POST['llave'] == "eliminarCliente"){
            $cedula = $_POST['id'];
            $query = mysqli_query($conn, "DELETE FROM USUARIO WHERE CEDULA = '$cedula';");
                echo 'Cliente eliminado exitosamente.';
        }
        if($_POST['llave'] == "eliminarCita"){
            $id_cita = $_POST['id'];
            $query = mysqli_query($conn, "DELETE FROM CITA WHERE ID_CITA = '$id_cita';");
                echo 'Cita eliminada exitosamente.';
        }
        if($_POST['llave'] == "eliminarBarbero"){
            $cedula = $_POST['id'];
            $query = mysqli_query($conn, "DELETE FROM USUARIO WHERE CEDULA = '$cedula';");
                echo 'Barbero eliminado exitosamente.';
        }
        if($_POST['llave'] == "eliminarProducto"){
            $id_prod = $_POST['id'];
            $query = mysqli_query($conn, "DELETE FROM PRODUCTO WHERE ID_PRODUCTO = '$id_prod';");
                echo 'Producto eliminado exitosamente.';
        }
        if($_POST['llave'] == "eliminarAdmin"){
            $cedula = $_POST['id'];
            $query = mysqli_query($conn, "DELETE FROM USUARIO WHERE CEDULA = '$cedula';");
                echo 'Administrador eliminado exitosamente.';
        }
        if($_POST['llave'] == "obtenerCliente"){
            $cedula = $_POST['id'];
            $query = mysqli_query($conn, "CALL SP_DATOSACTUALIZAR('$cedula');");
            $array = mysqli_fetch_array($query);
            echo json_encode($array);
        }
        if($_POST['llave'] == "obtenerBarbero"){
            $cedula = $_POST['id'];
            $query = mysqli_query($conn, "CALL SP_DATOSACTUALIZAR('$cedula');");
            $array = mysqli_fetch_array($query);
            echo json_encode($array);
        }
        if($_POST['llave'] == "obtenerAdmin"){
            $cedula = $_POST['id'];
            $query = mysqli_query($conn, "CALL SP_DATOSACTUALIZARADMIN('$cedula');");
            $array = mysqli_fetch_array($query);
            echo json_encode($array);
        }
        if($_POST['llave'] == "obtenerCita"){
            $id_cita = $_POST['id'];
            $query = mysqli_query($conn, "CALL SP_DATOSACTUALIZARCITA('$id_cita');");
            $array = mysqli_fetch_array($query);
            $array[4] = date("m/d/Y", strtotime($array[4]));
            echo json_encode($array);
        }
        if($_POST['llave'] == "obtenerProducto"){
            $id_poducto = $_POST['id'];
            $query = mysqli_query($conn, "CALL SP_DATOSACTUALIZARPROD('$id_poducto');");
            $array = mysqli_fetch_array($query);
            echo json_encode($array);
        }
        if($_POST['llave'] == "actualizarCliente"){
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $primerApellido = $_POST['primerApellido'];
            $segundoApellido = $_POST['segundoApellido'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $rol = $_POST['rol'];

            $query = mysqli_query($conn, "SELECT ID_ROL FROM ROLES WHERE NOMBRE_ROL = '$rol'");
            $fila = mysqli_fetch_array($query);
            $id_rol = $fila['ID_ROL'];            
            // verificar si ese correo aun no exite
            $sql = mysqli_query($conn, "SELECT * FROM USUARIO WHERE EMAILC = '$email' AND NOT CEDULA = '$cedula';");

            if (mysqli_num_rows($sql) > 0) {
                echo "email";
                return;
            }
            else if (mysqli_query($conn, "CALL SP_ACTUALIZARCLIENTE('$cedula', '$nombre', '$primerApellido', '$segundoApellido','$email', '$telefono', '$id_rol');")){
                echo "Cliente actualizado";
            }else{
                echo "No se actualizo";
            }
        }
        if($_POST['llave'] == "actualizarAdmin"){
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $primerApellido = $_POST['primerApellido'];
            $segundoApellido = $_POST['segundoApellido'];
            $telefono = $_POST['telefono'];
            $rol = $_POST['rol'];

            $query = mysqli_query($conn, "SELECT ID_ROL FROM ROLES WHERE NOMBRE_ROL = '$rol'");
            $fila = mysqli_fetch_array($query);
            $id_rol = $fila['ID_ROL'];            
             if (mysqli_query($conn, "CALL SP_ACTUALIZARADMIN('$cedula', '$nombre', '$primerApellido', '$segundoApellido', '$telefono', '$id_rol');")){
                echo "Administrador actualizado";
            }else{
                echo "No se actualizo";
            }
        }
        if($_POST['llave'] == "actualizarBarbero"){
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $primerApellido = $_POST['primerApellido'];
            $segundoApellido = $_POST['segundoApellido'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $rol = $_POST['rol'];

            $query = mysqli_query($conn, "SELECT ID_ROL FROM ROLES WHERE NOMBRE_ROL = '$rol'");
            $fila = mysqli_fetch_array($query);
            $id_rol = $fila['ID_ROL'];            
            // verificar si ese correo aun no exite
            $sql = mysqli_query($conn, "SELECT * FROM USUARIO WHERE EMAILC = '$email' AND NOT CEDULA = '$cedula';");

            if (mysqli_num_rows($sql) > 0) {
                echo "email";
                return;
            }
            else if (mysqli_query($conn, "CALL SP_ACTUALIZARCLIENTE('$cedula', '$nombre', '$primerApellido', '$segundoApellido','$email', '$telefono', '$id_rol');")){
                echo "Barbero actualizado";
            }else{
                echo "No se actualizo";
            }
        }
        if($_POST['llave'] == "actualizarProducto"){
            $id_prod = $_POST['id_prod'];
            $nombre = $_POST['nombre'];
            $desc = $_POST['desc'];
            $precio = $_POST['precio'];
            $cant = $_POST['cant'];
            $img = $_POST['img'];

            $temp = explode("\\", $img);
            $img = "../img/productos/".$temp[2];
          
            if (mysqli_query($conn, "CALL SP_ACTUALIZARPROD('$id_prod', '$nombre', '$desc','$precio', '$cant', '$img');")){
                echo "Producto actualizado";
            }else{
                echo "No se actualizo";
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
             //SACO CLIENTE Y FECHA
            date_default_timezone_set('America/Costa_Rica');
            //hago un datetime en fechacom
            $fechacom = new DateTime($hora);
            //le defino el formato de la base de datos
            $date =  $fechacom->format('Y-m-d');

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
     $conn->close();


?>