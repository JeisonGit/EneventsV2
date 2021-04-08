<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enevents</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../archivos/principio/favicon.png">

    <!-- ICONOS - TIPOGRAFIA -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;700&display=swap" rel="stylesheet">

    <!-- Estilos -->
    <link href="css/estilos.css" rel="stylesheet" />

    <!-- Sweet alerts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<?php

    // oculta los errores
    error_reporting(0);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $swValidarDatosUsuario = false;
    $swValidarSesionUsuario = false;

    // Función para llenar los selects Tipo de documento que se soliciten en los formularios
    function listarSelectTipoDocumento(){

        include('conexion.php');

            $sqlTipoDocumento = $conn -> query("CALL sp_ListarTodosTiposDocumento()");
            $filasTipoDocumento = mysqli_fetch_all($sqlTipoDocumento, MYSQLI_ASSOC);

        mysqli_close($conn);

        return $filasTipoDocumento;
    }

    // Función para llenar los select Area de trabajo que se soliciten en los formularios
    function listarSelectAreaTrabajo(){

        include('conexion.php');

            $sqlAreaTrabajo = $conn -> query("CALL sp_ListarTodosAreasTrabajo()");
            $filasAreaTrabajo= mysqli_fetch_all($sqlAreaTrabajo, MYSQLI_ASSOC);

        mysqli_close($conn);

        return $filasAreaTrabajo;
    }

    // Función para llenar los selects Departamento que se soliciten en los formularios
    function listarSelectDepartamento(){

        include('conexion.php');

            $sqlDepartamento = $conn -> query("CALL sp_ListarTodosDepartamentos()");
            $filasDepartamento = mysqli_fetch_all($sqlDepartamento, MYSQLI_ASSOC);

        mysqli_close($conn);

        return $filasDepartamento;
    }

    function listarSelectTipoUsuario(){

        include('conexion.php');

            $sqlTipoUsuario = $conn -> query("CALL sp_ListarTodosTiposUsuario()");
            $filasTipoUsuario = mysqli_fetch_all($sqlTipoUsuario, MYSQLI_ASSOC);

        mysqli_close($conn);

        return $filasTipoUsuario;
    }

    function listarSelectEstadoUsuario(){

        include('conexion.php');

            $sqlEstadoUsuario = $conn -> query("CALL sp_ListarTodosEstadosUsuario()");
            $filasEstadoUsuario = mysqli_fetch_all($sqlEstadoUsuario, MYSQLI_ASSOC);

        mysqli_close($conn);

        return $filasEstadoUsuario;
    }

    // Validar que los campos obligatorios no esten vacios
    function ValidacionesUsuario(){

        if(($tipo_documento == null) || ($documento == null) || ($nombres == null) || ($correo_empresarial == null) || ($area_trabajo == null) || ($telefono_movil == null) || ($ciudad == null) || ($contrasena == null)){

            $swValidarDatosUsuario = true;
        }
    }

    // Función para agregar un usuario mediante el formulario de la página principal
    function AgregarUsuarioPaginaPrincipal(){

        // Recupero los datos ingresados en el formulario
        $documento = $_POST['documento']; 
        $tipo_documento = $_POST['tipo_documento'];
        $nombres = $_POST['nombres']; 
        $apellidos = $_POST['apellidos']; 
        $correo_personal = $_POST['correo_personal']; 
        $correo_empresarial = $_POST['correo_empresarial']; 
        $direccion = $_POST['direccion']; 
        $telefono_fijo = $_POST['telefono_fijo']; 
        $telefono_movil = $_POST['telefono_movil']; 
        $area_trabajo = $_POST['area_trabajo']; 
        $ciudad = $_POST['ciudad']; 
        $contrasena = $_POST['password'];
        $contrasena = hash('sha512', $contrasena); 

        // Llamo la función que valida que los datos no esten vacios
        ValidacionesUsuario();
        if($swValidarDatosUsuario == true){
            ?>
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'ADVERTENCIA!!',
                        html: 'Todos los datos cuyo enunciado tenga un <b>*</b> son obligatorios.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true
                    });
                </script>
            <?php

            $swValidarDatosUsuario == false;
        }
        // Si los datos no estan vacios realizo la insercion
        else{

            include('conexion.php');

                $insert = $conn -> query("CALL sp_AgregarUsuarioSinImagen('$documento', '$tipo_documento', '$nombres', '$apellidos', '$correo_personal', '$correo_empresarial', '$direccion', '$telefono_fijo', '$telefono_movil', '$area_trabajo', '$ciudad', '$contrasena', '3', '2')");

            mysqli_close($conn); 

            // Valido que la insercion se haya realizo correctamente
            if($insert){
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito!',
                            html: 'Hemos enviado tus datos, los cuales serán revisados por administración. Posteriormente te contactaremos mediante el <b>Correo Empresarial</b>.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = "index.php";
                            }
                        });
                    </script>
                <?php
            }
            else{
                ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR!!!',
                            text: 'Tus datos no se han enviado. Verifique e intente nuevamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        });
                    </script>
                <?php
            }
            
        }     

    }

    // Función para enviar un correo al usuario con los pasos para reestablecer su contraseña
    function RecuperarContrasenaUsuario(){
        
        // Librerias phpmailer
        require 'Phpmailer/Exception.php';
        require 'Phpmailer/PHPMailer.php';
        require 'Phpmailer/SMTP.php';

        // Recupero los datos del formulario
        $documento = $_POST['documento'];
        $correoEmpresarial = $_POST['email'];

        // Valido que los datos no esten vacios
        if($documento == null || $correoEmpresarial == null){
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR!!!',
                        text: 'Los datos solicitados son obligatorios.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    });
                </script>
            <?php
        }
        else{

            // Realizo la consulta para encontrar al usuario y lo guardo en un array
            include('conexion.php');

            $usuarioRecuperar = $conn -> query("CALL sp_RecuperarContrasenaBuscarUsuario('$documento', '$correoEmpresarial')");

            if($fila = $usuarioRecuperar -> fetch_array()){
            }

            mysqli_close($conn);

            // Valido que la consulta solo haya traido un usuario
            $count = mysqli_num_rows($usuarioRecuperar);

            if($count == 1){

                // Creo una nueva contraseña al azar
                $nuevaContrasena = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15);

                // Encripto la nueva contraseña
                $nuevaContrasenaCifrada = hash('sha512', $nuevaContrasena);

                // Realizo la modificación de la contraseña en la BD
                include('conexion.php');

                $updateRecuperar = $conn -> query("CALL sp_RecuperarContrasenaCambiarContrasena('$nuevaContrasenaCifrada', '$documento', '$correoEmpresarial')");

                mysqli_close($conn);

                // Valido que la modificacion se haya realizado correctamente
                if($updateRecuperar){

                    // Cuerpo del mensaje electronico
                    $body = 
                    "Enevents La Ceja" . "<br>Correo: eneventsceja@gmail.com" . "<br>Teléfono: 4989712 <br>" 
                    . "Hola <b>" . $fila['Nombres'] . "  " . $fila['Apellidos'] 
                    . ".</b><br>Hemos recibido una solicitud para reestablecer tu contraseña en Enevents. Sigue las siguientes instrucciones:<br><br>" 
                    . "1. Ingresa a la página de Enevents en la sección de iniciar sesión<br>" 
                    . "2. Ingresa tu correo empresarial: " . $fila['Correo_empresarial'] 
                    . "<br>3. Utiliza la siguiente contraseña para ingresar: " . $nuevaContrasena 
                    . "<br><br><b>IMPORTANTE: NO OLVIDES MODIFICAR TU CONTRASEÑA CUANDO INGRESES A TU PERFIL<b><br><br>" 
                    . "Si luego de seguir las instrucciones aún no puedes ingresar comunicate con nosotros respondiendo este correo o presionando <a href='contacto.php'> aqui</a>";

                    // Envio del email
                    $mail = new PHPMailer(true);

                    try {

                        $mail->SMTPDebug = 0;                     
                        $mail->isSMTP();                                            

                        // CUAL SERA EL "SERVIDOR" QUE SE UTILIZARA. EN ESTE CASO GMAIL
                        $mail->Host       = 'smtp.gmail.com';                       
                        $mail->SMTPAuth   = true;                                  

                        // PERMITIR ACCESO A LA CUENTA DE GMAIL CON EL USER Y CONTRASEÑA
                        $mail->Username   = 'eneventsceja@gmail.com';                     
                        $mail->Password   = 'jeisonmi1';                               

                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          
                        $mail->Port       = 587;                                    

                        // CORREO Y NOMBRE DE LA PERSONA QUE ENVIARA LOS DATOS
                        $mail->setFrom('eneventsceja@gmail.com', 'Enevents');

                        // CORREO DEL ADMINISTRATIVO QUIEN RECIBIRA EL CORREO
                        $mail->addAddress($correoEmpresarial);                

                        //Content
                        $mail->isHTML(true);                                  
                        // ASUNTO DEL CORREO
                        $mail->Subject = 'Reestablecer Contraseña Enevents';
                        // MENSAJE
                        $mail->Body    = $body;
                        $mail->CharSet = 'UTF-8';

                        $mail->send();
                        ?>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Bien!',
                                    html: 'Revisa tu <b>Correo Empresarial</b> para continuar con el proceso de reestablecer tu contraseña.',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    allowEnterKey: false
                                }).then(okay => {
                                    if (okay) {
                                        location.href = "index.php";
                                    }
                                });
                            </script>
                        <?php
                    }
                    catch (Exception $e) {
                        ?>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR!!!',
                                    text: 'Verifique e intente nuevamente. Si el error persiste comunícate con un administrador.',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    allowEnterKey: false
                                }).then(okay => {
                                    if (okay) {
                                        location.href = 'contacto.php';
                                    }
                                });
                            </script>
                        <?php
                        die();
                    } 

                }
                else{
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!!',
                                text: 'Verifique e intente nuevamente. Si el error persiste comunícate con un administrador.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = 'contacto.php';
                                }
                            });
                        </script>
                    <?php
                }
            }
            else{
                ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR!!!',
                            text: 'Los datos no concuerdan.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = 'recuperarContrasena.php';
                            }
                        });
                    </script>
                <?php
            }
        }
    }

    // Función que valida al usuario para permitirle o denegarle el ingreso al panel
    function IniciarSesion(){

        // Recupero los datos del formulario
        $Correo_empresarial = $_POST['email'];
        $Contrasena = $_POST['password'];

        // Valido que los datos no esten vacios
        if($Correo_empresarial == null || $Contrasena == null){
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR!!!',
                        text: 'Los datos solicitados son obligatorios.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    });
                </script>
            <?php
            die();
        }
        else{

            // Encripto la contraseña que llega para validarla
            $Contrasena = hash('sha512', $Contrasena);

            // Busco al usuario que coincida con los datos ingresados
            include("conexion.php");

            $usuarioIniciarSesion = $conn -> query("CALL sp_IniciarSesionBuscarUsuario('$Correo_empresarial', '$Contrasena')");

            mysqli_close($conn);

            // Guardo el resultado de la consulta en un array
            if($row = $usuarioIniciarSesion -> fetch_assoc()){}

            // Valido que la consulta solo haya traido un usuario
            $count = mysqli_num_rows($usuarioIniciarSesion);

            if($count == 1){

                // Valido el Tipo y el Estado del usuario y dependiedon de estos inicio la sesion y re direcciona al panel correspondiente
                if($row['Rol'] == 1 && $row['Estado'] == 1){

                    session_start();

                    $_SESSION['id'] = $row['Documento'];
                    header('Location: Admin/inicio.php');

                }
                else if($row['Rol'] == 2 && $row['Estado'] == 1){

                    session_start();

                    $_SESSION['id'] = $row['Documento'];
                    header('Location: Usuario/inicio.php');

                }
                else{
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                html: 'Error de autentificación. Verifique e intente nuevamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: true
                            }).then(okay => {
                                if (okay) {
                                    location.href = "iniciarSesion.php";
                                }
                            });
                        </script>
                    <?php 
                }
            }
            else{
                ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR!!',
                            html: 'Error de autentificación. Verifique e intente nuevamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: true
                        }).then(okay => {
                            if (okay) {
                                location.href = "iniciarSesion.php";
                            }
                        });
                    </script>
                <?php 
            }
        }
    }

    function ValidarSesionUsuario(){

        session_start(); 
        $id = $_SESSION['id'];

        if($id == null || $id == ''){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = true;
            die();   
        }
        else{

            return $id;
        }
    }


    // FUNCIONES EXCLUSIVAS DEL USUARIO "CREADOR" 

    // Consulta que trae parte de la informacion del usuario que ha iniciado sesion
    function InformacionUsuarioSesion($id){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            include('conexion.php');

                $usuario = $conn -> query("CALL sp_InformacionUsuarioSesion('$id')");

            mysqli_close($conn);

            return $usuario;
        }
    }

    // Consulta que trae la cantidad de eventos segun el Estado del usuario que ha iniciado sesion
    function CantidadEventosEstadoUsuario($id){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            include('conexion.php');

                $CantidadEventos = $conn -> query("CALL sp_CantidadEventosEstadoUsuario('$id')");

            mysqli_close($conn);

            return $CantidadEventos;
        }

    }

    // Consulta que trae la información que puede modificar el usuario
    function InformacionUsuarioSesionModificar($id){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            include('conexion.php');

                $usuario = $conn -> query("CALL sp_InformacionUsuarioSesionModificar('$id')");

            mysqli_close($conn);

            return $usuario;
        }

    }

    // Función que modifica la información que haya cambiado el usuario
    function ModificarInformacionUsuarioSesion($id){

         ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            // Recupero los datos del formularios
            $tipo_documento = $_POST['tipo_documento'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $correo_personal = $_POST['correo_personal'];
            $correo_empresarial = $_POST['correo_empresarial'];
            $direccion = $_POST['direccion'];
            $area_trabajo = $_POST['area_trabajo'];
            $telefono_fijo = $_POST['telefono_fijo'];
            $telefono_movil = $_POST['telefono_movil']; 
            $ciudad = $_POST['ciudad'];

            if($tipo_documento == null || $nombres == null || $correo_empresarial == null || $area_trabajo == null || $telefono_movil == null || $ciudad == null){
                ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR!!!',
                            text: 'Los datos obligatorios no pueden estar vacios.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        });
                    </script>
                <?php
            }
            else{

                include('conexion.php');

                    $updateUsuario = $conn -> query("CALL sp_ModificarInformacionUsuarioSesion('$tipo_documento','$nombres','$apellidos','$correo_personal','$correo_empresarial','$direccion','$telefono_fijo','$telefono_movil','$area_trabajo','$ciudad','$id')");

                mysqli_close($conn);

                if($updateUsuario){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'Modificaciones realizadas correctamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "inicio.php";
                                }
                            });
                        </script>
                    <?php
                }
                else{
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!!',
                                text: 'Los datos no se han modificado. verifique e intente nuevamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            });
                        </script>
                    
                    <?php
                }
            }
        }
    }

    // Función que consulta la imagen del usuario que ha iniciado sesion
    function BuscarImagenUsuarioSesion($id){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            include('conexion.php');

                $imgBd = $conn -> query("CALL sp_BuscarImagenUsuarioSesion('$id')");
                if($fila = $imgBd -> fetch_assoc()){}

            mysqli_close($conn);

            return $fila;
        }
    }

    // Función que modifica la imagen del usuario que ha iniciado sesion
    function ModificarImagenUsuarioSesion($id){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            // Recupero los datos de la imagen seleccionada
            $imgPost = $_FILES['imagenUsuario']['name'];
            $archivo = $_FILES['imagenUsuario']['tmp_name'];
            $rutaBD = "/Enevents/archivos/usuarios/" . $imgPost;
            $rutaCarpeta = $_SERVER["DOCUMENT_ROOT"] . "/Enevents/archivos/usuarios/" . $imgPost; 
            copy($archivo, $rutaCarpeta);

            // Ralizo la modificacion de la ruta en la BD
            include('conexion.php');

                $updateImg = $conn -> query("CALL sp_ModificarImagenUsuarioSesion('$rutaBD','$id')");

            mysqli_close($conn);

            // Valido la modificacion
            if($updateImg){
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito!!',
                            html: 'La imagen de perfil se ha cambiado correctamnete.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = "configUsuario.php";
                            }
                        });
                    </script>
                <?php         
            }
            else{
                ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR!!!',
                            html: 'No se ha cambiado la imagen de perfil. Verifique e intente nuevamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        });
                    </script>
                <?php  
            }
        }

        
    }

    // Función que modifica la contrasena del usuario que ha iniciado sesion
    function ModificarContrasenaUsuarioSesion($id){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            // Recupero el dato ingresado en el primer input que corresponde a ingresar la antigua contraseña
            $contrasenaAntigua = $_POST['contrasenaA'];
            $contrasenaAntigua = hash('sha512', $contrasenaAntigua);


            // Recupero el dato que se considerara como nueva contrasena y a su vez su confirmación
            $contrasenaNueva = $_POST['contrasenaN'];
            $confirmarNueva = $_POST['confirmN'];

            // Valido la contrasena
            if(strlen($contrasenaNueva) < 5){
                header('Location: inicio.php');
                die();
            }
            else{

                // Consulto la contrasena que tiene actualmente el usuario en la BD
                include('conexion.php');
                
                    $consultaContrasena = $conn -> query("CALL sp_BuscarContrasenaUsuarioSesion('$id')");
                    if($fila = $consultaContrasena -> fetch_assoc()){}

                mysqli_close($conn);
                
                // Guardo la Contrasena de la consulta en una variable
                $contrasenaCifrada = $fila['Contrasena'];

                // Valido que la contrasena antigua ingresada en el formulario coincida con la contrasena de la BD
                if($contrasenaCifrada == $contrasenaAntigua){

                    // Valido que la nueva contrasena y la de confirmacion coincidan
                    if($contrasenaNueva == $confirmarNueva){
                        
                        // Encripto la nueva contrasena
                        $contrasenaNueva = hash('sha512', $contrasenaNueva);

                        include('conexion.php');
                        
                            // Realizo la modificacion de la contrasena
                            $update = $conn -> query("CALL sp_ModificarContrasenaUsuarioSesion('$contrasenaNueva','$id')");

                        mysqli_close($conn);


                        // Valido si se realizo la modificacion
                        if($update){
                            ?>
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Éxito!!',
                                        html: 'La contraseña se ha cambiado correctamente',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        allowEnterKey: false
                                    }).then(okay => {
                                        if (okay) {
                                            location.href = "inicio.php";
                                        }
                                    });
                                </script>
                            <?php         
                        }
                        else{
                            ?>
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ERROR!!!',
                                        text: 'La contraseña no se ha cambiado. Verifique e intente nuevamente.',
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        allowEnterKey: false
                                    });
                                </script>
                            <?php  
                        }
                    }
                    else{
                        ?>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ERROR!!!',
                                    html: 'La <b>Contraseña Nueva</b> no coincide con la de <b>Confirmación</b>. Verifique e intente nuevamente.',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    allowEnterKey: false
                                });
                            </script>
                        <?php  
                    }
                }
                else{
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!!',
                                html: 'La <b>Contraseña Antigua</b> no coincide. Verifique e intente nuevamente',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            });
                        </script>
                    <?php  
                }
            }
        }
    }


    // FUNCIONES EXCLUSIVAS DEL USUARIO "ADMIN"

    // Función que consulta la cantidad de eventos segun su estado
    function CantidadEventosInicioPanel(){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            include('conexion.php');

                $eventos = $conn -> query("CALL sp_CantidadEventos()");

            mysqli_close($conn);

            return $eventos;
        }
    }

    // Fucnión que consulta la cantidad de usuarios segun su estado
    function CantidadUsuariosInicioPanel(){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            include('conexion.php');

                $usuarios = $conn -> query("CALL sp_CantidadUsuarios()");

            mysqli_close($conn);

            return $usuarios;
        }
    }
    
    // Función que agrega un nuevo usuario 
    function AgregarUsuario(){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            $documento          = $_POST['documento'];
            $tipo_documento     = $_POST['tipo_documento'];
            $nombres            = $_POST['nombres'];
            $apellidos          = $_POST['apellidos'];
            $correo_personal    = $_POST['correo_personal'];
            $correo_empresarial = $_POST['correo_empresarial'];
            $direccion          = $_POST['direccion'];
            $telefono_fijo      = $_POST['telefono_fijo'];
            $telefono_movil     = $_POST['telefono_movil'];
            $area_trabajo       = $_POST['area_trabajo'];
            $ciudad             = $_POST['ciudad'];
            $contrasena         = $_POST['password'];
            $contrasena_cifrada = hash('sha512', $contrasena);
            $estado_usuario     = $_POST['estado_usuario'];
            $tipo_usuario       = $_POST['tipo_usuario'];

            $imgPost            = $_FILES['imagen']['name']; 
            $archivo            = $_FILES['imagen']['tmp_name']; 
            $rutaBD             = "/Enevents/archivos/usuarios/" . $imgPost; 
            $rutaServidor       = $_SERVER["DOCUMENT_ROOT"] . "/Enevents/archivos/usuarios/" . $imgPost; 
            
            ValidacionesUsuario();
            if($swValidarDatosUsuario == true){
                ?>
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'ADVERTENCIA!!',
                            html: 'Todos los datos cuyo enunciado tenga un <b>*</b> son obligatorios.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: true
                        });
                    </script>
                <?php

                $swValidarDatosUsuario == false;
            }
            else{

                copy($archivo, $rutaServidor);

                include('conexion.php');

                    $insertUsuario = $conn -> query("CALL sp_AgregarUsuario('$documento','$tipo_documento','$nombres','$apellidos','$correo_personal','$correo_empresarial','$direccion','$telefono_fijo','$telefono_movil','$area_trabajo','$ciudad','$rutaBD','$contrasena_cifrada','$estado_usuario','$tipo_usuario')");

                mysqli_close($conn);

                if($insertUsuario){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'El usuario se ha registrado correctamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoUsuario.php?id=<?php print $documento ?>";
                                }
                            });
                        </script>
                    <?php         
                }else{
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!!',
                                text: 'El usuario no se ha registrado. Verifique e intente nuevamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            });
                        </script>
                    <?php 
                }

            }
        }
    }

    // Función que consulta los usuarios dependiendo de su estado
    function ListarUsuarios($estado){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            if($estado == "Activos"){

                $titulo = "Usuarios Activos";

                include('conexion.php');

                    $usuarios = $conn -> query("CALL sp_ListarUsuariosActivos()");

                mysqli_close($conn);

                return array($usuarios, $titulo);
            }
            else if($estado == "Inactivos"){

                $titulo = "Usuarios Desactivados / Inactivos";

                include('conexion.php');

                    $usuarios = $conn -> query("CALL sp_ListarUsuariosInactivos()");

                mysqli_close($conn);

                return array($usuarios, $titulo);
            }
            else if($estado == "Espera"){

                $titulo = "Usuarios que han Solicitado Activación de Cuenta";

                include('conexion.php');

                    $usuarios = $conn -> query("CALL sp_ListarUsuariosEspera()");

                mysqli_close($conn);

                return array($usuarios, $titulo);
            }
            else{

                print   "<script>
                            alert('Seleccione alguna de las opciones primero.');
                            location.href = 'inicio.php';
                        </script>";
            }
        }
    }

    // Función que consulta los usuarios cuyo tipo de usuario es administrador
    function ListarUsuariosAdmin(){

        ValidarSesionUsuario();

        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{

            include('conexion.php');

                $usuarios = $conn -> query("CALL sp_ListarUsuariosAdmin()");

            mysqli_close($conn);

            return $usuarios;
        }
    }

    // Función que consulta la informacion completa del usuario seleccionado
    function InformacionUsuarioSeleccionado($documento){

        ValidarSesionUsuario();
        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{
            
            include('conexion.php');

                $usuario = $conn -> query("CALL sp_InformacionUsuarioSeleccionAdmin('$documento')");

            mysqli_close($conn);

            if($filaUsuario = $usuario -> fetch_assoc()){}

            return $filaUsuario;
        }
    }

    // Función que consulta la cantidad de usuarios que tiene el usuario seleccionado
    function CantidadEventosUsuarioSeleccionado($documento){
        
       ValidarSesionUsuario();
        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        } 
        else{

            include('conexion.php');

                $cantEventos = $conn -> query("CALL sp_CantidadEventosUsuarioSeleccion ('$documento')");

            mysqli_close($conn);

            return $cantEventos;
        }
    }

    // Función que consulta la información del usuario seleccionado a modificar
    function InformacionUsuarioModificar($documento){
        
        ValidarSesionUsuario();
        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{
            
            include('conexion.php');

                $usuario = $conn -> query("CALL sp_InformacionUsuarioModificar('$documento')");

            mysqli_close($conn);

            if($filaUsuario = $usuario -> fetch_assoc()){}

            return $filaUsuario;
        }
    }

    // Función que modifica al usuario que fue previamente seleccionado
    function ModificarUsuario($documento){
        ValidarSesionUsuario();
        if($swValidarSesionUsuario == true){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
            $swValidarSesionUsuario = false;        
            die();
        }
        else{
            
            $tipo_documento     = $_POST['tipo_documento'];
            $nombres            = $_POST['nombres'];
            $apellidos          = $_POST['apellidos'];
            $correo_personal    = $_POST['correo_personal'];
            $correo_empresarial = $_POST['correo_empresarial'];
            $direccion          = $_POST['direccion'];
            $telefono_fijo      = $_POST['telefono_fijo'];
            $telefono_movil     = $_POST['telefono_movil'];
            $area_trabajo       = $_POST['area_trabajo'];
            $ciudad             = $_POST['ciudad'];
            $contrasena         = $_POST['password'];
            $contrasena_cifrada = hash('sha512', $contrasena);
            $estado_usuario     = $_POST['estado_usuario'];
            $tipo_usuario       = $_POST['tipo_usuario'];

            $imgPost            = $_FILES['imagen']['name']; 
            $archivo            = $_FILES['imagen']['tmp_name']; 
            $rutaBD             = "/Enevents/archivos/usuarios/" . $imgPost; 
            $rutaServidor       = $_SERVER["DOCUMENT_ROOT"] . "/Enevents/archivos/usuarios/" . $imgPost;

            if($imgPost != null && $contrasena == null){

                copy($archivo, $rutaServidor);

                include('conexion.php');

                    $updateUsuario = $conn -> query("CALL sp_ModificarUsuarioSiImagenNoContrasena('$documento','$tipo_documento','$nombres','$apellidos','$correo_personal','$correo_empresarial','$direccion','$telefono_fijo','$telefono_movil','$area_trabajo','$ciudad','$rutaBD','$estado_usuario','$tipo_usuario')");

                mysqli_close($conn);
            }
            else if($imgPost == null && $contrasena != null){

                include('conexion.php');

                    $updateUsuario = $conn -> query("CALL sp_ModificarUsuarioNoImagenSiContrasena('$documento ','$tipo_documento','$nombres ','$apellidos ','$correo_personal','$correo_empresarial','$direccion ','$telefono_fijo','$telefono_movil','$area_trabajo','$ciudad','$contrasena_cifrada','$estado_usuario','$tipo_usuario')");
                
                mysqli_close($conn);
            }
            else if($imgPost == null && $contrasena == null){

                include('conexion.php');

                    $updateUsuario = $conn -> query("CALL sp_ModificarUsuarioNoImagenNoContrasena('$documento ','$tipo_documento','$nombres ','$apellidos ','$correo_personal','$correo_empresarial','$direccion ','$telefono_fijo','$telefono_movil','$area_trabajo','$ciudad','$estado_usuario','$tipo_usuario')");

                mysqli_close($conn);
            }
            else if($imgPost != null && $contrasena != null){

                copy($archivo, $rutaServidor);

                include('conexion.php');

                    $updateUsuario = $conn -> query("CALL sp_ModificarUsuarioSiImagenSiContrasena('$documento ','$tipo_documento','$nombres ','$apellidos ','$correo_personal','$correo_empresarial','$direccion ','$telefono_fijo','$telefono_movil','$area_trabajo','$ciudad','$rutaBD ','$contrasena_cifrada','$estado_usuario','$tipo_usuario')");

                mysqli_close($conn);
            }

            if($updateUsuario){
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito!!',
                            html: 'Datos modificados correctamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = "selectInfoUsuario.php?id=<?php print $documento ?>";
                            }
                        });
                    </script>
                <?php         
            }else{
                ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ERROR!!!',
                            text: 'Los datos no se han modificado. Verifique e intente nuevamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        });
                    </script>
                <?php 
            }
        }
    }

    // Función que modifica el estado del usuario segun la solicitud realizada
    function EstadoUsuario($documento){

        $tipoSolicitud = $_POST['tipoSolicitud'];

        if($documento == null || $tipoSolicitud == null){
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR!!',
                        html: 'Verifique e intente nuevamente.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    }).then(okay => {
                        if (okay) {
                            location.href = "inicio.php";
                        }
                    });
                </script>
            <?php 
        }
        else{

            if($tipoSolicitud == "Activar"){

                include('conexion.php');

                    $updateEstado = $conn -> query("CALL sp_ModificarEstadoUsuarioActivar('$documento')");

                mysqli_close($conn);

                if($updateEstado){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'El usuario se ha <b>Activado</b> correctamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoUsuario.php?id=<?php print $documento ?>";
                                }
                            });
                        </script>
                    <?php 
                }else{
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                html: 'El usuario no se ha <b>Activado</b>. Verifique e intente nuevamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoUsuario.php?id=<?php print $documento ?>";
                                }
                            });
                        </script>
                    <?php  
                }
            }
            else if($tipoSolicitud == "Desactivar"){

                include('conexion.php');

                    $updateEstado = $conn -> query("CALL sp_ModificarEstadoUsuarioInactivar('$documento')");

                mysqli_close($conn);

                if($updateEstado){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'El usuario se ha <b>Inhabilitado</b> correctamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoUsuario.php?id=<?php print $documento ?>";
                                }
                            });
                        </script>
                    <?php     
                }else{
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                html: 'El usuario no se ha <b>Inhabilitado</b>. Verifique e intente nuevamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoUsuario.php?id=<?php print $documento ?>";
                                }
                            });
                        </script>
                    <?php   
                }
            }
            else if($tipoSolicitud == "Rechazar"){

                include('conexion.php');

                    $updateEstado = $conn -> query("CALL sp_ModificarEstadoUsuarioEliminar('$documento')");

                mysqli_close($conn);

                if($updateEstado){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'La solicitud del usuario se ha <b>Rechazado</b> correctamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectUsuarios.php?Estado=Espera";
                                }
                            });
                        </script>
                    <?php 
                }else{
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                html: 'No se ha <b>Rechazado</b> la solicitud del usuario. Verifique e intente nuevamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoUsuario.php?id=<?php print $documento ?>";
                                }
                            });
                        </script>
                    <?php  
                }
            }
            else{
                ?>
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Advertencia!!',
                            html: 'Debe <b>Seleccionar</b> primero alguna opción',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = "selectInfoUsuario.php?id=<?php print $documento ?>";
                            }
                        });
                    </script>
                <?php 
            }
        }
    }

?>

    <!-- Sweet alerts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>

