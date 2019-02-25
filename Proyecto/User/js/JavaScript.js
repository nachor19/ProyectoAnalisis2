
$(document).ready(function(){
    controlarNavbar();
});

var controlarNavbar = function(){
    window.onscroll = function() {
        stickyNav()
    };
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    // agregar las clases
    function stickyNav() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    } 
}

function guardarCliente(llave){
    var cedula = $("#cedula");
    var nombre = $("#nombre");
    var primerApellido = $("#primerApellido");
    var segundoApellido = $("#segundoApellido");
    var telefono = $("#telefono");
    var email = $("#email");
    var pwd = $("#pwd");
    
    if(validarFormRegistro()){
        $.ajax({
            url: '../php/ManejoCliente.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: llave,
                cedula: cedula.val(),
                nombre: nombre.val(),
                primerApellido: primerApellido.val(),
                segundoApellido: segundoApellido.val(),
                telefono: telefono.val(),
                email: email.val(),
                pwd: pwd.val()
            }, success: function(respuesta){
                if(respuesta == "Guardado"){
                    $("#registrarseModal").modal("toggle");
                    window.location.href = '../php/ClienteLogin.php';
                }
                else{
                    $("#resultados").addClass("alert alert-danger");
                    $("#resultados").html(respuesta);
                    $("#resultados").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
            }
        });
    }
}
function validarFormRegistro(){
    var cedula = $("#cedula").val();
    var nombre = $("#nombre").val();
    var primerApellido = $("#primerApellido").val();
    var telefono = $("#telefono").val();
    var correo = $("#email").val();
    var pwd = $("#pwd").val();

    var check = true;

    if(cedula.length == 0){
        $("#cedula").css('border', '1px solid red');
        $("#cedulaErr").addClass("alert alert-danger");
        $("#cedulaErr").html("Por favor digite su cedula");
        check = false;
    }
    else{
        $("#nombre").css('border', '');
        $("#nombreErr").remove();
    }
    if(nombre.length == 0){
        $("#nombre").css('border', '1px solid red');
        $("#nombreErr").addClass("alert alert-danger");
        $("#nombreErr").html("Por favor digite su nombre");
        check = false;
    }
    else{
        $("#nombre").css('border', '');
        $("#nombreErr").remove();
    }
    if(primerApellido.length == 0){
        $("#primerApellido").css('border', '1px solid red');
        $("#primerApellidoErr").addClass("alert alert-danger");
        $("#primerApellidoErr").html("Por favor digite su apellido");
        check = false;
    }
    else{
        $("#primerApellido").css('border', '');
        $("#primerApellidoErr").remove();
    }
    if (telefono.length <= 0 || telefono.length > 11){
        $("#telefono").css('border', '1px solid red');
        $("#telefonoErr").addClass("alert alert-danger");
        $("#telefonoErr").html("Por favor ingrese un telefono");
        check = false;
    }
    else{
        $("#telefono").css('border', '');
        $("#telefonoErr").remove();
    }
    if (correo.length == 0){
        $("#email").css('border', '1px solid red');
        $("#emailErr").addClass("alert alert-danger");
        $("#emailErr").html("Por favor digite su correo electrónico");
        check = false;
    }
    else{
        $("#email").css('border', '');
        $("#emailErr").remove();
    }
    if(pwd.length == 0){
        $("#pwd").css('border', '1px solid red');
        $("#pwdErr").addClass("alert alert-danger");
        $("#pwdErr").html("Por favor digite su contraseña");
        check = false;
    }
    else if(pwd.length <= 7){
        $("#pwd").css('border', '1px solid red');
        $("#pwdErr").addClass("alert alert-danger");
        $("#pwdErr").html("Su contraseña debe tener más de 8 caracteres");
        check = false;
    }
    else{
        $("#pwd").css('border', '');
        $("#pwdErr").remove();
    }

    if(check == false){
        return false;
    }
    else{
        return true;
    }
}
// funcion que se encarga de iniciar sesion mediante AJAX
function iniciarSesion(llave){
    var email = $("#emailSesion");
    var pwd = $("#pwdSesion");

    if(validarFormSesion()){
        $.ajax({
            url: '../php/ManejoCliente.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: llave,
                email: email.val(),
                pwd: pwd.val()
            }, success: function(respuesta){
                if(respuesta == "Correo o contraseña inválidos."){
                    $("#miResultado").addClass("alert alert-danger");
                    $("#miResultado").html(respuesta);
                    $("#miResultado").delay(2000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
                else{
                    $("#iniciarSesionModal").modal("toggle");

                    window.location.href = '../php/ClienteLogin.php';
                }
            }
        });
    }
}
function validarFormSesion(){
    var email = $("#emailSesion").val();
    var pwd = $("#pwdSesion").val();

    var check = true;

    if(email.length == 0){
        $("#emailSesion").css('border', '1px solid red');
        $("#emailSesionErr").addClass("alert alert-danger");
        $("#emailSesionErr").html("Por favor digite su correo");
        check = false;
    }
    else{
        $("#emailSesion").css('border', '');
        $("#emailSesionErr").remove();
    }
    if(pwd.length == 0){
        $("#pwdSesion").css('border', '1px solid red');
        $("#pwdSesionErr").addClass("alert alert-danger");
        $("#pwdSesionErr").html("Por favor digite su contraseña");
        check = false;
    }
    else if(pwd.length <= 7){
        $("#pwdSesion").css('border', '1px solid red');
        $("#pwdSesionErr").addClass("alert alert-danger");
        $("#pwdSesionErr").html("Su contraseña no puede tener menos de 8 digitos.");
        check = false;
    }
    else{
        $("#pwdSesion").css('border', '');
        $("#pwdSesionErr").remove();
    }

    if(check == false){
        return false;
    }
    else{
        return true;
    }
}
// funcoon que se encarga de cerrar la sesion
function cerrarSesion(llave){
    $.ajax({
        url: '../php/manejoCliente.php',
        method: 'POST',
        dataType: 'text', 
        data: {
            llave: llave
        }, success: function(respuesta){
            if(respuesta == "Cerrada"){
                window.location.href = '../html/index.html';
            }
            else{
                $("#resultados").addClass("alert alert-danger");
                $("#resultados").html(respuesta);
                $("#resultados").delay(5000).fadeOut(function(){
                    $(this).removeClass("alert alert-danger");
                    $(this).html("");
                    $(this).css("display", "");
                });
            }
        }
    });
}
function cambiarPwd(llave){
    var pwd = $("#pwd");

    if(pwd.val().length <= 0){
        $("#errorPwd").addClass("alert alert-danger");
        $("#errorPwd").html("Por favor introduzca una contraseña");
        $("#errorPwd").delay(5000).fadeOut(function(){
            $(this).removeClass("alert alert-danger");
            $(this).html("");
            $(this).css("display", "");
        });
        return;
    }
    else if(pwd.val().length <=7 ){
        $("#errorPwd").addClass("alert alert-danger");
        $("#errorPwd").html("Su nueva contraseña debe de tener más de 7 digitos");
        $("#errorPwd").delay(5000).fadeOut(function(){
            $(this).removeClass("alert alert-danger");
            $(this).html("");
            $(this).css("display", "");
        });
        return;
    }
    else{
        $.ajax({
            url: '../php/manejoCliente.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: llave,
                pwd: pwd.val()
            }, success: function(respuesta){
                if(respuesta == "Cambiado"){
                    $("#pwd").val("");
                    $("#resultado").addClass("alert alert-success");
                    $("#resultado").html("La información fue editada con éxito <i class='fa fa-check-circle'></i>");
                    $("#resultado").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-success");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
                else{
                    $("#pwd").val("");
                    $("#resultado").addClass("alert alert-danger");
                    $("#resultado").html("Ocurrió un error, por favor intentelo de nuevo. Si vuelve a pasar comuníquese a soporte@pizzahotml.com");
                    $("#resultado").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
            }
        });
    }
}
function cambiarCorreo(llave){
    var email = $("#email");
    
    if(email.val().length <= 0){
        $("#errorEmail").addClass("alert alert-danger");
        $("#errorEmail").html("Por favor introduzca un correo");
        $("#errorEmail").delay(5000).fadeOut(function(){
            $(this).removeClass("alert alert-danger");
            $(this).html("");
            $(this).css("display", "");
        });
        return;
    }
    else{
        $.ajax({
            url: '../php/manejoCliente.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: llave,
                email: email.val()
            }, success: function(respuesta){
                if(respuesta == "Cambiado"){
                    $("#email").val("");
                    $("#resultado").addClass("alert alert-success");
                    $("#resultado").html("La información fue editada con éxito <i class='fa fa-check-circle'></i>");
                    $("#resultado").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-success");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
                else{
                    $("#email").val("");
                    $("#resultado").addClass("alert alert-danger");
                    $("#resultado").html("Ocurrió un error, por favor intentelo de nuevo.");
                    $("#resultado").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
            }
        });
    }
}
//PARA CARGAR TABLA
var cargarTabla = function(){
    var tabla = $("#tabla_citas").DataTable({
        responsive: true,
        "destroy": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
         "ajax":{
            url: '../php/manejoCitas.php',
            method: 'POST',
            data: {
                llave: 'cargarTabla'
            }
        },
        "columns": [
            {"data":"fecha"},
            {"data":"hora_cita"},
            {"data":"barbero"},
            {"data":"servicio"},
            {"data":"precio"}
        ]
    });
}

// funcion para SACAR CITA
function sacarCita(llave){
    var barbero = $("#barbero");
    var servicio = $("#servicio");
    var horario = $("#horario");
    
    $.ajax({
        url: '../php/manejoCitas.php',
        method: 'POST',
        dataType: 'text', 
        data: {
            llave: llave,
            barbero: barbero.val(),
            servicio: servicio.val(),
            horario: horario.val(),
        }, success: function(respuesta){
            if(respuesta == "Guardado"){
                cargarTabla();
                $("#sacarCitaModal").modal("toggle");
                $("#modalSuccess").modal('show');
            }
            else{
                $("#resultados").addClass("alert alert-danger");
                $("#resultados").html(respuesta);
                $("#resultados").delay(5000).fadeOut(function(){
                    $(this).removeClass("alert alert-danger");
                    $(this).html("");
                    $(this).css("display", "");
                });
            }
        }
    });
}  
