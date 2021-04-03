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

    // Función que consulta los eventos cuya fecha de inicio es la fecha de hoy
    function EventosHoyIndex(){

        include('conexion.php');

            $eventosHoy = $conn -> query("CALL sp_SeleccionarEventosHoy()");

        mysqli_close($conn);

        return $eventosHoy;
    }

    // Función que consulta los eventos cuya fecha de inicio esta entre hoy y (hoy + 8 dias)
    function EventosSemanaIndex(){

        include('conexion.php');

            $eventosSemana = $conn -> query("CALL sp_SeleccionarEventosSemana()");

        mysqli_close($conn);

        return $eventosSemana;
    }

    // Función que consulta el codigo y la fecha de finalización de los eventos para desactivarlos
    function BuscarEventosDesactivar(){

        include('conexion.php');

            $eventosDesactivar = $conn -> query("CALL sp_BuscarEventosDesactivarAutomaticamente()");

        mysqli_close($conn);  

        return $eventosDesactivar;
    }

    // Funcioón que consulta la información del evento seleccionado
    function InformacionEvento(){

        // Recupero el codigo del evento seleccionado
        $codigoEvento = $_POST['Evento'];

        // Valido que el codigo no este vacio
        if($codigoEvento == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto la información del evento seleccionado y la guardo en un array
            include('conexion.php');

            $evento = $conn -> query("CALL sp_SeleccionarInformacionEventoPoblacion('$codigoEvento')");
            if($filaEvento = $evento -> fetch_array()){}      

            mysqli_close($conn);

            // Formatos de fecha y hora para la información del evento
            $filaEvento['FechaHora_inicio'] = date_create($filaEvento['FechaHora_inicio']);
            $filaEvento['FechaHora_inicio'] = date_format($filaEvento['FechaHora_inicio'], "d-m-Y g:i a");

            $filaEvento['FechaHora_final'] = date_create($filaEvento['FechaHora_final']);
            $filaEvento['FechaHora_final'] = date_format($filaEvento['FechaHora_final'], "d-m-Y g:i a");

            return $filaEvento;
        }
    }

    // Función que consulta la informacion del usuario cuyo evento fue seleccionado
    function InformacionUsuarioEvento(){

        // Recupero el codigo del evento seleccionado
        $codigoEvento = $_POST['Evento'];

        // Valido que el codigo no este vacio
        if($codigoEvento == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto la información del usuario que "realiza" este evento y la guardo en un array
            include('conexion.php');

            $usuarioEvento = $conn -> query("CALL sp_SeleccionarInformacionUsuarioEventoPoblacion('$codigoEvento')");
            if($filaUsuario = $usuarioEvento -> fetch_array()){}

            mysqli_close($conn);

            return $filaUsuario;
        }
    }

    // Función que consulta eventos adicionales realizados por el usuario cuyo evento fue seleccionado
    function InformacionEventosAdicionalesUsuario(){

        // Recupero el codigo del evento seleccionado
        $codigoEvento = $_POST['Evento'];

        // Valido que el codigo no este vacio
        if($codigoEvento == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto la información de 3 eventos que esten activos y que pertenezcan a este usuario
            include('conexion.php');

            $eventosAdicionalesUsuario = $conn -> query("CALL sp_SeleccionarEventosAdicionalesUsuarioPoblacion('$codigoEvento')");

            mysqli_close($conn);

            return $eventosAdicionalesUsuario;
        }

    }

    // Función que consulta los eventos activos cuya categoria fue seleccionada
    function BuscarEventosActivosCategoria(){

        // Recupero el nombre de la categoria
        $categoria = $_REQUEST['categoria'];

        // Valido que la categoria no este vacia
        if($categoria == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto los eventos cuya categoria sea la seleccionada y que esten activos
            include('conexion.php');

            $eventosActivos = $conn -> query("CALL sp_SeleccionarEventosActivosCategoria('$categoria')");

            mysqli_close($conn);

            return $eventosActivos;
        }
    }

    // Función que consulta los eventos inactivos cuya categoria fue seleccionada
    function BuscarEventosInactivosCategoria(){

        // Recupero el nombre de la categoria
        $categoria = $_REQUEST['categoria'];

        // Valido que la categoria no este vacia
        if($categoria == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto los eventos cuya categoria sea la seleccionada y que esten inactivos
            include('conexion.php');

            $eventosInactivos = $conn -> query("CALL sp_SeleccionarEventosInactivosCategoria('$categoria')");

            mysqli_close($conn);

            return $eventosInactivos;
        }
    }

    // Función que consulta los eventos activos y que se encuentran entre el intervalo de fechas seleccionadas
    function BuscarEventosActivosFechas(){

        // Recupero las fechas ingresadas
        $fechaAntigua = $_POST['fechaAntigua'];
        $fechaReciente = $_POST['fechaReciente'];

        // Valido que las fechas concuerden y no esten vacias
        if($fechaAntigua > $fechaReciente && $fechaAntigua == null || $fechaReciente == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto los eventos que esten activos y cuyas fechas esten entre el intervalo seleccionado
            include('includes/conexion.php');

            $eventosActivos = $conn -> query("CALL sp_SeleccionarEventosActivosFechas('$fechaAntigua', '$fechaReciente')");

            mysqli_close($conn);

            return $eventosActivos;
        }
    }

    // Función que consulta los eventos inactivos y que se encuentran entre el intervalo de fechas seleccionadas
    function BuscarEventosInactivosFechas(){

        // Recupero las fechas ingresadas
        $fechaAntigua = $_POST['fechaAntigua'];
        $fechaReciente = $_POST['fechaReciente'];

        // Valido que las fechas concuerden y no esten vacias
        if($fechaAntigua > $fechaReciente && $fechaAntigua == null || $fechaReciente == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto los eventos que esten inactivos y cuyas fechas esten entre el intervalo seleccionado
            include('includes/conexion.php');

            $eventosInactivos = $conn -> query("CALL sp_SeleccionarEventosInactivosFechas('$fechaAntigua', '$fechaReciente')");

            mysqli_close($conn);

            return $eventosInactivos;
        }
    }

    // Función que consulta los eventos activos y que entre sus datos se encuentre alguna relación con la palabra ingresada
    function BuscarEventosActivosPalabra(){

        // Recupero el dato ingresado
        $palabra = $_POST['palabra'];

        if($palabra == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto los eventos que tengan cierta relacion con la palabra ingresada y que esten activos
            include('conexion.php');

            $eventosActivos = $conn -> query("CALL sp_SeleccionarEventosActivosPalabra('%$palabra%')");

            mysqli_close($conn);

            return $eventosActivos;
        }
    }

    // Función que consulta los eventos inactivos y que entre sus datos se encuentre alguna relación con la palabra ingresada
    function BuscarEventosInactivosPalabra(){

        // Recupero el dato ingresado
        $palabra = $_POST['palabra'];

        if($palabra == null){
            header('Location: index.php');
            die();
        }
        else{

            // Consulto los eventos que tengan cierta relacion con la palabra ingresada y que esten inactivos
            include('conexion.php');

            $eventosInactivos = $conn -> query("CALL sp_SeleccionarEventosInactivosPalabra('%$palabra%')");

            mysqli_close($conn);

            return $eventosInactivos;
        }
    }

    // Función que envia al correo administrativo los datos ingresados en el formulario de contacto
    function EnviarCorreoContacto(){

        require 'Phpmailer/Exception.php';
        require 'Phpmailer/PHPMailer.php';
        require 'Phpmailer/SMTP.php';

        // Recupero los datos ingresados en el formulario de contacto
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $mensaje = $_POST['mensaje'];

        // Valido que los datos ingresados no esten vacios
        if($nombre == null || $correo == null || $telefono == null || $mensaje == null){
            header('Location: index.php');
            die();
        }
        else{

            $body = "Nombre: " . $nombre . "<br>Correo: " . $correo . "<br>Teléfono: " . $telefono . "<br>Mensaje: " . $mensaje;

            // Realizo el envio del mail
            $mail = new PHPMailer(true);

            try {

            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                            

            // Servidor que se utilizara para enviar el correo
            $mail->Host       = 'smtp.gmail.com';                       
            $mail->SMTPAuth   = true;                                   

            // Permitir acceso a la cuenta administrativa
            $mail->Username   = 'eneventsceja@gmail.com';                     
            $mail->Password   = 'jeisonmi1';                               

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                                    

            // Correo y nombre que envia el correo
            $mail->setFrom($correo, $nombre);

            // Correo del administrativo que recibe el correo
            $mail->addAddress('eneventsceja@gmail.com');                

            $mail->isHTML(true);   

            // Asunto correo
            $mail->Subject = 'Formulario de Contacto Población';

            // Mensaje
            $mail->Body    = $body;
            $mail->CharSet = 'UTF-8';

            $mail->send();
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito!!',
                            html: 'El correo se ha enviado correctamente.',
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
                            title: 'ERROR!!',
                            html: 'El correo no se ha enviado. Verifique e intente nuevamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
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