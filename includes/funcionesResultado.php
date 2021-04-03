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

    // Función que consulta todos los resultados del evento seleccionado
    function ListarResultadosEvento($codEvento){

        include('conexion.php');

            $resultados = $conn -> query("CALL sp_ListarResultadosEvento('$codEvento')");

        mysqli_close($conn);

        return $resultados;

    }

    // Función que consulta el nombre y valor de entrada del evento seleccionado
    function NombreValorEventoInsertarResultado($codEvento){

        include('conexion.php');

            $evento = $conn -> query("CALL sp_NombreValorEventoInsertarResultado('$codEvento')");

        mysqli_close($conn);

        if($fila = $evento -> fetch_assoc()){}

        return $fila;
    }

    // Función que agrega un nuevo resultado
    function AgregarResultado($codEvento){

        // Recupero los datos ingresados en el formulario
        $valorEntrada = $_POST['valorEntrada'];
        $asistencia = $_POST['asistencia'];
        $costo = $_POST['costo'];
        $ingresosAdicionales = $_POST['ingresosadicionales'];
        $valoracion = $_POST['valoracion'];
        $descripcion = $_POST['descripcion'];

        include('conexion.php');

            $insertResultado = $conn -> query("CALL sp_AgregarResultado('$codEvento','$valorEntrada','$asistencia','$costo','$ingresosAdicionales','$valoracion','$descripcion')");

        mysqli_close($conn);

        if($insertResultado){
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!!',
                        html: 'El resultado se ha registrado correctamente.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    }).then(okay => {
                        if (okay) {
                            location.href = "selectResultadosEvento.php?cod=<?php print $codEvento ?>";
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
                        text: 'El resultado no se ha registrado. Verifique e intente nuevamente.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    });
                </script>
            <?php  
        }
    }

    // Función que consulta la información del resultado seleccionado
    function InformacionResultadoSeleccionUsuario($codResultado){

        include('conexion.php');

            $resultado = $conn -> query("CALL sp_InformacionResultadoSeleccionadoUsuario('$codResultado')");

        mysqli_close($conn);

        if($fila = $resultado -> fetch_assoc()){}

            // Formatos de moneda y fecha para los datos que lo requieren
            $fila['ValorEntrada'] = number_format($fila['ValorEntrada']);
            $fila['Costo'] = number_format($fila['Costo']);
            $fila['IngresosAdicionales'] = number_format($fila['IngresosAdicionales']);
            $fila['IngresosEntrada'] = number_format($fila['IngresosEntrada']);
            $fila['IngresosTotales'] = number_format($fila['IngresosTotales']);
            $fila['GananciaBruta'] = number_format($fila['GananciaBruta']);
            $fila['Valor'] = number_format($fila['Valor']);

            $fila['FechaHora'] = date_create($fila['FechaHora']);
            $fila['FechaHora'] = date_format($fila['FechaHora'], "d-m-Y g:i a");

        return $fila;
    }

    // Función que consulta la informacion del evento y del resultado seleccionado
    function InformacionResultadoSeleccionAdmin($codResultado){
        
        include('conexion.php');

            $resultado = $conn -> query("CALL sp_InformacionResultadoSeleccionadoAdmin('$codResultado')");

        mysqli_close($conn);

        if($fila = $resultado -> fetch_assoc()){}

            // Formatos de mondea, fecha y hora
            $fila['ValorEntrada'] = number_format($fila['ValorEntrada']);
            $fila['Costo'] = number_format($fila['Costo']);
            $fila['IngresosAdicionales'] = number_format($fila['IngresosAdicionales']);
            $fila['IngresosEntrada'] = number_format($fila['IngresosEntrada']);
            $fila['IngresosTotales'] = number_format($fila['IngresosTotales']);
            $fila['GananciaBruta'] = number_format($fila['GananciaBruta']);
            $fila['FechaHora'] = date_create($fila['FechaHora']);
            $fila['FechaHora'] = date_format($fila['FechaHora'], "d-m-Y g:i a");
            $fila['Valor'] = number_format($fila['Valor']);
            $fila['FechaHora_inicio'] = date_create($fila['FechaHora_inicio']);
            $fila['FechaHora_inicio'] = date_format($fila['FechaHora_inicio'], "d-m-Y g:i a");
            $fila['FechaHora_final'] = date_create($fila['FechaHora_final']);
            $fila['FechaHora_final'] = date_format($fila['FechaHora_final'], "d-m-Y g:i a");

        return $fila;
    }

    // Función que consulta la información disponible a modificar del resultado seleccionado
    function InformacionResultadoModificar($codResultado){

         include('conexion.php');

            $resultado = $conn -> query("CALL sp_InformacionResultadoModificar('$codResultado')");

        mysqli_close($conn);

        if($fila = $resultado -> fetch_assoc()){}

        return $fila;    
    }

    // Función que modifica el resultado
    function ModificarResultado($codResultado){

        // Recupero los datos del formulario
        $valorEntrada = $_POST['ValorEntrada'];
        $asistencia = $_POST['asistencia'];
        $costo = $_POST['costo'];
        $ingresosAdicionales = $_POST['ingresosadicionales'];
        $valoracion = $_POST['valoracion'];
        $descripcion = $_POST['descripcion'];

        include('conexion.php');
        
            $updateResultado = $conn -> query("CALL sp_ModificarResultado('$codResultado','$valorEntrada','$asistencia','$costo','$ingresosAdicionales','$valoracion','$descripcion')");

        mysqli_close($conn);

        if($updateResultado){
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito!!',
                        html: 'Los datos del resultado se han modificado correctamente.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    }).then(okay => {
                        if (okay) {
                            location.href = "selectInfoResultado.php?cod=<?php print $codResultado ?>";
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
                        text: 'Los datos del resultado no se han modificado. Verifique e intente nuevamente.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false
                    });
                </script>
            <?php 
        }
    }
    

?>

    <!-- Sweet alerts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>