$(document).ready(function(){
    controlarDesplazamiento();
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
// funcion que maneja cuando se le da click a un link
var controlarDesplazamiento = function(){
    $("a").on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 1000, function(){
                window.location.hash = hash;
            });
        }
    });
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
            url: '../php/manejocliente.php',
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
                if (respuesta == "email") {
                    $("#email").css('border', '1px solid red');
                    $("#emailErr").addClass("alert alert-danger");
                    $("#emailErr").html("El correo ingresado ya existe");
                } else if (respuesta == "id") {
                    $("#cedula").css('border', '1px solid red');
                    $("#cedulaErr").addClass("alert alert-danger");
                    $("#cedulaErr").html("La cedula ingresada ya existe");
                }
                else if(respuesta == "Guardado"){
                    $("#registrarseModal").modal("toggle");  
                    window.location.href = '../php/clientelogin.php';
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

function guardarClienteA(llave){
    var cedula = $("#cedula");
    var nombre = $("#nombre");
    var primerApellido = $("#primerApellido");
    var segundoApellido = $("#segundoApellido");
    var telefono = $("#telefono");
    var email = $("#email");
    var pwd = $("#pwd");
    
    if(validarFormRegistro()){
        $.ajax({
            url: '../php/manejoadmin.php',
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
                if (respuesta == "email") {
                    $("#email").css('border', '1px solid red');
                    $("#emailErr").addClass("alert alert-danger");
                    $("#emailErr").html("El correo ingresado ya existe");
                } else if (respuesta == "id") {
                    $("#cedula").css('border', '1px solid red');
                    $("#cedulaErr").addClass("alert alert-danger");
                    $("#cedulaErr").html("La cedula ingresada ya existe");
                }
                else if(respuesta == "Guardado"){
                    cargarTablaClientes();
                    $("#agregarClienteModal").modal("hide");  
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
        $("#cedula").css('border', '');
        $("#cedulaErr").removeClass("alert alert-danger");
        $("#cedulaErr").html("");
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
    } else if (! /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i.test(correo)){
        $("#email").css('border', '1px solid red');
        $("#emailErr").addClass("alert alert-danger");
        $("#emailErr").html("Por favor ingrese un correo válido");
        check = false;
    } else {
        $("#email").css('border', '');
        $("#emailErr").removeClass("alert alert-danger");
        $("#emailErr").html("");
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

    return check;
}
function soloNumeros(e){
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key);
    //numeros que se van a permitir
    numeros = "0123456789";
    //teclas especiales que se pueden usar
    especiales = "8-37-38-46";//array 
    teclado_especial=false;
    for (var i in especiales[i]) {
        if(key == especiales[i]){
            teclado_especial = true;
        }
    }
    if(numeros.indexOf(teclado) == -1 && !teclado_especial){
        return false;
    }
}
function start(){
    setFecha();
    cargarTabla();
    deshabilitar();
}
function setFecha(){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate()+1; //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10){
    dia='0'+dia; //agrega cero si el menor de 10
    }   
  if(mes<10){
    mes='0'+mes //agrega cero si el menor de 10
    }   
   var date = mes+"/"+dia+"/"+ano;
    document.getElementById('fecha').setAttribute("value", date);
    return date;
}
function deshabilitar(){
    document.getElementById('fecha').setAttribute("readonly", 'readonly');
}
//para poder llamar 2 funciones en html
function desyset(){
    deshabilitar();
    setFecha();
}
// funcion que se encarga de iniciar sesion mediante AJAX
function iniciarSesion(llave){
    var email = $("#emailSesion");
    var pwd = $("#pwdSesion");

    if(validarFormSesion()){
        $.ajax({
            url: '../php/manejocliente.php',
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
                } if (respuesta == "Bienvenido cliente") {
                    $("#iniciarSesionModal").modal("toggle");

                    window.location.href = '../php/clientelogin.php';
                } if (respuesta == "Bienvenido admin") {
                    $("#iniciarSesionModal").modal("toggle");

                    window.location.href = '../php/adminlogin.php';
                } if (respuesta == "Bienvenido barbero") {
                    $("#iniciarSesionModal").modal("toggle");
                    window.location.href = '../php/barberologin.php';
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
        url: '../php/manejocliente.php',
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
            url: '../php/manejocliente.php',
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
            url: '../php/manejocliente.php',
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
            url: '../php/manejocitas.php',
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
var cargarTablaClientes = function(){
    var tabla = $("#tabla_clientes").DataTable({
        responsive: true,
        select: true,
        "destroy": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
         "ajax":{
            url: '../php/manejoadmin.php',
            method: 'POST',
            data: {
                llave: 'cargarTablaClientes'
            }
        },
        "columns": [
            {"data":"cedula"},
            {"data":"nombre"},
            {"data":"apellidos"},
            {"data":"correo"},
            {"data":"telefono"},
        ],
    });
        tabla
        .on( 'select', function ( e, dt, type, indexes ) {
            var rowData = table.rows( indexes ).data().toArray();
            var hola = rowData[1]; 
        });
}

var cargarTablaCitas = function(){
    var tabla = $("#tabla_citas").DataTable({
        responsive: true,
        "destroy": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
         "ajax":{
            url: '../php/manejoadmin.php',
            method: 'POST',
            data: {
                llave: 'cargarTablaCitas'
            }
        },
        "columns": [
            {"data":"idcita"},
            {"data":"nombre"},
            {"data":"horario"},
            {"data":"cedula"},
            {"data":"usuario"},
            {"data":"fecha"},
            {"data":"desc"},
            {"data":"servicio"},
            {"data":"precio"}
        ]
    });
}
var cargarTablaBarberos = function(){
    var tabla = $("#tabla_barberos").DataTable({
        responsive: true,
        "destroy": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
         "ajax":{
            url: '../php/manejoadmin.php',
            method: 'POST',
            data: {
                llave: 'cargarTablaBarberos'
            }
        },
        "columns": [
            {"data":"cedula"},
            {"data":"nombre"},
            {"data":"apellidos"},
            {"data":"correo"},
            {"data":"telefono"}
        ]
    });
}
var cargarTablaProductos = function(){
    var tabla = $("#tabla_productos").DataTable({
        responsive: true,
        "destroy": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
         "ajax":{
            url: '../php/manejoadmin.php',
            method: 'POST',
            data: {
                llave: 'cargarTablaProductos'
            }
        },
        "columns": [
            {"data":"id_producto"},
            {"data":"nombre"},
            {"data":"desc"},
            {"data":"precio"},
            {"data":"cantidad"}
        ]
    });
}

function cargarTablas(){
    cargarTablaClientes(); 
    cargarTablaCitas();
    cargarTablaBarberos();
    cargarTablaProductos();
    desyset();
}

function modalCambio(){
    $("#agregarCitaModal").modal("toggle");
    $('#agregarClienteModal').modal('show');
}
// funcion para SACAR CITA
function sacarCita(llave){
    var barbero = $("#barbero");
    var servicio = $("#servicio");
    var horario = $("#horario");
    var fecha = $("#fecha");
    
    $.ajax({
        url: '../php/manejocitas.php',
        method: 'POST',
        dataType: 'text', 
        data: {
            llave: llave,

            barbero: barbero.val(),
            servicio: servicio.val(),
            horario: horario.val(),
            fecha: fecha.val()
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
function sacarCitaAdmin(llave){
    var barbero = $("#barbero");
    var servicio = $("#servicio");
    var horario = $("#horario");
    var fecha = $("#fecha");
    var cliente = $("#cliente")
    $.ajax({
        url: '../php/manejocitas.php',
        method: 'POST',
        dataType: 'text', 
        data: {
            llave: llave,
            cliente: cliente.val(),
            barbero: barbero.val(),
            servicio: servicio.val(),
            horario: horario.val(),
            fecha: fecha.val()
        }, success: function(respuesta){
            if(respuesta == "Guardado"){
                cargarTabla();
                $("#sacarCitaModal").modal("hide");
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
// funcion para ver si hay citas disponibles
function consultarCita(llave){
    var barbero = $("#barbero");
    var horario = $("#horario");
    var fecha = $("#fecha");
    
    $.ajax({
        url: '../php/manejocitas.php',
        method: 'POST',
        dataType: 'text', 
        data: {
            llave: llave,
            barbero: barbero.val(),
            horario: horario.val(),
            fecha: fecha.val()
        }, success: function(respuesta){
            if(respuesta == "Ya hay cita con este barbero en ese horario"){
                $("#resultados").addClass("alert alert-danger");
                $("#resultados").html(respuesta);
                $("#resultados").delay(8000).fadeOut(function(){
                    $(this).removeClass("alert alert-danger");
                    $(this).html("");
                    $(this).css("display", "");
                });
            }
            else{
                $("#resultados").addClass("alert alert-success");
                $("#resultados").html(respuesta);
                $("#resultados").delay(8000).fadeOut(function(){
                    $(this).removeClass("alert alert-danger");
                    $(this).html("");
                    $(this).css("display", "");
                });
            }
        }
    });
}
function showAll(llave){
    var cedula = $("#cliente");
    var datos;
    var array;
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: llave,
                cedula: cedula.val()
            },
            success: function(datos){
                array = JSON.parse(datos);
                document.getElementById("nombreCli").value = array[0];
                document.getElementById("Apellido1Cli").value = array[1];
                document.getElementById("Apellido2Cli").value = array[2];
            }
        });
        

}
function volver(){
    $("#verCitaModal").modal("toggle");
    window.location.href = '../html/index.html#sacarCita';
     $(window).load(function(){        
   $('#myModal').modal('show');
    }); 
}
function verCitas(){
    window.location.href = '../php/vercitas.php';
}