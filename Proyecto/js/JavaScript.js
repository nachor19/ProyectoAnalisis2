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
function guardarBarberoA(llave){
    var cedula = $("#cedulaBarb");
    var nombre = $("#nombreBarb");
    var primerApellido = $("#primerApellidoBarb");
    var segundoApellido = $("#segundoApellidoBarb");
    var telefono = $("#telefonoBarb");
    var email = $("#emailBarb");
    var pwd = $("#pwdBarb");
    
    if(validarFormRegistroBarb()){
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
                    $("#emailBarb").css('border', '1px solid red');
                    $("#emailBarbErr").addClass("alert alert-danger");
                    $("#emailBarbErr").html("El correo ingresado ya existe");
                } else if (respuesta == "id") {
                    $("#cedulaBarb").css('border', '1px solid red');
                    $("#cedulaBarbErr").addClass("alert alert-danger");
                    $("#cedulaBarbErr").html("La cedula ingresada ya existe");
                }
                else if(respuesta == "Guardado"){
                    jQuery.noConflict();
                    $('#agregarBarbModal').modal('hide');
                    $('#modalSuccessBarb').modal('show');
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

function registrarProducto(llave){
    var nombre = $("#nombreProd");
    var desc = $("#descProd");
    var precio = $("#precioProd");
    var cant = $("#cantProd");
    var img = $("#file");
    console.log(img.val());
    
    if(validarFormRegistroProd()){
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: llave,
                nombre: nombre.val(),
                desc: desc.val(),
                precio: precio.val(),
                cant: cant.val(),
                img: img.val()
            }, success: function(respuesta){
                 if(respuesta == "Guardado"){
                    jQuery.noConflict();
                    $('#agregarProductoModal').modal('hide');
                    $('#modalSuccessProd').modal('show');
                }
                else{
                    $("#miRespA").addClass("alert alert-danger");
                    $("#miRespA").html(respuesta);
                    $("#miRespA").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
            }
        });
    }
}
function registrarAdmin(llave){
    var cedula = $("#cedulaAdmin");
    var nombre = $("#nombreAdmin");
    var primerApellido = $("#primerApellidoAdmin");
    var segundoApellido = $("#segundoApellidoAdmin");
    var telefono = $("#telefonoAdmin");
    var email = $("#emailAdmin");
    var pwd = $("#pwdAdmin");
    
    if(validarFormRegistroAdmin()){
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
                    $("#emailAdmin").css('border', '1px solid red');
                    $("#emailAdminErr").addClass("alert alert-danger");
                    $("#emailAdminErr").html("El correo ingresado ya existe");
                } else if (respuesta == "id") {
                    $("#cedulaAdmin").css('border', '1px solid red');
                    $("#cedulaAdminErr").addClass("alert alert-danger");
                    $("#cedulaAdminErr").html("La cedula ingresada ya existe");
                }
                else if(respuesta == "Guardado"){
                    jQuery.noConflict();
                    $('#agregarAdminModal').modal('hide');
                    $('#modalSuccessAdmin').modal('show');
                }
                else{
                    $("#miRespA").addClass("alert alert-danger");
                    $("#miRespA").html(respuesta);
                    $("#miRespA").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
            }
        });
    }
}

function validarFormRegistroProd(){
    var nombre = $("#nombreProd");
    var desc = $("#descProd");
    var precio = $("#precioProd");
    var cantidad = $("#cantProd");

    var check = true;

    if(nombre.length == 0){
        $("#nombreProd").css('border', '1px solid red');
        $("#nombreProdErr").addClass("alert alert-danger");
        $("#nombreProdErr").html("Por favor digite el nombre del producto");
        check = false;
    }
    else{
        $("#nombreProd").css('border', '');
        $("#nombreProdErr").removeClass("alert alert-danger");
        $("#nombreProdErr").html("");
    }
    if(desc.length == 0){
        $("#descProd").css('border', '1px solid red');
        $("#descProdErr").addClass("alert alert-danger");
        $("#descProdErr").html("Por favor digite una descripcion del producto");
        check = false;
    }
    else{
        $("#descProd").css('border', '');
        $("#descProdErr").remove();
    }
    if(precio.length == 0){
        $("#precioProd").css('border', '1px solid red');
        $("#precioProdErr").addClass("alert alert-danger");
        $("#precioProdErr").html("Por favor digite su apellido");
        check = false;
    }
    else{
        $("#precioProd").css('border', '');
        $("#precioProdErr").remove();
    }
    if (cantidad.length == 0){
        $("#cantProd").css('border', '1px solid red');
        $("#cantProdErr").addClass("alert alert-danger");
        $("#cantProdErr").html("Por favor ingrese un telefono");
        check = false;
    }
    else{
        $("#cantProd").css('border', '');
        $("#cantProdErr").remove();
    }

    return check;
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
function validarFormRegistroBarb(){
    var cedula = $("#cedulaBarb").val();
    var nombre = $("#nombreBarb").val();
    var primerApellido = $("#primerApellidoBarb").val();
    var telefono = $("#telefonoBarb").val();
    var correo = $("#emailBarb").val();
    var pwd = $("#pwdBarb").val();

    var check = true;

    if(cedula.length == 0){
        $("#cedulaBarb").css('border', '1px solid red');
        $("#cedulaBarbErr").addClass("alert alert-danger");
        $("#cedulaBarbErr").html("Por favor digite su cedula");
        check = false;
    }
    else{
        $("#cedulaBarb").css('border', '');
        $("#cedulaBarbErr").removeClass("alert alert-danger");
        $("#cedulaBarbErr").html("");
    }
    if(nombre.length == 0){
        $("#nombreBarb").css('border', '1px solid red');
        $("#nombreBarbErr").addClass("alert alert-danger");
        $("#nombreBarbErr").html("Por favor digite su nombre");
        check = false;
    }
    else{
        $("#nombreBarb").css('border', '');
        $("#nombreBarbErr").remove();
    }
    if(primerApellido.length == 0){
        $("#primerApellidoBarb").css('border', '1px solid red');
        $("#primerApellidoBarbErr").addClass("alert alert-danger");
        $("#primerApellidoBarbErr").html("Por favor digite su apellido");
        check = false;
    }
    else{
        $("#primerApellidoBarb").css('border', '');
        $("#primerApellidoBarbErr").remove();
    }
    if (telefono.length <= 0 || telefono.length > 11){
        $("#telefonoBarb").css('border', '1px solid red');
        $("#telefonoBarbErr").addClass("alert alert-danger");
        $("#telefonoBarbErr").html("Por favor ingrese un telefono");
        check = false;
    }
    else{
        $("#telefonoBarb").css('border', '');
        $("#telefonoBarbErr").remove();
    }
    if (correo.length == 0){
        $("#emailBarb").css('border', '1px solid red');
        $("#emailBarbErr").addClass("alert alert-danger");
        $("#emailBarbErr").html("Por favor digite su correo electrónico");
        check = false;
    } else if (! /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i.test(correo)){
        $("#emailBarb").css('border', '1px solid red');
        $("#emailBarbErr").addClass("alert alert-danger");
        $("#emailBarbErr").html("Por favor ingrese un correo válido");
        check = false;
    } else {
        $("#emailBarb").css('border', '');
        $("#emailBarbErr").removeClass("alert alert-danger");
        $("#emailBarbErr").html("");
    }
    
    if(pwd.length == 0){
        $("#pwdBarb").css('border', '1px solid red');
        $("#pwdBarbErr").addClass("alert alert-danger");
        $("#pwdBarbErr").html("Por favor digite su contraseña");
        check = false;
    }
    else if(pwd.length <= 7){
        $("#pwdBarb").css('border', '1px solid red');
        $("#pwdBarbErr").addClass("alert alert-danger");
        $("#pwdBarbErr").html("Su contraseña debe tener más de 8 caracteres");
        check = false;
    }
    else{
        $("#pwdBarb").css('border', '');
        $("#pwdBarbErr").remove();
    }

    return check;
}

function validarFormRegistroAdmin(){
    var cedula = $("#cedulaAdmin").val();
    var nombre = $("#nombreAdmin").val();
    var primerApellido = $("#primerApellidoAdmin").val();
    var telefono = $("#telefonoAdmin").val();
    var correo = $("#emailAdmin").val();
    var pwd = $("#pwdAdmin").val();

    var check = true;

    if(cedula.length == 0){
        $("#cedulaAdmin").css('border', '1px solid red');
        $("#cedulaAdminErr").addClass("alert alert-danger");
        $("#cedulaAdminErr").html("Por favor digite su cedula");
        check = false;
    }
    else{
        $("#cedulaAdmin").css('border', '');
        $("#cedulaAdminErr").removeClass("alert alert-danger");
        $("#cedulaAdminErr").html("");
    }
    if(nombre.length == 0){
        $("#nombreAdmin").css('border', '1px solid red');
        $("#nombreAdminErr").addClass("alert alert-danger");
        $("#nombreAdminErr").html("Por favor digite su nombre");
        check = false;
    }
    else{
        $("#nombreAdmin").css('border', '');
        $("#nombreAdminErr").remove();
    }
    if(primerApellido.length == 0){
        $("#primerApellidoAdmin").css('border', '1px solid red');
        $("#primerApellidoAdminErr").addClass("alert alert-danger");
        $("#primerApellidoAdminErr").html("Por favor digite su apellido");
        check = false;
    }
    else{
        $("#primerApellidoAdmin").css('border', '');
        $("#primerApellidoAdminErr").remove();
    }
    if (telefono.length <= 0 || telefono.length > 11){
        $("#telefonoAdmin").css('border', '1px solid red');
        $("#telefonoAdminErr").addClass("alert alert-danger");
        $("#telefonoAdminErr").html("Por favor ingrese un telefono");
        check = false;
    }
    else{
        $("#telefonoAdmin").css('border', '');
        $("#telefonoAdminErr").remove();
    }
    if (correo.length == 0){
        $("#emailAdmin").css('border', '1px solid red');
        $("#emailAdminErr").addClass("alert alert-danger");
        $("#emailAdminErr").html("Por favor digite su correo electrónico");
        check = false;
    } else if (! /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i.test(correo)){
        $("#emailAdmin").css('border', '1px solid red');
        $("#emailAdminErr").addClass("alert alert-danger");
        $("#emailAdminErr").html("Por favor ingrese un correo válido");
        check = false;
    } else {
        $("#emailAdmin").css('border', '');
        $("#emailAdminErr").removeClass("alert alert-danger");
        $("#emailAdminErr").html("");
    }
    
    if(pwd.length == 0){
        $("#pwdAdmin").css('border', '1px solid red');
        $("#pwdAdminErr").addClass("alert alert-danger");
        $("#pwdAdminErr").html("Por favor digite su contraseña");
        check = false;
    }
    else if(pwd.length <= 7){
        $("#pwdAdmin").css('border', '1px solid red');
        $("#pwdAdminErr").addClass("alert alert-danger");
        $("#pwdAdminErr").html("Su contraseña debe tener más de 8 caracteres");
        check = false;
    }
    else{
        $("#pwdAdmin").css('border', '');
        $("#pwdAdminErr").remove();
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
            {"data":"eliminar"},
            {"data":"actualizar"}
        ],
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
            {"data":"estado"},
            {"data":"servicio"},
            {"data":"precio"},
            {"data":"eliminar"},
            {"data":"actualizar"}
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
            {"data":"telefono"},
            {"data":"eliminar"},
            {"data":"actualizar"}

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
            {"data":"cantidad"},
            {"data":"eliminar"},
            {"data":"actualizar"}
        ]
    });
}
var cargarTablaAdmins = function(){
    var tabla = $("#tabla_admins").DataTable({
        responsive: true,
        "destroy": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
         "ajax":{
            url: '../php/manejoadmin.php',
            method: 'POST',
            data: {
                llave: 'cargarTablaAdmins'
            }
        },
        "columns": [
            {"data":"cedula"},
            {"data":"nombre"},
            {"data":"apellidos"},
            {"data":"correo"},
            {"data":"telefono"},
            {"data":"eliminar"},
            {"data":"actualizar"}
        ]
    });
}

function cargarTablas(){
    cargarTablaClientes(); 
    cargarTablaCitas();
    cargarTablaBarberos();
    cargarTablaProductos();
    cargarTablaAdmins();
    desyset();
}
function eliminarCita(id){
    var resp = confirm("Seguro que desea eliminar la cita "+id);
    if(resp == true){
         $.ajax({
                url: '../php/manejoadmin.php',
                method: 'POST',
                dataType: 'text', 
                data: {
                    llave: 'eliminarCita',
                    id: id
                }, success: function(respuesta){
                    if(respuesta == "Cita eliminada exitosamente."){
                        cargarTablas();
                        $('#miResultadoC').addClass("alert alert-success");
                        $('#miResultadoC').html(respuesta);
                        $('#miResultadoC').delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-success");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                    else{
                        $("#miResultadoC").addClass("alert alert-danger");
                        $("#miResultadoC").html(respuesta);
                        $("#miResultadoC").delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-danger");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                }
            });
    }else{
        cargarTablas();
    }
}
function eliminarCliente(id){
    var resp = confirm("Seguro que desea eliminar al cliente "+id);
    if(resp == true){
         $.ajax({
                url: '../php/manejoadmin.php',
                method: 'POST',
                dataType: 'text', 
                data: {
                    llave: 'eliminarCliente',
                    id: id
                }, success: function(respuesta){
                    if(respuesta == "Cliente eliminado exitosamente."){
                        cargarTablas();
                        $('#miResultado').addClass("alert alert-success");
                        $('#miResultado').html(respuesta);
                        $('#miResultado').delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-success");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                    else{
                        $("#miResultado").addClass("alert alert-danger");
                        $("#miResultado").html(respuesta);
                        $("#miResultado").delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-danger");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                }
            });
    }else{
        cargarTablas();
    }
}
function eliminarAdmin(id){
    var resp = confirm("Seguro que desea eliminar al administrador "+id);
    if(resp == true){
         $.ajax({
                url: '../php/manejoadmin.php',
                method: 'POST',
                dataType: 'text', 
                data: {
                    llave: 'eliminarAdmin',
                    id: id
                }, success: function(respuesta){
                    if(respuesta == "Administrador eliminado exitosamente."){
                        cargarTablas();
                        $('#miResultadoA').addClass("alert alert-success");
                        $('#miResultadoA').html(respuesta);
                        $('#miResultadoA').delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-success");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                    else{
                        $("#miResultadoA").addClass("alert alert-danger");
                        $("#miResultadoA").html(respuesta);
                        $("#miResultadoA").delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-danger");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                }
            });
    }else{
        cargarTablas();
    }
}
function eliminarProducto(id){
    var resp = confirm("Seguro que desea eliminar el producto "+id);
    if(resp == true){
         $.ajax({
                url: '../php/manejoadmin.php',
                method: 'POST',
                dataType: 'text', 
                data: {
                    llave: 'eliminarProducto',
                    id: id
                }, success: function(respuesta){
                    if(respuesta == "Producto eliminado exitosamente."){
                        cargarTablas();
                        $('#miResultadoP').addClass("alert alert-success");
                        $('#miResultadoP').html(respuesta);
                        $('#miResultadoP').delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-success");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                    else{
                        $("#miResultadoP").addClass("alert alert-danger");
                        $("#miResultadoP").html(respuesta);
                        $("#miResultadoP").delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-danger");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                }
            });
    }else{
        cargarTablas();
    }
}
function eliminarBarbero(id){
    var resp = confirm("Seguro que desea eliminar al barbero "+id);
    if(resp == true){
         $.ajax({
                url: '../php/manejoadmin.php',
                method: 'POST',
                dataType: 'text', 
                data: {
                    llave: 'eliminarBarbero',
                    id: id
                }, success: function(respuesta){
                    if(respuesta == "Barbero eliminado exitosamente."){
                        cargarTablas();
                        $('#miResultadoB').addClass("alert alert-success");
                        $('#miResultadoB').html(respuesta);
                        $('#miResultadoB').delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-success");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                    else{
                        $("#miResultadoB").addClass("alert alert-danger");
                        $("#miResultadoB").html(respuesta);
                        $("#miResultadoB").delay(5000).fadeOut(function(){
                            $(this).removeClass("alert alert-danger");
                            $(this).html("");
                            $(this).css("display", "");
                        });
                    }
                }
            });
    }else{
        cargarTablaClientes();
    }
}
function actualizarProducto(id){
    var datos;
    var array;
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: 'obtenerProducto',
                id: id
            },
            success: function(datos){
                array = jQuery.parseJSON(datos);
                document.getElementById("idProdUp").readOnly = true;
                $('#idProdUp').val(array[0]);
                $('#nombreProdUp').val(array[1]);
                $('#descProdUp').val(array[2]);
                $('#precioProdUp').val(array[3]);                
                $('#cantProdUp').val(array[4]);
                $('#fileUp').val(array[5]);
            }
        });
         jQuery.noConflict();
        $('#actualizarProductoModal').modal('show');       
}
function realizarActualizacionP(llave){
    var id_prod = $('#idProdUp')
    var nombre = $("#nombreProdUp");
    var desc = $("#descProdUp");
    var precio = $("#precioProdUp");
    var cant = $("#cantProdUp");
    var img = $("#fileUp");
    
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: llave,
                id_prod: id_prod.val(),
                nombre: nombre.val(),
                desc: desc.val(),
                precio: precio.val(),
                cant: cant.val(),
                img: img.val()
            }, success: function(respuesta){
            if(respuesta == "Producto actualizado"){
                jQuery.noConflict();
                $('#actualizarProductoModal').modal('hide');
                $('#modalSuccessProdUp').modal('show');
                                cargarTablas();
            }
            else{
                $("#miRespP").addClass("alert alert-danger");
                $("#miRespP").html(respuesta);
                $("#miRespP").delay(5000).fadeOut(function(){
                    $(this).removeClass("alert alert-danger");
                    $(this).html("");
                    $(this).css("display", "");
                });
            }
            }
        });
}
function actualizarCita(id){
    var datos;
    var array;
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: 'obtenerCita',
                id: id
            },
            success: function(datos){
                array = jQuery.parseJSON(datos);
                $('#idCitaUp').val(array[0]);
                $('#barberoUp').val(array[1]);
                $('#horarioUp').val(array[2]);                
                $('#servicioUp').val(array[3]);
                $('#fechaUp').val(array[4]);
            }
        });
         jQuery.noConflict();
        $('#sacarCitaModalUp').modal('show');
}
function realizarActualizacionCita(llave){
    var id_cita = $('#idCitaUp')
    var barbero = $("#barberoUp");
    var horario = $("#horarioUp");
    var servicio = $("#servicioUp");
    var hora = $("#fechaUp");
    
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: llave,
                id_cita: id_cita.val(),
                barbero: barbero.val(),
                horario: horario.val(),
                servicio: servicio.val(),
                hora: hora.val()
            }, success: function(respuesta){
            if(respuesta == "Se actualizo"){
                jQuery.noConflict();
                $('#sacarCitaModalUp').modal('hide');
                $('#modalSuccessUpCita').modal('show');
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
function actualizarCliente(id){
    var datos;
    var array;
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: 'obtenerCliente',
                id: id
            },
            success: function(datos){
                array = jQuery.parseJSON(datos);
                document.getElementById("nombreUp").value = array[0];
                document.getElementById("primerApellidoUp").value = array[1];
                document.getElementById("segundoApellidoUp").value = array[2];
                document.getElementById("emailUp").value = array[3];
                document.getElementById("telefonoUp").value = array[4];
                document.getElementById("cedulaUp").value = array[6];
                document.getElementById("cedulaUp").readOnly = true;
            }
        });
         jQuery.noConflict();
        $('#actualizarClienteModal').modal('show');
}
function actualizarAdmin(id){
    var datos;
    var array;
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: 'obtenerAdmin',
                id: id
            },
            success: function(datos){
                array = jQuery.parseJSON(datos);
                document.getElementById("cedulaAdminUp").value = array[0];
                document.getElementById("nombreAdminUp").value = array[1];
                document.getElementById("primerApellidoAdminUp").value = array[2];
                document.getElementById("segundoApellidoAdminUp").value = array[3];
                document.getElementById("telefonoAdminUp").value = array[4];
                document.getElementById("cedulaAdminUp").readOnly = true;
            }
        });
         jQuery.noConflict();
        $('#actualizarAdminModal').modal('show');
}
function actualizarBarbero(id){
    var datos;
    var array;
        $.ajax({
            url: '../php/manejoadmin.php',
            method: 'POST',
            dataType: 'text', 
            data: {
                llave: 'obtenerBarbero',
                id: id
            },
            success: function(datos){
                array = jQuery.parseJSON(datos);
                document.getElementById("nombreBarbUp").value = array[0];
                document.getElementById("primerApellidoBarbUp").value = array[1];
                document.getElementById("segundoApellidoBarbUp").value = array[2];
                document.getElementById("emailBarbUp").value = array[3];
                document.getElementById("telefonoBarbUp").value = array[4];
                document.getElementById("cedulaBarbUp").value = array[6];
                document.getElementById("cedulaBarbUp").readOnly = true;
                if(array[5] == 'CLIENTE'){
                    $("#rolBarbUp option[value='0']").attr("selected", true);
                }else if(array[5] == 'ADMINISTRADOR'){
                    $("#rolBarbUp option[value='1']").attr("selected", true);    
                }else{
                    $("#rolBarbUp option[value='3']").attr("selected", true);
                }
            }
        });
         jQuery.noConflict();
        $('#actualizarBarberoModal').modal('show');
}
function validarFromActualizacion(){
    var nombre = $("#nombreUp").val();
    var primerApellido = $("#primerApellidoUp").val();
    var SegundoApellido = $("#segundoApellidoUp").val();
    var telefono = $("#telefonoUp").val();
    var correo = $("#emailUp").val();
    var rol = $("rolUp").val();

    var check = true;

    if(nombre.length == 0){
        $("#nombreUp").css('border', '1px solid red');
        $("#nombreUpErr").addClass("alert alert-danger");
        $("#nombreUpErr").html("Por favor digite su nombre");
        check = false;
    }
    else{
        $("#nombreUp").css('border', '');
        $("#nombreUpErr").remove();
    }
    if(primerApellido.length == 0){
        $("#primerApellidoUp").css('border', '1px solid red');
        $("#primerApellidoUpErr").addClass("alert alert-danger");
        $("#primerApellidoUpErr").html("Por favor digite su apellido");
        check = false;
    }
    else{
        $("#primerApellidoUp").css('border', '');
        $("#primerApellidoUpErr").remove();
    }
    if (telefono.length <= 0 || telefono.length > 11){
        $("#telefonoUp").css('border', '1px solid red');
        $("#telefonoUpErr").addClass("alert alert-danger");
        $("#telefonoUpErr").html("Por favor ingrese un telefono");
        check = false;
    }
    else{
        $("#telefonoUp").css('border', '');
        $("#telefonoUpErr").remove();
    }
    if (correo.length == 0){
        $("#emailUp").css('border', '1px solid red');
        $("#emailUpErr").addClass("alert alert-danger");
        $("#emailUpErr").html("Por favor digite su correo electrónico");
        check = false;
    } else if (! /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i.test(correo)){
        $("#emailUp").css('border', '1px solid red');
        $("#emailUpErr").addClass("alert alert-danger");
        $("#emailUpErr").html("Por favor ingrese un correo válido");
        check = false;
    } else {
        $("#emailUp").css('border', '');
        $("#emailUpErr").removeClass("alert alert-danger");
        $("#emailUpErr").html("");
    }
    return check;
}
function validarFromActualizacionBarb(){
    var nombre = $("#nombreBarbUp").val();
    var primerApellido = $("#primerApellidoBarbUp").val();
    var SegundoApellido = $("#segundoApellidoBarbUp").val();
    var telefono = $("#telefonoBarbUp").val();
    var correo = $("#emailBarbUp").val();
    var rol = $("rolBarbUp").val();

    var check = true;

    if(nombre.length == 0){
        $("#nombreBarbUp").css('border', '1px solid red');
        $("#nombreBarbUpErr").addClass("alert alert-danger");
        $("#nombreBarbUpErr").html("Por favor digite su nombre");
        check = false;
    }
    else{
        $("#nombreBarbUp").css('border', '');
        $("#nombreBarbUpErr").remove();
    }
    if(primerApellido.length == 0){
        $("#primerApellidoBarbUp").css('border', '1px solid red');
        $("#primerApellidoBarbUpErr").addClass("alert alert-danger");
        $("#primerApellidoBarbUpErr").html("Por favor digite su apellido");
        check = false;
    }
    else{
        $("#primerApellidoBarbUp").css('border', '');
        $("#primerApellidoBarbUpErr").remove();
    }
    if (telefono.length <= 0 || telefono.length > 11){
        $("#telefonoBarbUp").css('border', '1px solid red');
        $("#telefonoBarbUpErr").addClass("alert alert-danger");
        $("#telefonoBarbUpErr").html("Por favor ingrese un telefono");
        check = false;
    }
    else{
        $("#telefonoBarbUp").css('border', '');
        $("#telefonoBarbUpErr").remove();
    }
    if (correo.length == 0){
        $("#emailBarbUp").css('border', '1px solid red');
        $("#emailBarbUpErr").addClass("alert alert-danger");
        $("#emailBarbUpErr").html("Por favor digite su correo electrónico");
        check = false;
    } else if (! /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i.test(correo)){
        $("#emailBarbUp").css('border', '1px solid red');
        $("#emailBarbUpErr").addClass("alert alert-danger");
        $("#emailBarbUpErr").html("Por favor ingrese un correo válido");
        check = false;
    } else {
        $("#emailBarbUp").css('border', '');
        $("#emailBarbUpErr").removeClass("alert alert-danger");
        $("#emailBarbUpErr").html("");
    }
    return check;
}

function validarFromActualizacionAdmin(){
    var nombre = $("#nombreAdminUp").val();
    var primerApellido = $("#primerApellidoAdminUp").val();
    var telefono = $("#telefonoAdminUp").val();
    var rol = $("rolAdminUp").val();

    var check = true;

    if(nombre.length == 0){
        $("#nombreAdminUp").css('border', '1px solid red');
        $("#nombreAdminUpErr").addClass("alert alert-danger");
        $("#nombreAdminUpErr").html("Por favor digite su nombre");
        check = false;
    }
    else{
        $("#nombreAdminUp").css('border', '');
        $("#nombreAdminUpErr").remove();
    }
    if(primerApellido.length == 0){
        $("#primerApellidoAdminUp").css('border', '1px solid red');
        $("#primerApellidoAdminUpErr").addClass("alert alert-danger");
        $("#primerApellidoAdminUpErr").html("Por favor digite su apellido");
        check = false;
    }
    else{
        $("#primerApellidoAdminUp").css('border', '');
        $("#primerApellidoAdminUpErr").remove();
    }
    if (telefono.length <= 0 || telefono.length > 11){
        $("#telefonoAdminUp").css('border', '1px solid red');
        $("#telefonoAdminUpErr").addClass("alert alert-danger");
        $("#telefonoAdminUpErr").html("Por favor ingrese un telefono");
        check = false;
    }
    else{
        $("#telefonoAdminUp").css('border', '');
        $("#telefonoAdminUpErr").remove();
    }
    return check;
}

function realizarActualizacion(llave){
     var cedula = $("#cedulaUp");
    var nombre = $("#nombreUp");
    var primerApellido = $("#primerApellidoUp");
    var segundoApellido = $("#segundoApellidoUp");
    var telefono = $("#telefonoUp");
    var email = $("#emailUp");
    var rol = $("#rolUp");
    
    if(validarFromActualizacion()){
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
                rol: rol.val()
            }, success: function(respuesta){
                if (respuesta == "email") {
                    $("#emailUp").css('border', '1px solid red');
                    $("#emailUpErr").addClass("alert alert-danger");
                    $("#emailUpErr").html("El correo ingresado ya existe");
                }
                else if (respuesta == "No se pudo actualizar"){
                    $("#emailUp").css('border', '1px solid red');
                    $("#emailUpErr").addClass("alert alert-danger");
                    $("#emailUpErr").html(respuesta);
                }
                else if(respuesta == "Cliente actualizado"){
                 jQuery.noConflict();
                $('#actualizarClienteModal').modal('hide');
                $('#modalSuccessUp').modal('show');
                cargarTablas();
                }
                else{
                    $("#miResp").addClass("alert alert-danger");
                    $("#miResp").html('No se pudo actualizar.');
                    $("#miResp").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
            }
        });
    }
}

function realizarActualizacionAdmin(llave){
     var cedula = $("#cedulaAdminUp");
    var nombre = $("#nombreAdminUp");
    var primerApellido = $("#primerApellidoAdminUp");
    var segundoApellido = $("#segundoApellidoAdminUp");
    var telefono = $("#telefonoAdminUp");
    var rol = $("#rolAdminUp");
    
    if(validarFromActualizacionAdmin()){
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
                rol: rol.val()
            }, success: function(respuesta){
             if (respuesta == "No se pudo actualizar"){
                    $("#respAdminUp").addClass("alert alert-danger");
                    $("#respAdminUp").html(respuesta);
                }
                else if(respuesta == "Administrador actualizado"){
                 jQuery.noConflict();
                $('#actualizarAdminModal').modal('hide');
                $('#modalSuccessAdminUp').modal('show');
                cargarTablas();
                }
                else{
                    $("#respAdminUp").addClass("alert alert-danger");
                    $("#respAdminUp").html('No se pudo actualizar.');
                    $("#respAdminUp").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
            }
        });
    }
}
function realizarActualizacionB(llave){
     var cedula = $("#cedulaBarbUp");
    var nombre = $("#nombreBarbUp");
    var primerApellido = $("#primerApellidoBarbUp");
    var segundoApellido = $("#segundoApellidoBarbUp");
    var telefono = $("#telefonoBarbUp");
    var email = $("#emailBarbUp");
    var rol = $("#rolBarbUp");
    
    if(validarFromActualizacionBarb()){
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
                rol: rol.val()
            }, success: function(respuesta){
                if (respuesta == "email") {
                    $("#emailBarbUp").css('border', '1px solid red');
                    $("#emailBarbUpErr").addClass("alert alert-danger");
                    $("#emailBarbUpErr").html("El correo ingresado ya existe");
                }
                else if (respuesta == "No se pudo actualizar"){
                    $("#emailBarbUp").css('border', '1px solid red');
                    $("#emailBarbUpErr").addClass("alert alert-danger");
                    $("#emailBarbUpErr").html(respuesta);
                }
                else if(respuesta == "Barbero actualizado"){
                 jQuery.noConflict();
                $('#actualizarBarberoModal').modal('hide');
                $('#modalSuccessBarUp').modal('show');
                }
                else{
                    $("#miRespB").addClass("alert alert-danger");
                    $("#miRespB").html('No se pudo actualizar.');
                    $("#miRespB").delay(5000).fadeOut(function(){
                        $(this).removeClass("alert alert-danger");
                        $(this).html("");
                        $(this).css("display", "");
                    });
                }
            }
        });
                        this.cargarTablaBarberos();
    }
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
    var cliente = $("#cliente");
    var desc = $("#descUp");
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
            fecha: fecha.val(),
            desc: desc.val()
        }, success: function(respuesta){
            if(respuesta == "Guardado"){
                cargarTablas();
                jQuery.noConflict();
                $('#sacarCitaModal').modal('hide');
                $('#modalSuccessCita').modal('show');
            }
            else{
                $("#resultadosCita").addClass("alert alert-danger");
                $("#resultadosCita").html(respuesta);
                $("#resultadosCita").delay(5000).fadeOut(function(){
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