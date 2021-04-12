const expresionEmail = /\w+@\w+\.+[a-z]/;
const expresionNombres = /^[A-z]+$/i;

// VALIDACION GLOBAL IMAGENES
function validarImgEventos() {
    var imgId = document.getElementById("imagenEvento");
    var imgEvento = imgId.value;
    var extPermitidas = /(.PNG|.jpg|.jfif)$/i;

    if (!extPermitidas.exec(imgEvento)) {
        alert("Comprueba la extension de tus imagenes. Los formatos aceptados son: png, jpg y jpeg.");
        document.getElementById("imagenEvento").focus();
        return false;
    }
    else {
        if (imgId.files && imgId.files[0]) {
            var visor = new FileReader();
            visor.onload = function (e) {
                document.getElementById("visorArchivo").innerHTML =
                    '<embed src="' + e.target.result + '" width="150" height="150" >'
            };
            visor.readAsDataURL(imgId.files[0]);
        }
    }
}

// VALIDACIONES BUSCADORES - CONTACTO - RECUPERAR

// Filtrar por Fechas
function filtrarFechas() {

    const fechaMin = document.getElementById("fechaAntigua").value;
    const fechaMax = document.getElementById("fechaReciente").value;

    if (fechaMin == "" || fechaMax == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Se deben seleccionar ambas fechas.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (fechaMin > fechaMax) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La <b>Fecha Antigua</b> debe ser "menor" a la <b>Fecha Reciente</b>.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        }).then(okay => {
            if (okay) {
                document.getElementById("fechaAntigua").focus();
            }
        });
        return false;
    }
}


// Buscador Principal
function buscarPalabra() {
    
    const palabra = document.getElementById("palabra").value;

    if (palabra == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Ingrese una palabra, frase, seudonimo, etc',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        }).then(okay => {
            if (okay) {
                document.getElementById("palabra").focus();
            }
        });
        return false;
    }
    else if (palabra.length < 3) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La palabra es demasiado corta. <br> (Min. 3 caracteres)',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        }).then(okay => {
            if (okay) {
                document.getElementById("palabra").focus();
            }
        });
        return false;
    }
    else if (palabra.length > 15) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La palabra es demasiado larga. <br> (Max. 15 caracteres)',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        }).then(okay => {
            if (okay) {
                document.getElementById("palabra").focus();
            }
        });
        return false;
    }
}


// Validar Formulario Login
function login() {
    
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (email == "" || password == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Todos los datos son obligatorios.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionEmail.test(email) || email.length > 40) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El correo no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (password.length < 5) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La contraseña no es válida.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
}


// Validar Formulario Recuperar Contraseña
function recuperarContrasena() {
    
    const documento = document.getElementById("documento").value;
    const email = document.getElementById("email").value;

    if (documento == "" || email == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Todos los datos son obligatorios.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (isNaN(documento) || documento.length > 12) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El documento no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionEmail.test(email) || email.length > 40) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El correo no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
}


// Validar Formulario Contacto
function contacto() {
    
    const nombre = document.getElementById("nombre").value;
    const correo = document.getElementById("correo").value;
    const telefono = document.getElementById("telefono").value;
    const mensaje = document.getElementById("mensaje").value;

    if (nombre == "" || correo == "" || telefono == "" || mensaje == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Todos los datos son obligatorios.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (nombre.length > 100) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Nombre</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionEmail.test(correo) || correo.length > 70) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (telefono.length > 25) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono</b> es demasiado largo.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (mensaje.length > 500) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Mensaje</b> es demasiado largo.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
}


// Validacion Formulario Registrarse
function registrarse() {

    const tipoId = document.getElementById("tipoId").value;    
    const documento = document.getElementById("documento").value;
    const nombres = document.getElementById("nombres").value;
    const apellidos = document.getElementById("apellidos").value;
    const correo_empresarial = document.getElementById("correo_empresarial").value;
    const correo_personal = document.getElementById("correo_personal").value;
    const telefono_movil = document.getElementById("telefono_movil").value;
    const telefono_fijo = document.getElementById("telefono_fijo").value;
    const departamento = document.getElementById("departamento").value;
    const ciudad = document.getElementById("ciudad").value;
    const direccion = document.getElementById("direccion").value;
    const area_trabajo = document.getElementById("area_trabajo").value;
    const password = document.getElementById("password").value;
    const confirmpass = document.getElementById("confirmpass").value;

    if (tipoId == "" || documento == "" || nombres == "" || correo_empresarial == "" || telefono_movil == "" || departamento == "" || ciudad == "" || area_trabajo == "" || password == "" || confirmpass == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Todos los datos cuyo enunciado tenga un <b>*</b> son obligatorios.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (isNaN(documento) || documento.length > 12) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Documento</b> no es válido. <br> <b>Nota:</b> No incluya guiones o puntos.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (nombres.length > 60) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Nombre</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (apellidos.length > 50) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Apellido</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionEmail.test(correo_empresarial) || correo_empresarial.length > 40) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo Empresarial</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (correo_personal !== "" && !expresionEmail.test(correo_personal) || correo_personal.length > 70) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo Personal</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (isNaN(telefono_movil) || telefono_movil.length > 15) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono Móvil</b> no es válido. <br> <b>Nota:</b> Sólo valores númericos.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (telefono_fijo.length > 25) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono Fijo</b> es demasiado largo.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (direccion.length > 60) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La <b>Dirección</b> es demasiado larga.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (password.length < 5) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La <b>Contraseña</b> es demasiado corta. <br> <b>Recomendación:</b> Mezcle Mayúsculas, Minúsculas y números.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (password !== confirmpass) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Las <b>Contraseñas</b> no coinciden.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    

}

// FIN VALIDACIONES INDEX PRINCIPAL



// VALIDACIONES MODULO USUARIO

// Validar Formulario Update Usuario
function updateUsuario() {

    const tipoId = document.getElementById("tipoId").value;
    const documento = document.getElementById("documento").value;
    const nombres = document.getElementById("nombres").value;
    const apellidos = document.getElementById("apellidos").value;
    const correo_empresarial = document.getElementById("correo_empresarial").value;
    const correo_personal = document.getElementById("correo_personal").value;
    const telefono_movil = document.getElementById("telefono_movil").value;
    const telefono_fijo = document.getElementById("telefono_fijo").value;
    const departamento = document.getElementById("departamento").value;
    const ciudad = document.getElementById("ciudad").value;
    const direccion = document.getElementById("direccion").value;
    const area_trabajo = document.getElementById("area_trabajo").value;


    if (tipoId == "" || documento == "" || nombres == "" || correo_empresarial == "" || telefono_movil == "" || departamento == "" || ciudad == "" || area_trabajo == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Todos los datos cuyo enunciado tenga un <b>*</b> son obligatorios.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionNombres.test(nombres) || nombres.length > 60) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Nombre</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionNombres.test(apellidos) || apellidos.length > 50) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Apellido</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionEmail.test(correo_empresarial) || correo_empresarial.length > 40) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo Empresarial</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (correo_personal !== "" && !expresionEmail.test(correo_personal) || correo_personal.length > 70) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo Personal</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (isNaN(telefono_movil) || telefono_movil.length > 15) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono Móvil</b> no es válido. <br> <b>Nota:</b> Sólo valores númericos.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (telefono_fijo.length > 25) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono Fijo</b> es demasiado largo.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (direccion.length > 60) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La <b>Dirección</b> es demasiado larga.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
}

// Validar que la nuvea y contraseña y la confirmación coincidan
function cambiarContrasena() {
    
    const nueva = document.getElementById('contrasenaN').value;
    const confirm = document.getElementById('confirmN').value;

    if (nueva !== confirm) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La nueva contraseña y la de confirmación no coinciden.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (nueva.length < 5) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La <b>Nueva Contraseña</b> es demasiado corta. <br> <b>Recomendación:</b> Mezcle Mayúsculas, Minúsculas y números.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
}

function cambiarImagen() {

    const imagen = document.getElementById('imagenEvento').value;

    if (imagen == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Seleccione una imagen primero.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }

}


// VALIDACIONES MODULO ADMINISTRATIVO

function agregarUsuario() {

    const tipoId = document.getElementById("tipoId").value;
    const documento = document.getElementById("documento").value;
    const nombres = document.getElementById("nombres").value;
    const apellidos = document.getElementById("apellidos").value;
    const correo_empresarial = document.getElementById("correo_empresarial").value;
    const correo_personal = document.getElementById("correo_personal").value;
    const telefono_movil = document.getElementById("telefono_movil").value;
    const telefono_fijo = document.getElementById("telefono_fijo").value;
    const departamento = document.getElementById("departamento").value;
    const ciudad = document.getElementById("ciudad").value;
    const direccion = document.getElementById("direccion").value;
    const area_trabajo = document.getElementById("area_trabajo").value;
    const tipo_usuario = document.getElementById("tipo_usuario").value;
    const estado_usuario = document.getElementById("estado_usuario").value;
    const password = document.getElementById("password").value;
    const confirmpass = document.getElementById("confirmpass").value;

    if (documento == "" || nombres == "" || correo_empresarial == "" || telefono_movil == "" || departamento == "" || ciudad == "" || password == "" || confirmpass == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Todos los datos cuyo enunciado tenga un <b>*</b> son obligatorios.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (tipoId == "" || tipoId < 1 || tipoId > 3) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            html: 'Verifique e intente nuevamente.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (isNaN(documento) || documento.length > 12) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Documento</b> no es válido. <br> <b>Nota:</b> No incluya guiones o puntos.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (nombres.length > 60) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Nombre</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (apellidos.length > 50) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Apellido</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionEmail.test(correo_empresarial) || correo_empresarial.length > 40) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo Empresarial</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (correo_personal !== "" && !expresionEmail.test(correo_personal) || correo_personal.length > 70) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo Personal</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (isNaN(telefono_movil) || telefono_movil.length > 15) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono Móvil</b> no es válido. <br> <b>Nota:</b> Sólo valores númericos.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (telefono_fijo.length > 25) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono Fijo</b> es demasiado largo.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (direccion.length > 60) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La <b>Dirección</b> es demasiado larga.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (area_trabajo == "" || area_trabajo < 1 || area_trabajo > 8) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            html: 'Verifique e intente nuevamente.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (tipo_usuario == "" || tipo_usuario < 1 || tipo_usuario > 2) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            html: 'Verifique e intente nuevamente.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (estado_usuario == "" || estado_usuario < 1 || estado_usuario > 3) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            html: 'Verifique e intente nuevamente.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (password.length < 5) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La <b>Contraseña</b> es demasiado corta. <br> <b>Recomendación:</b> Mezcle Mayúsculas, Minúsculas y números.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (password !== confirmpass) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Las <b>Contraseñas</b> no coinciden.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }


}

function updateUsuario() {

    const tipoId = document.getElementById("tipoId").value;
    const nombres = document.getElementById("nombres").value;
    const apellidos = document.getElementById("apellidos").value;
    const correo_empresarial = document.getElementById("correo_empresarial").value;
    const correo_personal = document.getElementById("correo_personal").value;
    const telefono_movil = document.getElementById("telefono_movil").value;
    const telefono_fijo = document.getElementById("telefono_fijo").value;
    const departamento = document.getElementById("departamento").value;
    const ciudad = document.getElementById("ciudad").value;
    const direccion = document.getElementById("direccion").value;
    const area_trabajo = document.getElementById("area_trabajo").value;
    const tipo_usuario = document.getElementById("tipo_usuario").value;
    const estado_usuario = document.getElementById("estado_usuario").value;
    const password = document.getElementById("password").value;
    const confirmpass = document.getElementById("confirmpass").value;

    if (nombres == "" || correo_empresarial == "" || telefono_movil == "" || departamento == "" || ciudad == "") {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Todos los datos cuyo enunciado tenga un <b>*</b> son obligatorios.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (tipoId == "" || tipoId < 1 || tipoId > 3) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            html: 'Verifique e intente nuevamente.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (nombres.length > 60) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Nombre</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (apellidos.length > 50) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Apellido</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (!expresionEmail.test(correo_empresarial) || correo_empresarial.length > 40) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo Empresarial</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (correo_personal !== "" && !expresionEmail.test(correo_personal) || correo_personal.length > 70) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Correo Personal</b> no es válido.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (isNaN(telefono_movil) || telefono_movil.length > 15) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono Móvil</b> no es válido. <br> <b>Nota:</b> Sólo valores númericos.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (telefono_fijo.length > 25) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'El <b>Teléfono Fijo</b> es demasiado largo.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (direccion.length > 60) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'La <b>Dirección</b> es demasiado larga.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (area_trabajo == "" || area_trabajo < 1 || area_trabajo > 8) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            html: 'Verifique e intente nuevamente.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (tipo_usuario == "" || tipo_usuario < 1 || tipo_usuario > 2) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            html: 'Verifique e intente nuevamente.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (estado_usuario == "" || estado_usuario < 1 || estado_usuario > 3) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            html: 'Verifique e intente nuevamente.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }
    else if (password !== confirmpass) {
        Swal.fire({
            icon: 'warning',
            title: 'ADVERTENCIA!!',
            html: 'Las <b>Contraseñas</b> no coinciden.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true
        });
        return false;
    }


}
