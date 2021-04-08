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

    // Zona Horaria
    date_default_timezone_set('America/Bogota');

    $swValidarDatosEvento = false;

    // Función que rellena el select de categoria de los formularios de evento
    function ListarSelectCategoriaEvento(){

        include('conexion.php');

            $sqlCategoriaEvento = $conn -> query("CALL sp_ListarTodosCategoriasEvento()");
            $filasCategoriaEvento = mysqli_fetch_all($sqlCategoriaEvento, MYSQLI_ASSOC);

        mysqli_close($conn);

        return $filasCategoriaEvento;
    }

    // Función que rellena el select estado de los formularios de evento
    function ListarSelectEstadoEvento(){

        include('conexion.php');

            $sqlEstadoEvento = $conn -> query("CALL sp_ListarTodosEstadosEvento()");
            $filasEstadoEvento = mysqli_fetch_all($sqlEstadoEvento, MYSQLI_ASSOC);

        mysqli_close($conn);

        return $filasEstadoEvento;
    }

    // Función que valida los datos ingresados en el formulario del evento
    function ValidarDatosEvento($categoria, $nombre, $fhini, $fhfin, $lugar, $costo, $descripcion, $imgPost, $tamano_img){
        
        if($categoria == null || $nombre == null || $fhini == null || $fhfin == null || $lugar == null || $descripcion == null ){
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
                die();
        }
        else if(strlen($nombre) > 500){
            ?>
                <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'ADVERTENCIA!!',
                            html: 'El <b>Nombre</b> es demasiado largo.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: true
                        });
                </script>
            <?php
            die();
        }
        else if($imgPost != null){

            if($tamano_img > 300000){
                ?>
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'ADVERTENCIA!!',
                            html: 'La <b>Imagen</b> es demasiado pesada.<br>(Máx. 300 KB)',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: true
                        });
                    </script>
                <?php
                die(); 
            }
        }
        else if($fhini > $fhfin){
            ?>
                <script>
                        Swal.fire({
                        icon: 'warning',
                        title: 'ADVERTENCIA!!',
                        html: 'La <b>Fecha y Hora de Inicio</b> debe ser "Menor" a la <b>Fecha y Hora de Finalización</b>.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true
                    });
                </script>
            <?php
            die();
        }
        else if(strlen($lugar) > 100){
            ?>
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'ADVERTENCIA!!',
                        html: 'El <b>Lugar / Dirección</b> donde se realizará el evento es demasiado largo.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true
                    });
                </script>
            <?php
            die();
        }
        else if(!is_int($costo) || $costo < 0 || $costo > 99999999){
            ?>
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'ADVERTENCIA!!',
                        html: 'El <b>Costo</b> de entrada no es válido.<br><br><b>Nota:</b> Sólo valores númericos enteros positivos. (Mín. 0 / Máx. 99.999.999)',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true
                    });
                </script>
            <?php
            die();
        }
        else if(strlen($descripcion) > 3000){
            ?>
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'ADVERTENCIA!!',
                        html: 'La <b>Descripción</b> es demasiado larga.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true
                    });
                </script>
            <?php
            die();
        }  
    }

    // FUNCIONES MODULO USUARIO CREADOR

    // Función que consulta los eventos que pertenecen al usuario
    function ListarEventosUsuarioSesion($id, $estado){

        if($estado == "Activos"){

            include('conexion.php');

                $eventos = $conn -> query("CALL sp_ListarEventosActivosUsuarioSesion('$id')");

            mysqli_close($conn);

            return $eventos;
        }
        else if($estado == "Inactivos"){

            include('conexion.php');

                $eventos = $conn -> query("CALL sp_ListarEventosInactivosUsuarioSesion('$id')");

            mysqli_close($conn);

            return $eventos;
        }
        else if($estado == "Espera"){

            include('conexion.php');

                $eventos = $conn -> query("CALL sp_ListarEventosEsperaUsuarioSesion('$id')");

            mysqli_close($conn);

            return $eventos;
        }
        else{
            print   "<script>
                        alert('Seleccione alguna de las opciones primero.');
                        location.href = 'inicio.php';
                    </script>";
        }
    }

    // Función que trae la informaciín del evento seleccionado
    function InformacionEventoSeleccionadoUsuarioSesion($codigoEvento){

        include('conexion.php');

            $evento = $conn -> query("CALL sp_InformacionEventoSeleccionadoUsuarioSesion('$codigoEvento')");

        mysqli_close($conn);

        if($filaEvento = $evento -> fetch_assoc()){}

        return $filaEvento;
    }

    // Función que agrega el evento a la BD de acuerdo a los datos introducidos en el formulario
    function AgregarEventoUsuarioSesion($id){

        // Recupero los datos del formulario 
        $usuario = $id;
        $categoria = $_POST['categoria'];
        $nombre = $_POST['nombre'];
        $fhini = $_POST['fhinicio'];
        $fhfin = $_POST['fhfinal'];
        $lugar = $_POST['lugar'];
        $costo = $_POST['valor'];
        $descripcion = $_POST['descripcion'];

        $imgPost = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $tipo_img = $_FILES['imagen']['type']; 
        $tamano_img = $_FILES['imagen']['size'];  

        $rutaBD = "/Enevents/archivos/eventos/" . $imgPost; 
        $rutaServidor = $_SERVER["DOCUMENT_ROOT"] . "/Enevents/archivos/eventos/" . $imgPost;

        ValidarDatosEvento($usuario, $categoria, $nombre, $fhini, $fhfin, $lugar, $costo, $descripcion, $imgPost, $tamano_img);

            copy($archivo, $rutaServidor);

            include('conexion.php');

                $insertEvento = $conn -> query("CALL sp_AgregarEventoUsuarioSesion('$id', '$categoria', '$nombre', '$rutaBD', '$fhini', '$fhfin', '$lugar', '$costo', '$descripcion')");

            mysqli_close($conn);

            if($insertEvento){
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito!!',
                            html: 'El evento se ha registrado correctamente. Administración revisará los datos y lo activará si considera conveniente.<br><br><b>Nota: </b>Recuerda enviar al Correo xxx@xxx la documentación que se solícita.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = "selectEventos.php?Estado=Espera";
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
                            text: 'El evento no se ha registrado. Verifique e intente nuevamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        });
                    </script>
                <?php 
            } 
    }

    // Función que trae la información del evento a modificar
    function InformacionEventoModificar($codEvento){

        include('conexion.php');

            $infoEvento = $conn -> query("CALL sp_InformacionEventoUsuarioSesionModificar('$codEvento')");
            if($filaEvento = $infoEvento -> fetch_assoc()){}

        mysqli_close($conn);

        return $filaEvento;

    }

    // Función que modifica la información del evento en la BD
    function ModificarEventoUsuarioSesion($codEvento, $id){

        // Recupero los datos del formulario
        $categoria = $_POST['categoria'];
        $nombre = $_POST['nombre'];
        $fhini = $_POST['fhinicio'];
        $fhfin = $_POST['fhfinal'];
        $lugar = $_POST['lugar'];
        $costo = $_POST['valor'];
        $descripcion = $_POST['descripcion'];

        $imgPost = $_FILES['imagen']['name']; 
        $archivo = $_FILES['imagen']['tmp_name']; 
        $rutaBD = "/Enevents/archivos/eventos/" . $imgPost; 
        $rutaServidor = $_SERVER["DOCUMENT_ROOT"] . "/Enevents/archivos/eventos/" . $imgPost; 
        
        // ValidarDatosEvento($categoria, $nombre, $fhini, $fhfin, $lugar, $costo, $descripcion, $imgPost, $tamano_img);

        if($imgPost == ""){

            include('conexion.php');

                $updateEvento = $conn -> query("CALL sp_ModificarInformacionEventoSinImagenUsuarioSesion('$codEvento','$id','$categoria','$nombre','$fhini','$fhfin','$lugar','$costo','$descripcion')");

            mysqli_close($conn);
        }
        else{
            
            copy($archivo, $rutaServidor);

            include('conexion.php');

                $updateEvento = $conn -> query("CALL sp_ModificarInformacionEventoConImagenUsuarioSesion ('$codEvento','$id','$categoria','$nombre','$rutaBD','$fhini','$fhfin','$lugar','$costo','$descripcion')");

            mysqli_close($conn);
        }

        if($updateEvento){
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!!',
                        html: 'Los datos se han modificado correctamente.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    }).then(okay => {
                        if (okay) {
                            location.href = "selectInfoEvento.php?cod=<?php print $codEvento ?>";
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
                        text: 'Los datos no se han modificado. Verifique e intente nuevamente',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    });
                </script>
            <?php  
        }
    }

    // Función que dependiendo de la opcion seleccionado modifica el estado del evento
    function GestionarEstadoEventoUsuarioSesion($codigo){

        $tipoSolicitud = $_POST['tipoSolicitud'];

        if($codigo == null || $tipoSolicitud == null){
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ERROR!!',
                        html: 'Verifique e intente nuevamente',
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

                    $update = $conn -> query("CALL sp_ModificarEstadoEventoEspera('$codigo')");

                mysqli_close($conn);

                if($update){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'Se ha enviado la solicitud para <b>Activar</b> el evento. Administración revisará la información y activará el evento si cumple con las regulaciones.<br><br><b>Importante:</b> Recuerda enviar al Correo xxx@xxx la documentación que se solícita.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
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
                                html: 'Verifique e intente nuevamente',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
                                }
                            });
                        </script>
                    <?php 
                }
            }
            else if($tipoSolicitud == "Desactivar"){

                include('conexion.php');

                    $update = $conn -> query("CALL sp_ModificarEstadoEventoInactivo('$codigo')");

                mysqli_close($conn);

                if($update){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'El evento se ha <b>Desactivado</b> correctamente ¿Desea agregar los resultados obtenidos ahora?<br><br><b>Nota:</b> Puede agregar los resultados más tarde.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false,
                                confirmButtonText: 'Agregar Resultados',
                                showCancelButton: true,
                                cancelButtonText: 'Agregar más Tarde',
                            }).then(result => {
                                if (result.isConfirmed) {
                                    location.href = "insertResultado.php?cod=<?php print $codigo ?>";
                                }else{
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
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
                                title: 'ERROR!!',
                                html: 'Verifique e intente nuevamente',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
                                }
                            });
                        </script>
                    <?php 
                }
            }
            else if($tipoSolicitud == "Cancelar"){

                include('conexion.php');

                    $update = $conn -> query("CALL sp_ModificarEstadoEventoEliminar('$codigo')");

                mysqli_close($conn);

                if($update){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'El evento se ha <b>Cancelado</b> correctamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectEventos.php?Estado=Espera";
                                }
                            });
                        </script>
                    <?php         
                }
                else{

                    include('conexion.php');

                        $update = $conn -> query("CALL sp_ModificarEstadoEventoInactivo('$codigo')");

                    mysqli_close($conn);
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'info',
                                title: 'Información!!',
                                html: 'El evento <b>No</b> se puede cancelar, por ende sólo se <b>Desactivará</b>.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
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
                            html: 'Verifique e intente nuevamente',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
                            }
                        });
                    </script>
                <?php 
            }
        }
    }

    // FUNCIONES MODULO ADMINISTRATIVO

    // Función que agrega un nuevo evento
    function AgregarEventoAdmin($usuario){

        if($usuario == "" || $usuario == null){
            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
        }
        else{

            // Recupero los datos del formulario
            $categoria      = $_POST['categoria'];
            $nombre         = $_POST['nombre'];
            $fhini          = $_POST['fhinicio'];
            $fhfin          = $_POST['fhfinal'];
            $lugar          = $_POST['lugar'];
            $costo          = $_POST['valor'];
            $descrip        = $_POST['descripcion'];
            $estado         = $_POST['estado'];

            $imgPost        = $_FILES['imagen']['name']; 
            $archivo        = $_FILES['imagen']['tmp_name']; 
            $rutaBD         = "/Enevents/archivos/eventos/" . $imgPost; 
            $rutaServidor   = $_SERVER["DOCUMENT_ROOT"] . "/Enevents/archivos/eventos/" . $imgPost; 

            copy($archivo, $rutaServidor);

            include('conexion.php');

                $insertEvento = $conn -> query("CALL sp_AgregarEventoAdmin('$usuario','$categoria','$nombre','$rutaBD','$fhini','$fhfin ','$lugar','$costo ','$descrip','$estado')");

            mysqli_close($conn);

            if($insertEvento){
                ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito!!',
                            html: 'El evento se ha registrado correctamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = "selectEventosUsuario.php?id=<?php print $usuario ?>";
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
                            text: 'El evento no se ha registrado. Verifique e intente nuevamente.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        });
                    </script>
                <?php 
            }    
        }
    }

    // Función que consulta los eventos segun su estado
    function ListarEventosAdmin($estado){

        if($estado == "Activos"){

            $titulo = "Eventos Activos";

            include('conexion.php');

                // REALIZO CONSULTA DE ACUERDO AL ESTADO DEL EVENTO
                $eventos = $conn -> query("CALL sp_ListarEventosActivos()");

            mysqli_close($conn);

            return array($eventos, $titulo);
        }
        else if($estado == "Inactivos"){

            $titulo = "Eventos Inactivos";

            include('conexion.php');

                $eventos = $conn -> query("CALL sp_ListarEventosInactivos()");

            mysqli_close($conn);

            return array($eventos, $titulo);
        }
        else if($estado == "Espera"){

            $titulo = "Eventos que han Solicitado Aprobación para Activarse";

            include('conexion.php');

                $eventos = $conn -> query("CALL sp_ListarEventosEspera()");

            mysqli_close($conn);

            return array($eventos, $titulo);
        }
        else{
            print   "<script>
                        alert('Seleccione alguna de las opciones de Evento primero.');
                        location.href = 'inicio.php';
                    </script>";
        }
    }

    // Función que consulta el nombre y apellidos del usuario seleccionado
    function NombreUsuarioSeleccionEventos($documento){

        include('conexion.php');

            $nombreUsuario = $conn  -> query("CALL sp_BuscarNombreUsuarioSeleccion('$documento')");
            if($row = $nombreUsuario -> fetch_assoc()){}

        mysqli_close($conn);

        return $row;
    }

    // Función que consulta los eventos activos del usuario seleccionado
    function ListarEventosActivosUsuarioSeleccionAdmin($documento){

        include('conexion.php');

            $eventos = $conn -> query("CALL sp_ListarEventosActivosUsuarioSeleccion('$documento')");

        mysqli_close($conn);

        return $eventos;
    }

    // Función que consulta los eventos inactivos del usuario seleccionado
    function ListarEventosInactivosUsuarioSeleccionAdmin($documento){

        include('conexion.php');

            $eventos = $conn -> query("CALL sp_ListarEventosInactivosUsuarioSeleccion('$documento')");

        mysqli_close($conn);

        return $eventos;
    }

    // Función que consulta los eventos en espera del usuario seleccionado
    function ListarEventosEsperaUsuarioSeleccionAdmin($documento){

        include('conexion.php');

            $eventos = $conn -> query("CALL sp_ListarEventosEsperaUsuarioSeleccion('$documento')");

        mysqli_close($conn);

        return $eventos;
    }

    // Función que consulta la informacion del evento seleccionado
    function InformacionEventoSeleccionadoAdmin($codEvento){

        include('conexion.php');

            $infoEvento = $conn -> query("CALL sp_InformacionEventoSeleccionadoAdmin('$codEvento')");
            if($filaEvento = $infoEvento -> fetch_assoc()){}

        mysqli_close($conn);

        // Formatos de valor, fecha y hora
        $filaEvento['Valor'] = number_format($filaEvento['Valor']);
        $filaEvento['FechaHora_inicio'] = date_create($filaEvento['FechaHora_inicio']);
        $filaEvento['FechaHora_inicio'] = date_format($filaEvento['FechaHora_inicio'], "d-m-Y g:i a");
        $filaEvento['FechaHora_final'] = date_create($filaEvento['FechaHora_final']);
        $filaEvento['FechaHora_final'] = date_format($filaEvento['FechaHora_final'], "d-m-Y g:i a");

        return $filaEvento;
    }

    // Función que recupera los datos del evento previamente seleccionado
    function InformacionEventoModificarAdmin($codEvento){

        include('conexion.php');

            $infoEvento = $conn -> query("CALL sp_InformacionEventoModificarAdmin('$codEvento')");
            if($filaEvento = $infoEvento -> fetch_assoc()){}

        mysqli_close($conn);

        return $filaEvento;

    }

    // Función que modifica los datos del evento que fue seleccionado
    function ModificarEventoAdmin($idAdmin, $codEvento){

        if($idAdmin == null || $idAdmin == ""){

            print   "<script>
                        alert('DEBES INICIAR SESIÓN PRIMERO');
                        location.href = '../iniciarSesion.php';
                    </script>";
        }
        else{

            // Recupero los datos del formulario
            $categoria      = $_POST['categoria'];
            $nombre         = $_POST['nombre'];
            $fhini          = $_POST['fhinicio'];
            $fhfin          = $_POST['fhfinal'];
            $lugar          = $_POST['lugar'];
            $costo          = $_POST['valor'];
            $descrip        = $_POST['descripcion'];
            $estado         = $_POST['estado'];

            $imgPost        = $_FILES['imagen']['name']; 
            $archivo        = $_FILES['imagen']['tmp_name']; 
            $rutaBD         = "/Enevents/archivos/eventos/" . $imgPost; 
            $rutaServidor   = $_SERVER["DOCUMENT_ROOT"] . "/Enevents/archivos/eventos/" . $imgPost; 

            if($imgPost == "" || $imgPost == null){

                include('conexion.php');

                    $update = $conn -> query("CALL sp_ModificarEventoSinImagenAdmin('$codEvento','$categoria','$nombre','$fhini','$fhfin','$lugar','$costo','$descrip','$estado')");

                mysqli_close($conn);
            }
            else{

                copy($archivo, $rutaServidor);

                include('conexion.php');

                    $update = $conn -> query("CALL sp_ModificarEventoConImagenAdmin('$codEvento','$categoria','$nombre','$rutaBD','$fhini','$fhfin','$lugar','$costo','$descrip','$estado')");

                mysqli_close($conn);
            }

            if ($update) {
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
                                location.href = "selectInfoEvento.php?cod=<?php print $codEvento ?>";
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

    // Función que gestiona los estados del evento seleccionado
    function GestionarEstadoEventoAdmin($codigo){

        $tipoSolicitud = $_POST['tipoSolicitud'];

        if($codigo == null || $tipoSolicitud == null){
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

                    $update = $conn -> query("CALL sp_ModificarEstadoEventoActivar('$codigo')");

                mysqli_close($conn);

                if($update){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'El evento se ha <b>Activado</b> correctamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
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
                                html: 'El evento no se ha <b>Activado</b>. Verifique e intente nuevamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
                                }
                            });
                        </script>
                    <?php         
                }

            }
            else if($tipoSolicitud == "Desactivar"){

                include('conexion.php');

                    $update = $conn -> query("CALL sp_ModificarEstadoEventoInactivo('$codigo')");

                mysqli_close($conn);

                if($update){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'El evento se ha <b>Desactivado</b> correctamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
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
                                html: 'El evento no se ha <b>Desactivado</b>. Verifique e intente nuevamente.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
                                }
                            });
                        </script>
                    <?php  
                }

            }
            else if($tipoSolicitud == "Cancelar"){

                include('conexion.php');

                    $update = $conn -> query("CALL sp_ModificarEstadoEventoEliminar('$codigo')");

                mysqli_close($conn);

                if($update){
                    ?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito!!',
                                html: 'Se ha <b>Rechazado</b> la solicitud del evento.',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            }).then(okay => {
                                if (okay) {
                                    location.href = "selectEventos.php?Estado=Espera";
                                }
                            });
                        </script>
                    <?php 
                }
                else{

                    include('conexion.php');

                        $update = $conn -> query("CALL sp_ModificarEstadoEventoInactivo('$codigo')");

                    mysqli_close($conn);

                    ?>
                    <script>
                        Swal.fire({
                            icon: 'info',
                            title: 'Información!!',
                            html: 'El evento no se puede <b>Rechazar</b> puesto que cuenta con resultados. Por ende se <b>Desactivará</b>.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then(okay => {
                            if (okay) {
                                location.href = "selectInfoEvento.php?cod=<?php print $codigo ?>";
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
                                location.href = "inicio.php";
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